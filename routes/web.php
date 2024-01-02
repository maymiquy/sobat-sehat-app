<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\NewsController;

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

Route::get('/', [HomeController::class, 'indexNews'])->name('home');
Route::get('/kegiatan', [HomeController::class, 'indexEvent'])->name('kegiatan');
Route::post('/kegiatan', [HomeController::class, 'storeEvent'])->name('kegiatan.store');
Route::get('/search', [HomeController::class, 'searchEvent'])->name('kegiatan.search');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'Admin') {
        return view('dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
});


require __DIR__ . '/auth.php';
