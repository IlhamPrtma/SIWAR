@extends("layouts.pelanggan")

@section("content")
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
                @foreach ($menus as $menu)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 menu-item" data-category="{{ $menu->category->nama }}">
                    <div class="card">
                        <img src="{{ asset('storage/'.$menu->gambar) }}" class="w-100 rounded-top-3"
                            style="object-fit: cover; height: 200px;" alt="Image 1">
                        @if ($menu->ketersediaan == 0)
                        <img src="{{ asset('public/storage/kosong.png') }}"
                            class="w-100 rounded-top-3 position-absolute top-0 start-0"
                            style="object-fit: cover; height: 200px;" alt="Stok Kosong">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $menu->nama }}</h6>
                            <div class="d-flex flex-row gap-4 justify-content-between">
                                <h5 class="menu-category align-content-xl-center">Rp
                                    {{ number_format($menu->harga, 0, ",", ".") }}</h5>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#orderMenuModal-{{ $menu->id }}" @if ($menu->ketersediaan == 0)
                                    disabled @endif>
                                    <p class="m-0" style="font-size: 12px">Keranjang</p>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="orderMenuModal-{{ $menu->id }}" tabindex="-1"
                                    aria-labelledby="orderMenuModal-{{ $menu->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="orderMenuModal-{{ $menu->id }}Label">Tambahkan Keranjang</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ route('pelanggan.addCart', ['menu_id' => $menu->id]) }}"
                                                method="post" id="form-{{ $menu->id }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nama_menu" class="form-label">Nama Menu</label>
                                                        <input type="text" class="form-control" name="nama_menu"
                                                            value="{{ $menu->nama }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kuantitas" class="form-label">Kuantitas</label>
                                                        <input type="number" class="form-control" name="kuantitas"
                                                            id="kuantitas-{{ $menu->id }}" required>
                                                        <div class="alert alert-danger mt-2" style="display: none;"></div>
                                                        <!-- Pesan error -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btnTambahkan"
                                                        data-menu-id="{{ $menu->id }}">Tambahkan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div id="notFoundMessage" style="display: none; text-align: center; margin-top: 20px;">
                Menu Tidak Ditemukan!
            </div>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Filter based on menu category
    document.getElementById("menuTypeFilter").addEventListener("click", function(event) {
        if (event.target.tagName === "A") {
            event.preventDefault();
            const filter = event.target.getAttribute("data-category").toUpperCase();
            const cardContainer = document.getElementById("menus");
            const cards = cardContainer.getElementsByClassName("menu-item");

            for (let i = 0; i < cards.length; i++) {
                const cardCategory = cards[i].getAttribute("data-category").toUpperCase();
                if (filter === "SEMUA" || cardCategory === filter) {
                    cards[i].style.display = "block";
                } else {
                    cards[i].style.display = "none";
                }
            }

            // Update active class on menu links
            document.querySelectorAll("#menuTypeFilter .nav-link").forEach((link) => {
                link.classList.remove("active");
            });
            event.target.classList.add("active");
        }
    });

    // Form validation and submission for adding to cart
    $(document).on('click', '.btnTambahkan', function(e) {
        e.preventDefault();
        const menuId = $(this).data('menu-id');
        const kuantitas = $('#kuantitas-' + menuId).val();

        if (kuantitas < 1 || kuantitas > 10) {
            $('#form-' + menuId + ' .alert-danger').text('Kuantitas harus diisi dengan angka antara 1 dan 10.');
            $('#form-' + menuId + ' .alert-danger').show();
        } else {
            $('#form-' + menuId + ' .alert-danger').hide();
            $('#form-' + menuId).submit();
        }
    });

    // Search functionality
    document.getElementById("searchInput").addEventListener("keyup", function() {
        const filter = this.value.toUpperCase();
        const cardContainer = document.getElementById("menus");
        const cards = cardContainer.getElementsByClassName("menu-item");
        let found = false;

        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector(".card-title");
            if (title.innerText.toUpperCase().includes(filter)) {
                cards[i].style.display = "block";
                found = true;
            } else {
                cards[i].style.display = "none";
            }
        }

        const notFoundMessage = document.getElementById("notFoundMessage");
        if (!found) {
            notFoundMessage.style.display = "block";
        } else {
            notFoundMessage.style.display = "none";
        }
    });
</script>

@if (session()->has("add-cart-over"))
<script>
    Swal.fire({
        title: "Item Gagal Ditambahkan!",
        text: "{{ session()->get('add-cart-over') }}",
        icon: "error"
    });
</script>
@endif

@if (session()->has("add-cart-successfully"))
<script>
    Swal.fire({
        title: "Item Keranjang Bertambah!",
        text: "{{ session()->get('add-cart-successfully') }}",
        icon: "success"
    });
</script>
@endif
@endpush
