<?php
namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function pesanan()
    {
        $pesanans = Pesanan::with(['menus','detailPesanan'])->get();
        $menus = Menu::all();
        return view('admin.pesanan', compact('pesanans','menus'));
    }
    public function menu()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }
    public function addPesanan(Request $request){
        $validatedData = $request->validate([
            'nama_pemesan' => 'required|string|min:3|max:255',  
            'nomor_phone' => 'required|string',  
            'no_meja' => 'required|integer|min:1|max:1000',     
            'makanan-select' => 'required|exists:menus,id',   
            'makanan_quantity' => 'required|integer|min:1',      
            'minuman-select' => 'required|exists:menus,id',   
            'minuman_quantity' => 'required|integer|min:1',      
            'camilan-select' => 'required|exists:menus,id',   
            'camilan_quantity' => 'required|integer|min:1',      
        ]);
        $pesanan = new Pesanan;
        $pesanan->nama_pemesan = $validatedData['nama_pemesan'];
        $pesanan->nomor_phone = $validatedData['nomor_phone'];
        $pesanan->no_meja = $validatedData['no_meja'];
        $pesanan->metode = 'qris';
        $pesanan->status = 'proses';
        $hargaMakanan = Menu::select('harga')->where('id', $validatedData['makanan-select'])->first()->harga * $validatedData['makanan_quantity'];
        $hargaMinuman = Menu::select('harga')->where('id', $validatedData['minuman-select'])->first()->harga * $validatedData['minuman_quantity'];
        $hargaCamilan = Menu::select('harga')->where('id', $validatedData['camilan-select'])->first()->harga * $validatedData['camilan_quantity'];
        $pesanan->total_harga = $hargaCamilan+$hargaMakanan+$hargaMinuman;
        $pesanan->save();
        $menus = [];

        if ($request->input('makanan-select') != 'Pilih makanan') {
            $hargaMakanan = Menu::select('harga')->where('id', $request->input('makanan-select'))->first()->harga * $validatedData['makanan_quantity'];
            $pesanan->total_harga += $hargaMakanan;
            $menus[] = [
                'id' => $request->input('makanan-select'),
                'kuantitas' => $validatedData['makanan_quantity'],
                'total_harga' => $hargaMakanan,
            ];
        }
        
        if ($request->input('minuman-select') != 'Pilih minuman') {
            $hargaMinuman = Menu::select('harga')->where('id', $request->input('minuman-select'))->first()->harga * $validatedData['minuman_quantity'];
            $pesanan->total_harga += $hargaMinuman;
            $menus[] = [
                'id' => $request->input('minuman-select'),
                'kuantitas' => $validatedData['minuman_quantity'],
                'total_harga' => $hargaMinuman,
            ];
        }
        
        if ($request->input('camilan-select') != 'Pilih camilan') {
            $hargaCamilan = Menu::select('harga')->where('id', $request->input('camilan-select'))->first()->harga * $validatedData['camilan_quantity'];
            $pesanan->total_harga += $hargaCamilan;
            $menus[] = [
                'id' => $request->input('camilan-select'),
                'kuantitas' => $validatedData['camilan_quantity'],
                'total_harga' => $hargaCamilan,
            ];
        }
        
        foreach ($menus as $menu) {
            DetailPesanan::create([
                'id_menu' => $menu['id'],
                'id_pesanan' => $pesanan->id, 
                'kuantitas' => $menu['kuantitas'],
                'total_harga' => $menu['total_harga'],
            ]);
        }
        return redirect()->back();
    }
    public function updateMenu(Request $request, $id_menu){
        $rules = [
            'nama' => 'required|max:255',
            
            'ketersediaan' => 'required|in:1,0',  
        ];
        $validatedData = $request->validate($rules);
        $updateData = [
            'nama' => $validatedData['nama'],
            
            'ketersediaan' => $validatedData['ketersediaan'],
        ];
        if ($request->hasFile('gambar')) {
            $imageRules = [
                'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'  
            ];
            $request->validate($imageRules);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/menu', $filename);
            $publicFilePath = str_replace('public/', '', $filePath);
            $updateData['gambar'] = $publicFilePath;
            
            $publicStoragePath = 'storage/menu/' . $filename;
            $storedFilePath = storage_path('app/' . $filePath);
            copy($storedFilePath, public_path($publicStoragePath));

        }
        Menu::where('id', $id_menu)->update($updateData);
        Session::flash('update-menu-successfully', 'Data Menu Berhasil Berubah!');
        return redirect()->back();
    }


    public function updateStatusPesanan(Request $request, $pesanan_id)
{
    $validatedData = $request->validate([
        'nama_pemesan' => 'required|string',
        'status' => 'required|in:proses,sukses,batal'
    ]);

    // Ambil pesanan berdasarkan $pesanan_id
    $pesanan = Pesanan::findOrFail($pesanan_id);

    // Update status pesanan
    $pesanan->status = $validatedData['status'];
    $pesanan->save();

    // Ambil nama pemesan dari data yang divalidasi
    $nama_pemesan = $validatedData['nama_pemesan'];

    // Buat pesan flash dengan nama pemesan yang berhasil diubah statusnya
    Session::flash('update-pesanan-successfully', 'Status Pesanan ' . $nama_pemesan . ' Berhasil Diubah!');

    return redirect()->back();
}

    public function destroyPesanan($id){
        // Temukan pesanan berdasarkan ID bersama dengan detail pesanannya
        $pesanan = Pesanan::with('detailPesanan')->find($id);

        if ($pesanan) {
            // Hapus detail pesanan terlebih dahulu
            $pesanan->detailPesanan()->delete();

            // Hapus pesanan itu sendiri
            $pesanan->delete();
        }

        Session::flash('delete-pesanan-successfully', 'Data Pesanan Berhasil Dihapus!');
        return redirect()->back();
    }
}
