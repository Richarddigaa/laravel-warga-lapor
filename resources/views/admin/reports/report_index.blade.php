@extends('admin.admin_master')
@section('title', 'Data Laporan | WargaLapor')

@push('style')
<link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Laporan | WargaLapor</h1>

    <div class="col-12 grid-margin stretch-card">

        <a href="{{route('admin.reports.create')}}" class="btn btn-primary mt-1 mb-3">
            <i class="fas fa-fw fa-plus"></i>
            Tambah Laporan
        </a>

        <div class="card">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-dark">DATA LAPORAN</h6>
            </div>
            <div class="card-body">
                <div class="widget">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Laporan</th>
                                    <th>Judul Laporan</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $index => $report)
                                <tr>
                                    <td class="align-middle">{{$index + 1}}.</td>
                                    <td class="align-middle">{{$report->code}}</td>
                                    <td class="align-middle">{{$report->title}}</td>
                                    <td class="align-middle">{{$report->category->name}}</td>
                                    <td class="align-middle">{{ Str::upper(str_replace('_', ' ', $report->latest_status)) }}</td>
                                    <td class="align-middle">{{$report->created_at->translatedFormat('d F Y, H:i')}}</td>
                                    <td>
                                        <a href="{{route('admin.reports.show', $report->id)}}" class="btn btn-outline-primary">
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