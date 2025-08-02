@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Masyarakat</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">

                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops! Ada kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('masyarakat.store') }}" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
                        </div>

                        {{-- NIK --}}
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" class="form-control" required value="{{ old('nik') }}">
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="form-group mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir') }}">
                        </div>

                        {{-- Penghasilan --}}
                        <div class="form-group mb-3">
                            <label for="no_telepon">No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" required value="{{ old('no_telepon') }}">
                        </div>

                        {{-- Jumlah Tanggungan --}}
                        <div class="form-group mb-3">
                            <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                            <input type="number" name="jumlah_tanggungan" class="form-control" required value="{{ old('jumlah_tanggungan') }}">
                        </div>

                        {{-- Kondisi Rumah --}}
                        <div class="form-group mb-3">
                            <label for="kondisi_rumah">Kondisi Rumah</label>
                            <select name="kondisi_rumah" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Layak" {{ old('kondisi_rumah') == 'Layak' ? 'selected' : '' }}>Layak</option>
                                <option value="Kurang Layak" {{ old('kondisi_rumah') == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
                                <option value="Tidak Layak" {{ old('kondisi_rumah') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                            </select>
                        </div>

                        {{-- Status Pekerjaan --}}
                        <div class="form-group mb-3">
                            <label for="status_pekerjaan">Status Pekerjaan</label>
                            <select name="status_pekerjaan" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Pengangguran" {{ old('status_pekerjaan') == 'Pengangguran' ? 'selected' : '' }}>Pengangguran</option>
                                <option value="Tidak Tetap" {{ old('status_pekerjaan') == 'Tidak Tetap' ? 'selected' : '' }}>Tidak Tetap</option>
                                <option value="Tetap" {{ old('status_pekerjaan') == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                            </select>
                        </div>

                        {{-- Pendidikan --}}
                        <div class="form-group mb-3">
                            <label for="pendidikan">Pendidikan</label>
                            <select name="pendidikan" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tidak Sekolah" {{ old('pendidikan') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="Diploma" {{ old('pendidikan') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                            </select>
                        </div>

                        {{-- Akses Kesehatan --}}
                        <div class="form-group mb-3">
                            <label for="akses_kesehatan">Akses Kesehatan (BPJS)</label>
                            <select name="akses_kesehatan" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="1" {{ old('akses_kesehatan') == '1' ? 'selected' : '' }}>Punya</option>
                                <option value="0" {{ old('akses_kesehatan') == '0' ? 'selected' : '' }}>Tidak Punya</option>
                            </select>
                        </div>

                        {{-- Kepemilikan Aset --}}
                        <div class="form-group mb-4">
                            <label for="kepemilikan_aset">Kepemilikan Aset (bisa pilih lebih dari satu)</label>
                            <select name="kepemilikan_aset[]" class="form-control" multiple>
                                <option value="motor" {{ is_array(old('kepemilikan_aset')) && in_array('motor', old('kepemilikan_aset')) ? 'selected' : '' }}>Motor</option>
                                <option value="mobil" {{ is_array(old('kepemilikan_aset')) && in_array('mobil', old('kepemilikan_aset')) ? 'selected' : '' }}>Mobil</option>
                                <option value="tanah" {{ is_array(old('kepemilikan_aset')) && in_array('tanah', old('kepemilikan_aset')) ? 'selected' : '' }}>Tanah</option>
                                <option value="rumah" {{ is_array(old('kepemilikan_aset')) && in_array('rumah', old('kepemilikan_aset')) ? 'selected' : '' }}>Rumah</option>
                            </select>
                            <small class="text-muted">Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu</small>
                        </div>

                        {{-- Tombol Simpan dan Kembali --}}
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('masyarakat.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
