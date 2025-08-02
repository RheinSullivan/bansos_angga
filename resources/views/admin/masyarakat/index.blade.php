@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Masyarakat</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('masyarakat.create') }}" class="btn btn-success mb-3">+ Tambah Data</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakat as $data)
                <tr>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->nik }}</td>
                    <td>{{ $data->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
