@extends("layouts.admin")
@section("content")
@hasanyrole('admin')
    <div class="text-start">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex flex-row">
                    <div class="card text-white h-50 mr-3" style="width: 15rem; background-color: #FF8F0B">
                        <div class="card-body">
                            <svg class="my-3" width="35" height="35" viewBox="0 0 35 35" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="17.5" cy="17.5" r="17.5" fill="black" fill-opacity="0.1" />
                                <g clip-path="url(#clip0_751_255)">
                                    <path
                                        d="M16.9873 4.5C10.0873 4.5 4.4873 10.1 4.4873 17C4.4873 23.9 10.0873 29.5 16.9873 29.5C23.8873 29.5 29.4873 23.9 29.4873 17C29.4873 10.1 23.8873 4.5 16.9873 4.5ZM21.4998 12.425C22.8373 12.425 23.9123 13.5 23.9123 14.8375C23.9123 16.175 22.8373 17.25 21.4998 17.25C20.1623 17.25 19.0873 16.175 19.0873 14.8375C19.0748 13.5 20.1623 12.425 21.4998 12.425ZM13.9998 10.45C15.6248 10.45 16.9498 11.775 16.9498 13.4C16.9498 15.025 15.6248 16.35 13.9998 16.35C12.3748 16.35 11.0498 15.025 11.0498 13.4C11.0498 11.7625 12.3623 10.45 13.9998 10.45ZM13.9998 21.8625V26.55C10.9998 25.6125 8.6248 23.3 7.5748 20.35C8.8873 18.95 12.1623 18.2375 13.9998 18.2375C14.6623 18.2375 15.4998 18.3375 16.3748 18.5125C14.3248 19.6 13.9998 21.0375 13.9998 21.8625ZM16.9873 27C16.6498 27 16.3248 26.9875 15.9998 26.95V21.8625C15.9998 20.0875 19.6748 19.2 21.4998 19.2C22.8373 19.2 25.1498 19.6875 26.2998 20.6375C24.8373 24.35 21.2248 27 16.9873 27Z"
                                        fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_751_255">
                                        <rect width="30" height="30" fill="white" transform="translate(2 2)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <h5 class="card-title font-weight-bold">Total Pesanan</h5>
                            <p class="card-text" style="font-size: 24px">{{count($pesanans)}}</p>
                        </div>
                    </div>
                    <div class="card text-white h-50 mr-3" style="width: 15rem; background-color: #FF8F0B">
                        <div class="card-body">
                            <svg class="my-3" width="35" height="35" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_751_245)">
                                    <path
                                        d="M26.25 6.25C24.8625 5.8125 23.3375 5.625 21.875 5.625C19.4375 5.625 16.8125 6.125 15 7.5C13.1875 6.125 10.5625 5.625 8.125 5.625C5.6875 5.625 3.0625 6.125 1.25 7.5V25.8125C1.25 26.125 1.5625 26.4375 1.875 26.4375C2 26.4375 2.0625 26.375 2.1875 26.375C3.875 25.5625 6.3125 25 8.125 25C10.5625 25 13.1875 25.5 15 26.875C16.6875 25.8125 19.75 25 21.875 25C23.9375 25 26.0625 25.375 27.8125 26.3125C27.9375 26.375 28 26.375 28.125 26.375C28.4375 26.375 28.75 26.0625 28.75 25.75V7.5C28 6.9375 27.1875 6.5625 26.25 6.25ZM26.25 23.125C24.875 22.6875 23.375 22.5 21.875 22.5C19.75 22.5 16.6875 23.3125 15 24.375V10C16.6875 8.9375 19.75 8.125 21.875 8.125C23.375 8.125 24.875 8.3125 26.25 8.75V23.125Z"
                                        fill="black" />
                                    <path
                                        d="M21.875 13.125C22.975 13.125 24.0375 13.2375 25 13.45V11.55C24.0125 11.3625 22.95 11.25 21.875 11.25C19.75 11.25 17.825 11.6125 16.25 12.2875V14.3625C17.6625 13.5625 19.625 13.125 21.875 13.125Z"
                                        fill="black" />
                                    <path
                                        d="M16.25 15.6125V17.6875C17.6625 16.8875 19.625 16.45 21.875 16.45C22.975 16.45 24.0375 16.5625 25 16.775V14.875C24.0125 14.6875 22.95 14.575 21.875 14.575C19.75 14.575 17.825 14.95 16.25 15.6125Z"
                                        fill="black" />
                                    <path
                                        d="M21.875 17.9126C19.75 17.9126 17.825 18.2751 16.25 18.9501V21.0251C17.6625 20.2251 19.625 19.7876 21.875 19.7876C22.975 19.7876 24.0375 19.9001 25 20.1126V18.2126C24.0125 18.0126 22.95 17.9126 21.875 17.9126Z"
                                        fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_751_245">
                                        <rect width="30" height="30" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <h5 class="card-title font-weight-bold text-wrap" >Total Menu</h5>
                            <p class="card-text" style="font-size: 24px">{{count($menus)}}</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column mt-4">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menu Rekomendasi</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body shadow animated--grow-in p-3" aria-labelledby="alertsDropdown">
                            @foreach ($recomendations->take(4) as $recom)
                                
                            <a class="d-flex align-items-center mb-4">
                                <div class="mr-3">
                                    <div class="icon-circle text-white bg-success">
                                        {{$loop->iteration}}
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{$recom->jumlah}} Pesanan</div>
                                    <span class="font-weight-bold">{{$recom->menu->nama}}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <a href="{{route('pelanggan.menu')}}" class="btn btn btn-primary text-orange-500 rounded-pill px-3" style="background-color: black">
                    <img src="{{ asset("svg/plus.svg") }}" class="mr-3">
                    <span>Tambah Pesanan</span>
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="color: white; background-color: #FF8F0B">
                            <tr>
                                <th>Meja</th>
                                <th>Nama Menu</th>
                                <th>Jumlah</th>
                                <th>Jenis Menu</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_pesanans as $pesanan)
                                
                            <tr style="color: black; background-color: #ffc27c;">
                                <td>{{$pesanan->pesanan->no_meja}}</td>
                                <td>{{$pesanan->menu->nama}}</td>
                                <td>{{$pesanan->kuantitas}}</td>
                                <td>{{$pesanan->menu->category->nama}}</td>
                                <td style="font-size: 14px">{{\Carbon\Carbon::parse($pesanan->created_at)->addHours(7)->isoFormat('D MMMM YYYY HH:mm').' WIB'}}</td>
                                <td>
                                    <h5>
                                        <span class="badge text-white bg-{{ $pesanan->pesanan->status == 'proses' ? 'warning' : ($pesanan->pesanan->status == 'sukses' ? 'success' : 'danger') }}">
                                            {{ $pesanan->pesanan->status == 'batal' ? 'Belum Bayar' : Str::of($pesanan->pesanan->status)->apa() }}
                                        </span>
                                    </h5>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endhasanyrole

