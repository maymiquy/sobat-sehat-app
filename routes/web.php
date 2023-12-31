<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

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
Route::post('/kegiatan/peserta', [HomeController::class, 'storeMember'])->name('peserta.store');
Route::get('/search', [HomeController::class, 'searchEvent'])->name('kegiatan.search');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'Admin') {
        return view('dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('can:Admin')->group(function () {
        Route::resource('events', EventController::class);
        Route::resource('members', MemberController::class);
        Route::resource('news', NewsController::class);
    });
});


require __DIR__ . '/auth.php';
