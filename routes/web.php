<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminLamaranController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LokerinajaController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\UserController;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $welcomeJobs = Lowongan::latest()->limit(8)->get();
    $featuredWelcomeJob = $welcomeJobs->first() ?? Lowongan::latest()->first();
    $activeLowonganCount = Lowongan::count();

    return view('welcome', compact('welcomeJobs', 'featuredWelcomeJob', 'activeLowonganCount'));
})->name('welcome');

Route::get('/detail/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/lamar', [ApplicationController::class, 'store'])->name('applications.store');

Route::view('/lamaran-user', 'applications.placeholder')->name('applications.complete');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'prosesLogin']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'prosesRegister']);

Route::get('/lokerinaja', [LokerinajaController::class, 'index'])->name('home');
Route::post('/apply', [LokerinajaController::class, 'apply'])->name('apply');

Route::get('/daftar-lowongan', function () {
    $query = Lowongan::query();

    if (request()->filled('search')) {
        $query->where('posisi', 'like', '%' . request('search') . '%');
    }

    if (request()->filled('kategori')) {
        $query->where('kategori', request('kategori'));
    }

    if (request()->filled('lokasi')) {
        $query->where('lokasi', request('lokasi'));
    }

    $lowongan = $query->latest()->paginate(6)->withQueryString();
    $kategoris = Lowongan::distinct()->orderBy('kategori')->pluck('kategori');
    $lokasis = Lowongan::distinct()->orderBy('lokasi')->pluck('lokasi');

    return view('lokerinaja.daftar', compact('lowongan', 'kategoris', 'lokasis'));
})->name('daftar.lowongan');

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/{lowongan}/detail', [JobController::class, 'showLowongan'])->name('lowongan.detail');
Route::get('/lowongan-tersimpan', [SavedJobController::class, 'index'])->name('saved-jobs.index');
Route::post('/lowongan-tersimpan/toggle', [SavedJobController::class, 'toggle'])->name('saved-jobs.toggle');

Route::get('/lamaran', [LamaranController::class, 'index'])->name('lamaran.index');
Route::post('/lamaran', [LamaranController::class, 'store'])->name('lamaran.store');
Route::get('/status-lamaran', [LamaranController::class, 'status'])->name('lamaran.status');
Route::post('/status-lamaran/{lamaran}/hadir', [LamaranController::class, 'confirmInterview'])->name('lamaran.interview.confirm');
Route::post('/status-lamaran/{lamaran}/reschedule', [LamaranController::class, 'requestReschedule'])->name('lamaran.interview.reschedule');

Route::get('/admin/lamaran', [AdminLamaranController::class, 'index'])->name('admin.lamaran.index');
Route::post('/admin/lamaran/{lamaran}/status', [AdminLamaranController::class, 'updateStatus'])->name('admin.lamaran.status');
Route::post('/admin/lamaran/{lamaran}/reschedule', [AdminLamaranController::class, 'updateReschedule'])->name('admin.lamaran.reschedule');
