<?php $__env->startPush("styles"); ?>
    <link href="<?php echo e(asset("admin/vendor/datatables/dataTables.bootstrap4.min.css")); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection("content"); ?>
    <!-- DataTales Example -->
    <div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800" style="font-weight: bold">Halaman Menu</h1>
    <p>Pengelolaan Daftar Menu, memungkinkan untuk menambah, mengedit, dan menghapus item menu</p>
</div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Tabel Menu</h6>
        </div>
        <div class="card-body">
            <div class="my-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                            <button type="button" class="btn btn-dark text-orange-500" style="background-color: black"
                            data-bs-toggle="modal" data-bs-target="#addMenuModal">
                            <img src="<?php echo e(asset("svg/add-list.svg")); ?>" class="mr-3">
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div>
                        <label for="filterCategory">Filter Menu</label>
                        <select id="filterCategory" class="form-select">
                            <option value="">Semua</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                            <option value="camilan">Camilan</option>
                        </select>
                    </div>
                </div>
                <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addMenuModalLabel">Tambah Data Menu
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- <?php if(session('menu-exists')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e(session('menu-exists')); ?>

                                </div>
                            <?php endif; ?> -->
                                <form method="post" action="<?php echo e(route("superadmin.add.menu")); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Menu</label>
                                        <input type="text" class="form-control" name="nama" required>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" name="id_kategori" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->nama); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input class="form-control" type="file" name="gambar" id="gambar"
                                            accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ketersediaan" class="form-label">Ketersediaan</label>
                                        <select class="form-select" name="ketersediaan" aria-label="Default select example"
                                            required>
                                            <option selected>Pilih status ketersediaan</option>
                                            <option value="1">Tersedia</option>
                                            <option value="0">Kosong</option>
                                        </select>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambah data</button>
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
                            <th>Nama Item</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Total Pesanan</th>
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
                                        <img src="<?php echo e(asset("/storage/" . $menu->gambar)); ?>" alt="Menu Image" style="width: 75px; height: 50px" class="flex-shrink-0">
                                        <p>
                                            <?php echo e($menu->nama); ?>

                                        </p>
                                    </div>
                                </td>
                                <td><?php echo e($menu->category->nama); ?></td>
                                <td><?php echo e($menu->harga); ?></td>
                                <td><?php echo e($menu->detailPesanans->count()); ?></td>
                                <td><?php echo e($menu->created_at); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="rounded-circle bg-<?php echo e($menu->ketersediaan == 1 ? "success" : "danger"); ?> text-white d-flex justify-content-center align-items-center"
                                            style="width: 25px; height: 25px;">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal"
                                            data-bs-target="#editMenuModal<?php echo e($menu->id); ?>">Edit</button>
                                        <div class="modal fade" id="editMenuModal<?php echo e($menu->id); ?>" tabindex="-1"
                                            aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editMenuModalLabel">Edit Menu</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="<?php echo e(route("admin.update.menu", ["id_menu" => $menu->id])); ?>"
                                                            enctype="multipart/form-data">
                                                            <?php echo method_field("put"); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama Menu</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    value="<?php echo e($menu->nama); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="id_kategori"
                                                                    class="form-label">Kategori</label>
                                                                <select class="form-select" name="id_kategori"
                                                                    aria-label="Default select example">
                                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($kategori->id); ?>"
                                                                            <?php echo e($kategori->id == $menu->id_kategori ? "selected" : ""); ?>>
                                                                            <?php echo e($kategori->nama); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="gambar" class="form-label">Gambar</label>
                                                                <input class="form-control" type="file" id="gambar"
                                                                    name="gambar">
                                                                <?php if($menu->gambar): ?>
                                                                    <p>Gambar saat ini:</p>
                                                                    <img src="<?php echo e(asset("/storage/" . $menu->gambar)); ?>"
                                                                        alt="Menu Image" style="max-width: 100px;">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga" class="form-label">Harga</label>
                                                                <input type="number" class="form-control" name="harga"
                                                                    value="<?php echo e($menu->harga); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="ketersediaan"
                                                                    class="form-label">Ketersediaan</label>
                                                                <select class="form-select" name="ketersediaan"
                                                                    aria-label="Default select example">
                                                                    <option value="1"
                                                                        <?php echo e($menu->ketersediaan == 1 ? "selected" : ""); ?>>
                                                                        Tersedia</option>
                                                                    <option value="0"
                                                                        <?php echo e($menu->ketersediaan == 0 ? "selected" : ""); ?>>
                                                                        Kosong</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Perbarui
                                                            data</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="delete_menu_<?php echo e($menu->id); ?>"
                                            action="<?php echo e(route("superadmin.delete.menu", ["id_menu" => $menu->id])); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field("DELETE"); ?>
                                            <button type="button" onclick='showAlert(<?php echo json_encode([$menu->id, $menu->nama], 512) ?>)' class="btn btn-danger">Hapus</button>
                                        </form>
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
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable(); // Inisialisasi DataTable
            
            $('#filterCategory').on('change', function () {
                var selectedCategory = $(this).val(); // Ambil nilai dari select
                if (selectedCategory === '') {
                    table.column(1).search('').draw(); // Jika "Semua" dipilih, reset filter
                } else {
                    table.column(1).search(selectedCategory).draw(); // Terapkan filter
                }
            });
        });
    </script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset("admin/js/demo/datatables-demo.js")); ?>"></script>
    <?php if(session()->has("update-menu-successfully")): ?>
        <?php
            $message = session()->get("update-menu-successfully"); // Mengambil pesan dari sesi
        ?>
        <script>
            Swal.fire({
                title: "Kelola Menu Sukses!",
                text: "<?php echo e(addslashes($message)); ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>

    <script> 
        function showAlert(data){
            const [id, name] = data;

            Swal.fire({
                title: `Anda yakin ingin menghapus data menu ${name}?`,
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Tidak, batal",
                confirmButtonText: "Ya, hapus",
                
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete_menu_${id}`).submit();
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

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/superadmin/menu.blade.php ENDPATH**/ ?>