<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\Users\TiketsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
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
Route::post('/tiket/reply', [TiketController::class, 'reply'])->name('tiket.reply');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'user-role:0'])->group(function () {
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');
    Route::get('/tiketsaya', [TiketsController::class, 'tiketsaya'])->name('user.tiketsaya');
    Route::get('/ajukan/user', [TiketsController::class, 'create'])->name('user.ajukan');
    Route::post('/store/user', [TiketsController::class, 'store'])->name('user.store');
    Route::get('/tiket/user/{tiket}', [TiketsController::class, 'show'])->name('user.show');
});

Route::middleware(['auth', 'user-role:1'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('home.admin');

    Route::get('/ajukan', [TiketController::class, 'create'])->name('tiket.ajukan');
    Route::post('/store', [TiketController::class, 'store'])->name('tiket.store');
    Route::get('/daftar', [TiketController::class, 'index'])->name('tiket.daftar');
    Route::post('/tiket/close/{id}', [TiketController::class, 'close'])->name('tiket.close');
    Route::get('/tiket/{tiket}', [TiketController::class, 'show'])->name('tiket.show');
});

Route::resource('tiket', TiketController::class);



Route::get('/user', function () {
    return view('user');
});

Route::get('/divisi', function () {
    return view('divisi');
});

