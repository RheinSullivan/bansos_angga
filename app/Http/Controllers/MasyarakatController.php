<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakats = Masyarakat::all();
        return view('masyarakat.index', compact('masyarakats'));
    }

    public function create()
    {
        return view('masyarakat.create');
    }

    public function store(Request $request)
    {
        // Bersihkan input numerik dari tanda titik
        $request->merge([
            'no_telepon' => str_replace('.', '', $request->no_telepon),
            'jumlah_tanggungan' => str_replace('.', '', $request->jumlah_tanggungan),
        ]);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:masyarakat',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => 'required|string|max:20',
            'jumlah_tanggungan' => 'required|integer',
            'kondisi_rumah' => 'required|in:Layak,Kurang Layak,Tidak Layak',
            'status_pekerjaan' => 'required|in:Pengangguran,Tidak Tetap,Tetap',
            'pendidikan' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Diploma,S1',
            'akses_kesehatan' => 'required|boolean',
            'kepemilikan_aset' => 'nullable|array',
        ]);

        $usia = Carbon::parse($request->tanggal_lahir)->age;

        Masyarakat::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'kondisi_rumah' => $request->kondisi_rumah,
            'status_pekerjaan' => $request->status_pekerjaan,
            'pendidikan' => $request->pendidikan,
            'akses_kesehatan' => $request->akses_kesehatan,
            'kepemilikan_aset' => $request->kepemilikan_aset ? json_encode($request->kepemilikan_aset) : null,
            'usia' => $usia,
        ]);

        return redirect()->route('masyarakat.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.edit', compact('masyarakat'));
    }

    public function update(Request $request, $id)
    {
        $masyarakat = Masyarakat::findOrFail($id);

        // Bersihkan input numerik dari tanda titik
        $request->merge([
            'no_telepon' => str_replace('.', '', $request->no_telepon),
            'jumlah_tanggungan' => str_replace('.', '', $request->jumlah_tanggungan),
        ]);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:masyarakat,nik,' . $masyarakat->id,
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => 'required|string|max:20',
            'jumlah_tanggungan' => 'required|integer',
            'kondisi_rumah' => 'required|in:Layak,Kurang Layak,Tidak Layak',
            'status_pekerjaan' => 'required|in:Pengangguran,Tidak Tetap,Tetap',
            'pendidikan' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Diploma,S1',
            'akses_kesehatan' => 'required|in:0,1',
            'kepemilikan_aset' => 'nullable|array',
        ]);

        $usia = Carbon::parse($request->tanggal_lahir)->age;

        $masyarakat->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'kondisi_rumah' => $request->kondisi_rumah,
            'status_pekerjaan' => $request->status_pekerjaan,
            'pendidikan' => $request->pendidikan,
            'akses_kesehatan' => $request->akses_kesehatan,
            'kepemilikan_aset' => $request->kepemilikan_aset ? json_encode($request->kepemilikan_aset) : null,
            'usia' => $usia,
        ]);

        return redirect()->route('masyarakat.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->delete();

        return redirect()->route('masyarakat.index')->with('success', 'Data berhasil dihapus');
    }
}
