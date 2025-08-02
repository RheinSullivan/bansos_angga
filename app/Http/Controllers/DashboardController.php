<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Penilaian;

class DashboardController extends Controller
{
    public function admin()
    {
        $jumlahMasyarakat = Masyarakat::count();
        $jumlahKriteria = Kriteria::count();
        $jumlahSubkriteria = Subkriteria::count();
        $jumlahPenilaian = Penilaian::count();

        return view('dashboard.admin', compact(
            'jumlahMasyarakat',
            'jumlahKriteria', 
            'jumlahSubkriteria',
            'jumlahPenilaian'
        ));
    }
}
