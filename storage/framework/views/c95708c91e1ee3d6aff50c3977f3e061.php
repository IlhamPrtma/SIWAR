<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Warmindo Aroma | <?php echo e((Auth::user() && Auth::user()->roles == 'admin') ? 'Karyawan' : 'Pemilik'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('admin/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo e(asset('admin/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/css/custom.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light topbar static-top shadow" style="background-color: black">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style ="color:white"></i>
                    </button>
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <h1 class="titleNav">Warmindo Aroma</h1>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                    $profilePhoto = Auth::user() ? Auth::user()->profile_photo : null;
                                    $profileSrc = $profilePhoto ? asset('storage/'.$profilePhoto) : asset('admin/img/undraw_profile.svg');
                                ?>
                                <img class="img-profile rounded-circle mx-2" src="<?php echo e($profileSrc); ?>">
                                <div class="d-flex flex-column mx-1">
                                    <p class="mr-2 d-none d-lg-inline text-gray-600 small m-0 font-weight-bold">Welcome</p>
                                    <span class="mr-2 d-none d-lg-inline text-white font-weight-bolder small m-0"><?php echo e(Auth::user()->nama); ?></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid pt-4 bg-gray-primary">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RIB Team</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="<?php echo e(asset('admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/sb-admin-2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/demo/chart-pie-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/demo/chart-bar-demo.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/layouts/admin.blade.php ENDPATH**/ ?>