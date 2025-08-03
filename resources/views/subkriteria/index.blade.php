@extends('layouts.admin')

@section('title', 'Data Subkriteria')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 text-primary font-weight-bold">📊 Data Subkriteria</h4>

    {{-- Pesan sukses --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- Tombol Tambah --}}
    <div class="mb-3">
        <a href="{{ route('subkriteria.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Tambah Subkriteria
        </a>
    </div>

    {{-- Tabel --}}
    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Nama Subkriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subkriterias as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kriteria->nama ?? '-' }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td>
                                <a href="{{ route('subkriteria.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit Subkriteria">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('subkriteria.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Subkriteria">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">🙁 Belum ada data subkriteria.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection