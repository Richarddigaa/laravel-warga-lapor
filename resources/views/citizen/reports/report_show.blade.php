@extends('citizen.citizen_master')

@section('title', 'Detail Laporan | WargaLapor')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">

<!-- Leaflet -->
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    :root {
        --border: #e5e7eb;
        --success: #16a34a;
        --warning: #f59e0b;
        --primary: #0d6efd;
    }

    .stack-tight {
        display: grid;
        gap: 1.5rem;
        /* jarak antar card */
        grid-auto-rows: max-content;
        /* <-- kunci: baris setinggi isi, tidak melar */
    }

    .card {
        height: auto !important;
        min-height: 0 !important;
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 10px 28px rgba(2, 8, 23, 0.08);
    }

    .status-badge {
        padding: 0.35rem 0.7rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 24px;
        border: 1px solid transparent;
        display: inline-block;
    }

    .border-soft {
        border-color: rgba(229, 231, 235, 0.6) !important;
    }

    /* Wrapper */
    .timeline-wrapper {
        padding-left: 0;
        /* Reset padding jika ada */
    }

    /* Item Timeline */
    .timeline-item {
        position: relative;
        padding-bottom: 2.5rem;
        /* Ini yang menentukan panjang garis ke bawah */
        z-index: 1;
    }

    /* ITEM TERAKHIR: Matikan padding & garis */
    .timeline-item:last-child {
        padding-bottom: 0;
    }

    /* MEMBUAT GARIS OTOMATIS */
    .timeline-item::before {
        content: "";
        position: absolute;
        top: 0;
        /* Perhitungan: (Lebar Dot 35px / 2) - (Lebar Garis 2px / 2) = 16.5px */
        left: 17px;
        height: 100%;
        width: 2px;
        background-color: #e3e6f0;
        z-index: -1;
        /* Taruh di belakang dot */
    }

    /* HILANGKAN GARIS DI ITEM TERAKHIR */
    .timeline-item:last-child::before {
        display: none;
    }

    /* Dot Icon */
    .timeline-dot {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: white;
        /* Penting: Kasih background putih/warna card biar garis di belakangnya tertutup rapi */
        background-color: #fff;
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
        position: relative;
        z-index: 2;
    }

    /* gallery */
    .ratio-square {
        position: relative;
        width: 100%;
        padding-top: 100%;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .ratio-square img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0);
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-item:hover .gallery-overlay {
        background: rgba(0, 0, 0, 0.2);
    }
</style>
@endpush

