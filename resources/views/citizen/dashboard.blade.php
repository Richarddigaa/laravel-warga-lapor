@extends('citizen.citizen_master')
@section('title', 'Dashboard | WargaLapor')

@push('style')
<style>
    .card {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 10px 26px rgba(2, 8, 23, 0.08);
    }

    .stat .icon {
        width: 40px;
        height: 40px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .border-soft {
        border-color: #e5e7eb !important;
    }

    .btn-outline {
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #0f172a;
    }

    .btn-outline:hover {
        background: #f8fafc;
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<main class="container container-7xl py-4 py-lg-5">
    <h1 class="h3 fw-bold mb-3">Dashboard Warga</h1>
    <p class="text-secondary mb-4">Selamat datang kembali, {{$user->name}}!</p>

    <!-- SUMMARY CARDS -->
    <div class="row g-3 mb-3 justify-content-center">

        <div class="col-12 col-md-4">
            <div class="card p-3 stat h-100">
                <div class="d-flex align-items-center">
                    <div class="icon me-3" style="background: rgba(37, 99, 235, 0.12); color: #2563eb">
                        <i class="bi bi-card-text"></i>
                    </div>
                    <div>
                        <div class="small text-secondary">Total Laporan</div>
                        <div class="h4 fw-bold mb-0">{{ $reportUserCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card p-3 stat h-100">
                <div class="d-flex align-items-center">
                    <div class="icon me-3" style="background: rgba(16, 185, 129, 0.12); color: #16a34a">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div>
                        <div class="small text-secondary">Laporan Valid</div>
                        <div class="h4 fw-bold mb-0">{{ $reportVerified }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card p-3 stat h-100">
                <div class="d-flex align-items-center">
                    <div class="icon me-3" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <div class="small text-secondary">Laporan Aktif</div>
                        <div class="h4 fw-bold mb-0">{{ $reportInProgress }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card p-3 stat h-100">
                <div class="d-flex align-items-center">
                    <div class="icon me-3" style="background: rgba(37, 99, 235, 0.12); color: #2563eb">
                        <i class="bi bi-stars"></i>
                    </div>
                    <div>
                        <div class="small text-secondary">Total Poin</div>
                        <div class="h4 fw-bold mb-0">{{ $totalPoints }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card p-3 stat h-100">
                <div class="d-flex align-items-center">
                    <div class="icon me-3" style="background: rgba(16, 185, 129, 0.12); color: #16a34a">
                        <i class="bi bi-clipboard2-check"></i>
                    </div>
                    <div>
                        <div class="small text-secondary">Laporan Selesai</div>
                        <div class="h4 fw-bold mb-0">{{ $reportResolved }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card p-3 stat h-100">
                <div class="d-flex align-items-center">
                    <div class="icon me-3" style="background: rgba(239, 68, 68, 0.12); color: #ef4444">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div>
                        <div class="small text-secondary">Laporan Ditolak</div>
                        <div class="h4 fw-bold mb-0">{{ $reportRejected }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">
        <!-- LEFT: LAPORAN TERBARU (PERSIS seperti kodenmu) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h2 class="h6 fw-bold mb-0 text-dark">Riwayat Laporan Terbaru</h2>
                    <a href="{{ route('citizen.reports.index') }}" class="small fw-semibold text-decoration-none text-primary">
                        Lihat Semua
                    </a>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($paginateUserReports as $report)
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

                    <div class="list-group-item list-group-item-action p-3 p-md-4">
                        <div class="row align-items-center g-3">

                            <div class="col-12 col-md-9">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                    <span class="small text-muted fw-medium">{{$report->code}}</span>
                                    <span class="badge rounded-pill {{ $statusClass }}">
                                        {{ Str::title(str_replace('_', ' ', $report->latest_status ?? 'N/A')) }}
                                    </span>
                                </div>

                                <h3 class="h6 fw-bold text-dark mb-2">
                                    {{$report->title}}
                                </h3>

                                <p class="small text-secondary text-truncate-2 mb-2">
                                    {{$report->description}}
                                </p>

                                <div class="d-flex flex-wrap align-items-center gap-3 text-secondary small mb-2">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-tag me-1"></i> {{$report->category->name}}
                                    </span>
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $report->created_at->translatedFormat('d F Y') }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-center text-secondary small mb-2">
                                    <i class="bi bi-geo-alt me-2 flex-shrink-0"></i>
                                    <p class="mb-0 text-truncate-2">
                                        {{ $report->location }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 text-md-end">
                                <a href="{{ route('citizen.reports.show', $report) }}"
                                    class="btn btn-outline-primary btn-sm rounded-pill px-4 w-100 w-md-auto">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="text-center py-5">
                        <div class="mb-3 text-muted opacity-50">
                            <i class="bi bi-clipboard-x display-4"></i>
                        </div>
                        <h6 class="fw-semibold text-secondary">Belum ada riwayat laporan</h6>
                        <p class="small text-muted mb-0">Laporan yang Anda buat akan muncul di sini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT: PROFIL SAYA (sesuai wireframe) -->
        <div class="col-lg-4">
            <div class="card p-3 p-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-badge me-2"></i>
                    <h2 class="h6 fw-semibold mb-0">Profil Saya</h2>
                </div>

                <div class="text-center mb-3">
                    <!-- Avatar -->
                    <div class="rounded-circle overflow-hidden d-inline-block border bg-light" style="width:72px;height:72px">

                        <img
                            src="{{ $user->avatar ? Storage::url($user->avatar) : asset('assets/img/user.png') }}"
                            alt="Avatar"
                            class="w-100 h-100 object-fit-cover"
                            loading="lazy" />

                    </div>

                    <div class="fw-semibold mt-2">{{$user->name}}</div>
                </div>

                <div class="d-grid gap-2 small text-secondary mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope me-2"></i> {{$user->email}}
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-telephone me-2"></i> {{$user->phone}}
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar2-check me-2"></i> Bergabung: {{$user->created_at->format('d F Y')}}
                    </div>
                </div>

                <a href="{{ route('citizen.profile.index') }}" class="btn btn-outline w-100"><i class="bi bi-pencil-square me-2"></i>Ubah Profil</a>
            </div>
        </div>
    </div>
</main>
@endsection