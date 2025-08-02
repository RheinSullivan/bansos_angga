@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Data Masyarakat</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('masyarakat.update', $masyarakat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required value="{{ old('nama', $masyarakat->nama) }}">
                        </div>

                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" required value="{{ old('nik', $masyarakat->nik) }}">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $masyarakat->alamat) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $masyarakat->no_telepon) }}">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ $masyarakat->tanggal_lahir->format('Y-m-d') }}" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Tanggungan</label>
                            <input type="number" name="jumlah_tanggungan" class="form-control" min="0" value="{{ old('jumlah_tanggungan', $masyarakat->jumlah_tanggungan) }}">
                        </div>

                        <div class="form-group">
                            <label>Kondisi Rumah</label>
                            <select name="kondisi_rumah" class="form-control" required>
                            <option value="Layak" {{ old('kondisi_rumah', $masyarakat->kondisi_rumah) == 'Layak' ? 'selected' : '' }}>Layak</option>
                            <option value="Kurang Layak" {{ old('kondisi_rumah', $masyarakat->kondisi_rumah) == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
                            <option value="Tidak Layak" {{ old('kondisi_rumah', $masyarakat->kondisi_rumah) == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label>Status Pekerjaan</label>
                            <input type="text" name="status_pekerjaan" class="form-control" value="{{ old('status_pekerjaan', $masyarakat->status_pekerjaan) }}">
                        </div>

                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan" class="form-control" value="{{ old('pendidikan', $masyarakat->pendidikan) }}">
                        </div>

                        <div class="form-group">
                            <label>Akses Kesehatan (BPJS)</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="akses_kesehatan" value="1" {{ old('akses_kesehatan', $masyarakat->akses_kesehatan) ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="akses_kesehatan" value="0" {{ !old('akses_kesehatan', $masyarakat->akses_kesehatan) ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">Tidak Ada</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kepemilikan Aset</label><br>
                            @php
                                $aset = json_decode($masyarakat->kepemilikan_aset, true) ?? [];
                                $opsiAset = ['sepeda', 'motor', 'mobil', 'tanah', 'rumah'];
                            @endphp
                            @foreach($opsiAset as $a)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="kepemilikan_aset[]" value="{{ $a }}" {{ in_array($a, $aset) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ ucfirst($a) }}</label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('masyarakat.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
