<?php $__env->startPush("styles"); ?>
    <link href="<?php echo e(asset("admin/vendor/datatables/dataTables.bootstrap4.min.css")); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection("content"); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
        </div>
        
        <div class="card-body">
            <div class="d-flex justify-content-between">
                    <div class="">
                        <a href="<?php echo e(route('pelanggan.menu')); ?>" class="btn btn btn-primary text-orange-500 rounded-pill px-3" style="background-color: black">
                            <img src="<?php echo e(asset("svg/plus.svg")); ?>" class="mr-3">
                            <span>Tambah Pesanan</span>
                        </a>
                    </div>
                    <div>
                        <label for="filterStatus">Filter Status</label>
                        <select id="filterStatus" class="form-select mb-3">
                            <option value="">Semua</option>
                            <option value="proses">Proses</option>
                            <option value="sukses">Sukses</option>
                            <option value="batal">Batal</option>
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
                            <th>Total </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($pesanan->no_meja); ?></td>
                                <td class="text-start">
                                    <?php $__currentLoopData = $pesanan->detailPesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($menu->menu->nama . ' ('.$menu->kuantitas.' item)     ' . '(Rp '. number_format($menu->menu->harga, 0, '.','.').')'); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($pesanan->nama_pemesan); ?></td>
                                <td><?php echo e($pesanan->nomor_phone); ?></td>
                                <td><?php echo e("Rp " . number_format($pesanan->total_harga, 0, ".", ".")); ?></td>
                                <td>
                                    <h5>
                                        <span class="badge text-white bg-<?php echo e($pesanan->status == 'proses' ? 'warning' : ($pesanan->status == 'sukses' ? 'success' : 'danger')); ?>"><?php echo e(Str::of($pesanan->status)->apa()); ?></span>
                                    </h5>
                                </td>
                                <td>
                                    <div class="d-flex flex-row gap-3 justify-items-center align-content-center justify-content-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPesananModal<?php echo e($pesanan->id); ?>">Edit</button>
                                        <div class="modal fade" id="editPesananModal<?php echo e($pesanan->id); ?>" tabindex="-1"
                                            aria-labelledby="editPesananModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo e(route('admin.update.status.order', ['pesanan_id' => $pesanan->id])); ?>" method="post">
                                                        <?php echo method_field('put'); ?>
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editPesananModalLabel">Edit Status Pesanan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_pemesan" class="form-label">Nama Pemesan|Meja</label>
                                                                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" value="<?php echo e($pesanan->nama_pemesan.' ( Meja No.'.$pesanan->no_meja.' )'); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status Pesanan</label>
                                                                <select class="form-select" aria-label="Default select example" name="status" required>
                                                                    <option selected>Open this select menu</option>
                                                                    <?php $__currentLoopData = ['proses','batal','sukses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($status); ?>" <?php if($pesanan->status === $status): ?> selected <?php endif; ?> ><?php echo e(Str::of($status)->apa()); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable(); // Inisialisasi DataTable
            
            $('#filterStatus').on('change', function () {
                var selectedCategory = $(this).val(); // Ambil nilai dari select
                if (selectedCategory === '') {
                    table.column(5).search('').draw(); // Jika "Semua" dipilih, reset filter
                } else {
                    table.column(5).search(selectedCategory).draw(); // Terapkan filter
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/admin/pesanan.blade.php ENDPATH**/ ?>