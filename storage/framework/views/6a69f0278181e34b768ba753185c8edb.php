<?php $__env->startSection("content"); ?>
    <div class="container bg-gray-light" style="padding-top: 200px">
        <div class="container">
            <h2 class="text-black animated slideInLeft ff-righteous mb-5">Keranjang</h2>
            <div class="row">
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="width: 40%">Item</th>
                                <th scope="col">Harga</th>
                                <th scope="col" style="width: 15%">Kuantitas</th>
                                <th scope="col">Jumlah Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                    <td>
                                        <?php
                                            $menu = App\Models\Menu::select('gambar')->where('nama', $cart['name'])->first();
                                        ?>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo e(asset("storage/".$menu->gambar)); ?>" alt="Product Image"
                                                style="width: 70px; height: auto; margin-right: 10px;">
                                            <div>
                                                <h6 class="fw-bold m-0"><?php echo e($cart["name"]); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-items-center text-center"><?php echo e($cart["price"]); ?></td>
                                    <td>
                                        <input type="number" min="1" class="form-control w-100"
                                            value="<?php echo e($cart["quantity"]); ?>" readonly>
                                    </td>
                                    <td class="align-items-center text-center"><?php echo e($cart["total_price"]); ?></td>
                                    <td class="align-items-center">
                                        <!-- Tombol untuk menghapus item -->
                                        <form action="<?php echo e(route("cart.remove", ["order_id" => $index])); ?>" method="POST"
                                            style="display: inline;">
                                            <?php echo csrf_field(); ?> <!-- Token CSRF untuk keamanan -->
                                            <button type="submit" class="btn btn-danger rounded-3">
                                                <img src="<?php echo e(asset("svg/trash.svg")); ?>" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>

                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded rounded-3 p-3">
                        <h6>Total Harga</h6>
                        <span class="text-success fw-bold fs-3">Rp <?php echo e(number_format(session()->get('totalPrice'), 0, ".", ".")); ?></span>
                        <div class="mt-4">
                            <form action="<?php echo e(route("pelanggan.checkout.cart")); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <p class="mb-3 text-danger">*Masukan data diri terlebih dahulu</p>
                                <div class="mb-3 d-none">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" min="1" class="form-control" name="total_harga"
                                        value="<?php echo e($totalPrice ?? session()->get('totalPrice')); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_meja" min = "1" class="form-label">Nomor Meja</label>
                                    <input type="number" min="1" max="12" class="form-control" name="nomor_meja"
                                        placeholder="XX" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_phone" class="form-label">Nomor Handphone</label>
                                    <input type="text" class="form-control" name="nomor_phone" id="nomor_phone" placeholder="0817267XXXX" pattern="08[0-9]{8,11}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" name="nama_pemesan"
                                        placeholder="Masukkan nama pemesan" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100 rounded-3" 
                                    <?php if(session()->get('totalPrice') == 0): ?> disabled <?php endif; ?>>
                                    Pesan Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">INVOICE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between">
                        <p>Tanggal: <?php echo e(date('l, d F Y h:i:s', strtotime('+7 hours'))); ?></p>
                        <p>No Meja: <?php echo e($no_meja); ?> </p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_price = 0;
                            ?>
                            <?php $__currentLoopData = $lastCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center">
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e($cart['name']); ?></td>
                                <td><?php echo e($cart['quantity']); ?></td>
                                <td><?php echo e(number_format($cart['total_price'], 0, ".", ".")); ?></td>
                            </tr>               
                            <?php
                                $total_price += $cart['total_price'];
                            ?>                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr class="text-center">
                                <td colspan="3" class="text-end">Total:</td>
                                <td>Rp <?php echo e(number_format($total_price, 0, ".", ".")); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="text-danger">*Silahkan dapat discreenshoot untuk bukti invoicenya dan konfirmasi pembayaran melalui KASIR</span>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush("scripts"); ?>
    <?php if(session()->has("checkout-order-successfully")): ?>
<?php
    $message = session()->get("checkout-order-successfully"); // Mengambil pesan dari sesi
?>
    <script>
        Swal.fire({
            title: "Order Sukses",

            text: "Silahkan lanjutkan proses pembayaran melalui kayrawan",
            icon: "success",
            showDenyButton: true,
            reverseButtons: true,
            showCancelButton: false,
            confirmButtonText: "Lihat Invoice",
            denyButtonText: `Order Kembali`,
            customClass: {
                confirmButton: 'btn btn-success',
                denyButton: 'btn btn-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#invoiceModal').modal('show');
            } else if (result.isDenied) {
                window.location.href = "<?php echo e(route("pelanggan.menu")); ?>";
            }
        });

    </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("layouts.pelanggan", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order-food-app-main\resources\views/pelanggan/cart.blade.php ENDPATH**/ ?>