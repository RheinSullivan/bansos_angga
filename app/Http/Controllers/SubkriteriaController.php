<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Subkriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $subkriterias = Subkriteria::with('kriteria')->get();

        return view('subkriteria.index', compact('subkriterias'));
    }

    public function create()
    {
        $kriteriaList = Kriteria::all();

        $page_meta = [
            'title' => 'Tambah Subkriteria',
            'method' => 'POST',
            'button' => 'Simpan',
        ];

        return view('subkriteria.create', compact('kriteriaList', 'page_meta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama' => 'required|string',
            'nilai' => 'required|numeric',
        ]);

        Subkriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama' => $request->nama,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $subkriteria = Subkriteria::findOrFail($id);
        $kriteriaList = Kriteria::all();

        $page_meta = [
            'title' => 'Edit Subkriteria',
            'method' => 'PUT',
            'button' => 'Update',
        ];

        return view('subkriteria.edit', compact('subkriteria', 'kriteriaList', 'page_meta'));
    }

    public function update(Request $request, $id)
    {
        $subkriteria = Subkriteria::findOrFail($id);

        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama' => 'required|string',
            'nilai' => 'required|numeric',
        ]);

        $subkriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'nama' => $request->nama,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Subkriteria::destroy($id);
        return redirect()->route('subkriteria.index')->with('success', 'Data berhasil dihapus.');
    }
}
