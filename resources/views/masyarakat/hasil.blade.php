@extends('layouts.masyarakat')

@section('title', 'Hasil Perhitungan')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hasil Perhitungan SAW</h1>
</div>

<!-- Alert Info -->
<div class="alert alert-info">
    <h6><i class="fas fa-info-circle mr-2"></i>Informasi Metode SAW:</h6>
    <ul class="mb-0">
        <li>Simple Additive Weighting (SAW) adalah metode penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua kriteria</li>
        <li>Status "Layak" diberikan kepada 3 peringkat teratas</li>
        <li>Total skor dihitung berdasarkan normalisasi dan bobot kriteria</li>
    </ul>
</div>

<!-- Hasil Perhitungan Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-chart-bar mr-2"></i>Hasil Perhitungan Anda
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>Nama:</strong></td>
                        <td>{{ $hasil['nama'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>NIK:</strong></td>
                        <td>{{ $hasil['nik'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Skor:</strong></td>
                        <td><span class="font-weight-bold text-primary">{{ $hasil['total'] }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Peringkat:</strong></td>
                        <td><span class="font-weight-bold text-warning">{{ $hasil['ranking'] }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($hasil['status'] === 'Layak')
                                <span class="status-layak">{{ $hasil['status'] }}</span>
                            @else
                                <span class="status-tidak-layak">{{ $hasil['status'] }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    @if($hasil['status'] === 'Layak')
                        <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                        <h5 class="text-success">Selamat! Anda layak menerima bantuan sosial.</h5>
                        <p class="text-muted">Anda termasuk dalam 3 peringkat teratas berdasarkan perhitungan SAW.</p>
                    @else
                        <i class="fas fa-times-circle fa-5x text-danger mb-3"></i>
                        <h5 class="text-danger">Maaf, Anda belum layak menerima bantuan sosial.</h5>
                        <p class="text-muted">Hanya 3 peringkat teratas yang layak menerima bantuan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Kriteria Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list mr-2"></i>Data Kriteria yang Digunakan
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $index => $kriteria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kriteria->nama }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td>{{ ucfirst($kriteria->tipe) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Penjelasan Perhitungan Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-calculator mr-2"></i>Penjelasan Perhitungan
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold text-primary">Langkah-langkah Perhitungan:</h6>
                <ol>
                    <li><strong>Normalisasi:</strong> Nilai kriteria dinormalisasi berdasarkan tipe kriteria (benefit/cost)</li>
                    <li><strong>Benefit:</strong> Nilai dibagi dengan nilai maksimum kriteria tersebut</li>
                    <li><strong>Cost:</strong> Nilai minimum kriteria dibagi dengan nilai kriteria tersebut</li>
                    <li><strong>Bobot:</strong> Setiap kriteria memiliki bobot yang berbeda</li>
                    <li><strong>Total Skor:</strong> Jumlah dari (nilai ternormalisasi × bobot) untuk semua kriteria</li>
                </ol>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold text-primary">Kriteria Penilaian:</h6>
                <ul>
                    <li><strong>Pendapatan:</strong> Semakin rendah semakin baik (Cost)</li>
                    <li><strong>Jumlah Tanggungan:</strong> Semakin banyak semakin baik (Benefit)</li>
                    <li><strong>Kondisi Rumah:</strong> Semakin layak semakin baik (Benefit)</li>
                    <li><strong>Status Pekerjaan:</strong> Semakin tetap semakin baik (Benefit)</li>
                    <li><strong>Pendidikan:</strong> Semakin tinggi semakin baik (Benefit)</li>
                    <li><strong>Akses Kesehatan:</strong> Ada akses lebih baik (Benefit)</li>
                    <li><strong>Usia:</strong> Usia produktif lebih baik (Benefit)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="text-center">
    <a href="{{ route('dashboard.masyarakat') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
    </a>
</div>
@endsection 