@section('content')
<main class="container container-7xl py-4 py-lg-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('citizen.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('citizen.reports.index') }}" class="text-decoration-none text-secondary">Daftar Laporan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Detail Laporan
            </li>
        </ol>
    </nav>

    <div class="card p-4 p-lg-5 mb-4 mb-lg-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
            <div class="flex-fill">
                <h1 class="h4 fw-bold mb-1">{{ $report->title }}</h1>
                <div class="text-secondary small mb-3">
                    Nomor Laporan:
                    <span class="fw-semibold text-dark">{{ $report->report_code ?? $report->code }}</span>
                </div>

                <div class="d-flex flex-wrap gap-3 small text-secondary">
                    <span class="d-inline-flex align-items-center">
                        <i class="bi bi-tag me-2"></i>Kategori: {{ $report->category->name }}
                    </span>
                    <span class="d-inline-flex align-items-center">
                        <i class="bi bi-clock-history me-2"></i>Dilaporkan: {{ $report->created_at->translatedFormat('d F Y, H:i') }}
                    </span>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-sm-start gap-2">
                @if ($report->latest_status == 'pending')
                <form
                    id="delete-form-{{ $report->id }}"
                    action="{{ route('citizen.reports.destroy', $report) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger w-100" onclick="confirmDelete('{{ $report->id }}')">
                        <i class="bi bi-trash me-1"></i>Hapus Laporan
                    </button>
                </form>
                @else
                @php
                // Logika untuk memilih class CSS badge berdasarkan status
                $statusClass = match ($report->latest_status) {
                'pending' => 'bg-secondary-subtle text-secondary-emphasis',
                'verified' => 'bg-info-subtle text-info-emphasis',
                'in_progress' => 'bg-warning-subtle text-warning-emphasis',
                'resolved' => 'bg-success-subtle text-success-emphasis',
                'rejected' => 'bg-danger-subtle text-danger-emphasis',
                default => 'bg-light text-muted',
                };
                @endphp
                <span class="{{ $statusClass }} status-badge text-center">
                    {{ Str::title(str_replace('_', ' ', $report->latest_status)) }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4 g-lg-5">
        <div class="col-lg-8 stack-tight">
            <section class="card p-4 p-lg-5">
                <h2 class="h6 fw-semibold mb-3">Deskripsi Laporan</h2>
                <p class="text-secondary mb-0" style="white-space: pre-wrap;">{{ $report->description }}</p>
            </section>

            @if($report->files->isNotEmpty())
            <section class="card p-4 p-lg-5">
                <h2 class="h6 fw-semibold mb-3">Bukti Foto & Video</h2>
                <div class="row row-cols-2 row-cols-md-3 g-3">
                    @foreach($report->files as $file)
                    <div class="col">
                        <div class="gallery-item position-relative">
                            <div class="gallery-overlay rounded">
                                <i class="fas {{ $file->type == 'image' ? 'fa-search-plus' : 'fa-play' }} text-white fa-2x"></i>
                            </div>
                            <div class="ratio-square bg-light">
                                @if($file->type == 'image')
                                <a href="{{ Storage::url($file->media_path ?? $file->path) }}" title="bukti laporan" class="glightbox">
                                    <img src="{{ Storage::url($file->media_path ?? $file->path) }}" alt="bukti laporan" />
                                </a>
                                @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                                    <i class="bi bi-play-circle-fill fs-1"></i>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <section class="card p-4 p-lg-5">
                <h2 class="h6 fw-semibold mb-3">Lokasi</h2>
                <div class="small text-secondary mb-3">
                    <i class="bi bi-geo-alt me-2"></i> {{ $report->location }} — Koordinat:
                    <span class="text-dark fw-semibold">{{ $report->latitude }}, {{ $report->longitude }}</span>
                </div>
                <div id="map" class="rounded-3 overflow-hidden" style="height: 360px"></div>
            </section>
        </div>

        <div class="col-lg-4 stack-tight">
            <div class="card shadow mb-4 border-0">
                <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-dark">Riwayat Status</h6>
                </div>

                <div class="card-body">
                    <div class="timeline-wrapper">

                        @forelse($report->statuses as $status)
                        @php
                        // Logic Warna & Icon
                        $timelineStyle = match($status->status) {
                        'pending' => ['color' => '#858796', 'bg' => 'bg-secondary', 'icon' => '
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />'],

                        'verified' => ['color' => '#4e73df', 'bg' => 'bg-primary', 'icon' => '
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />'],

                        'in_progress' => ['color' => '#f6c23e', 'bg' => 'bg-warning', 'icon' => '
                        <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z" />'],

                        'resolved' => ['color' => '#1cc88a', 'bg' => 'bg-success', 'icon' => '
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />'],

                        'rejected' => ['color' => '#e74a3b', 'bg' => 'bg-danger', 'icon' => '
                        <path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z" />'],

                        default => ['color' => '#858796', 'bg' => 'bg-secondary', 'icon' => '
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />'],
                        };
                        @endphp

                        <div class="timeline-item d-flex align-items-start">

                            <div class="timeline-dot shadow-sm" style="background-color: <?= $timelineStyle['color']; ?>;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#ffffff">
                                    {!! $timelineStyle['icon'] !!}
                                </svg>
                            </div>

                            <div class="ms-3 flex-fill">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold text-dark mb-0">
                                        {{ Str::title(str_replace('_', ' ', $status->status)) }}
                                    </h6>
                                    <span class="small text-secondary">
                                        {{ $status->created_at->translatedFormat('d F Y, H:i') }}
                                    </span>
                                </div>

                                <div class="p-3 rounded bg-light border">
                                    <p class="small text-secondary mb-0">
                                        {{ $status->note ?? 'Status diperbarui tanpa catatan tambahan.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @empty
                        <div class="text-center py-5 text-muted">
                            <p class="mb-0">Belum ada riwayat status.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @if($report->points_summary['total'] > 0)
            <div class="card shadow-sm mb-4 border-0 border-start border-success border-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="row align-items-center g-0">

                        <div class="col me-2">
                            <div class="text-uppercase fw-bold text-success small mb-1">
                                Poin Yang Didapatkan
                            </div>
                            <div class="h4 mb-0 fw-bold text-dark">
                                +{{ $report->points_summary['total'] }} Poin
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                @if($report->points_summary['verified'] > 0)
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill fw-medium">
                                    <i class="fas fa-check-circle me-1"></i> Verifikasi: {{ $report->points_summary['verified'] }}
                                </span>
                                @endif

                                @if($report->points_summary['resolved'] > 0)
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill fw-medium">
                                    <i class="fas fa-check-double me-1"></i> Selesai: {{ $report->points_summary['resolved'] }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-secondary opacity-25"></i>
                        </div>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Kamu yakin ingin menghapus laporan ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        closeButton: true,
    });
</script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Map
    document.addEventListener("DOMContentLoaded", () => {
        const reportData = <?= json_encode([
                                'lat' => $report->latitude,
                                'lng' => $report->longitude,
                                'location' => $report->location
                            ]) ?>;

        // Cek apakah koordinat valid sebelum membuat peta
        if (reportData.lat && reportData.lng) {
            const map = L.map("map").setView([reportData.lat, reportData.lng], 16);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(map);

            L.marker([reportData.lat, reportData.lng])
                .addTo(map)
                .bindPopup(`<b>Lokasi Laporan</b><br>${reportData.location}`)
                .openPopup();
        } else {
            // Tampilkan pesan error jika koordinat tidak ada
            document.getElementById('map').innerHTML = '<div class="alert alert-warning">Data lokasi tidak tersedia untuk laporan ini.</div>';
        }
    });

    // Modal gambar
    function openImageModal(src) {
        const img = document.getElementById("modalImage");
        img.src = src;
        new bootstrap.Modal(document.getElementById("imageModal")).show();
    }

    // Hapus laporan (dummy)
    document.getElementById("btnDelete").addEventListener("click", () => {
        if (
            confirm(
                "Yakin ingin menghapus laporan ini? Tindakan tidak dapat dibatalkan."
            )
        ) {
            alert("Laporan dihapus. Mengarahkan ke Daftar Laporan.");
            window.location.href = "reports.html";
        }
    });
</script>
@endpush