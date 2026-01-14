@extends('admin.admin_master')
@section('title', 'Data Kategori | WargaLapor')

@push('style')
<link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Kategori | WargaLapor</h1>

    <div class="col-12 grid-margin stretch-card">

        <!-- BTN: Tambah (buka modal) -->
        <button type="button" class="btn btn-primary mt-1 mb-3" data-toggle="modal" data-target="#createCategoryModal">
            <i class="fas fa-fw fa-plus"></i>
            Tambah Kategori
        </button>

        <div class="card">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-dark">KATEGORI</h6>
            </div>
            <div class="card-body">
                <div class="widget">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $index => $category)
                                <tr>
                                    <td>{{$index + 1}}.</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <div class="row">
                                            <!-- edit -->
                                            <button
                                                type="button"
                                                class="btn btn-outline-primary mr-2 btn-edit-category"
                                                data-toggle="modal"
                                                data-target="#editCategoryModal"
                                                data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}"
                                                data-action="{{ route('admin.categories.update', $category->id) }}">
                                                <i class="far fa-fw fa-edit"></i> Ubah
                                            </button>

                                            <!-- Delete -->
                                            <button
                                                type="button"
                                                class="btn btn-outline-danger mr-2 btn-delete-category"
                                                data-toggle="modal"
                                                data-target="#deleteCategoryModal"
                                                data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}"
                                                data-action="{{ route('admin.categories.destroy', $category->id) }}">
                                                <i class="fas fa-fw fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL: CREATE -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-name">Nama Kategori</label>
                        <input type="text" name="name" id="create-name" class="form-control" placeholder="contoh: Jalan" value="{{ old('name') }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: EDIT -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="editCategoryForm" action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit-id">
                    <div class="form-group">
                        <label for="edit-name">Nama Kategori</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: DELETE -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Konfirmasi Hapus</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus kategori <strong id="modal-category-name"></strong>?
                <br>
                <small class="text-danger">Kategori ini akan terhapus dan data terkait kategori ini juga akan terhapus.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                <form id="deleteCategoryForm" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        // Isi modal Edit secara dinamis saat dibuka
        $('#editCategoryModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');
            const name = button.data('name') || '';
            const action = button.data('action');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#editCategoryForm').attr('action', action);
        });
    });

    $('#deleteCategoryModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var action = button.data('action');

        var modal = $(this);
        modal.find('#modal-category-name').text(name);
        modal.find('#deleteCategoryForm').attr('action', action);
    });
</script>
@endpush