<nav class="navbar navbar-expand-lg shadow-sm" style="background:#8B5E3C; padding-top: 10px; padding-bottom: 10px;">
    <div class="container">

        <!-- LOGO & DESKRIPSI TOKO DI NAVBAR -->
        <a class="navbar-brand text-white d-flex align-items-center gap-2 text-decoration-none" href="{{ route('dashboard') }}">
            <div style="font-size: 28px; background: #FFF8F1; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                🍞
            </div>
            <div>
                <div style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 18px; line-height: 1.2;">
                    Holland Bakery
                </div>
                <div style="font-size: 11px; color: #F3E5D8; font-weight: 400; max-width: 320px; line-height: 1.3;">
                    Menyajikan makanan & minuman berkualitas dari bahan-bahan pilihan yang segar setiap hari.
                </div>
            </div>
        </a>

        <button class="navbar-toggler bg-light" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">

                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('dashboard') ? 'fw-bold border-bottom border-2' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door-fill me-1"></i>
                        Beranda
                    </a>
                </li>

                @can('viewAny', App\Models\User::class)
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/users') ? 'fw-bold border-bottom border-2' : '' }}"
                        href="{{ route('admin.users') }}">
                        <i class="bi bi-people-fill me-1"></i>
                        Pengguna
                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('produk*') ? 'fw-bold border-bottom border-2' : '' }}"
                        href="{{ route('produk.index') }}">
                        <i class="bi bi-box-seam me-1"></i>
                        Produk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('tentang*') ? 'fw-bold border-bottom border-2' : '' }}"
                        href="{{ route('tentang') }}">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('penjualan*') ? 'fw-bold border-bottom border-2' : '' }}"
                        href="{{ route('penjualan.index') }}">
                        <i class="bi bi-cart-fill me-1"></i>
                        Penjualan
                    </a>
                </li>

            </ul>

            <div class="d-flex align-items-center">

                @auth
                    <div class="text-white text-end me-3">
                        <small>Login sebagai</small><br>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-light rounded-pill px-3">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-3">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk
                    </a>
                @endauth

            </div>

        </div>

    </div>
</nav>