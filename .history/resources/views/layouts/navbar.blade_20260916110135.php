<nav class="navbar navbar-expand-lg shadow-sm" style="background:#8B5E3C;">
    <div class="container">

        <a class="navbar-brand text-white fw-bold" href="{{ route('tentang') }}">
            🍞 Holland Bakery
        </a>

        <button class="navbar-toggler bg-light" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

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

                <!-- MENU TENTANG -->
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