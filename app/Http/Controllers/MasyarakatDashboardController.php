<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;

class MasyarakatDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data masyarakat berdasarkan user yang login
        $masyarakat = Masyarakat::where('nik', $user->username)->first();
        
        if (!$masyarakat) {
            return redirect()->route('login')->with('error', 'Data masyarakat tidak ditemukan!');
        }

        // Ambil hasil perhitungan untuk masyarakat ini
        $hasilPerhitungan = $this->hitungSAWForMasyarakat($masyarakat);

        return view('dashboard.masyarakat', compact('masyarakat', 'hasilPerhitungan'));
    }

    public function hasil()
    {
        $user = Auth::user();
        $masyarakat = Masyarakat::where('nik', $user->username)->first();
        
        if (!$masyarakat) {
            return redirect()->route('login')->with('error', 'Data masyarakat tidak ditemukan!');
        }

        $hasil = $this->hitungSAWForMasyarakat($masyarakat);
        $kriterias = Kriteria::all();

        return view('masyarakat.hasil', compact('hasil', 'kriterias', 'masyarakat'));
    }

    private function hitungSAWForMasyarakat($masyarakat)
    {
        $kriterias = Kriteria::all();
        $total_bobot = $kriterias->sum('bobot');

        // Data kriteria untuk masyarakat ini
        $dataKriteria = [
            'pendapatan' => $masyarakat->penghasilan,
            'tanggungan' => $masyarakat->jumlah_tanggungan,
            'rumah' => $this->getKondisiRumahScore($masyarakat->kondisi_rumah),
            'pekerjaan' => $this->getPekerjaanScore($masyarakat->status_pekerjaan),
            'pendidikan' => $this->getPendidikanScore($masyarakat->pendidikan),
            'kesehatan' => $masyarakat->akses_kesehatan ? 1 : 0,
            'usia' => $masyarakat->usia
        ];

        $nilai_akhir = 0;
        foreach ($kriterias as $index => $kriteria) {
            $nilai = $dataKriteria[$this->getKriteriaKey($index)] ?? 0;
            
            // Normalisasi berdasarkan tipe kriteria
            $semua_nilai = $this->getSemuaNilaiKriteria($index);
            if ($kriteria->tipe == 'benefit') {
                $max = $semua_nilai->max() ?: 1;
                $normal = $nilai / $max;
            } else {
                $min = $semua_nilai->min() ?: 1;
                $normal = $min / $nilai;
            }

            $bobot_ternormalisasi = $kriteria->bobot / $total_bobot;
            $nilai_akhir += $normal * $bobot_ternormalisasi;
        }

        return [
            'nama' => $masyarakat->nama,
            'nik' => $masyarakat->nik,
            'total' => number_format($nilai_akhir, 4),
            'status' => $this->getStatus($nilai_akhir),
            'ranking' => $this->getRanking($masyarakat, $nilai_akhir)
        ];
    }

    private function getKriteriaKey($index)
    {
        $keys = ['pendapatan', 'tanggungan', 'rumah', 'pekerjaan', 'pendidikan', 'kesehatan', 'usia'];
        return $keys[$index] ?? 'pendapatan';
    }

    private function getKondisiRumahScore($kondisi)
    {
        $scores = [
            'Sangat Layak' => 5,
            'Layak' => 4,
            'Cukup Layak' => 3,
            'Kurang Layak' => 2,
            'Tidak Layak' => 1
        ];
        return $scores[$kondisi] ?? 3;
    }

    private function getPekerjaanScore($pekerjaan)
    {
        $scores = [
            'Tetap' => 5,
            'Kontrak' => 4,
            'Honorer' => 3,
            'Wirausaha' => 4,
            'Tidak Bekerja' => 1
        ];
        return $scores[$pekerjaan] ?? 3;
    }

    private function getPendidikanScore($pendidikan)
    {
        $scores = [
            'S3' => 5,
            'S2' => 4,
            'S1' => 3,
            'D3' => 3,
            'SMA' => 2,
            'SMP' => 1,
            'SD' => 1
        ];
        return $scores[$pendidikan] ?? 2;
    }

    private function getSemuaNilaiKriteria($index)
    {
        $masyarakat = Masyarakat::all();
        $values = collect();

        foreach ($masyarakat as $m) {
            $dataKriteria = [
                'pendapatan' => $m->penghasilan,
                'tanggungan' => $m->jumlah_tanggungan,
                'rumah' => $this->getKondisiRumahScore($m->kondisi_rumah),
                'pekerjaan' => $this->getPekerjaanScore($m->status_pekerjaan),
                'pendidikan' => $this->getPendidikanScore($m->pendidikan),
                'kesehatan' => $m->akses_kesehatan ? 1 : 0,
                'usia' => $m->usia
            ];

            $key = $this->getKriteriaKey($index);
            $values->push($dataKriteria[$key] ?? 0);
        }

        return $values;
    }

    private function getStatus($nilai)
    {
        // Ambil 3 peringkat teratas sebagai layak
        $semuaMasyarakat = Masyarakat::all();
        $nilaiSemua = collect();

        foreach ($semuaMasyarakat as $m) {
            $nilaiM = $this->hitungSAWForMasyarakat($m);
            $nilaiSemua->push($nilaiM['total']);
        }

        $nilaiSemua = $nilaiSemua->sort()->reverse();
        $peringkat3 = $nilaiSemua->take(3)->last();

        return $nilai >= $peringkat3 ? 'Layak' : 'Tidak Layak';
    }

    private function getRanking($masyarakat, $nilai)
    {
        $semuaMasyarakat = Masyarakat::all();
        $rankings = collect();

        foreach ($semuaMasyarakat as $m) {
            $nilaiM = $this->hitungSAWForMasyarakat($m);
            $rankings->push([
                'nama' => $m->nama,
                'nilai' => $nilaiM['total']
            ]);
        }

        $rankings = $rankings->sortByDesc('nilai')->values();
        
        foreach ($rankings as $index => $ranking) {
            if ($ranking['nama'] === $masyarakat->nama) {
                return $index + 1;
            }
        }

        return 0;
    }
} 