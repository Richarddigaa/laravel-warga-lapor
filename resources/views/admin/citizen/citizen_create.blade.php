@extends('admin.admin_master')
@section('title', 'Tambah Warga Baru | WargaLapor')

@push('style')
<style>
    /* Styling Preview Avatar */
    .avatar-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #f8f9fc;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .custom-file-label::after {
        content: "Cari";
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Warga Baru | WargaLapor</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">FORMULIR TAMBAH WARGA</h6>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.citizen.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-4 text-center border-right">

                        <div class="form-group mb-4">
                            <label class="font-weight-bold d-block">Foto Profil (Avatar)</label>

                            <img id="avatar-preview" src="{{ asset('assets/img/user.png') }}" alt="Preview Avatar" class="avatar-preview mb-3">

                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                                <label class="custom-file-label" for="avatar">Pilih Foto...</label>
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-2">Format: JPG, PNG, JPEG. Max: 2MB.</small>
                        </div>

                    </div>

                    <div class="col-lg-8">

                        <h6 class="heading-small text-muted mb-4">Informasi Akun</h6>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nik" class="font-weight-bold">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK" required>
                                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama sesuai KTP" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="font-weight-bold">Nomor Telepon/WA <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="heading-small text-muted mb-4">Data Pribadi</h6>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_of_birth" class="font-weight-bold">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type_of_work" class="font-weight-bold">Pekerjaan</label>
                                <input type="text" class="form-control @error('type_of_work') is-invalid @enderror" id="type_of_work" name="type_of_work" value="{{ old('type_of_work') }}" placeholder="Contoh: Wiraswasta">
                                @error('type_of_work') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Alamat Lengkap</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Alamat domisili saat ini...">{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <hr class="my-4">

                        <h6 class="heading-small text-muted mb-4">Keamanan</h6>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="font-weight-bold">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="font-weight-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.citizen.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save fa-sm text-white-50 mr-1"></i> Simpan Data
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk preview gambar saat dipilih
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('avatar-preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

        // Update label input file dengan nama file
        var fileName = event.target.files[0].name;
        var nextSibling = event.target.nextElementSibling;
        nextSibling.innerText = fileName;
    }
</script>
@endpush