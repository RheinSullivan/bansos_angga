@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Kriteria</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="nama">Nama Kriteria</label>
                            <input type="text" name="nama" class="form-control" required value="{{ old('nama', $kriteria->nama) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="bobot">Bobot</label>
                            <input type="number" step="0.01" name="bobot" class="form-control" required value="{{ old('bobot', $kriteria->bobot) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="tipe">Tipe</label>
                            <select name="tipe" class="form-control" required>
                                <option value="benefit" {{ $kriteria->tipe == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ $kriteria->tipe == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
