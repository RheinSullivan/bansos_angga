<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung total masyarakat
        $jumlahMasyarakat = Masyarakat::count();

        // Kirim ke view
        return view('dashboard.admin', compact('jumlahMasyarakat'));
    }
}
