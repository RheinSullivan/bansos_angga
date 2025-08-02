@extends('layouts.masyarakat')

@section('title', 'Dashboard Masyarakat')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Masyarakat</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Welcome Card -->
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Selamat Datang
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $masyarakat->nama }}
                        </div>
                        <div class="text-sm text-gray-600">
                            NIK: {{ $masyarakat->nik }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Hasil Perhitungan Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Skor
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $hasilPerhitungan['total'] }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calculator fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Status
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if($hasilPerhitungan['status'] === 'Layak')
                                <span class="status-layak">{{ $hasilPerhitungan['status'] }}</span>
                            @else
                                <span class="status-tidak-layak">{{ $hasilPerhitungan['status'] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        @if($hasilPerhitungan['status'] === 'Layak')
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        @else
                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ranking Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Peringkat
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $hasilPerhitungan['ranking'] }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-trophy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Data Pribadi -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user mr-2"></i>Data Pribadi
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Nama:</strong></td>
                            <td>{{ $masyarakat->nama }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIK:</strong></td>
                            <td>{{ $masyarakat->nik }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat:</strong></td>
                            <td>{{ $masyarakat->alamat }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Lahir:</strong></td>
                            <td>{{ date('d/m/Y', strtotime($masyarakat->tanggal_lahir)) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Usia:</strong></td>
                            <td>{{ $masyarakat->usia }} tahun</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Ekonomi -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-line mr-2"></i>Data Ekonomi
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Penghasilan:</strong></td>
                            <td>Rp {{ number_format($masyarakat->penghasilan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Tanggungan:</strong></td>
                            <td>{{ $masyarakat->jumlah_tanggungan }} orang</td>
                        </tr>
                        <tr>
                            <td><strong>Status Pekerjaan:</strong></td>
                            <td>{{ $masyarakat->status_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pendidikan:</strong></td>
                            <td>{{ $masyarakat->pendidikan }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kondisi Rumah:</strong></td>
                            <td>{{ $masyarakat->kondisi_rumah }}</td>
                        </tr>
                        <tr>
                            <td><strong>Akses Kesehatan:</strong></td>
                            <td>
                                @if($masyarakat->akses_kesehatan)
                                    <span class="badge badge-success">Ya</span>
                                @else
                                    <span class="badge badge-danger">Tidak</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body text-center">
                <h6 class="mb-3 text-primary">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Penting
                </h6>
                <p class="mb-3">
                    Sistem ini menggunakan metode Simple Additive Weighting (SAW) untuk menentukan 
                    kelayakan penerima bantuan sosial. Status "Layak" diberikan kepada 3 peringkat teratas.
                </p>
                <a href="{{ route('masyarakat.hasil') }}" class="btn btn-primary">
                    <i class="fas fa-chart-bar mr-2"></i>Lihat Detail Hasil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
