@extends('admin.admin_master')
@section('title', 'Dashboard Admin | WargaLapor')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                Data Kategori
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                {{ $categories }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('admin.categories.index')}}">
                                <i class="fas fa-list fa-3x text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                Data Laporan
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                {{ $reports }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('admin.reports.index')}}">
                                <i class="fas fa-clipboard-list fa-3x text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                Data Hadiah
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                {{ $rewards }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('admin.rewards.index')}}">
                                <i class="fas fa-gift fa-3x text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                Data Warga
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                {{ $citizens }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('admin.citizen.index')}}">
                                <i class="fas fa-users fa-3x text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection