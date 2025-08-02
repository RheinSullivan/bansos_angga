@extends('layouts.admin')

@section('title', $page_meta['title'])

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 text-primary font-weight-bold">📝 {{ $page_meta['title'] }}</h4>

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ route('subkriteria.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="kriteria_id">Kriteria</label>
                    <select name="kriteria_id" id="kriteria_id" class="form-control" required>
                        <option value="">-- Pilih Kriteria --</option>
                        @foreach ($kriteriaList as $kriteria)
                        <option value="{{ $kriteria->id }}" {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                            {{ $kriteria->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('kriteria_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nama">Nama Subkriteria</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nilai">Nilai</label>
                    <input type="number" step="0.01" name="nilai" id="nilai" class="form-control" value="{{ old('nilai') }}" required>
                    @error('nilai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>{{ $page_meta['button'] }}
                </button>
                <a href="{{ route('subkriteria.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection