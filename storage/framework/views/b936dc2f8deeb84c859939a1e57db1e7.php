<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800" style="font-weight: bold">Halaman Laporan</h1>
    <p>Pengelolaan Data Penjualan, memungkinkan untuk memantau dan mencetak laporan penjualan</p>
</div>
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Laporan</h6>
        </div>
        <div class="card-body">
        <div class="my-3">
    <form action="<?php echo e(route('superadmin.print.laporan')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-3"> 
            <div class="flex-fill mb-2 mb-md-0 me-md-2"> 
                <label for="start_date" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="name@example.com" required>
            </div>
            <div class="flex-fill ms-md-2"> 
                <label for="end_date" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="name@example.com" required>
            </div>
        </div>                
        <button type="submit" class="btn btn-primary text-orange-500" style="background-color: black">
            <span>Print</span>
        </button>
    </form>
</div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Menu</th>
                            <th>Kategori</th>
                            <th>Total Terjual</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row gap-3">
                                        <img src="<?php echo e(asset("storage/" . $laporan->menu->gambar)); ?>" alt="Menu Image" style="max-width: 75px;">
                                        <p>
                                            <?php echo e($laporan->menu->nama); ?>

                                        </p>
                                    </div>
                                </td>
                                    
                                <td><?php echo e($laporan->menu->category->nama); ?></td>
                                <td><?php echo e($laporan->total_kuantitas); ?></td>
                                <td><?php echo e($laporan->total_harga); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('admin/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/js/sb-admin-2.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/js/demo/datatables-demo.js')); ?>"></script>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/superadmin/laporan.blade.php ENDPATH**/ ?>