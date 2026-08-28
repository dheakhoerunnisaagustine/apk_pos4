<form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off" style="background: #FFF8F2; padding: 30px; border-radius: 20px; border: 1px solid #E6D7C8; box-shadow: 0 10px 25px rgba(92, 72, 56, 0.05);">
    @csrf

    <!-- Input dummy tersembunyi untuk mengecoh Chrome Autofill -->
    <input type="text" style="display:none;" aria-hidden="true">
    <input type="password" style="display:none;" aria-hidden="true">

    <!-- Input Nama -->
    <div class="mb-3">
        <label class="form-label font-weight-bold" style="color: #4A3525; font-weight: 600;">Nama Lengkap</label>
        <input type="text" name="name"
            class="form-control bakery-input @error('name') is-invalid @enderror"
            placeholder="Masukkan nama anda"
            value="{{ old('name', $user->name ?? '') }}"
            autocomplete="off">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Input Email -->
    <div class="mb-3">
        <label class="form-label" style="color: #4A3525; font-weight: 600;">Alamat Email</label>
        <input type="email" name="email"
            class="form-control bakery-input @error('email') is-invalid @enderror"
            placeholder="Masukan email anda"
            value="{{ old('email', $user->email ?? '') }}"
            autocomplete="off">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Input Password -->
    <div class="mb-3">
        <label class="form-label" style="color: #4A3525; font-weight: 600;">Password</label>
        <input type="password" name="password"
            class="form-control bakery-input @error('password') is-invalid @enderror"
            placeholder="Masukan password anda"
            autocomplete="new-password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Input Role -->
    <div class="mb-3">
        <label class="form-label" style="color: #4A3525; font-weight: 600;">Role Pengguna</label>
        <select name="role_id"
            class="form-select bakery-input @error('role_id') is-invalid @enderror">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                    @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        @error('role_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Tombol Aksi -->
    <div style="display: flex; gap: 15px; margin-top: 25px;">
        <button type="submit"
                style="
                    background: #D97736;
                    color: white;
                    border: none;
                    padding: 12px 25px;
                    border-radius: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    box-shadow: 0 6px 15px rgba(217, 119, 54, .25);
                ">
            💾 Simpan
        </button>

        <a href="{{ route('admin.users.index') }}"
           style="
                background: #EFE4D8;
                color: #5C4838;
                padding: 12px 25px;
                border-radius: 12px;
                text-decoration: none;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
           ">
            ← Kembali
        </a>
    </div>
</form>

<style>
/* Styling Input Tema Bakery */
.bakery-input {
    background-color: #FAF8F5 !important;
    border: 1px solid #E3D3C3 !important;
    border-radius: 12px !important;
    padding: 10px 16px !important;
    color: #3D2C1E !important;
}

.bakery-input:focus {
    background-color: #FFFFFF !important;
    border-color: #D97736 !important;
    box-shadow: 0 0 0 3px rgba(217, 119, 54, 0.15) !important;
}
</style>