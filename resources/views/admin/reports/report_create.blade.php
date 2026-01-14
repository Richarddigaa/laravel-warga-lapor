@extends('admin.admin_master')
@section('title', 'Buat Laporan | WargaLapor')

@push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    /* Penyesuaian Tinggi Peta */
    #map {
        height: 400px;
        z-index: 1;
    }

    /* Custom Dropzone untuk SB Admin 2 */
    .dropzone {
        border: 2px dashed #d1d3e2;
        /* Warna border khas SB Admin 2 */
        border-radius: 0.35rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        background: #fff;
        transition: all 0.3s ease;
    }

    .dropzone.hover {
        border-color: #4e73df;
        background: rgba(78, 115, 223, 0.05);
    }

    /* Helper Classes untuk Preview Gambar */
    .aspect-square {
        position: relative;
        width: 100%;
        padding-top: 100%;
    }

    .aspect-square>* {
        position: absolute;
        inset: 0;
    }

    .object-cover {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .btn-remove-thumb {
        width: 24px;
        height: 24px;
        line-height: 20px;
        font-weight: 700;
        border-radius: 50%;
        border: 0;
        background: #e74a3b;
        /* Danger color SB Admin 2 */
        color: #fff;
        padding: 0;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Buat Laporan Baru | WargaLapor</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">BUAT LAPORAN BARU</h6>
        </div>
        <div class="card-body">

            <div id="successAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                <strong>Berhasil!</strong> Laporan telah berhasil dibuat.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.reports.store') }}" id="reportForm" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="row">
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Judul Laporan <span class="text-danger">*</span></label>
                            <input
                                id="title"
                                name="title"
                                type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Contoh: Jalan berlubang di RT 05"
                                value="{{ old('title') }}"
                                required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">Kategori <span class="text-danger">*</span></label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror"
                                required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Deskripsi Masalah <span class="text-danger">*</span></label>
                            <textarea
                                id="description"
                                name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="6"
                                placeholder="Jelaskan masalah secara detail..."
                                minlength="50"
                                required>{{ old('description') }}</textarea>
                            <small class="form-text text-muted">Minimal 50 karakter.</small>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <label class="font-weight-bold">Foto/Video Dokumentasi <span class="text-danger">*</span></label>

                            <div id="file-drop-zone" class="dropzone"
                                ondrop="handleDrop(event)"
                                ondragover="handleDragOver(event)"
                                ondragleave="handleDragLeave(event)"
                                onclick="document.getElementById('file-input').click()">

                                <i class="fas fa-cloud-upload-alt fa-3x text-gray-400 mb-3"></i>
                                <p class="font-weight-bold mb-1">Klik atau seret file ke sini</p>
                                <p class="small text-muted mb-0">Max 3 file (Img/Video), Total Max 20MB</p>
                            </div>

                            <input type="file" id="file-input" name="files[]" multiple accept="image/*,video/*" class="d-none" onchange="handleFileSelect(event)">

                            <div id="files-error" class="text-danger small mt-2" style="display: none">
                                Minimal unggah 1 file.
                            </div>

                            <div id="file-preview" class="d-none mt-3">
                                <h6 class="font-weight-bold">File Terpilih:</h6>
                                <div id="file-list" class="row"></div>
                                <div class="mt-2 p-2 bg-light rounded d-flex justify-content-between small">
                                    <span>Total: <b id="total-size">0 MB</b></span>
                                    <span>Jumlah: <b id="file-count">0/3</b></span>
                                </div>
                            </div>
                        </div>
                        @error('files')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                        @error('files.*')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Lokasi Masalah <span class="text-danger">*</span></label>

                            <div class="input-group mb-2">
                                <input type="text" id="location" name="location" class="form-control bg-light" placeholder="Pilih lokasi di peta..." readonly required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" id="use-location-btn">
                                        <i class="fas fa-crosshairs fa-sm"></i> Lokasi Saya
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" id="latitude" name="latitude" required>
                            <input type="hidden" id="longitude" name="longitude" required>

                            <div class="position-relative border rounded">
                                <div id="map"></div>
                            </div>
                            <small class="form-text text-muted mt-2">
                                Geser pin merah untuk menentukan titik lokasi yang akurat.
                            </small>
                            <div class="invalid-feedback">Mohon tentukan lokasi.</div>
                            @error('latitude')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                            @error('longitude')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" id="submitBtn" class="btn btn-primary">
                        <i class="fas fa-paper-plane fa-sm text-white-50 mr-1"></i> Kirim Laporan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Peta dengan Leaflet
    let map, marker;
    let currentLocation = {
        lat: -6.2088,
        lng: 106.8456
    }; // Default Jakarta

    function updateLatLngInputs(lat, lng) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();
        wireLocationButton();
        wireForm();
    });

    function initMap() {
        map = L.map("map").setView([currentLocation.lat, currentLocation.lng], 13);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        marker = L.marker([currentLocation.lat, currentLocation.lng], {
            draggable: true
        }).addTo(map);

        updateLatLngInputs(currentLocation.lat, currentLocation.lng);

        // Event saat marker digeser
        marker.on("dragend", function(e) {
            const p = e.target.getLatLng();
            updateLatLngInputs(p.lat, p.lng);
            reverseGeocode(p.lat, p.lng);
        });

        // Event saat peta diklik
        map.on("click", function(e) {
            const p = e.latlng;
            marker.setLatLng(p);
            updateLatLngInputs(p.lat, p.lng);
            reverseGeocode(p.lat, p.lng);
        });
    }

    function wireLocationButton() {
        const btn = document.getElementById("use-location-btn");
        btn?.addEventListener("click", () => {
            if (!navigator.geolocation) {
                alert("Browser Anda tidak mendukung geolokasi.");
                return;
            }
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mencari...';

            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    const {
                        latitude: lat,
                        longitude: lng
                    } = pos.coords;
                    map.setView([lat, lng], 16);
                    marker.setLatLng([lat, lng]);
                    updateLatLngInputs(lat, lng);
                    reverseGeocode(lat, lng, () => {
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    });
                },
                (err) => {
                    alert("Gagal mengambil lokasi: " + err.message);
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }, {
                    enableHighAccuracy: true
                }
            );
        });
    }

    function reverseGeocode(lat, lng, done) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
            .then((r) => r.json())
            .then((d) => {
                const input = document.getElementById("location");
                if (input) {
                    input.value = d && d.display_name ? d.display_name : lat.toFixed(6) + ", " + lng.toFixed(6);
                }
            })
            .catch(() => {})
            .finally(() => typeof done === "function" && done());
    }

    // File Upload
    let selectedFiles = [];

    function handleFileSelect(event) {
        const files = Array.from(event.target.files || []);
        processFiles(files);
    }

    function handleDragOver(event) {
        event.preventDefault();
        event.currentTarget.classList.add("hover");
    }

    function handleDragLeave(event) {
        event.preventDefault();
        event.currentTarget.classList.remove("hover");
    }

    function handleDrop(event) {
        event.preventDefault();
        event.currentTarget.classList.remove("hover");
        const files = Array.from(event.dataTransfer.files || []);
        processFiles(files);
    }

    function processFiles(files) {
        const valid = files.filter((f) => f.type.startsWith("image/") || f.type.startsWith("video/"));

        if (selectedFiles.length + valid.length > 3) {
            alert("Maksimal 3 file.");
            return;
        }

        // Cek total size (max 20MB)
        const currentTotal = selectedFiles.reduce((s, f) => s + f.size, 0);
        const newTotal = valid.reduce((s, f) => s + f.size, 0);

        if (currentTotal + newTotal > 20 * 1024 * 1024) {
            alert("Total ukuran file melebihi 20MB.");
            return;
        }

        selectedFiles.push(...valid);
        updateFilePreview();
        validateFiles();
    }

    function updateFilePreview() {
        const preview = document.getElementById("file-preview");
        const list = document.getElementById("file-list");
        const totalSizeEl = document.getElementById("total-size");
        const fileCountEl = document.getElementById("file-count");

        if (selectedFiles.length === 0) {
            preview.classList.add("d-none");
        } else {
            preview.classList.remove("d-none");
        }

        list.innerHTML = "";
        selectedFiles.forEach((file, idx) => {
            const col = document.createElement("div");
            col.className = "col-4 mb-2"; // Grid Bootstrap 4
            const isImg = file.type.startsWith("image/");

            col.innerHTML = `
            <div class="position-relative border rounded p-1">
              <div class="aspect-square bg-light overflow-hidden mb-1">
                ${isImg 
                  ? `<img src="${URL.createObjectURL(file)}" class="object-cover rounded">` 
                  : `<div class="d-flex align-items-center justify-content-center h-100 text-secondary"><i class="fas fa-video fa-lg"></i></div>`
                }
              </div>
              <div class="text-truncate small" title="${file.name}">${file.name}</div>
              <button type="button" class="btn-remove-thumb position-absolute" style="top:-8px; right:-8px;" onclick="removeFile(${idx})">&times;</button>
            </div>`;
            list.appendChild(col);
        });

        const total = selectedFiles.reduce((s, f) => s + f.size, 0);
        totalSizeEl.textContent = formatFileSize(total);
        fileCountEl.textContent = `${selectedFiles.length}/3`;
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateFilePreview();
        validateFiles();
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return "0 B";
        const k = 1024;
        const sizes = ["B", "KB", "MB", "GB"];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return (bytes / Math.pow(k, i)).toFixed(2) + " " + sizes[i];
    }

    function validateFiles() {
        const err = document.getElementById("files-error");
        err.style.display = selectedFiles.length === 0 ? "block" : "none";
        return selectedFiles.length > 0;
    }

    // Form validation
    function wireForm() {
        const form = document.getElementById("reportForm");
        const description = document.getElementById("description");
        const fileInput = document.getElementById("file-input"); // Ambil elemen input file

        form.addEventListener("submit", function(e) {
            // 1. CEK VALIDASI MANUAL
            let isValid = true;
            if (!validateFiles()) isValid = false;
            if (description.value.length < 50) {
                description.classList.add('is-invalid');
                isValid = false;
            } else {
                description.classList.remove('is-invalid');
            }

            if (!form.checkValidity() || !isValid) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add("was-validated");
                return;
            }

            // 2. BAGIAN PENTING: TRANSFER FILE DARI JS KE HTML INPUT
            // buat container file virtual
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            // Paksa input HTML untuk menggunakan file dari container tersebut
            fileInput.files = dataTransfer.files;

            // 3. Matikan tombol submit agar tidak double post
            const btn = document.getElementById("submitBtn");
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';

            // Form akan lanjut submit secara normal membawa file yang sudah di-inject
        });

        description.addEventListener("input", () => {
            if (description.value.length >= 50) description.classList.remove('is-invalid');
        });
    }
</script>
@endpush