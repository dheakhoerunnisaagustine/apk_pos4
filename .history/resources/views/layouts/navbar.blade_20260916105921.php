@extends('layouts.app')

@section('title', 'Tentang Kami - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div style="background: #FAF4EE; min-height: 90vh; padding: 50px 20px; font-family: 'Poppins', sans-serif;">
    <div style="max-width: 900px; margin: auto;">

        <!-- HEADER SECTION -->
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="font-size: 50px; margin-bottom: 10px;">🍞</div>
            <h1 style="font-family: 'Playfair Display', serif; color: #4A3525; font-weight: 700; margin-bottom: 10px;">
                Tentang Holland Bakery
            </h1>
            <p style="color: #8C7A6B; font-size: 15px;">
                Mengenal lebih dekat toko roti, kualitas produk, dan komitmen pelayanan kami.
            </p>
        </div>

        <!-- MAIN CARD -->
        <div style="background: white; border-radius: 25px; border: 1px solid #E8D8C8; box-shadow: 0 15px 35px rgba(139, 94, 60, .12); padding: 40px; margin-bottom: 30px;">
            
            <h3 style="font-family: 'Playfair Display', serif; color: #4A3525; margin-bottom: 20px; font-weight: 700;">
                ✨ Kualitas Rasa & Komitmen Kami
            </h3>

            <!-- PARAGRAF UTAMA YANG DIMINTA -->
            <div style="background: #FFF8F1; border-left: 5px solid #D97736; padding: 20px 25px; border-radius: 0 16px 16px 0; margin-bottom: 30px;">
                <p style="color: #5C4838; font-size: 15px; line-height: 1.8; margin: 0;">
                    Holland Bakery adalah toko roti terkemuka yang menyajikan aneka pilihan makanan dan minuman berkualitas tinggi, mulai dari roti manis, pastry renyah, kue tart, hingga hidangan penutup dan minuman segar yang selalu dibuat setiap hari. Kami berkomitmen untuk selalu mengutamakan kepuasan pelanggan dengan menggunakan bahan-bahan pilihan yang segar, higienis, dan bermutu tinggi pada setiap produk makanan dan minuman yang kami sajikan, sehingga menghasilkan cita rasa yang lezat, lembut, dan istimewa di setiap gigitannya.
                </p>
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-md-6 mb-4">
                    <div style="background: #FAF4EE; padding: 25px; border-radius: 20px; height: 100%; border: 1px solid #F0E2D3;">
                        <h5 style="font-family: 'Playfair Display', serif; color: #4A3525; font-weight: 700; margin-bottom: 12px;">
                            🥐 Aneka Produk Pilihan
                        </h5>
                        <p style="color: #7A6859; font-size: 13.5px; line-height: 1.6; margin: 0;">
                            Menyediakan berbagai variasi roti tawar, roti isi, kue tradisional, kue ulang tahun, serta hidangan pastry modern yang dipanggang secara berkala setiap harinya demi menjaga kelezatan optimal.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div style="background: #FAF4EE; padding: 25px; border-radius: 20px; height: 100%; border: 1px solid #F0E2D3;">
                        <h5 style="font-family: 'Playfair Display', serif; color: #4A3525; font-weight: 700; margin-bottom: 12px;">
                            🥤 Minuman Segar & Berkualitas
                        </h5>
                        <p style="color: #7A6859; font-size: 13.5px; line-height: 1.6; margin: 0;">
                            Melengkapi kelezatan santapan roti Anda dengan sajian aneka minuman pilihan yang menyegarkan, diracik higienis menggunakan bahan berkualitas tinggi yang cocok untuk segala suasana.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- TOMBOL KEMBALI -->
        <div style="text-align: center;">
            <a href="{{ route('dashboard') }}" style="background: #D97736; color: #ffffff; padding: 12px 30px; border-radius: 14px; text-decoration: none; font-weight: 600; display: inline-block; box-shadow: 0 5px 15px rgba(217,119,54,0.3);">
                ← Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

@endsection