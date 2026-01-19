@extends('citizen.citizen_master')
@section('title', 'Buat Laporan | WargaLapor')

@push('style')
<!-- Leaflet (peta) -->
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    .shadow-soft {
        box-shadow: 0 10px 26px rgba(2, 8, 23, 0.08);
    }

    #map {
        height: 20rem;
    }

    /* Dropzone */
    .dropzone {
        border: 2px dashed #d1d5db;
        border-radius: 0.875rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        background: #fff;
    }

    .dropzone.hover {
        border-color: var(--bs-primary);
        background: rgba(13, 110, 253, 0.06);
    }

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
        line-height: 24px;
        font-weight: 700;
        border-radius: 50%;
        border: 0;
        background: #dc3545;
        color: #fff;
    }
</style>
@endpush

@section('content')
<main class="py-4">
    <div class="container" style="max-width: 880px">
        <div class="text-center mb-4">
            <h1 class="h2 fw-bold mb-2">Buat Laporan Baru</h1>
            <p class="text-secondary mb-0">
                Laporkan masalah infrastruktur dan kebersihan di lingkungan Anda
            </p>
        </div>

        <div class="card shadow-soft">
            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{route('citizen.reports.store')}}" id="reportForm" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-file-text me-1"></i> Judul Laporan
                            <span class="text-danger">*</span></label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Contoh: Jalan berlubang di RT 05"
                            value="{{ old('title') }}"
                            required
                            autofocus />
                        <div class="invalid-feedback">Judul wajib diisi.</div>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select
                            id="category_id"
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Pilih salah satu kategori.</div>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Masalah <span class="text-danger">*</span></label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Jelaskan masalah secara detail, termasuk dampak yang ditimbulkan..."
                            minlength="50"
                            required
                            autofocus>{{ old('description') }}</textarea>
                        <div class="form-text">
                            Minimal 50 karakter. Semakin detail, semakin mudah ditangani.
                        </div>
                        <div class="invalid-feedback">
                            Deskripsi minimal 50 karakter.
                        </div>
                    </div>

                    <!-- Lokasi (PETA) -->
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-geo-alt me-1"></i> Lokasi Masalah
                            <span class="text-danger">*</span></label>

                        <div class="d-grid d-sm-flex gap-2 mb-2">
                            <button
                                type="button"
                                id="use-location-btn"
                                class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-geo me-1"></i> Gunakan Lokasi Saya
                            </button>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                class="form-control"
                                placeholder="Alamat akan terisi otomatis setelah memilih lokasi di peta"
                                readonly
                                required />

                            <input type="hidden" id="latitude" name="latitude" required readonly>
                            <input type="hidden" id="longitude" name="longitude" required readonly>
                        </div>

                        <div class="position-relative">
                            <div id="map" class="w-100 rounded-3 border"></div>
                            <div
                                id="map-loading"
                                class="position-absolute top-0 start-0 end-0 bottom-0 bg-white bg-opacity-75 d-flex align-items-center justify-content-center rounded-3">
                                <div class="text-center">
                                    <div
                                        class="spinner-border text-primary mb-2"
                                        role="status"
                                        style="width: 2rem; height: 2rem"></div>
                                    <p class="small text-secondary mb-0">Memuat peta...</p>
                                </div>
                            </div>
                        </div>
                        <p class="small text-secondary mt-2 mb-0">
                            Seret pin merah untuk menentukan lokasi yang tepat, atau klik
                            tombol “Gunakan Lokasi Saya”.
                        </p>
                        <div class="invalid-feedback">Mohon tentukan lokasi.</div>
                        @error('latitude')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                        @error('longitude')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Foto/Video (Dropzone lengkap) -->
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-camera me-1"></i> Foto/Video Dokumentasi
                            <span class="text-danger">*</span></label>

                        <div
                            id="file-drop-zone"
                            class="dropzone"
                            ondrop="handleDrop(event)"
                            ondragover="handleDragOver(event)"
                            ondragleave="handleDragLeave(event)"
                            onclick="document.getElementById('file-input').click()">
                            <svg
                                width="40"
                                height="40"
                                class="text-secondary mb-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="fs-6 fw-semibold mb-1">
                                Seret file ke sini atau klik untuk memilih
                            </p>
                            <p class="small text-secondary mb-2">
                                Maksimal 3 file, total ukuran 20MB
                            </p>
                            <p class="small text-secondary">
                                Format didukung: JPG, PNG, MP4, MOV
                            </p>
                        </div>

                        <input
                            type="file"
                            id="file-input"
                            name="files[]"
                            multiple
                            accept="image/*,video/*"
                            class="d-none"
                            onchange="handleFileSelect(event)" />

                        <!-- Preview -->
                        <div id="file-preview" class="d-none mt-3">
                            <h3 class="h6 fw-semibold mb-3">File yang Dipilih:</h3>
                            <div id="file-list" class="row g-3"></div>
                            <div class="mt-3 p-3 rounded-3" style="background: #f8fafc">
                                <div class="d-flex justify-content-between small">
                                    <span class="text-secondary">Total ukuran:</span>
                                    <span id="total-size" class="fw-medium">0 MB</span>
                                </div>
                                <div class="d-flex justify-content-between small mt-1">
                                    <span class="text-secondary">Jumlah file:</span>
                                    <span id="file-count" class="fw-medium">0/3</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol kamera (mobile) -->
                        <div class="d-sm-none mt-2">
                            <button
                                type="button"
                                class="btn btn-outline-secondary w-100"
                                onclick="openCamera()">
                                Ambil Foto dengan Kamera
                            </button>
                        </div>

                        <div
                            class="invalid-feedback d-block"
                            id="files-error"
                            style="display: none">
                            Minimal unggah 1 file (maks 3 file, total ≤ 20MB).
                        </div>

                        @error('files')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                        @error('files.*') {{-- Untuk error per file --}}
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Persetujuan -->
                    <div class="form-check mb-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="agreement"
                            required />
                        <label class="form-check-label" for="agreement">
                            Saya menyatakan bahwa informasi yang saya berikan adalah benar
                            dan akurat. Saya memahami laporan palsu dapat dikenakan
                            sanksi.
                        </label>
                        <div class="invalid-feedback">
                            Anda harus menyetujui pernyataan ini.
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="d-grid d-sm-flex gap-3">
                        <a
                            href="{{route('citizen.reports.index')}}"
                            class="btn btn-outline-secondary flex-fill">Batal
                        </a>
                        <button
                            id="submitBtn"
                            type="submit"
                            class="btn btn-primary flex-fill">
                            <i class="fas fa-paper-plane fa-sm"></i>
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips -->
        <div class="card shadow-soft mt-4">
            <div class="card-body">
                <h2 class="h6 fw-semibold mb-3">Tips Laporan Berkualitas</h2>
                <ul class="mb-0 text-secondary">
                    <li>Sertakan foto yang jelas dari berbagai sudut.</li>
                    <li>Berikan alamat yang spesifik dan mudah ditemukan.</li>
                    <li>Jelaskan dampak masalah terhadap aktivitas warga.</li>
                    <li>Laporan yang valid akan mendapat poin reward.</li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Peta
    let map, marker;
    let currentLocation = {
        lat: -6.2088,
        lng: 106.8456
    }; // Default Jakarta

    // FUNGSI BARU: Untuk update nilai ke dalam hidden input
    function updateLatLngInputs(lat, lng) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();
        wireLocationButton();
        wireForm(); // pastikan fungsi wireForm juga dipanggil
    });

    function initMap() {
        map = L.map("map").setView(
            [currentLocation.lat, currentLocation.lng],
            13
        );
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        marker = L.marker([currentLocation.lat, currentLocation.lng], {
            draggable: true,
        }).addTo(map);

        // PANGGIL DI SINI untuk mengisi nilai awal (default)
        updateLatLngInputs(currentLocation.lat, currentLocation.lng);

        marker.on("dragend", function(e) {
            const p = e.target.getLatLng();
            currentLocation = {
                lat: p.lat,
                lng: p.lng
            };

            // PANGGIL DI SINI setelah pin digeser
            updateLatLngInputs(p.lat, p.lng);
            reverseGeocode(p.lat, p.lng);
        });

        map.on("click", function(e) {
            const p = e.latlng;
            marker.setLatLng(p);
            currentLocation = {
                lat: p.lat,
                lng: p.lng
            };

            // PANGGIL DI SINI setelah peta diklik
            updateLatLngInputs(p.lat, p.lng);
            reverseGeocode(p.lat, p.lng);
        });

        setTimeout(
            () => document.getElementById("map-loading")?.classList.add("d-none"),
            800
        );
    }

    function wireLocationButton() {
        const btn = document.getElementById("use-location-btn");
        btn?.addEventListener("click", () => {
            if (!navigator.geolocation) {
                alert("Browser Anda tidak mendukung geolokasi.");
                return;
            }
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span>Mencari lokasi...';

            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    const {
                        latitude: lat,
                        longitude: lng
                    } = pos.coords;
                    currentLocation = {
                        lat,
                        lng
                    };
                    map.setView([lat, lng], 16);
                    marker.setLatLng([lat, lng]);

                    // PANGGIL DI SINI setelah lokasi ditemukan
                    updateLatLngInputs(lat, lng);

                    reverseGeocode(lat, lng, () => {
                        btn.disabled = false;
                        btn.innerHTML = original;
                    });
                },
                (err) => {
                    alert("Tidak dapat mengakses lokasi: " + err.message);
                    btn.disabled = false;
                    btn.innerHTML = original;
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 60000
                }
            );
        });
    }

    function reverseGeocode(lat, lng, done) {
        fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`
            )
            .then((r) => r.json())
            .then((d) => {
                const input = document.getElementById("location");
                if (!input) return;
                input.value =
                    d && d.display_name ?
                    d.display_name :
                    lat.toFixed(6) + ", " + lng.toFixed(6);
                input.setCustomValidity("");
            })
            .catch(() => {
                const input = document.getElementById("location");
                if (!input) return;
                input.value = lat.toFixed(6) + ", " + lng.toFixed(6);
                input.setCustomValidity("");
            })
            .finally(() => typeof done === "function" && done());
    }

    // ====== FILE UPLOAD (Dropzone seperti sebelumnya) ======
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
        const valid = files.filter(
            (f) => f.type.startsWith("image/") || f.type.startsWith("video/")
        );
        // cek jumlah maksimal 5
        if (selectedFiles.length + valid.length > 3) {
            alert("Maksimal 3 file yang dapat diupload.");
            return;
        }
        // cek total size ≤ 20MB
        const totalAfter = [...selectedFiles, ...valid].reduce(
            (s, f) => s + f.size,
            0
        );
        if (totalAfter > 20 * 1024 * 1024) {
            alert("Total ukuran file tidak boleh lebih dari 20MB.");
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
            col.className = "col-6 col-sm-4 col-lg-3";
            const isImg = file.type.startsWith("image/");
            const isVid = file.type.startsWith("video/");
            col.innerHTML = `
            <div class="position-relative p-2 rounded-3 border bg-white">
              <div class="aspect-square rounded-3 bg-light overflow-hidden mb-2">
                ${
                  isImg
                    ? `<img src="${URL.createObjectURL(
                        file
                      )}" class="object-cover" alt="Preview">`
                    : `<div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                      <svg width="28" height="28" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                    </div>`
                }
              </div>
              <div class="small text-truncate" title="${file.name}">${
            file.name
          }</div>
              <div class="text-secondary small">${formatFileSize(
                file.size
              )}</div>
              <button type="button" class="btn-remove-thumb position-absolute top-0 end-0 translate-middle" onclick="removeFile(${idx})">×</button>
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

    function openCamera() {
        const input = document.createElement("input");
        input.type = "file";
        input.accept = "image/*";
        input.capture = "environment";
        input.onchange = handleFileSelect;
        input.click();
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return "0 B";
        const k = 1024,
            sizes = ["B", "KB", "MB", "GB"];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return (bytes / Math.pow(k, i)).toFixed(2) + " " + sizes[i];
    }

    function validateFiles() {
        const err = document.getElementById("files-error");
        if (selectedFiles.length === 0) {
            err.style.display = "block";
            return false; // <--- PENTING: Mengembalikan false jika gagal
        } else {
            err.style.display = "none";
            return true; // <--- PENTING: Mengembalikan true jika sukses
        }
    }

    // ====== FORM ======
    function wireForm() {
        const form = document.getElementById("reportForm");
        const description = document.getElementById("description");
        const fileInput = document.getElementById("file-input");

        form.addEventListener("submit", function(e) {
            let isValid = true;

            // Cek validasi file (sekarang sudah mengembalikan true/false)
            if (!validateFiles()) {
                isValid = false;
            }

            // Cek validasi deskripsi manual
            if (description.value.length < 50) {
                description.classList.add('is-invalid');
                isValid = false;
            } else {
                description.classList.remove('is-invalid');
            }

            // Cek validasi HTML5 bawaan (termasuk hidden input latitude/longitude)
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add("was-validated");

                // Cek khusus jika Lokasi belum dipilih (karena inputnya hidden)
                const lat = document.getElementById('latitude').value;
                if (!lat) {
                    alert("Mohon pilih lokasi pada peta terlebih dahulu.");
                }
                return; // Stop di sini jika HTML tidak valid
            }

            // Jika validasi manual JS gagal (File kosong atau deskripsi kurang)
            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
                return; // Stop di sini
            }

            // --- TRANSFER FILE DARI JS KE INPUT HTML ---
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            fileInput.files = dataTransfer.files;

            // UI Feedback (Loading)
            const btn = document.getElementById("submitBtn");
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';

            // Biarkan form submit secara alami (jangan di preventDefault di sini)
        });

        description.addEventListener("input", () => {
            if (description.value.length >= 50) description.classList.remove('is-invalid');
        });
    }
</script>
@endpush