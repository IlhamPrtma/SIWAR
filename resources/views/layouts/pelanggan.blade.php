<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Warmindo Aroma | {{$title ?? ''}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('storage/icon.png') }}" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Font Style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&display=swap" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @stack('styles')
</head>

<body >
    <div class="col-md-12 bg-gray-light">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container" >
                <a href="" class="navbar-brand" >
                    <h2 class="text-primary" style="font-family: 'Poppins' font-size: 1.5rem;">Warmindo Aroma</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-start align-items-end" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0 pe-4 ">
                        <a href="{{route('home')}}" class="nav-item nav-link active {{ request()->routeIs('home') ?'fw-bolder' : ''}}">Beranda</a>
                        <a href="{{route('pelanggan.menu')}}" class="nav-item nav-link active {{ request()->routeIs('pelanggan.menu') ?'fw-bolder' : ''}}">Menu</a>
                        <a href="{{route('pelanggan.cart')}}" class="nav-item nav-link active {{ request()->routeIs('pelanggan.cart') ?'fw-bolder' : ''}}">Keranjang</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar & Hero End -->
        
        @yield('content')

        <!-- Footer Start -->
        <footer class="container-fluid bg-dark text-light mt-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="text-start text-primary mb-4">Warmindo Aroma</h4>
                        <p class="text-start" >Kunjungi kami untuk menikmati berbagai pilihan menu autentik yang akan memanjakan lidah Anda. Warmindo Aroma menyediakan hidangan nusantara dengan cita rasa yang khas dan suasana yang nyaman untuk dinikmati bersama keluarga dan teman.</p>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-start text-primary mb-4">Kontak Kami</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-geo-alt-fill me-3"></i>Gondang Barat II RT 08 RW 01, Kecamatan Tembalang, Kota Semarang</li>
                            <li class="mb-2"><i class="bi bi-telephone-fill me-3"></i>+62 813 945 06412</li>
                            <li class="mb-2"><i class="bi bi-envelope-fill me-3"></i>warmindoaroma@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top rounded-circle"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    @stack('scripts')
</body>

</html>
