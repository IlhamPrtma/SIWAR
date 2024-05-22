<?php $__env->startPush("styles"); ?>
    <link href="<?php echo e(asset("admin/vendor/datatables/dataTables.bootstrap4.min.css")); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection("content"); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Tanggal Pemasaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row gap-3">
                                        <img src="<?php echo e(asset("/storage/" . $menu->gambar)); ?>" alt="Menu Image" style="max-width: 75px;">
                                        <p>
                                            <?php echo e($menu->nama); ?>

                                        </p>
                                    </div>
                                </td>
                                <td><?php echo e(number_format($menu->harga, 0, '.', '.')); ?></td>
                                <td><?php echo e($menu->created_at); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="rounded-circle bg-<?php echo e($menu->ketersediaan == 1 ? 'success' : 'danger'); ?> text-white d-flex justify-content-center align-items-center"
                                            style="width: 25px; height: 25px;">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center flex-row align-items-center">
                                        <button type="button" type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editMenuModal<?php echo e($menu->id); ?>">Edit</button>
                                        <div class="modal fade" id="editMenuModal<?php echo e($menu->id); ?>" tabindex="-1"
                                            aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editMenuModalLabel">Edit Menu
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo e(route('admin.update.menu', ['id_menu' => $menu->id])); ?>">
                                                            <?php echo method_field('put'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <div class="mb-3">
                                                              <label for="nama" class="form-label">Nama Menu</label>
                                                              <input type="text" class="form-control" name="nama" value="<?php echo e($menu->nama); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="gambar" class="form-label">Gambar</label>
                                                                <input class="form-control" type="file" id="gambar">
                                                              </div>
                                                            <div class="mb-3">
                                                              <label for="harga" class="form-label">Harga</label>
                                                              <input type="number" class="form-control" name="harga" value="<?php echo e($menu->harga); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                              <label for="ketersediaan" class="form-label">Ketersediaan</label>
                                                              <select class="form-select" name="ketersediaan" aria-label="Default select example">
                                                                <?php $__currentLoopData = [['code' => 1,'status'=>"Tersedia"],['code' => 0,'status'=>"Kosong"]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ketersediaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($ketersediaan['code']); ?>" <?php if($ketersediaan['code'] === $menu->ketersediaan): ?> selected <?php endif; ?> ><?php echo e($ketersediaan['status']); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                              </select>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Perbarui data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/admin/menu.blade.php ENDPATH**/ ?>