@hasanyrole('super admin')
<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800" style="font-weight: bold">Dashboard</h1>
    <p>Hi <span style="font-weight: bold">{{Auth::user()->nama}}</span>, Welcome Back to Warmindo Aroma Super Admin</p>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <img src="{{asset('svg/order.svg')}}" alt="">
                    </div>
                    <div class="col ml-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-900">{{count($pesanans)}}</div>
                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">Total Pesanan </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <img src="{{asset('svg/customer.svg')}}" alt="">
                    </div>
                    <div class="col ml-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-900">{{count($pelanggans)}}</div>
                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">Pelanggan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <img src="{{asset('svg/noodle.svg')}}" alt="">
                    </div>
                    <div class="col ml-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-900">{{count($menus)}}</div>
                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">Total Menu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <img src="{{asset('svg/employee.svg')}}" alt="">
                    </div>
                    <div class="col ml-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-900">{{count($karyawans)}}</div>
                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">Karyawan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-gray-900">Revenue</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart2"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-gray-900">Map Pelanggan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="mt-0">
                </div>
                <div class="chart-area">
                    <canvas id="mapPelangganChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-gray-900">Ringkasan Pesanan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <p class="m-0"> Performa pesanan berdasarkan berbagai kategori  </p>
                <div class="d-flex flex-row justify-content-center align-items-center" style="height: 100%;">
                    <div class="pt-4 ">
                        <canvas id="mostMenuOrderPieChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- <div class="card-body" style="position: relative;">
                <div class="d-flex flex-row justify-content-center align-items-center" style="height: 100%;">
                    <div class="pt-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <canvas id="mostMenuOrderPieChart"></canvas>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <div class="col-lg-6 mb-4">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-gray-900">Menu Rekomendasi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body shadow animated--grow-in p-3" aria-labelledby="alertsDropdown">
                @foreach ($recomendations->take(5) as $recom)
                    
                <a class="d-flex align-items-center mb-4">
                    <div class="mr-3">
                        <div class="icon-circle text-white" style="background-color:orange">
                            {{$loop->iteration}}
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{$recom->jumlah}} Pesanan</div>
                        <span class="font-weight-bold text-gray-900">{{$recom->menu->nama}}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endhasanyrole

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
    {{-- <script src="{{ asset("admin/js/sb-admin-2.min.js") }}"></script> --}}

    <!-- Page level plugins -->
    <script src="{{ asset("admin/vendor/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("admin/vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset("admin/js/demo/datatables-demo.js") }}"></script>

    <!-- Tambahkan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php
        $kategoriMakanan = $most_menu_order->where('nama', 'Makanan')->pluck('total_kuantitas')->first() ?? 0;
        $kategoriMinuman = $most_menu_order->where('nama', 'Minuman')->pluck('total_kuantitas')->first() ?? 0;
        $kategoriCamilan = $most_menu_order->where('nama', 'Camilan')->pluck('total_kuantitas')->first() ?? 0;

    @endphp
    <script>


        const ctx2 = document.getElementById('myAreaChart2').getContext('2d');
        let myLineChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: <?= json_encode($months) ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?= json_encode($profits) ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        display: true,
                        title: {
                            display: true,
                            text: 'Pendapatan (Rupiah)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString(); // Format angka ke format Rupiah
                            }
                        }
                    }
                }
            }
        });


        const ctx2MapPelanggan = document.getElementById('mapPelangganChart').getContext('2d');
        let myBarChartMapPelanggan = new Chart(ctx2MapPelanggan, {
            type: 'bar',
            data: {
                labels: <?= json_encode($months) ?>,
                datasets: [{
                    label: 'Map Pelanggan',
                    data: <?= json_encode($pelanggansd) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Warna latar belakang batang grafik
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                indexAxis: 'x', // Mengatur sumbu x menjadi sumbu y (menyesuaikan dari yang sebelumnya adalah sumbu x)
                scales: {
                    x: {
                        beginAtZero: true,
                        display: true,
                        title: {
                            display: true,
                            text: 'Bulan'
                        },
                        ticks: {
                            stepSize: 1 // Mengatur langkah nilai di sumbu x
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pelanggan'
                        }
                    }
                }
            }
        });

        
        const ctxmostMenuOrder = document.getElementById('mostMenuOrderPieChart').getContext('2d');
        let myPieChartMostMenuOrder = new Chart(ctxmostMenuOrder, {
            type: 'pie',
            data: {
                labels: [
                    'Makanan',
                    'Minuman',
                    'Camilan'
                ],
                datasets: [{
                    label: 'Ringkasan Pesanan',
                    data: [<?= $kategoriMakanan ?>, <?= $kategoriMinuman ?>, <?= $kategoriCamilan ?>],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            }
        });


    </script>
@endpush
