@csrf

@if (!empty($produk->foto))
    <div style="margin-bottom: 25px;">
        <label style="font-weight: 600; color: #5C4838;">Foto Saat Ini</label><br>

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

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 25px;">
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

<div style="margin-bottom: 20px;">
    <label style="font-weight: 600; color: #5C4838;">
        🍞 Nama Produk
    </label>

    <input type="text"
           name="nama"
           value="{{ old('nama', $produk->nama ?? '') }}"
           style="
               width: 100%;
               margin-top: 8px;
               padding: 14px;
               border: 1px solid #E6D7C8;
               border-radius: 15px;
               background: #FFF8F2;
           ">

    @error('nama')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- Harga Beli & Jenis Produk Berjajar (2 Kolom) -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
    <div>
        <label style="font-weight: 600; color: #5C4838;">
            💰 Harga Beli
        </label>

        <input type="number"
               name="harga_beli"
               value="{{ old('harga_beli', $produk->harga_beli ?? '') }}"
               style="
                   width: 100%;
                   margin-top: 8px;
                   padding: 14px;
                   border: 1px solid #E6D7C8;
                   border-radius: 15px;
                   background: #FFF8F2;
               ">
        @error('harga_beli')
            <div style="color: red; margin-top: 6px;">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label style="font-weight: 600; color: #5C4838; display: block; margin-bottom: 8px;">
            🏷️ Jenis Produk
        </label>

        <select name="jenis"
                class="form-control @error('jenis') is-invalid @enderror"
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
            <option value="Makanan" {{ (old('jenis', $produk->jenis ?? '') == 'Makanan') ? 'selected' : '' }}>Makanan</option>
            <option value="Minuman" {{ (old('jenis', $produk->jenis ?? '') == 'Minuman') ? 'selected' : '' }}>Minuman</option>
        </select>

        @error('jenis')
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
           name="harga_jual"
           value="{{ old('harga_jual', $produk->harga_jual ?? '') }}"
           style="
               width: 100%;
               margin-top: 8px;
               padding: 14px;
               border: 1px solid #E6D7C8;
               border-radius: 15px;
               background: #FFF8F2;
           ">
    @error('harga_jual')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror
</div>

<div style="margin-top: 20px;">
    <label style="font-weight: 600; color: #5C4838;">
        📦 Stok
    </label>

    <input type="number"
           name="stok"
           value="{{ old('stok', $produk->stok ?? '') }}"
           style="
               width: 100%;
               margin-top: 8px;
               padding: 14px;
               border: 1px solid #E6D7C8;
               border-radius: 15px;
               background: #FFF8F2;
           ">
    @error('stok')
        <div style="color: red; margin-top: 6px;">
            {{ $message }}
        </div>
    @enderror
</div>

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