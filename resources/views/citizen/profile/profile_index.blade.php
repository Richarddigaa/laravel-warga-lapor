@extends('citizen.citizen_master')

@section('title', 'Profil Saya | WargaLapor')

@push('style')
<style>
    :root {
        --primary: #0d6efd;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --border: #e5e7eb;
        --bg: #f5f7fb;
    }
</style>
@endpush

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <!-- Header -->
                <div class="mb-4">
                    <h1 class="h3 fw-bold mb-1">Profil Saya</h1>
                    <p class="text-secondary">Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun.</p>
                </div>

                <!-- Card -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <!-- Banner Background -->
                    <div class="bg-primary-subtle" style="height: 120px;"></div>

                    <div class="card-body p-4 position-relative">

                        <!-- Foto Profil -->
                        <div class="position-absolute" style="top: -60px; left: 30px;">
                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('assets/img/user.png') }}"
                                alt="Profile"
                                class="rounded-circle border border-4 border-white shadow-sm"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        </div>

                        <!-- Tombol Edit -->
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('citizen.profile.edit') }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-pencil-square me-1"></i> Ubah Profil
                            </a>
                        </div>

                        <!-- Info Nama & Status -->
                        <div class="mt-4 pt-2 mb-4">
                            <h2 class="h4 fw-bold mb-1">{{ $user->name }}</h2>
                            <p class="text-secondary mb-2">{{ $user->email }}</p>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                <i class="bi bi-check-circle-fill me-1"></i> Akun Warga Aktif
                            </span>
                        </div>

                        <hr class="border-secondary-subtle my-4">

                        <!-- Grid Data Detail -->
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="text-secondary small mb-1">Nomor Induk Kependudukan (NIK)</div>
                                <div class="fw-medium text-dark">{{ $user->nik }}</div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="text-secondary small mb-1">Nomor Telepon</div>
                                <div class="fw-medium text-dark">{{ $user->phone }}</div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="text-secondary small mb-1">Tanggal Lahir</div>
                                <div class="fw-medium text-dark">
                                    {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->translatedFormat('d F Y') : '-' }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="text-secondary small mb-1">Pekerjaan</div>
                                <div class="fw-medium text-dark">{{ $user->type_of_work ?? '-' }}</div>
                            </div>

                            <div class="col-12">
                                <div class="text-secondary small mb-1">Alamat Lengkap</div>
                                <div class="fw-medium text-dark">{{ $user->address ?? '-' }}</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Section Statistik -->
                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                                    <i class="bi bi-file-earmark-text fs-4"></i>
                                </div>
                                <div>
                                    <div class="small text-secondary">Total Laporan</div>
                                    <!-- Asumsi ada relasi reports -->
                                    <div class="h5 fw-bold mb-0">{{ $user->reports()->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-3" style="background: rgba(37, 99, 235, 0.12); color: #2563eb">
                                    <i class="bi bi-stars fs-4"></i>
                                </div>
                                <div>
                                    <div class="small text-secondary">Poin Saat Ini</div>
                                    <div class="h5 fw-bold mb-0">{{ number_format($user->getCurrentPoints()) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection