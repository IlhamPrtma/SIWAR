<?php $__env->startPush("styles"); ?>
    <link href="<?php echo e(asset("admin/vendor/datatables/dataTables.bootstrap4.min.css")); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection("content"); ?>
    <!-- DataTales Example -->
    <div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800" style="font-weight: bold">Halaman Karyawan</h1>
    <p>Pengelololaan User, daftar semua karyawan atau admin termasuk nama pengguna, email, dan perannya</p>
</div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="my-3">
                <button type="button" class="btn btn-primary text-orange-500" style="background-color: black"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="<?php echo e(asset("svg/plus-people.svg")); ?>" class="mr-3">
                    <span>Tambah</span>
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Karyawan Baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="<?php echo e(route('superadmin.add.account')); ?>" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="8" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label"><h6>Role</h6></label>
                                        <select class="form-select" id="role" name="role" aria-label="Default select example" required>
                                            <option selected>Pilih role</option>
                                            <option value="admin">Admin</option>
                                            <option value="super admin">Super Admin</option>
                                          </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto_profil" class="form-label">Gambar</label>
                                        <input class="form-control" type="file" id="foto_profil" name="foto_profil" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Selesai</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($user->id !== Auth::user()->id): ?>
                                <td>
                                    <img class="img-profile mx-2" width="50px" src="<?php echo e(asset('storage/'.$user->profile_photo)); ?>" alt="Photo Profile">
                                    <?php echo e($user->username); ?></td>
                                <td><?php echo e($user->nama); ?></td>
                                <td><?php echo e(Str::of($user->roles->first()->name)->apa()); ?></td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal" data-bs-target="#editUserModal-<?php echo e($user->id); ?>">Edit</button>
                                        <div class="modal fade" id="editUserModal-<?php echo e($user->id); ?>" tabindex="-1" aria-labelledby="editUserModalLabel-<?php echo e($user->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Karyawan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?php echo e(route('superadmin.update.account', ['user_id' => $user->id])); ?>" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <?php echo method_field('put'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($user->nama); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?php echo e($user->username); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="8" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="role" class="form-label"><h6>Role</h6></label>
                                                                <select class="form-select" id="role" name="role" aria-label="Role Selection" required>
                                                                    <option value="admin" <?php echo e($user->roles->first()->name === 'admin' ? 'selected' : ''); ?>>Admin</option>
                                                                    <option value="super admin" <?php echo e($user->roles->first()->name === 'super admin' ? 'selected' : ''); ?>>Super Admin</option>
                                                                </select>                                                                
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="foto_profil" class="form-label">Gambar</label>
                                                                <input class="form-control" type="file" id="foto_profil" name="foto_profil" accept="image/*">
                                                                <?php if($user->profile_photo): ?>
                                                                    <p>Gambar saat ini:</p>
                                                                    <img src="<?php echo e(asset("/storage/" . $user->profile_photo)); ?>"
                                                                        alt="Menu Image" style="max-width: 100px;">
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
                                        <form id="delete_account_<?php echo e($user->id); ?>"
                                            action="<?php echo e(route("superadmin.delete.account", ["id_account" => $user->id])); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field("DELETE"); ?>
                                            <button type="button" onclick='deleteAccount(<?php echo json_encode([$user->id, $user->username], 512) ?>)' class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>

                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush("scripts"); ?>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="<?php echo e(asset("admin/vendor/jquery/jquery.min.js")); ?>"></script>
    <script src="<?php echo e(asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js")); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset("admin/vendor/jquery-easing/jquery.easing.min.js")); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset("admin/js/sb-admin-2.min.js")); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo e(asset("admin/vendor/datatables/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("admin/vendor/datatables/dataTables.bootstrap4.min.js")); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset("admin/js/demo/datatables-demo.js")); ?>"></script>
    <?php if(session()->has("add-account-successfully")): ?>
        <?php
            $message = session()->get("add-account-successfully"); // Mengambil pesan dari sesi
        ?>
        <script>
            Swal.fire({
                title: "Kelola Akun Sukses!",
                text: "<?php echo e(addslashes($message)); ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>
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
    <?php if(session()->has("update-account-failed")): ?>
        <?php
            $message = session()->get("update-account-failed"); // Mengambil pesan dari sesi
        ?>
        <script>
            Swal.fire({
                title: "Kelola Akun Gagal!",
                text: "<?php echo e(addslashes($message)); ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>

    <script> 
        function deleteAccount(data){
            const [id, name] = data;

            Swal.fire({
                title: `Anda yakin ingin menghapus data akun ${name}?`,
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Tidak, batal",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete_account_${id}`).submit();
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/superadmin/karyawan.blade.php ENDPATH**/ ?>