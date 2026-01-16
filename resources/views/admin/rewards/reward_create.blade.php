@extends('admin.admin_master')
@section('title', 'Tambah Hadiah Baru | WargaLapor')

@push('style')
<style>
    /* Styling Preview Thumbnail (Kotak dengan sudut tumpul, beda dengan avatar user) */
    .thumbnail-preview {
        width: 100%;
        max-width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 10px;
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

    <h1 class="h3 mb-4 text-gray-800">Tambah Hadiah Baru | WargaLapor</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">FORMULIR TAMBAH HADIAH</h6>
        </div>
        <div class="card-body">

            {{-- Pastikan route ini sesuai dengan route di web.php Anda --}}
            <form method="POST" action="{{ route('admin.rewards.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-4 text-center border-right">

                        <div class="form-group mb-4">
                            <label class="font-weight-bold d-block">Gambar Hadiah (Thumbnail)</label>

                            <img id="thumbnail-preview" src="{{ asset('assets/img/default-thumbnail.png') }}" alt="Preview Thumbnail" class="thumbnail-preview mb-3">

                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(event)">
                                <label class="custom-file-label" for="thumbnail">Pilih Gambar...</label>
                                @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-2">Format: JPG, PNG, JPEG. Max: 2MB.</small>
                        </div>

                    </div>

                    <div class="col-lg-8">

                        <h6 class="heading-small text-muted mb-4">Informasi Hadiah</h6>

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nama Hadiah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Voucher Belanja 50rb" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="point_cost" class="font-weight-bold">Harga Poin <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('point_cost') is-invalid @enderror" id="point_cost" name="point_cost" value="{{ old('point_cost') }}" placeholder="0" min="1" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Pts</span>
                                    </div>
                                    @error('point_cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <small class="text-muted">Jumlah poin yang dibutuhkan warga untuk menukar.</small>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="stock" class="font-weight-bold">Stok Awal <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0" min="0" required>
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="heading-small text-muted mb-4">Pengaturan Status</h6>

                        <div class="form-group">
                            <label for="is_active" class="font-weight-bold">Status Publikasi</label>
                            <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif (Dapat dilihat warga)</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif (Disembunyikan)</option>
                            </select>
                            @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <a href="{{ route('admin.rewards.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save fa-sm text-white-50 mr-1"></i> Simpan Hadiah
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
            var output = document.getElementById('thumbnail-preview');
            output.src = reader.result;
        }
        // Cek jika ada file yang dipilih
        if (event.target.files.length > 0) {
            reader.readAsDataURL(event.target.files[0]);

            // Update label input file dengan nama file
            var fileName = event.target.files[0].name;
            var nextSibling = event.target.nextElementSibling;
            nextSibling.innerText = fileName;
        }
    }
</script>
@endpush