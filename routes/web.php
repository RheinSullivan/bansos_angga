<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\MasyarakatDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Welcome  
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Login/logout
Auth::routes(['register' => false]);

// Redirect setelah login berdasarkan role
Route::get('/home', function(){
    return view('home');
})->middleware('auth');

// Route untuk Admin
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard/admin', [App\Http\Controllers\DashboardController::class, 'admin'])->name('dashboard.admin');
    // CRUD Akun (User)
    Route::prefix('admin/akun')->name('akun.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // CRUD Masyarakat
    Route::prefix('admin/masyarakat')->name('masyarakat.')->group(function () {
        Route::get('/', [MasyarakatController::class, 'index'])->name('index');
        Route::get('/create', [MasyarakatController::class, 'create'])->name('create');
        Route::post('/', [MasyarakatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MasyarakatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MasyarakatController::class, 'update'])->name('update');
        Route::delete('/{id}', [MasyarakatController::class, 'destroy'])->name('destroy');
    });

    // CRUD Kriteria
    Route::prefix('admin/kriteria')->name('kriteria.')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('index');
        Route::get('/create', [KriteriaController::class, 'create'])->name('create');
        Route::post('/', [KriteriaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KriteriaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KriteriaController::class, 'update'])->name('update');
        Route::delete('/{id}', [KriteriaController::class, 'destroy'])->name('destroy');
    });

    // CRUD Subkriteria
    Route::prefix('admin/subkriteria')->name('subkriteria.')->group(function () {
        Route::get('/', [SubkriteriaController::class, 'index'])->name('index');
        Route::get('/create', [SubkriteriaController::class, 'create'])->name('create');
        Route::post('/', [SubkriteriaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SubkriteriaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SubkriteriaController::class, 'update'])->name('update');
        Route::delete('/{id}', [SubkriteriaController::class, 'destroy'])->name('destroy');
    });

    // CRUD Penilaian
    Route::prefix('admin/penilaian')->name('penilaian.')->middleware('admin')->group(function () {
        Route::get('/', [PenilaianController::class, 'index'])->name('index');
        Route::post('/', [PenilaianController::class, 'store'])->name('store');
        Route::get('/hasil', [PenilaianController::class, 'hasil'])->name('hasil');
        Route::get('/cetak-pdf', [PenilaianController::class, 'cetakPDF'])->name('cetak-pdf');
        Route::get('/cetak-pdf-detail', [PenilaianController::class, 'cetakPDFDetail'])->name('cetak-pdf-detail');
    });

});

// Route untuk masyarakat
Route::middleware(['auth'])->group(function () {
    Route::prefix('masyarakat')->name('masyarakat.')->middleware('masyarakat')->group(function () {
        Route::get('/dashboard', [MasyarakatDashboardController::class, 'index'])->name('dashboard');
        Route::get('/hasil', [MasyarakatDashboardController::class, 'hasil'])->name('hasil');
    });
});

// Route Hasil Penilaian
Route::middleware(['auth', 'masyarakat'])->group(function () {
    Route::get('/masyarakat/penilaian/hasil', [PenilaianController::class, 'hasil'])->name('penilaian.hasil.masyarakat');
});
