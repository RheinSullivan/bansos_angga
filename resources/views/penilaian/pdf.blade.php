@extends('layouts.admin')

@section('title', 'Hasil Perhitungan SAW - PDF')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">
                <i class="fas fa-file-pdf mr-2"></i>
                HASIL PERHITUNGAN SISTEM PENDUKUNG KEPUTUSAN
            </h4>
            <p class="text-center mb-0">PEMILIHAN PENERIMA BANTUAN SOSIAL</p>
            <p class="text-center mb-0">Menggunakan Metode Simple Additive Weighting (SAW)</p>
            <p class="text-center mb-0">Tanggal: {{ date('d/m/Y H:i:s') }}</p>
        </div>
        <div class="card-body">
<body>
            <div class="alert alert-info">
                <h6><i class="fas fa-info-circle mr-2"></i>Keterangan:</h6>
                <ul class="mb-0">
                    <li>Metode yang digunakan: Simple Additive Weighting (SAW)</li>
                    <li>Status "Layak" diberikan kepada 3 peringkat teratas</li>
                    <li>Total skor dihitung berdasarkan normalisasi dan bobot kriteria</li>
                </ul>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Total Skor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hasil as $item)
                            <tr>
                                <td>{{ $item['ranking'] }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['nik'] }}</td>
                                <td>{{ $item['total'] }}</td>
                                <td>
                                    @if($item['status'] === 'Layak')
                                        <span class="badge badge-success">Layak</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Layak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-4">
                <small class="text-muted">
                    Dicetak pada: {{ date('d/m/Y H:i:s') }}<br>
                    Dicetak oleh: Admin Sistem
                </small>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <button onclick="window.print()" class="btn btn-primary">
        <i class="fas fa-print mr-2"></i>Cetak
    </button>
    <a href="{{ route('penilaian.hasil') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>
@endsection 