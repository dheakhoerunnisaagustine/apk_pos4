<nav class="navbar navbar-expand-lg shadow-sm" style="background:#8B5E3C;">
    <div class="container">

        <!-- LOGO DI POJOK KIRI YANG KALAU DIPENCET MUNCUL POP-UP -->
        <a class="navbar-brand text-white fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#modalTentangToko" style="cursor: pointer;">
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

                <!-- MENU TENTANG DI TENGAH DIKEMBALIKAN DI SINI -->
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

<!-- MODAL / POP-UP DESKRIPSI TOKO HOLLAND BAKERY -->
<div class="modal fade" id="modalTentangToko" tabindex="-1" aria-labelledby="modalTentangTokoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; background: #FAF4EE;">
            
            <div class="modal-header border-0 pb-0" style="padding: 25px 30px 0 30px;">
                <h5 class="modal-title fw-bold" id="modalTentangTokoLabel" style="color: #4A3525; font-size: 22px;">
                    🍞 Tentang Holland Bakery
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding: 20px 30px 30px 30px; font-family: 'Poppins', sans-serif;">
                
                <!-- KOTAK DESKRIPSI UTAMA -->
                <div style="background: #FFF8F1; border-left: 5px solid #D97736; padding: 20px; border-radius: 0 12px 12px 0; margin-bottom: 20px;">
                    <p style="color: #5C4838; font-size: 15px; line-height: 1.7; margin: 0;">
                        Holland Bakery adalah toko roti terkemuka yang menyajikan aneka pilihan makanan dan minuman berkualitas tinggi, mulai dari roti manis, pastry renyah, kue tart, hingga hidangan penutup dan minuman segar yang selalu dibuat setiap hari. Kami berkomitmen untuk selalu mengutamakan kepuasan pelanggan dengan menggunakan bahan-bahan pilihan yang segar, higienis, dan bermutu tinggi pada setiap produk makanan dan minuman yang kami sajikan.
                    </p>
                </div>

                <!-- INFO TAMBAHAN MAKANAN & MINUMAN -->
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div style="background: white; padding: 15px; border-radius: 12px; border: 1px solid #E8D8C8; height: 100%;">
                            <h6 style="color: #4A3525; font-weight: 700; margin-bottom: 8px;">🥐 Produk Makanan</h6>
                            <p style="color: #7A6859; font-size: 13px; margin: 0; line-height: 1.5;">
                                Berbagai variasi roti, pastry, dan kue dengan tekstur lembut serta cita rasa khas yang dipanggang segar setiap hari.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div style="background: white; padding: 15px; border-radius: 12px; border: 1px solid #E8D8C8; height: 100%;">
                            <h6 style="color: #4A3525; font-weight: 700; margin-bottom: 8px;">🥤 Minuman Segar</h6>
                            <p style="color: #7A6859; font-size: 13px; margin: 0; line-height: 1.5;">
                                Aneka pilihan minuman higienis yang diracik khusus untuk menemani santapan lezat Anda.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal" style="background: #8C7A6B; border: none;">Tutup</button>
            </div>

        </div>
    </div>
</div>