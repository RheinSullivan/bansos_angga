@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('penilaian.hasil') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-chart-bar mr-2"></i>Hasil Perhitungan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('penilaian.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-clipboard-check mr-2"></i>Input Penilaian
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('penilaian.cetak-pdf') }}" class="btn btn-info btn-block">
                                <i class="fas fa-file-pdf mr-2"></i>Cetak PDF
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('masyarakat.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-users mr-2"></i>Data Masyarakat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Card Jumlah Masyarakat -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Masyarakat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $jumlahMasyarakat ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Kriteria -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $jumlahKriteria ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Subkriteria -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Subkriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $jumlahSubkriteria ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Penilaian -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Penilaian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $jumlahPenilaian ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contoh tambahan: Jumlah Admin -->
        {{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

</div>
@endsection
