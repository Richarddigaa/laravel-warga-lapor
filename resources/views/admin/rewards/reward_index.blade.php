@extends('admin.admin_master')
@section('title', 'Data Hadiah | WargaLapor')

@push('style')
<link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Hadiah | WargaLapor</h1>

    <div class="col-12 grid-margin stretch-card">

        <a href="{{route('admin.rewards.create')}}" class="btn btn-primary mt-1 mb-3">
            <i class="fas fa-fw fa-plus"></i>
            Tambah Hadiah
        </a>

        <div class="card">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-dark">DATA HADIAH</h6>
            </div>
            <div class="card-body">
                <div class="widget">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Thumbnail</th>
                                    <th>Nama Hadiah</th>
                                    <th>Harga Poin</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rewards as $index => $reward)
                                <tr>
                                    <td class="align-middle">{{$index + 1}}.</td>
                                    <td class="align-middle">
                                        <img class="rounded"
                                            style="width: 100px; height: 60px; object-fit: cover;"
                                            src="{{ Storage::url($reward->thumbnail) }}"
                                            alt="Thumbnail">
                                    </td>
                                    <td class="align-middle">{{$reward->name}}</td>
                                    <td class="align-middle">{{$reward->point_cost}}</td>
                                    <td class="align-middle">{{$reward->stock}}</td>
                                    <td class="align-middle">
                                        {{$reward->is_active == 1 ? 'Aktif' : 'Tidak Aktif'}}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.rewards.edit', $reward->id) }}" class="btn btn-outline-primary mr-1">
                                            <i class="fas fa-fw fa-edit"></i> Ubah
                                        </a>

                                        <!-- Delete -->
                                        <button
                                            type="button"
                                            class="btn btn-outline-danger"
                                            data-toggle="modal"
                                            data-target="#deleteRewardModal"
                                            data-id="{{ $reward->id }}"
                                            data-name="{{ $reward->name }}"
                                            data-action="{{ route('admin.rewards.destroy', $reward->id) }}">
                                            <i class="fas fa-fw fa-trash"></i> Hapus
                                        </button>
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

<!-- MODAL: DELETE -->
<div class="modal fade" id="deleteRewardModal" tabindex="-1" role="dialog" aria-labelledby="deleteRewardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteRewardModalLabel">Konfirmasi Hapus</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus kategori <strong id="modal-reward-name"></strong>?
                <br>
                <small class="text-danger">Hadiah ini akan terhapus permanen.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                <form id="deleteRewardForm" action="#" method="POST">
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
    });

    $('#deleteRewardModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var action = button.data('action');

        var modal = $(this);
        modal.find('#modal-reward-name').text(name);
        modal.find('#deleteRewardForm').attr('action', action);
    });
</script>
@endpush