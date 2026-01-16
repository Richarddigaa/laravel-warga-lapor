@extends('admin.admin_master')
@section('title', 'Detail Warga | WargaLapor')

@push('style')
<link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Warga | WargaLapor</h1>
        <a href="{{ route('admin.citizen.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-body text-center p-5">
                    <img class="img-profile rounded-circle mb-3 shadow-sm"
                        style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff;"
                        src="{{ $citizen->avatar ? Storage::url($citizen->avatar) : asset('assets/img/user.png') }}"
                        alt="Avatar User">

                    <h4 class="font-weight-bold text-gray-800 mb-1">{{ $citizen->name }}</h4>
                    <p class="text-muted mb-4">{{ $citizen->email }}</p>

                    <div class="row text-center border-top border-bottom py-3 mb-4">
                        <div class="col-12">
                            <span class="small text-uppercase text-gray-500 font-weight-bold">Bergabung Sejak</span>
                            <div class="h6 font-weight-bold text-gray-800 mb-0">
                                {{ $citizen->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.citizen.edit', $citizen->id) }}" class="btn btn-warning btn-icon-split mr-2">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Ubah Data</span>
                        </a>

                        <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#deleteModal">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Informasi Biodata</h6>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="small text-secondary text-uppercase font-weight-bold">Nomor Induk Kependudukan (NIK)</label>
                            <div class="h5 font-weight-bold text-gray-800">
                                <i class="fas fa-id-card fa-fw mr-2 text-gray-400"></i>
                                {{ $citizen->nik }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-secondary text-uppercase font-weight-bold">Nomor Telepon / WA</label>
                            <div class="h5 font-weight-bold text-gray-800">
                                <i class="fab fa-whatsapp fa-fw mr-2 text-success"></i>
                                {{ $citizen->phone }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="small text-secondary text-uppercase font-weight-bold">Tempat, Tanggal Lahir</label>
                            <div class="font-weight-bold text-gray-800">
                                {{-- Pastikan format date disimpan benar, atau gunakan helper text biasa --}}
                                {{ $citizen->date_of_birth ? \Carbon\Carbon::parse($citizen->date_of_birth)->translatedFormat('d F Y') : '-' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-secondary text-uppercase font-weight-bold">Pekerjaan</label>
                            <div class="font-weight-bold text-gray-800">
                                {{ $citizen->type_of_work ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <label class="small text-secondary text-uppercase font-weight-bold">Alamat Lengkap</label>
                            <div class="p-3 bg-light rounded border">
                                <i class="fas fa-map-marker-alt mr-2 text-danger"></i>
                                {{ $citizen->address ?? 'Alamat belum dilengkapi.' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Riwayat Laporan</h6>
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
                                    @foreach($citizen->reports as $index => $report)
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
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data warga <strong>{{ $citizen->name }}</strong>?
                <br>
                <small class="text-danger">Semua laporan dan data terkait user ini juga akan terhapus.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                <form action="{{ route('admin.citizen.destroy', $citizen->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus Permanen</button>
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
</script>
@endpush