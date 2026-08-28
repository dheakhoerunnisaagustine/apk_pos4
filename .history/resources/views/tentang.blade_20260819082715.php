{{-- Bagian Foto dan Nama Pengembang --}}
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/foto-saya.jpg') }}" alt="Foto Pengembang" 
                            class="rounded-circle shadow mb-3 border border-3 border-light" 
                            style="width: 150px; height: 150px; object-fit: cover;">
                        
                        {{-- Ganti "Nama Lengkap Anda" dengan nama asli Anda --}}
                        <h4 class="fw-bold mb-1">Nama Lengkap Anda</h4>
                        
                        {{-- Ganti deskripsi profesi/peran Anda --}}
                        <p class="text-muted">Full Stack Developer / Mahasiswa / Programmer</p>
                    </div>

                    <hr class="text-muted my-4">

                    {{-- Informasi Pengembangan Aplikasi --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-laptop me-2" style="color: #8B5E3C;"></i>Pengembangan Aplikasi
                        </h5>
                        {{-- Ganti kalimat deskripsi di bawah jika ingin menceritakan aplikasi buatan Anda --}}
                        <p class="text-secondary" style="text-align: justify;">
                            Aplikasi <strong>Holland Bakery Management System</strong> ini dikembangkan sebagai solusi digital untuk mempermudah pengelolaan produk, pencatatan transaksi penjualan, serta manajemen pengguna secara efisien dan terstruktur.
                        </p>
                    </div>

                    {{-- Teknologi yang Digunakan (Sesuaikan badge jika perlu) --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-cpu me-2" style="color: #8B5E3C;"></i>Teknologi yang Digunakan
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-danger px-3 py-2 fs-6">Laravel 10/11</span>
                            <span class="badge bg-primary px-3 py-2 fs-6">PHP 8+</span>
                            <span class="badge bg-info text-dark px-3 py-2 fs-6">Bootstrap 5</span>
                            <span class="badge bg-secondary px-3 py-2 fs-6">MySQL</span>
                            <span class="badge bg-dark px-3 py-2 fs-6">HTML5 & CSS3</span>
                        </div>
                    </div>

                    {{-- Informasi Kontak / Pengembang (Ganti dengan data Anda) --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-person-badge me-2" style="color: #8B5E3C;"></i>Informasi Pengembang
                        </h5>
                        <ul class="list-unstyled text-secondary">
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i> Email: emailkamu@domain.com</li>
                            <li class="mb-2"><i class="bi bi-github me-2"></i> GitHub: github.com/usernamekamu</li>
                            <li class="mb-2"><i class="bi bi-instagram me-2"></i> Instagram: @usernamekamu</li>
                        </ul>
                    </div>