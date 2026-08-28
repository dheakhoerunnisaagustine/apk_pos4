@extends('layouts.app')

@section('title', 'Manajemen User - Bakery POS')

@section('content')

@include('layouts.navbar')

<!-- Import Font Google untuk tema Bakery -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div class="bakery-bg-wrapper">
    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bold mb-1 bakery-title">
                    👥 Manajemen User
                </h2>
                <p class="mb-0 bakery-subtitle">
                    Kelola akun Admin, Kasir, dan staf toko bakery kamu.
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}" class="btn btn-bakery-add">
                <i class="bi bi-person-plus-fill me-1"></i>
                ✨ Tambah User
            </a>
        </div>

        <!-- Search Bar -->
        <div class="card bakery-card shadow-sm mb-4">
            <div class="card-body p-3">
                <form action="{{ route('admin.users') }}" method="GET">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control bakery-input"
                            placeholder="Cari nama atau email pengguna...">

                        <button class="btn btn-bakery-search" type="submit">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card bakery-card shadow-lg border-0">
            
            <div class="card-header bakery-header d-flex align-items-center justify-content-between p-3">
                <h5 class="mb-0 fw-bold bakery-title-card">
                    🥐 Daftar Pengguna
                </h5>
                <span class="badge bakery-badge-count">
                    Total: {{ $users->total() ?? count($users) }} User
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bakery-table-head">
                        <tr>
                            <th width="70" class="ps-4">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="200" class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                        <tr class="bakery-tr">
                            <td class="ps-4 text-muted font-monospace">
                                {{ $loop->iteration }}
                            </td>

                            <td class="fw-bold text-dark-brown">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar-icon">
                                        👤
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="text-secondary">
                                {{ $user->email }}
                            </td>

                            <td>
                                @if(optional($user->role)->name == 'Admin' || $user->role_id == 1)
                                    <span class="badge bakery-role-admin">
                                        👑 Admin
                                    </span>
                                @else
                                    <span class="badge bakery-role-kasir">
                                        🧁 Kasir
                                    </span>
                                @endif
                            </td>

                            <td class="text-center pe-4">

    <div class="d-flex justify-content-center gap-2">


        {{-- EDIT ICON --}}
        <a href="{{ route('admin.users.edit', $user) }}"

        style="
        width:38px;
        height:38px;
        background:#F5D7B8;
        color:#6B4328;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-decoration:none;
        font-size:18px;
        box-shadow:0 4px 10px rgba(139,94,60,.15);
        ">

            ✏️

        </a>



        {{-- HAPUS ICON --}}
        <form action="{{ route('admin.users.destroy', $user) }}"
              method="POST"
              style="display:inline;">

            @csrf
            @method('DELETE')


            <button

            onclick="return confirm('Yakin ingin menghapus user ini?')"

            style="
            width:38px;
            height:38px;
            background:#E8B4A8;
            color:#7A2E22;
            border:none;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:18px;
            cursor:pointer;
            box-shadow:0 4px 10px rgba(122,46,34,.15);
            ">

                🗑️

            </button>


        </form>


    </div>

</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div style="font-size: 2.5rem;" class="mb-2">🥖</div>
                                <p class="mb-0 fw-medium">Belum ada data user tersedia.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($users, 'links'))
            <div class="card-footer bakery-footer p-3">
                {{ $users->links() }}
            </div>
            @endif

        </div>

    </div>
</div>

<style>
/* Background Wrapper */
.bakery-bg-wrapper {
    background-color: #FAF4EE;
    min-height: 90vh;
    font-family: 'Poppins', sans-serif;
}

/* Tipografi */
.bakery-title {
    font-family: 'Playfair Display', serif;
    color: #4A3525;
}

.bakery-subtitle {
    color: #8C7A6B;
    font-size: 0.92rem;
}

.bakery-title-card {
    font-family: 'Playfair Display', serif;
    color: #4A3525;
}

.text-dark-brown {
    color: #3D2C1E;
}

/* Card Styling */
.bakery-card {
    border-radius: 20px !important;
    background: #FFFFFF !important;
    border: 1px solid #E8D8C8 !important;
    overflow: hidden;
}

.bakery-header {
    background: linear-gradient(135deg, #FAF4EE 0%, #F5E8DC 100%) !important;
    border-bottom: 1px solid #EFE0D2 !important;
}

.bakery-footer {
    background: #FAF8F5 !important;
    border-top: 1px solid #EFE0D2 !important;
}

.bakery-badge-count {
    background-color: #EFE6DC;
    color: #5C4838;
    padding: 6px 12px;
    border-radius: 12px;
    font-weight: 500;
}

/* Avatar Icon Small */
.user-avatar-icon {
    width: 32px;
    height: 32px;
    background: #FAF4EE;
    border: 1px solid #E8D8C8;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

/* Table Styling */
.bakery-table-head {
    background-color: #FAF4EE !important;
}

.bakery-table-head th {
    color: #5C4838 !important;
    font-weight: 600 !important;
    padding: 14px 12px !important;
    font-size: 0.88rem;
    border-bottom: 1px solid #EFE0D2 !important;
}

.bakery-tr {
    transition: background-color 0.2s ease;
}

.bakery-tr:hover {
    background-color: #FAF8F5 !important;
}

.bakery-tr td {
    padding: 14px 12px !important;
    border-bottom: 1px solid #F0E2D3 !important;
}

/* Forms & Inputs */
.bakery-input {
    border-radius: 12px 0 0 12px !important;
    background-color: #FAF8F5 !important;
    border: 1px solid #E3D3C3 !important;
    color: #3D2C1E !important;
    padding: 10px 16px !important;
}

.bakery-input:focus {
    background-color: #FFFFFF !important;
    border-color: #D97736 !important;
    box-shadow: 0 0 0 3px rgba(217, 119, 54, 0.15) !important;
}

.btn-bakery-search {
    background-color: #8B5E3C !important;
    color: #FFFFFF !important;
    border-radius: 0 12px 12px 0 !important;
    padding: 10px 20px !important;
    font-weight: 600 !important;
    border: none !important;
}

.btn-bakery-search:hover {
    background-color: #6F452D !important;
}

/* Buttons */
.btn-bakery-add {
    background-color: #D97736 !important;
    color: #FFFFFF !important;
    border-radius: 14px !important;
    padding: 10px 22px !important;
    font-weight: 600 !important;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(217, 119, 54, 0.25);
    transition: all 0.2s ease;
}

.btn-bakery-add:hover {
    background-color: #C06528 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(217, 119, 54, 0.35);
}

.btn-bakery-edit {
    background-color: #F59E0B !important;
    color: #FFFFFF !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    padding: 6px 14px !important;
    border: none !important;
}

.btn-bakery-edit:hover {
    background-color: #D97706 !important;
}

.btn-bakery-delete {
    background-color: #EF4444 !important;
    color: #FFFFFF !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    padding: 6px 14px !important;
    border: none !important;
}

.btn-bakery-delete:hover {
    background-color: #DC2626 !important;
}

/* Role Badges */
.bakery-role-admin {
    background-color: #FEE2E2 !important;
    color: #991B1B !important;
    padding: 7px 14px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    font-size: 0.8rem !important;
}

.bakery-role-kasir {
    background-color: #FEF3C7 !important;
    color: #92400E !important;
    padding: 7px 14px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    font-size: 0.8rem !important;
}
</style>

@endsection