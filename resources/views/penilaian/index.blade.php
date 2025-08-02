@extends('layouts.admin')

@section('title', 'Form Penilaian')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 text-primary font-weight-bold">📝 Form Penilaian</h4>

    <div class="card shadow">
        <div class="card-body">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="masyarakat_id" class="form-label">Nama Masyarakat</label>
            <select name="masyarakat_id" id="masyarakat_id" class="form-select" required>
                <option value="">-- Pilih --</option>
                @foreach($masyarakat as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->nik }}</option>
                @endforeach
            </select>
        </div>

        <hr>

        @foreach($kriteria as $krit)
            <div class="mb-3">
                <label class="form-label">{{ $krit->nama }}</label>
                <select name="nilai[{{ $krit->id }}]" class="form-select" required>
                    <option value="">-- Pilih Subkriteria --</option>
                    @foreach($krit->subkriteria as $sub)
                        <option value="{{ $sub->id }}">
                            {{ $sub->nama }} (Nilai: {{ $sub->nilai }})
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Simpan & Hitung SAW
            </button>
        </form>
        </div>
    </div>
</div>
@endsection
