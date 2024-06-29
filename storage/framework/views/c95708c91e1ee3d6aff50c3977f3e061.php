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

                    <!-- Modal -->
                    
                    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Akun Pengguna</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="userProfile">
                                        <!-- Ini tempat untuk menampilkan informasi pengguna -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="editUserButton">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Edit User -->
                    <div class="modal fade" id="editUserModal-<?php echo e(Auth::id()); ?>" tabindex="-1" aria-labelledby="editUserModalLabel-<?php echo e(Auth::id()); ?>" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Akun</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo e(route('superadmin.update.account', ['user_id' => Auth::id()])); ?>" method="POST" enctype="multipart/form-data">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>
    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e(Auth::user()->nama); ?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo e(Auth::user()->username); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="8" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label"><h6>Role</h6></label>
            <select class="form-select" id="role" name="role" aria-label="Role Selection" required disabled>
                <option value="admin" <?php echo e(Auth::user()->roles->first()->name === 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="super admin" <?php echo e(Auth::user()->roles->first()->name === 'super admin' ? 'selected' : ''); ?>>Super Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto_profil" class="form-label">Gambar</label>
            <input class="form-control" type="file" id="foto_profil" name="foto_profil" accept="image/*">
            <?php if(Auth::user()->profile_photo): ?>
                <p>Gambar saat ini:</p>
                <img src="<?php echo e(asset("/storage/" . Auth::user()->profile_photo)); ?>" alt="Menu Image" style="max-width: 100px;">
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Perbarui Data</button>
    </div>
</form>

                            </div>
                        </div>
                    </div>

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
    <script>
    // Ketika navbar di-klik, tampilkan modal dan isi informasi pengguna
    document.getElementById('userDropdown').addEventListener('click', function() {
        // Simpan informasi pengguna dalam variabel
        var profilePhoto = "<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>";
        var nama = "<?php echo e(Auth::user()->nama); ?>";
        var username = "<?php echo e(Auth::user()->username); ?>";
        var email = "<?php echo e(Auth::user()->email); ?>";

        // Isi modal dengan informasi pengguna
        document.getElementById('userProfile').innerHTML = `
            <div class="d-flex align-items-center">
                <img src="${profilePhoto}" class="img-profile rounded-circle mx-2" style="width: 115px; height: 115px; border: 2px solid #ccc;">
                <div class="d-flex flex-column">
                    <p><strong>Nama:</strong> ${nama}</p>
                    <p><strong>Username:</strong> ${username}</p>
                    <p><strong>Email:</strong> ${email}</p>
                </div>
            </div>
        `;
        // Tampilkan modal
        $('#userModal').modal('show');
    });

    // Tambahkan event listener untuk tombol "Edit" di modal userModal
    document.getElementById('editUserButton').addEventListener('click', function() {
        var userId = "<?php echo e(Auth::id()); ?>"; 
        $('#editUserModal-' + userId).modal('show');
        $('#userModal').modal('hide');
    });
</script>
    <script src="<?php echo e(asset("admin/js/demo/datatables-demo.js")); ?>"></script>
    <?php if(session()->has("update-account-successfully")): ?>
        <?php
            $message = session()->get("update-account-successfully"); // Mengambil pesan dari sesi
        ?>
        <script>
            Swal.fire({
                title: "Kelola Akun Sukses!",
                text: "<?php echo e(addslashes($message)); ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/layouts/admin.blade.php ENDPATH**/ ?>