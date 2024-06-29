<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index() {
        $recommended_menus = Menu::withCount('detailPesanans')->orderByDesc('detail_pesanans_count')->take(4)->get();
        $title = 'Beranda';
        return view("pelanggan.beranda", compact('recommended_menus','title'));
    }

    public function menu(){
        $cart = session()->get('cart', []);
        $menus = Menu::with('category')
                ->orderBy('ketersediaan', 'desc') 
                ->orderBy('id_kategori') // Urutkan berdasarkan ID kategori
                ->orderBy('nama') // Kemudian urutkan berdasarkan nama menu (ascending)
                ->get();
        $title = 'Menu';
        return view('pelanggan.menu', compact('menus','title'));
    }

    public function cart($lastCart = []){
        $carts = session()->get('cart', []);
        $lastCart = session()->get('lastCart', []);
        $no_meja = session()->get('nomorMeja', 0);
        $totalPrice = 0;
        $title = 'Keranjang';
        
        foreach ($carts as $item) {
            $totalPrice += $item['total_price'];
        }
        session()->put('totalPrice', $totalPrice);

        return view('pelanggan.cart', compact('carts', 'no_meja', 'lastCart','title'));
    }

    public function addCart(Request $request, $menu_id){

        $validatedData = $request->validate([
            'nama_menu' => 'required',
            'kuantitas' => 'required|integer|min:1|max:10|',
        ]);
    
        $menu = Menu::find($menu_id);
        if(!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan');
        }
    
        $cart = session()->get('cart', []);
    
        // Check if the item with the same name already exists in the cart
        $existingItem = collect($cart)->first(function ($item) use ($validatedData) {
            return $item['name'] === $validatedData['nama_menu'];
        });
    
        if ($existingItem) {
           
            if ($existingItem['quantity'] + $validatedData['kuantitas'] > 10) {
                session()->flash('add-cart-over', 'Pesanan menu dengan nama yang sama tidak dapat  lebih dari 10');
                return redirect()->back();
                
            }
    
            
            $cart[$existingItem['menu_id']]['quantity'] += $validatedData['kuantitas'];
            $cart[$existingItem['menu_id']]['total_price'] = $cart[$existingItem['menu_id']]['price'] * $cart[$existingItem['menu_id']]['quantity'];
        } else {
            // If the item does not exist in the cart, add it
            $cart[$menu_id] = [
                'menu_id' => $menu_id,
                'name' => $validatedData['nama_menu'],
                'price' => $menu->harga,
                'quantity' => $validatedData['kuantitas'],
                'total_price' => $menu->harga * $validatedData['kuantitas'], 
            ];
        }
    
        session()->put('cart', $cart);
        session()->flash('add-cart-successfully', 'Item berhasil ditambahkan ke keranjang');
    
        return redirect()->back();
    }


    public function removeItem($order_id) {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$order_id])) {
            unset($cart[$order_id]); 
        }
    
        session()->put('cart', $cart);
        session()->flash('remove-cart-successfully', 'Item berhasil dihapus dari keranjang');
    
        return redirect()->back();
    }

    public function checkoutOrder(Request $request){
        $validatedData = $request->validate([
            'total_harga' => 'required|numeric',
            'nomor_meja' => 'required|numeric',
            'nomor_phone' => 'required|string',
            'nama_pemesan' => 'required|string',
        ]);
        $carts = session()->get('cart', []);
        $new_pesanan = new Pesanan();

        $new_pesanan->no_meja = $validatedData['nomor_meja'];
        $new_pesanan->nama_pemesan = $validatedData['nama_pemesan'];
        $new_pesanan->nomor_phone = $validatedData['nomor_phone'];
        $new_pesanan->total_harga = $validatedData['total_harga'];
        $new_pesanan->metode = 'qris';
        $new_pesanan->status = 'batal';
        $new_pesanan->save();

        foreach ($carts as $index => $cart) {
            $menu = Menu::select('id')->where('nama', $cart['name']);

            DetailPesanan::create([
                'id_menu' => $menu->first()->id,
                'id_pesanan' => $new_pesanan->id, 
                'kuantitas' => $cart['quantity'],
                'total_harga' => $cart['total_price'],
            ]);
        }
        
        session()->get('lastCart', $carts);
        $totalPrice = session()->put('totalPrice');
        $no_meja =  session()->put('nomorMeja', $new_pesanan->no_meja);
        session()->forget('cart');
        session()->forget('totalPrice');
        
        session()->flash('checkout-order-successfully', 'Terima kasih sudah memesan di Warmindo Aroma');

        if (Auth::user()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('pelanggan.cart')->with([
            'no_meja' => $no_meja,
            'lastCart' => $carts,
            'totalPrice' => $totalPrice
        ]);


    }

}
