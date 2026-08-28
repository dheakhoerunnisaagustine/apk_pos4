@csrf

@if (!empty($produk->foto))
<div style="margin-bottom:25px;">
    <label style="font-weight:600;color:#5C4838;">Foto Saat Ini</label><br>

    <img src="{{ asset('storage/'.$produk->foto) }}"
        style="
        width:150px;
        height:150px;
        object-fit:cover;
        border-radius:20px;
        border:3px solid #F3E3D3;
        margin-top:10px;
        ">
</div>
@endif


<div style="display:grid;grid-template-columns:1fr 1fr;gap:25px;margin-bottom:25px;">

    <!-- Upload -->
    <div>

        <label style="font-weight:600;color:#5C4838;">
            📷 Gambar Produk
        </label>

        <input
            type="file"
            name="foto"
            onchange="previewImage(this)"
            class="@error('foto') is-invalid @enderror"

            style="
            width:100%;
            margin-top:8px;
            padding:12px;
            border:1px solid #E6D7C8;
            border-radius:15px;
            background:#FFF8F2;
            ">

        @error('foto')
        <div style="color:red;margin-top:6px;">
            {{ $message }}
        </div>
        @enderror

    </div>

    <!-- Preview -->
    <div>

        <label style="font-weight:600;color:#5C4838;">
            Preview Foto
        </label>

        <br>

        <img id="preview"
            style="
            display:none;
            width:150px;
            height:150px;
            object-fit:cover;
            border-radius:20px;
            border:3px solid #F3E3D3;
            margin-top:10px;
            ">

    </div>

</div>



<!-- Nama Produk -->

<div style="margin-bottom: 20px;">
    <label style="font-weight: 600; color: #5C4838;">
        🍞 Nama Produk
    </label>

    <input type="text"
           name="name"
           value="{{ old('name', $produk->name ?? '') }}"
           style="
               width: 100%;
               margin-top: 8px;
               padding: 14px;
               border: 1px solid #E6D7C8;
               border-radius: 15px;
               background: #FFF8F2;
           ">

    @error('name')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror

    </div>

</div>

<!-- Harga -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

    <div>
        <label style="font-weight: 600; color: #5C4838;">
            💰 Harga Beli
        </label>

        <input type="number"
               name="purchase_price"
               value="{{ old('purchase_price', $produk->harga_beli ?? '') }}"
               style="
                   width: 100%;
                   margin-top: 8px;
                   padding: 14px;
                   border: 1px solid #E6D7C8;
                   border-radius: 15px;
                   background: #FFF8F2;
               ">
    </div>

    <div>
        <label style="font-weight: 600; color: #5C4838;">
            🏷 Harga Jual
        </label>


