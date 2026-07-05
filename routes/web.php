<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/detail/1');

Route::get('/detail/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/lamar', [ApplicationController::class, 'store'])->name('applications.store');

Route::view('/lamaran-user', 'applications.placeholder')->name('applications.complete');
