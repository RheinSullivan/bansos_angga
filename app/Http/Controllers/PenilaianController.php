<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use App\Models\Kriteria;
use App\Models\Subkriteria;

class PenilaianController extends Controller
{
    // ✅ Index tampilkan form penilaian
    public function index()
    {
        $masyarakat = Masyarakat::all();
        $kriteria = Kriteria::with('subkriteria')->get();
        
        return view('penilaian.index', compact('masyarakat', 'kriteria'));
    }

    // ✅ Simpan penilaian dan hitung otomatis
    public function store(Request $request)
    {
        $request->validate([
            'masyarakat_id' => 'required|exists:masyarakat,id',
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $kriteria_id => $subkriteria_id) {
            $sub = Subkriteria::find($subkriteria_id);
            if (!$sub) continue;

            Penilaian::updateOrCreate(
                [
                    'masyarakat_id' => $request->masyarakat_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'subkriteria_id' => $subkriteria_id,
                    'nilai' => $sub->nilai,
                ]
            );
        }

        return redirect()->route('penilaian.hasil')->with('success', 'Penilaian berhasil disimpan!');
    }

    // ✅ Tampilkan hasil perhitungan SAW
    public function hasil()
    {
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all()->groupBy('masyarakat_id');

        $bobot = $kriterias->pluck('bobot', 'id');
        $tipe = $kriterias->pluck('tipe', 'id');

        $matrix = [];
        foreach ($penilaians as $masyarakat_id => $items) {
            foreach ($items as $p) {
                $matrix[$masyarakat_id][$p->kriteria_id] = $p->nilai;
            }
        }

        // Hitung nilai maksimum dan minimum dengan proteksi
        $nilaiMax = $nilaiMin = [];
        foreach ($kriterias as $k) {
            $nilaiKriteria = array_map(fn($m) => $m[$k->id] ?? null, $matrix);
            $nilaiKriteria = array_filter($nilaiKriteria, fn($v) => $v !== null);

            $nilaiMax[$k->id] = count($nilaiKriteria) > 0 ? max($nilaiKriteria) : 1;
            $nilaiMin[$k->id] = count($nilaiKriteria) > 0 ? min($nilaiKriteria) : 1;
        }

        // Hitung nilai total
        $hasil = [];
        foreach ($matrix as $masyarakatId => $nilaiKriteria) {
            $total = 0;
            foreach ($kriterias as $k) {
                $nilai = $nilaiKriteria[$k->id] ?? 0;

                if ($tipe[$k->id] === 'benefit') {
                    $normal = $nilai / max($nilaiMax[$k->id], 1);
                } else {
                    $normal = max($nilaiMin[$k->id], 1) / max($nilai, 1);
                }

                $total += $normal * $bobot[$k->id];
            }

            $masyarakat = Masyarakat::find($masyarakatId);

            $hasil[] = [
                'masyarakat_id' => $masyarakatId,
                'nama' => $masyarakat->nama ?? '-',
                'nik' => $masyarakat->nik ?? '-',
                'total' => round($total, 4),
            ];
        }

        // Ranking dan status
        usort($hasil, fn($a, $b) => $b['total'] <=> $a['total']);

        foreach ($hasil as $i => &$data) {
            $data['ranking'] = $i + 1;
            $data['status'] = $i < 3 ? 'Layak' : 'Tidak Layak'; // 3 teratas dianggap layak
        }

        return view('penilaian.hasil', compact('hasil'));
    }

    // ✅ Cetak PDF hasil perhitungan
    public function cetakPDF()
    {
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all()->groupBy('masyarakat_id');

        $bobot = $kriterias->pluck('bobot', 'id');
        $tipe = $kriterias->pluck('tipe', 'id');

        $matrix = [];
        foreach ($penilaians as $masyarakat_id => $items) {
            foreach ($items as $p) {
                $matrix[$masyarakat_id][$p->kriteria_id] = $p->nilai;
            }
        }

        // Hitung nilai maksimum dan minimum dengan proteksi
        $nilaiMax = $nilaiMin = [];
        foreach ($kriterias as $k) {
            $nilaiKriteria = array_map(fn($m) => $m[$k->id] ?? null, $matrix);
            $nilaiKriteria = array_filter($nilaiKriteria, fn($v) => $v !== null);

            $nilaiMax[$k->id] = count($nilaiKriteria) > 0 ? max($nilaiKriteria) : 1;
            $nilaiMin[$k->id] = count($nilaiKriteria) > 0 ? min($nilaiKriteria) : 1;
        }

        // Hitung nilai total
        $hasil = [];
        foreach ($matrix as $masyarakatId => $nilaiKriteria) {
            $total = 0;
            foreach ($kriterias as $k) {
                $nilai = $nilaiKriteria[$k->id] ?? 0;

                if ($tipe[$k->id] === 'benefit') {
                    $normal = $nilai / max($nilaiMax[$k->id], 1);
                } else {
                    $normal = max($nilaiMin[$k->id], 1) / max($nilai, 1);
                }

                $total += $normal * $bobot[$k->id];
            }

            $masyarakat = Masyarakat::find($masyarakatId);

            $hasil[] = [
                'masyarakat_id' => $masyarakatId,
                'nama' => $masyarakat->nama ?? '-',
                'nik' => $masyarakat->nik ?? '-',
                'total' => round($total, 4),
            ];
        }

        // Ranking dan status
        usort($hasil, fn($a, $b) => $b['total'] <=> $a['total']);

        foreach ($hasil as $i => &$data) {
            $data['ranking'] = $i + 1;
            $data['status'] = $i < 3 ? 'Layak' : 'Tidak Layak';
        }

        return view('penilaian.pdf', compact('hasil'));
    }

    // ✅ Cetak PDF detail dengan penjelasan perhitungan
    public function cetakPDFDetail()
    {
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all()->groupBy('masyarakat_id');

        $bobot = $kriterias->pluck('bobot', 'id');
        $tipe = $kriterias->pluck('tipe', 'id');

        $matrix = [];
        foreach ($penilaians as $masyarakat_id => $items) {
            foreach ($items as $p) {
                $matrix[$masyarakat_id][$p->kriteria_id] = $p->nilai;
            }
        }

        // Hitung nilai maksimum dan minimum dengan proteksi
        $nilaiMax = $nilaiMin = [];
        foreach ($kriterias as $k) {
            $nilaiKriteria = array_map(fn($m) => $m[$k->id] ?? null, $matrix);
            $nilaiKriteria = array_filter($nilaiKriteria, fn($v) => $v !== null);

            $nilaiMax[$k->id] = count($nilaiKriteria) > 0 ? max($nilaiKriteria) : 1;
            $nilaiMin[$k->id] = count($nilaiKriteria) > 0 ? min($nilaiKriteria) : 1;
        }

        // Hitung nilai total
        $hasil = [];
        foreach ($matrix as $masyarakatId => $nilaiKriteria) {
            $total = 0;
            foreach ($kriterias as $k) {
                $nilai = $nilaiKriteria[$k->id] ?? 0;

                if ($tipe[$k->id] === 'benefit') {
                    $normal = $nilai / max($nilaiMax[$k->id], 1);
                } else {
                    $normal = max($nilaiMin[$k->id], 1) / max($nilai, 1);
                }

                $total += $normal * $bobot[$k->id];
            }

            $masyarakat = Masyarakat::find($masyarakatId);

            $hasil[] = [
                'masyarakat_id' => $masyarakatId,
                'nama' => $masyarakat->nama ?? '-',
                'nik' => $masyarakat->nik ?? '-',
                'total' => round($total, 4),
            ];
        }

        // Ranking dan status
        usort($hasil, fn($a, $b) => $b['total'] <=> $a['total']);

        foreach ($hasil as $i => &$data) {
            $data['ranking'] = $i + 1;
            $data['status'] = $i < 3 ? 'Layak' : 'Tidak Layak';
        }

        return view('penilaian.pdf-detail', compact('hasil', 'kriterias'));
    }
}
