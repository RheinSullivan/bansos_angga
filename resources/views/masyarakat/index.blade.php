@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4 text-primary font-weight-bold">👥 Data Masyarakat</h4>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Card Data --}}
    <div class="card shadow">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="font-weight-bold">📄 Daftar Data</span>
            <a href="{{ route('masyarakat.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-sm">
                    <thead class="text-center">
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>No Telepon</th>
                            <th>Tanggungan</th>
                            <th>Kondisi Rumah</th>
                            <th>Pekerjaan</th>
                            <th>Pendidikan</th>
                            <th>BPJS</th>
                            <th>Aset</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($masyarakats as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>{{ $item->jumlah_tanggungan }}</td>
                            <td>{{ $item->kondisi_rumah }}</td>
                            <td>{{ $item->status_pekerjaan }}</td>
                            <td>{{ $item->pendidikan }}</td>
                            <td class="text-center">
                                @if ($item->akses_kesehatan)
                                    ✅
                                @else
                                    ❌
                                @endif
                            </td>
                            <td>
                                @php
                                    $aset = json_decode($item->kepemilikan_aset, true);
                                @endphp
                                @if (!empty($aset))
                                    <ul class="mb-0 pl-3">
                                        @foreach($aset as $a)
                                            <li>{{ ucfirst($a) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('masyarakat.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit Data Masyarakat">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('masyarakat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data Masyarakat">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted">🙁 Belum ada data masyarakat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
