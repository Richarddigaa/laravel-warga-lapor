@extends('admin.admin_master')
@section('title', 'Data Warga | WargaLapor')

@push('style')
<link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Warga | WargaLapor</h1>

    <div class="col-12 grid-margin stretch-card">

        <a href="{{route('admin.citizen.create')}}" class="btn btn-primary mt-1 mb-3">
            <i class="fas fa-fw fa-plus"></i>
            Tambah Warga
        </a>

        <div class="card">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-dark">DATA WARGA</h6>
            </div>
            <div class="card-body">
                <div class="widget">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Avatar</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($citizens as $index => $citizen)
                                <tr>
                                    <td class="align-middle">{{$index + 1}}.</td>
                                    <td class="align-middle">
                                        <img class=" rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;"
                                            src="{{ $citizen->avatar ? Storage::url($citizen->avatar) : asset('assets/img/user.png') }}"
                                            alt="Avatar">
                                    </td>
                                    <td class="align-middle">{{$citizen->nik}}</td>
                                    <td class="align-middle">{{$citizen->name}}</td>
                                    <td class="align-middle">{{$citizen->email}}</td>
                                    <td class="align-middle">{{$citizen->created_at->translatedFormat('d F Y, H:i')}}</td>
                                    <td class="align-middle">
                                        <a href="{{route('admin.citizen.show', $citizen->id)}}" class="btn btn-outline-primary">
                                            <i class="fas fa-fw fa-search-plus"></i>
                                            Lihat Detail
                                        </a>
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

@endsection

@push('scripts')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush