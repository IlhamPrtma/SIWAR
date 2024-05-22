<ul class="navbar-nav bg-white sidebar sidebar-dark accordion" id="accordionSidebar" style="position: sticky; top: 0; max-height: 100vh;">


    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-2" style="background-color: #FF8F0B;">
        <div class="sidebar-brand-text mx-3 text-gray-900">
            <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'super admin')): ?>SUPER ADMIN TOOL <?php endif; ?> 
            <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'admin')): ?>ADMIN TOOL <?php endif; ?> 
        </div>
    </a>
    <li class="nav-item active text-gray-900 <?php echo e(request()->routeIs('dashboard') ?'text-white bg-orange-primary rounded-pill' : ''); ?>">
        <a class="nav-link text-gray-900" href="<?php echo e(route('dashboard')); ?>">
            <img src="<?php echo e(asset('svg/beranda.svg')); ?>" alt="Beranda Icon">
            <span>Beranda</span>
        </a>
    </li>

    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'super admin')): ?>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 <?php echo e(request()->routeIs('superadmin.menu') ?'text-white bg-orange-primary rounded-pill' : ''); ?>" href="<?php echo e(route('superadmin.menu')); ?>">
            <img src="<?php echo e(asset('svg/menu-book.svg')); ?>" alt="Menu Book Icon">
            <span>Menu</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 <?php echo e(request()->routeIs('superadmin.laporan') ?'text-white bg-orange-primary rounded-pill' : ''); ?>" href="<?php echo e(route('superadmin.laporan')); ?>">
            <img src="<?php echo e(asset('svg/laporan.svg')); ?>" alt="Laporan Icon">
            <span>Laporan</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 <?php echo e(request()->routeIs('superadmin.karyawan') ?'text-white bg-orange-primary rounded-pill' : ''); ?>" href="<?php echo e(route('superadmin.karyawan')); ?>">
            <img src="<?php echo e(asset('svg/karyawan.svg')); ?>" alt="Karyawan Icon">
            <span>Karyawan</span>
        </a>
    </li>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'admin')): ?>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 <?php echo e(request()->routeIs('admin.pesanan') ?'text-white bg-orange-primary rounded-pill' : ''); ?>" href="<?php echo e(route('admin.pesanan')); ?>">
            <img src="<?php echo e(asset('svg/pesanan.svg')); ?>" alt="Pesanan Icon">
            <span>Pesanan</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 <?php echo e(request()->routeIs('admin.menu') ?'text-white bg-orange-primary rounded-pill' : ''); ?>" href="<?php echo e(route('admin.menu')); ?>">
            <img src="<?php echo e(asset('svg/menu-book.svg')); ?>" alt="Menu Icon">
            <span>Menu</span>
        </a>
    </li>
    <?php endif; ?>

    
    <li class="nav-item active" style="position: absolute; bottom: 0;">
        <a class="nav-link text-gray-900" href="#" id="logoutButton">
            <img src="<?php echo e(asset('svg/logout.svg')); ?>" alt="Logout Icon">
            <span>Log Out</span>
        </a>
    </li>
</ul>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('logoutButton').addEventListener('click', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo e(route('logout')); ?>";
            }
        });
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>