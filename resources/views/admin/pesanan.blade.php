@extends("layouts.admin")
@section("content")
@push("styles")
    <link href="{{ asset("admin/vendor/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet">
@endpush
@section("content")
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Pesanan</h6>
        </div>
        
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="md-8">
                    <a href="{{route('pelanggan.menu')}}" class="btn btn btn-primary text-orange-500 rounded-pill px-3" style="background-color: black">
                        <img src="{{ asset("svg/plus.svg") }}" class="mr-3">
                        <span>Tambah</span>
                    </a>
                </div>
                <div class="md-8">
                    <label for="filterStatus">Filter Status</label>
                    <select id="filterStatus" class="form-select mb-3">
                        <option value="">Semua</option>
                        <option value="Belum Bayar">Belum Bayar</option>
                        <option value="proses">Proses</option>
                        <option value="sukses">Sukses</option>
                    </select>
                </div>
            </div>    
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Nomor Meja</th>
                            <th>Daftar Pesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Nomor Telp. Pemesan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Total </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $pesanan->no_meja }}</td>
                                <td class="text-start">
                                    @foreach ($pesanan->detailPesanan as $menu)
                                        <li>{{$menu->menu->nama . ' ('.$menu->kuantitas.' item)     ' . '(Rp '. number_format($menu->menu->harga, 0, '.','.').')'}}</li>
                                    @endforeach
                                </td>
                                <td>{{ $pesanan->nama_pemesan }}</td>
                                <td>{{ $pesanan->nomor_phone }}</td>
                                <td style="font-size: 14px">{{\Carbon\Carbon::parse($pesanan->created_at)->addHours(7)->isoFormat('D MMMM YYYY HH:mm').' WIB'}}</td>
                                <td>{{ "Rp " . number_format($pesanan->total_harga, 0, ".", ".") }}</td>
                                <td>
                                    <h5>
                                        <span class="badge text-white bg-{{ $pesanan->status == 'proses' ? 'warning' : ($pesanan->status == 'sukses' ? 'success' : 'danger') }}">
                                            {{ $pesanan->status == 'batal' ? 'Belum Bayar' : Str::of($pesanan->status)->apa() }}
                                        </span>
                                    </h5>
                                </td>
                                <td>
                                    <div class="d-flex flex-row gap-3 justify-items-center align-content-center justify-content-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPesananModal{{$pesanan->id}}">Edit</button>
                                        <div class="modal fade" id="editPesananModal{{$pesanan->id}}" tabindex="-1"
                                            aria-labelledby="editPesananModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('admin.update.status.order', ['pesanan_id' => $pesanan->id])}}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editPesananModalLabel">Edit Status Pesanan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_pemesan" class="form-label">Nama Pemesan|Meja</label>
                                                                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" value="{{$pesanan->nama_pemesan.' ( Meja No.'.$pesanan->no_meja.' )'}}" readOnly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status Pesanan</label>
                                                                <select class="form-select" aria-label="Default select example" name="status" required>
                                                                    @foreach ([ 'batal', 'proses', 'sukses'] as $status)
                                                                        @if ($status === 'batal')
                                                                            <option value="{{ $status }}" @if ($pesanan->status === $status) selected @endif>Belum Bayar</option>
                                                                        @else
                                                                            <option value="{{ $status }}" @if ($pesanan->status === $status) selected @endif>{{ Str::of($status)->apa() }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Ubah Status</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="delete_pesanan_{{ $pesanan->id }}"
                                            action="{{ route('admin.delete.pesanan', ['id' => $pesanan->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="showAlert({{ $pesanan->id }}, '{{ $pesanan->nama_pemesan }}')" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset("admin/vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset("admin/vendor/jquery-easing/jquery.easing.min.js") }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset("admin/js/sb-admin-2.min.js") }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset("admin/vendor/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("admin/vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset("admin/js/demo/datatables-demo.js") }}"></script>
    @if (session()->has("delete-pesanan-successfully"))
        @php
            $message = session()->get("delete-pesanan-successfully"); // Mengambil pesan dari sesi
        @endphp
        <script>
            Swal.fire({
                title: "Hapus Pesanan Sukses!",
                text: "{{ addslashes($message) }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session()->has("update-pesanan-successfully"))
        @php
            $message = session()->get("update-pesanan-successfully"); // Mengambil pesan dari sesi
        @endphp
        <script>
            Swal.fire({
                title: "Kelola Pesanan Sukses!",
                text: "{{ addslashes($message) }}",
                icon: "success"
            });
        </script>
    @endif
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable(); // Inisialisasi DataTable
            
            $('#filterStatus').on('change', function () {
                var selectedCategory = $(this).val(); // Ambil nilai dari select
                if (selectedCategory === '') {
                    table.column(6).search('').draw(); // Jika "Semua" dipilih, reset filter
                } else {
                    table.column(6).search(selectedCategory).draw(); // Terapkan filter
                }
            });
        });
    </script>
    <script>
        function showAlert(id, namaPemesan) {
            Swal.fire({
                title: `Anda yakin ingin menghapus pesanan ${namaPemesan}?`,
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, hapus",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete_pesanan_${id}`).submit();
                }
            });
        }
    </script>
    <script>
        // Script untuk mengendalikan sidebar
        $(document).ready(function() {
            $('#sidebarToggleTop').on('click', function() {
                $('body').toggleClass('sidebar-toggled');
                $('.sidebar').toggleClass('toggled');
                if ($('.sidebar').hasClass('toggled')) {
                    $('.sidebar .collapse').collapse('hide');
                }
            });
        });
    </script>
    
@endpush
