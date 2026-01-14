@extends('admin.admin_master')
@section('title', 'Detail Laporan | WargaLapor')

@push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    /* Penyesuaian Peta */
    #map {
        height: 350px;
        width: 100%;
        z-index: 1;
    }

    /* Gallery Grid */
    .aspect-square {
        position: relative;
        width: 100%;
        padding-top: 100%;
        overflow: hidden;
        border-radius: 0.35rem;
        background-color: #f8f9fc;
        border: 1px solid #e3e6f0;
    }

    .aspect-square img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
        cursor: pointer;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .timeline-wrapper {
        position: relative;
        padding-left: 10px;
    }

    /* Garis vertikal di belakang */
    .timeline-line {
        position: absolute;
        left: 28px;
        /* Posisi tengah dot */
        top: 15px;
        bottom: 15px;
        width: 2px;
        background-color: #e3e6f0;
        /* Gray-200 */
        z-index: 0;
    }

    .timeline-item {
        position: relative;
        z-index: 1;
        margin-bottom: 1.5rem;
        /* Pengganti gap-4 di BS4 */
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-dot {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
        border: 4px solid #fff;
        /* Ring putih agar garis tidak menempel */
        flex-shrink: 0;
        /* Agar bulatan tidak gepeng di layar hp */
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Laporan | WargaLapor</h1>
        <a href="{{ route('admin.reports.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Informasi Laporan</h6>
                    <span class="badge badge-light text-uppercase border text-primary">
                        {{ $report->report_code ?? $report->code }}
                    </span>
                </div>
                <div class="card-body">
                    <h2 class="h4 font-weight-bold text-gray-800 mb-3">{{ $report->title }}</h2>

                    <div class="mb-4">
                        <span class="mr-3 text-secondary small">
                            <i class="fas fa-tag fa-fw mr-1"></i> {{ $report->category->name }}
                        </span>
                        <span class="text-secondary small">
                            <i class="fas fa-clock fa-fw mr-1"></i> {{ $report->created_at->translatedFormat('d F Y, H:i') }}
                        </span>
                    </div>

                    <h6 class="font-weight-bold">Deskripsi:</h6>
                    <p class="text-gray-700" style="white-space: pre-wrap;">{{ $report->description }}</p>
                </div>
            </div>

            @if($report->files->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Bukti Lampiran</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($report->files as $file)
                        <div class="col-6 col-md-4 mb-3">
                            <div class="gallery-item position-relative">
                                <div class="aspect-square">
                                    @if($file->type == 'image')
                                    <img src="{{ Storage::url($file->media_path ?? $file->path) }}" alt="bukti">
                                    @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-gray-500">
                                        <i class="fas fa-video fa-3x"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="gallery-overlay rounded" onclick="openMediaModal('{{ Storage::url($file->media_path ?? $file->path) }}', '{{ $file->type }}')">
                                    <i class="fas {{ $file->type == 'image' ? 'fa-search-plus' : 'fa-play' }} text-white fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Lokasi Masalah</h6>
                </div>
                <div class="card-body">
                    <p class="small text-secondary mb-2">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $report->location }}
                    </p>
                    <div id="map" class="rounded border"></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Status Terkini</h6>
                </div>
                <div class="card-body text-center">
                    @php
                    $badgeClass = match ($report->latest_status) {
                    'verified' => 'badge-info',
                    'in_progress' => 'badge-warning',
                    'resolved' => 'badge-success',
                    'rejected' => 'badge-danger',
                    'pending' => 'badge-secondary',
                    };
                    @endphp
                    <span class="badge badge-pill {{ $badgeClass }} px-3 py-2" style="font-size: 1rem;">
                        {{ Str::upper(str_replace('_', ' ', $report->latest_status)) }}
                    </span>

                    <hr>

                    <div class="d-flex flex-column">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#updateStatusModal">
                            <i class="fas fa-edit fa-fw"></i> Ubah Status
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteReportModal">
                            <i class="fas fa-trash fa-fw"></i> Hapus Laporan
                        </button>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Riwayat Status</h6>
                </div>
                <div class="card-body">
                    <div class="timeline-wrapper">

                        @if($report->statuses->count() > 0)
                        <div class="timeline-line"></div>
                        @endif

                        @forelse($report->statuses as $status)
                        @php
                        $timelineStyle = match($status->status) {
                        'pending' => ['color' => '#858796', 'bg' => 'bg-secondary', 'icon' => '
                        <path d="M19 11H13V5h-2v6H5v2h6v6h2v-6h6z" />'],
                        'verified' => ['color' => '#2563eb', 'bg' => 'bg-info', 'icon' => '
                        <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1 14l-4-4 1.41-1.41L11 12.17l4.59-4.58L17 9z" />'],
                        'in_progress' => ['color' => '#f6c23e', 'bg' => 'bg-warning', 'icon' => '
                        <path d="M6 2h12v3a6 6 0 01-3 5 6 6 0 013 5v3H6v-3a6 6 0 013-5 6 6 0 01-3-5V2z" />'],
                        'resolved' => ['color' => '#1cc88a', 'bg' => 'bg-success', 'icon' => '
                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" />'],
                        'rejected' => ['color' => '#e74a3b', 'bg' => 'bg-danger', 'icon' => '
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />'],
                        default => ['color' => '#858796', 'bg' => 'bg-secondary', 'icon' => '
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />'],
                        };
                        @endphp

                        <div class="timeline-item d-flex align-items-start">
                            <div class="timeline-dot" style="background-color: <?= $timelineStyle['color']; ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    {!! $timelineStyle['icon'] !!}
                                </svg>
                            </div>

                            <div class="ml-3 flex-fill">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="font-weight-bold text-gray-800 mb-0">
                                        {{ Str::title(str_replace('_', ' ', $status->status)) }}
                                    </h6>
                                    <span class="small text-gray-500">
                                        {{ $status->created_at->translatedFormat('d F Y, H:i') }}
                                    </span>
                                </div>

                                <div class="rounded bg-gray-100 border border-light mb-2">
                                    <p class="small text-gray-700 mb-0">
                                        {{ $status->note ?? 'Status diperbarui tanpa catatan tambahan.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted small">
                            <i class="fas fa-info-circle mb-2 d-block fa-2x"></i>
                            Belum ada riwayat status untuk laporan ini.
                        </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Informasi Pelapor</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="mr-3">
                            <img class="img-profile rounded-circle"
                                style="width: 60px; height: 60px; object-fit: cover;"
                                src="{{ $report->user->avatar ? Storage::url($report->user->avatar) : asset('assets/img/user.png') }}"
                                alt="Avatar Pelapor">
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-gray-800 mb-0">{{ $report->user->name }}</h5>
                            <span class="small text-secondary">
                                Bergabung sejak {{ $report->user->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <hr class="sidebar-divider my-3">

                    <div class="mb-2">
                        <small class="text-uppercase text-xs font-weight-bold text-gray-500">NIK</small>
                        <div class="font-weight-bold text-gray-800">
                            {{ $report->user->nik }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-uppercase text-xs font-weight-bold text-gray-500">Email</small>
                        <div class="font-weight-bold text-gray-800">
                            {{ $report->user->email }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-uppercase text-xs font-weight-bold text-gray-500">Nomor Telepon</small>
                        <div class="font-weight-bold text-gray-800">
                            {{ $report->user->phone ?? '-' }}
                        </div>
                    </div>

                    <a href="{{ route('admin.citizen.show', $report->user->id) }}" class="btn btn-light btn-sm btn-block border mt-3">
                        <i class="fas fa-user fa-sm fa-fw mr-1"></i> Lihat Profil Lengkap
                    </a>
                </div>
            </div>

            @if($report->points_summary['total'] > 0)
            <div class="card shadow mb-4 border-left-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Poin Yang Didapatkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">+{{ $report->points_summary['total'] }} Poin</div>

                            <div class="mt-2 small text-gray-600">
                                @if($report->points_summary['verified'] > 0)
                                <div><i class="fas fa-check-circle text-success"></i> Verifikasi: {{ $report->points_summary['verified'] }}</div>
                                @endif
                                @if($report->points_summary['resolved'] > 0)
                                <div><i class="fas fa-check-circle text-success"></i> Selesai: {{ $report->points_summary['resolved'] }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- MODAL MEDIA -->
    <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="close text-white position-absolute" style="top: -30px; right: 0; opacity: 1;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img id="modalImage" src="" class="img-fluid rounded shadow-lg d-none">
                    <video id="modalVideo" src="" class="w-100 rounded shadow-lg d-none" controls></video>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UPDATE STATUS -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-gray-800" id="updateModalLabel">Ubah Status Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.reports.updateStatus', $report->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="modal-body">
                        <div class="form-group">
                            <label for="status" class="font-weight-bold text-small">Pilih Status Baru</label>
                            <select name="status" id="status" class="form-control custom-select">
                                <option value="pending" {{ $report->latest_status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="verified" {{ $report->latest_status == 'verified' ? 'selected' : '' }}>Verified (Diverifikasi)</option>
                                <option value="in_progress" {{ $report->latest_status == 'in_progress' ? 'selected' : '' }}>In Progress (Sedang Diproses)</option>
                                <option value="resolved" {{ $report->latest_status == 'resolved' ? 'selected' : '' }}>Resolved (Selesai)</option>
                                <option value="rejected" {{ $report->latest_status == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="note" class="font-weight-bold text-small">Catatan / Keterangan (Opsional)</label>
                            <textarea name="note" id="note" rows="3" class="form-control" placeholder="Contoh: Laporan sedang ditangani oleh dinas terkait..."></textarea>
                            <small class="text-muted">Catatan ini akan muncul di riwayat timeline user.</small>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE REPORT -->
    <div class="modal fade" id="deleteReportModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title font-weight-bold">Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus laporan ini secara permanen?
                    <br><small class="text-danger font-weight-bold">Tindakan ini tidak dapat dibatalkan.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                    <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Peta dengan Leaflet
    document.addEventListener("DOMContentLoaded", () => {
        const reportData = <?= json_encode([
                                'lat' => $report->latitude,
                                'lng' => $report->longitude,
                                'location' => $report->location
                            ]) ?>;

        if (reportData.lat && reportData.lng) {
            const map = L.map("map").setView([reportData.lat, reportData.lng], 16);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(map);

            L.marker([reportData.lat, reportData.lng])
                .addTo(map)
                .bindPopup(`<b>Lokasi Kejadian</b><br>${reportData.location}`)
                .openPopup();


            setTimeout(() => {
                map.invalidateSize();
            }, 500);
        } else {
            document.getElementById('map').innerHTML =
                '<div class="p-4 text-center text-muted bg-light">Koordinat lokasi tidak tersedia.</div>';
        }
    });

    // Fungsi untuk membuka modal media
    function openMediaModal(src, type) {
        const imgEl = document.getElementById("modalImage");
        const vidEl = document.getElementById("modalVideo");
        const modal = $('#mediaModal');

        imgEl.classList.add('d-none');
        vidEl.classList.add('d-none');
        vidEl.pause();

        if (type === 'image') {
            imgEl.src = src;
            imgEl.classList.remove('d-none');
        } else {
            vidEl.src = src;
            vidEl.classList.remove('d-none');
        }

        modal.modal('show');
    }
</script>
@endpush