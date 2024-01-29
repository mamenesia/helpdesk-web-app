<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\Users\TiketsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\DivisiController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/tiketsaya', [TiketsController::class, 'tiketsaya'])->name('user.tiketsaya');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'user-role:0'])->group(function () {

    Route::get('/ajukan/user', [TiketsController::class, 'create'])->name('user.ajukan');
    Route::post('/store/user', [TiketsController::class, 'store'])->name('user.store');
    Route::get('/tiket/user/{id}', [TiketsController::class, 'tampilkan'])->name('user.tampilkan');
    Route::post('/tiket/user/reply', [TiketsController::class, 'reply'])->name('user.reply');
    Route::post('/tiket/user/storeppkb', [TiketsController::class, 'storeppkb'])->name('user.storeppkb');
    Route::get('/submission/user', [TiketsController::class, 'createppkb'])->name('user.submission');
    Route::get('/daftar/submission', [TiketsController::class, 'daftarsubmission'])->name('user.daftarsubmission');
    Route::get('/submission/user/{id}', [TiketsController::class, 'tampilkansubmission'])->name('user.tampilkansubmission');
    Route::post('/submission/close/{id}', [TiketsController::class, 'selesai'])->name('submission.close');
    Route::put('/submission/status-update/{id}', [TiketsController::class, 'updatesubmission'])->name('submission.update');
});

Route::middleware(['auth', 'user-role:1'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
    Route::put('/tiket/{tiket}/update-prioritas', [TiketController::class, 'updatePrioritas'])->name('tiket.updatePrioritas');
    Route::get('/ajukan', [TiketController::class, 'create'])->name('tiket.ajukan');
    Route::post('/store', [TiketController::class, 'store'])->name('tiket.store');
    Route::get('/daftar', [TiketController::class, 'index'])->name('tiket.daftar');
    Route::post('/tiket/close/{id}', [TiketController::class, 'close'])->name('tiket.close');
    Route::get('/tiket/{tiket}', [TiketController::class, 'show'])->name('tiket.show');
    Route::post('/tiket/reply', [TiketController::class, 'reply'])->name('tiket.reply');

});

Route::resource('tiket', TiketController::class);


