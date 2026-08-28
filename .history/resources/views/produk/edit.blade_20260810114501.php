@extends('layouts.app')

@section('title', 'Edit Produk - Bakery Theme')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">


            <!-- Bakery Card -->

            <div class="card product-edit-card shadow-lg border-0">


                <!-- Header -->

                <div class="product-edit-header text-center">


                    <div class="bakery-icon-badge mx-auto mb-2">
                        🥐
                    </div>


                    <h3 class="fw-bold mb-1 title-bakery">
                        Edit Produk
                    </h3>


                    <p class="mb-0 subtitle-bakery">
                        Perbarui informasi produk bakery
                    </p>


                </div>




                <!-- Form -->

                <div class="card-body p-4 p-md-5">


                    <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')



                        <!-- Nama -->

                        <div class="mb-3">

                            <label class="form-label bakery-label">
                                🍞 Nama Produk
                            </label>


                            <input
                                type="text"
                                name="name"
                                class="form-control bakery-input"
                                value="{{ old('name', $produk->nama) }}"
                                placeholder="Masukkan nama produk..."
                                required>

                        </div>




                        <!-- Harga Beli -->

                        <div class="mb-3">

                            <label class="form-label bakery-label">
                                💰 Harga Beli
                            </label>


                            <input
                                type="number"
                                name="purchase_price"
                                class="form-control bakery-input"
                                value="{{ old('purchase_price', $produk->harga_beli) }}"
                                placeholder="Harga beli..."
                                required>

                        </div>




                        <!-- Harga Jual -->

                        <div class="mb-3">

                            <label class="form-label bakery-label">
                                💵 Harga Jual
                            </label>


                            <input
                                type="number"
                                name="selling_price"
                                class="form-control bakery-input"
                                value="{{ old('selling_price', $produk->harga_jual) }}"
                                placeholder="Harga jual..."
                                required>

                        </div>




                        <!-- Stok -->

                        <div class="mb-3">

                            <label class="form-label bakery-label">
                                📦 Stok Produk
                            </label>


                            <input
                                type="number"
                                name="stock"
                                class="form-control bakery-input"
                                value="{{ old('stock', $produk->stok) }}"
                                placeholder="Jumlah stok..."
                                required>

                        </div>




                        <!-- Foto -->

                        <div class="mb-4">

                            <label class="form-label bakery-label">
                                🖼 Foto Produk
                            </label>


                            <input
                                type="file"
                                name="foto"
                                class="form-control bakery-input">


                            @if($produk->foto)

                            <div class="mt-3 text-center">

                                <p style="color:#8C7A6B;font-size:.85rem;">
                                    Foto saat ini
                                </p>

                                <img 
                                src="{{ asset('storage/'.$produk->foto) }}"
                                width="100"
                                height="100"
                                style="
                                object-fit:cover;
                                border-radius:20px;
                                border:2px solid #E8D8C8;
                                ">

                            </div>

                            @endif


                        </div>




                        <!-- Button -->

                        <div class="d-flex justify-content-between align-items-center pt-2">


                            <a href="{{ route('produk.index') }}" 
                            class="btn btn-cancel-bakery">

                                ← Kembali

                            </a>



                            <button type="submit" 
                            class="btn btn-save-bakery">

                                ✨ Simpan

                            </button>


                        </div>



                    </form>


                </div>


            </div>


        </div>


    </div>


</div>




<style>


.title-bakery {

    font-family:'Playfair Display',serif;
    color:#4A3525;

}


.subtitle-bakery {

    font-family:'Poppins',sans-serif;
    color:#8C7A6B;
    font-size:.9rem;

}



.product-edit-card {

    border-radius:28px !important;
    overflow:hidden;
    background:#FFFFFF;
    border:1px solid #F0E2D3 !important;

}



.product-edit-header {

    background:linear-gradient(135deg,#FAF4EE 0%,#F5E8DC 100%);
    padding:30px 20px 20px;
    border-bottom:1px solid #EFE0D2;

}



.bakery-icon-badge {

    width:52px;
    height:52px;
    background:#FFFFFF;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.6rem;
    box-shadow:0 4px 12px rgba(217,119,54,.12);

}



.bakery-label {

    font-family:'Poppins',sans-serif;
    font-weight:600;
    color:#5C4838;
    font-size:.88rem;

}



.bakery-input {

    border-radius:14px !important;
    padding:11px 16px !important;
    background:#FAF8F5 !important;
    border:1px solid #E3D3C3 !important;

}



.bakery-input:focus {

    border-color:#D97736 !important;
    box-shadow:0 0 0 4px rgba(217,119,54,.15) !important;

}



.btn-save-bakery {

    background:#D97736 !important;
    color:white !important;
    border-radius:16px !important;
    padding:10px 26px !important;
    font-weight:600;
    border:none !important;

}



.btn-cancel-bakery {

    background:#EFE6DC !important;
    color:#5C4838 !important;
    border-radius:16px !important;
    padding:10px 22px !important;
    font-weight:600;
    text-decoration:none;

}


</style>


@endsection