@extends('layouts.admin')

@section('title', 'Detail Perhitungan SAW')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0 text-center">
                <i class="fas fa-file-alt mr-2"></i>
                DETAIL PERHITUNGAN SISTEM PENDUKUNG KEPUTUSAN
            </h4>
            <p class="text-center mb-0">PEMILIHAN PENERIMA BANTUAN SOSIAL</p>
            <p class="text-center mb-0">Menggunakan Metode Simple Additive Weighting (SAW)</p>
            <p class="text-center mb-0">Tanggal: {{ date('d/m/Y H:i:s') }}</p>
        </div>
        <div class="card-body">
<body>
            <div class="alert alert-info">
                <h6><i class="fas fa-info-circle mr-2"></i>Keterangan Metode SAW:</h6>
                <ul class="mb-0">
                    <li>Simple Additive Weighting (SAW) adalah metode penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua kriteria</li>
                    <li>Status "Layak" diberikan kepada 3 peringkat teratas</li>
                    <li>Total skor dihitung berdasarkan normalisasi dan bobot kriteria</li>
                </ul>
            </div>

            <div class="mb-4">
                <h5><i class="fas fa-list mr-2"></i>Data Kriteria:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
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

            <div class="mb-4">
                <h5><i class="fas fa-chart-bar mr-2"></i>Hasil Perhitungan SAW:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ranking</th>
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
            </div>

            <div class="mb-4">
                <h5><i class="fas fa-calculator mr-2"></i>Penjelasan Perhitungan:</h5>
                <ol>
                    <li><strong>Normalisasi:</strong> Nilai kriteria dinormalisasi berdasarkan tipe kriteria (benefit/cost)</li>
                    <li><strong>Benefit:</strong> Nilai dibagi dengan nilai maksimum kriteria tersebut</li>
                    <li><strong>Cost:</strong> Nilai minimum kriteria dibagi dengan nilai kriteria tersebut</li>
                    <li><strong>Bobot:</strong> Setiap kriteria memiliki bobot yang berbeda</li>
                    <li><strong>Total Skor:</strong> Jumlah dari (nilai ternormalisasi × bobot) untuk semua kriteria</li>
                </ol>
            </div>

            <div class="text-right mt-4">
                <small class="text-muted">
                    Dicetak pada: {{ date('d/m/Y H:i:s') }}<br>
                    Dicetak oleh: Admin Sistem<br>
                    Total Data: {{ count($hasil) }} Masyarakat
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