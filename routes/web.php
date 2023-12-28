<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/kegiatan', function () {
    return view('activity');
})->name('kegiatan');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'Admin') {
        return view('dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
