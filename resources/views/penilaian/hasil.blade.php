@extends('layouts.admin')

@section('title', 'Hasil Perhitungan SAW')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-primary font-weight-bold">📊 Hasil Perhitungan SAW</h4>
        <div>
            <a href="{{ route('penilaian.cetak-pdf') }}" class="btn btn-success mr-2">
                <i class="fas fa-file-pdf mr-2"></i>Cetak PDF
            </a>
            <a href="{{ route('penilaian.cetak-pdf-detail') }}" class="btn btn-info">
                <i class="fas fa-file-alt mr-2"></i>Cetak Detail
            </a>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 text-sm">
                    <thead class="thead-light text-center">
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
                            <tr class="text-center">
                                <td>{{ $item['ranking'] }}</td>
                                <td class="text-left">{{ $item['nama'] }}</td>
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
    </div>
</div>
@endsection
