@extends('citizen.citizen_master')

@section('title', 'Ubah Profil | WargaLapor')

@push('style')
<style>
    :root {
        --primary: #0d6efd;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --border: #e5e7eb;
        --bg: #f5f7fb;
    }

    .avatar-upload {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .avatar-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .avatar-edit-btn {
        position: absolute;
        bottom: 5px;
        right: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--bs-primary);
        color: white;
        border: 2px solid #fff;
        cursor: pointer;
        transition: all 0.2s;
    }

    .avatar-edit-btn:hover {
        background-color: var(--bs-primary-dark);
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 fw-bold mb-0">Ubah Profil</h1>
                    <a href="{{ route('citizen.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('citizen.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Avatar -->
                            <div class="text-center mb-5">
                                <div class="avatar-upload mb-3">
                                    <!-- gambar -->
                                    <img id="avatarPreview"
                                        src="{{ $user->avatar ? Storage::url($user->avatar) : asset('assets/img/user.png') }}"
                                        alt="Profile"
                                        class="avatar-preview">

                                    <!-- Upload File -->
                                    <label for="avatarInput" class="avatar-edit-btn shadow-sm">
                                        <i class="bi bi-camera-fill small"></i>
                                    </label>
                                </div>
                                <!-- Input Hidden -->
                                <input type="file" id="avatarInput" name="avatar" class="d-none" accept="image/*" onchange="previewImage(event)">

                                <div class="small text-secondary">Klik ikon kamera untuk mengganti foto.</div>

                                @error('avatar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <!-- Informasi Pribadi -->
                                <div class="col-12 mb-2">
                                    <h5 class="fw-bold text-primary mb-3">Informasi Pribadi</h5>
                                </div>

                                <!-- NIK -->
                                <div class="col-12 col-md-6">
                                    <label for="nik" class="form-label fw-semibold small">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ $user->nik }}" placeholder="16 digit NIK">
                                    @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nama Lengkap -->
                                <div class="col-12 col-md-6">
                                    <label for="name" class="form-label fw-semibold small">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $user->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-12 col-md-6">
                                    <label for="date_of_birth" class="form-label fw-semibold small">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                        id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Pekerjaan -->
                                <div class="col-12 col-md-6">
                                    <label for="type_of_work" class="form-label fw-semibold small">Pekerjaan</label>
                                    <input type="text" class="form-control @error('type_of_work') is-invalid @enderror"
                                        id="type_of_work" name="type_of_work" value="{{ old('type_of_work', $user->type_of_work) }}" placeholder="Contoh: Wiraswasta">
                                    @error('type_of_work')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kontak -->
                                <div class="col-12 mt-4 mb-2">
                                    <h5 class="fw-bold text-primary mb-3">Kontak & Alamat</h5>
                                </div>

                                <!-- Email -->
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label fw-semibold small">Alamat Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ $user->email }}" readonly>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- No Telepon -->
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label fw-semibold small">Nomor Telepon/WA</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary">+62</span>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ $user->phone }}" placeholder="8123xxxx">
                                    </div>
                                    @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="col-12">
                                    <label for="address" class="form-label fw-semibold small">Alamat Lengkap</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" rows="3" placeholder="Nama jalan, RT/RW, Kelurahan...">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-5">
                                <button type="reset" class="btn btn-light border px-4">Reset</button>
                                <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    // Fungsi sederhana untuk preview gambar sebelum diupload
    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("avatarPreview");

        reader.onload = function() {
            if (reader.readyState == 2) {
                imageField.src = reader.result;
            }
        }

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush

@endsection