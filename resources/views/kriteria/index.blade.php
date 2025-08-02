@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Kriteria</h1>

    <a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-3">+ Tambah Kriteria</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriteria as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>{{ ucfirst($item->tipe) }}</td>
                            <td>
                                <a href="{{ route('kriteria.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
