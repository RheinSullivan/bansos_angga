<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    // Menentukan kolom yang digunakan untuk login
    public function username()
    {
        return 'username';
    }

    // Redirect berdasarkan role setelah login berhasil
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('/dashboard/admin');
        } elseif ($user->role === 'masyarakat') {
            return redirect('/masyarakat/dashboard');
        }

        return redirect('/'); // fallback jika role tidak terdefinisi
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
