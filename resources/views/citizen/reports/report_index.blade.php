@extends('citizen.citizen_master')

@section('title', 'Daftar Laporan | WargaLapor')

@push('style')
<style>
    .card-hover:hover {
        box-shadow: 0 12px 24px rgba(2, 8, 23, 0.08);
        transition: 0.2s ease;
    }

    .status-badge {
        font-weight: 600;
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        overflow: hidden;
    }

    .avatar-32 {
        width: 32px;
        height: 32px;
        object-fit: cover;
    }

    .navbar .dropdown-menu {
        --bs-dropdown-padding-x: 0.25rem;
    }

    .navbar .dropdown-item {
        border-radius: 0.5rem;
    }

    .navbar .dropdown-item:active {
        background-color: var(--bs-primary);
        color: #fff;
    }
</style>
@endpush

@section('content')
<main class="py-4">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <div>
                <h1 class="h2 fw-bold mb-1">Daftar Laporan</h1>
                <p class="text-secondary mb-0">
                    Pantau semua laporan masalah infrastruktur dan kebersihan dari warga
                </p>
            </div>
            <a href="{{ route('citizen.reports.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                <i class="bi bi-plus-lg me-1"></i> Buat Laporan Baru
            </a>
        </div>

        <div class="bg-white border rounded-4 p-4 mb-4 shadow-sm">
            <form action="{{ route('citizen.reports.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-12 col-md-3">
                        <label for="q" class="form-label mb-1 small fw-semibold">Pencarian</label>
                        <input id="q" name="q" type="search" class="form-control form-control-sm"
                            placeholder="Cari judul/kode..." value="{{ request('q') }}" />
                    </div>

                    <div class="col-12 col-md-2">
                        <label for="category" class="form-label mb-1 small fw-semibold">Kategori</label>
                        <select id="category" name="category" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category')==$category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-2">
                        <label for="status" class="form-label mb-1 small fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            <option value="pending" @selected(request('status')=='pending' )>Pending</option>
                            <option value="verified" @selected(request('status')=='verified' )>Diverifikasi</option>
                            <option value="in_progress" @selected(request('status')=='in_progress' )>Dikerjakan</option>
                            <option value="rejected" @selected(request('status')=='rejected' )>Ditolak</option>
                            <option value="resolved" @selected(request('status')=='resolved' )>Selesai</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="type" class="form-label mb-1 small fw-semibold">Jenis Laporan</label>
                        <select id="type" name="type" class="form-select form-select-sm">
                            <option value="">Semua Laporan</option>
                            @auth
                            <option value="me" @selected(request('type')=='me' )>Laporan Saya</option>
                            @endauth
                        </select>
                    </div>

                    <div class="col-12 col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse ($reports as $report)
            @php
            $statusClass = match ($report->latest_status) {
            'pending' => 'bg-secondary-subtle text-secondary-emphasis',
            'verified' => 'bg-info-subtle text-info-emphasis',
            'in_progress' => 'bg-warning-subtle text-warning-emphasis',
            'resolved' => 'bg-success-subtle text-success-emphasis',
            'rejected' => 'bg-danger-subtle text-danger-emphasis',
            default => 'bg-light text-muted',
            };
            @endphp

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 card-hover">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h3 class="h6 mb-0">{{ $report->title }}</h3>
                                <small class="text-secondary">{{ $report->code }}</small>
                            </div>
                            <span class="badge rounded-pill {{ $statusClass }} status-badge">
                                {{ Str::title(str_replace('_', ' ', $report->latest_status ?? 'N/A')) }}
                            </span>
                        </div>

                        <p class="text-secondary text-truncate-2 mb-3">{{ $report->description }}</p>

                        <div class="d-flex flex-wrap align-items-center gap-3 text-secondary small mb-2">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-tag me-1"></i> {{$report->category->name}}
                            </span>
                            <span class="d-flex align-items-center">
                                <i class="bi bi-calendar-event me-1"></i> {{ $report->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        <div class="d-flex align-items-center text-secondary small mb-3">
                            <i class="bi bi-geo-alt me-2 flex-shrink-0"></i>
                            <p class="mb-0 text-truncate-2">
                                {{ $report->location }}
                            </p>
                        </div>

                        <a href="{{ route('citizen.reports.show', $report) }}" class="btn btn-outline-primary w-100 mt-auto">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-light border text-center mb-0">
                    Tidak ada laporan yang cocok dengan filter.
                </div>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    </div>
</main>
@endsection