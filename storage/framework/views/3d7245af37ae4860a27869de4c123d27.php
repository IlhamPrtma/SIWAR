<?php $__env->startSection("content"); ?>
    <div class="container py-5 bg-gray-light">
        <div class="container mx-auto justify-items-center align-content-center mt-5">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <span class="fa fa-search form-control-feedback"></span>
                </span>
                <input type="text" class="form-control p-3" id="searchInput" placeholder="Cari nama menu..."
                    aria-label="Pencarian Menu" aria-describedby="basic-addon1">
            </div>
        </div>
        <div id="exTab1" class="container">
            <p class="mb-2">Pilih jenis menu:</p>
            <ul class="nav nav-pills gap-3" id="menuTypeFilter">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-category="semua">Semua</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-category="makanan">Makanan</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-category="minuman">Minuman</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-category="camilan">Camilan</a>
                </li>
            </ul>

            <div class="tab-content clearfix">
                <div class="my-4 row g-3" id="menus">

                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 menu-item"
                            data-category="<?php echo e($menu->category->nama); ?>">
                            <div class="card">
                                <img src="<?php echo e(asset('storage/'.$menu->gambar)); ?>"
                                class="w-100 rounded-top-3"
                                style="object-fit: cover; height: 200px;"
                                    alt="Image 1">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo e($menu->nama); ?></h6>
                                    <div class="d-flex flex-row gap-4 justify-content-between">
                                        <h5 class="menu-category align-content-xl-center">Rp
                                            <?php echo e(number_format($menu->harga, 0, ",", ".")); ?></h5>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#orderMenuModal-<?php echo e($menu->id); ?>">
                                            <p class="m-0" style="font-size: 12px">Keranjang</p>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="orderMenuModal-<?php echo e($menu->id); ?>" tabindex="-1"
                                            aria-labelledby="orderMenuModal-<?php echo e($menu->id); ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="orderMenuModal-<?php echo e($menu->id); ?>Label">Tambahkan Keranjang</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?php echo e(route('pelanggan.addCart',['menu_id'=>$menu->id])); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-body">
                                                                <div class="mb-3">
                                                                <label for="nama_menu" class="form-label">Nama Menu</label>
                                                                <input type="text" class="form-control" name="nama_menu" value="<?php echo e($menu->nama); ?>" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kuantitas" class="form-label">Kuantitas</label>
                                                                <input type="number" min="1" class="form-control" name="kuantitas" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush("scripts"); ?>
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const filter = this.value.toUpperCase();
            const cardContainer = document.getElementById("menus");
            const cards = cardContainer.getElementsByClassName("menu-item");
            for (let i = 0; i < cards.length; i++) {
                const title = cards[i].querySelector(".card-title");
                if (title.innerText.toUpperCase().includes(filter)) {
                    cards[i].style.display = "block";
                } else {
                    cards[i].style.display = "none";
                }
            }
        });

        document.getElementById("menuTypeFilter").addEventListener("click", function(event) {
            if (event.target.tagName === "A") {
                event.preventDefault();
                console.log('masuk')

                // Ambil kategori dari elemen klik
                const filter = event.target.getAttribute("data-category").toUpperCase();
                console.log(filter)

                // Ambil semua kartu menu
                const cardContainer = document.getElementById("menus");
                console.log(cardContainer)
                const cards = cardContainer.getElementsByClassName("menu-item");
                console.log(cards)

                // Tampilkan/hide kartu berdasarkan filter
                for (let i = 0; i < cards.length; i++) {
                    const cardCategory = cards[i].getAttribute("data-category").toUpperCase();
                    if (filter === "SEMUA" || cardCategory === filter) {
                        cards[i].style.display = "block";
                    } else {
                        cards[i].style.display = "none";
                    }
                }

                // Update kelas 'active' pada link menu
                document.querySelectorAll("#menuTypeFilter .nav-link").forEach((link) => {
                    link.classList.remove("active");
                });
                event.target.classList.add("active");
            }
        });
    </script>
    <?php if(session()->has("add-cart-successfully")): ?>
        <?php
            $message = session()->get("add-cart-successfully"); // Mengambil pesan dari sesi
        ?>
        <script>
            Swal.fire({
                title: "Item Keranjang Bertambah!",
                text: "<?php echo e(addslashes($message)); ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("layouts.pelanggan", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/pelanggan/menu.blade.php ENDPATH**/ ?>