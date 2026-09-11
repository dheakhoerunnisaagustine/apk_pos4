@csrf

@if (!empty($produk->foto))
    <div style="margin-bottom: 25px;">
        <label style="font-weight: 600; color: #5C4838;">
            Foto Saat Ini
        </label>
        <br>

        <img src="{{ asset('storage/'.$produk->foto) }}"
             style="
                 width: 150px;
                 height: 150px;
                 object-fit: cover;
                 border-radius: 20px;
                 border: 3px solid #F3E3D3;
                 margin-top: 10px;
             ">
    </div>
@endif

<div style="
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 25px;
">

    <!-- Gambar Produk -->
    <div>
        <label style="font-weight: 600; color: #5C4838;">
            📷 Gambar Produk
        </label>

        <input type="file"
               name="foto"
               onchange="previewImage(this)"
               class="@error('foto') is-invalid @enderror"
               style="
                   width: 100%;
                   margin-top: 8px;
                   padding: 12px;
                   border: 1px solid #E6D7C8;
                   border-radius: 15px;
                   background: #FFF8F2;
               ">

        @error('foto')
            <div style="color: red; margin-top: 6px;">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Preview Foto -->
    <div>
        <label style="font-weight: 600; color: #5C4838;">
            Preview Foto
        </label>

        <br>

        <img id="preview"
             style="
                 display: none;
                 width: 150px;
                 height: 150px;
                 object-fit: cover;
                 border-radius: 20px;
                 border: 3px solid #F3E3D3;
                 margin-top: 10px;
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
           value="{{ old('name', $produk->nama ?? '') }}"
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

<!-- Harga Beli & Jenis Produk -->
<div style="
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
">

    <!-- Harga Pokok -->
    <div>
        <label style="font-weight: 600; color: #5C4838;">
            💰 Harga Pokok
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

        @error('purchase_price')
            <div style="color: red; margin-top: 6px;">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Jenis Produk -->
   <div>
    <label style="font-weight: 600; color: #5C4838; display: block; margin-bottom: 8px;">
        🏷️ Jenis Produk
    </label>

    <select name="jenis_id"
            id="jenis_id"
            required
            style="
                width: 100%;
                padding: 14px;
                border: 1px solid #E6D7C8;
                border-radius: 15px;
                background: #FFF8F2;
                color: #5C4838;
            ">

        <option value="">-- Pilih Jenis Produk --</option>

        @foreach($jenis as $item)
            <option value="{{ $item->jenis_id }}"
                {{ old('jenis_id') == $item->jenis_id ? 'selected' : '' }}>
                {{ $item->nama_jenis }}
            </option>
        @endforeach

    </select>

    @error('jenis_id')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror
</div>

</div>

<!-- Harga Jual -->
<div style="margin-bottom: 20px;">
    <label style="font-weight: 600; color: #5C4838;">
        🏷 Harga Jual
    </label>

    <input type="number"
           name="selling_price"
           value="{{ old('selling_price', $produk->harga_jual ?? '') }}"
           style="
               width: 100%;
               margin-top: 8px;
               padding: 14px;
               border: 1px solid #E6D7C8;
               border-radius: 15px;
               background: #FFF8F2;
           ">

    @error('selling_price')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- Stok -->
<div style="margin-top: 20px;">
    <label style="font-weight: 600; color: #5C4838;">
        📦 Stok
    </label>

    <input type="number"
           name="stock"
           value="{{ old('stock', $produk->stok ?? '') }}"
           style="
               width: 100%;
               margin-top: 8px;
               padding: 14px;
               border: 1px solid #E6D7C8;
               border-radius: 15px;
               background: #FFF8F2;
           ">

    @error('stock')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- Tombol -->
<div style="
    display: flex;
    gap: 15px;
    margin-top: 35px;
">

    <button type="submit"
            style="
                background: #D97736;
                color: white;
                border: none;
                padding: 14px 30px;
                border-radius: 15px;
                font-weight: 600;
                cursor: pointer;
                box-shadow: 0 10px 20px rgba(217, 119, 54, .25);
            ">
        💾 Simpan
    </button>

    <a href="{{ route('produk.index') }}"
       style="
            background: #EFE4D8;
            color: #5C4838;
            padding: 14px 30px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
       ">
        ← Kembali
    </a>

</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            preview.src = URL.createObjectURL(input.files[0]);
            preview.style.display = 'block';
        }
    }
</script>