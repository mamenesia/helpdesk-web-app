<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'user-role:0'])->group(function () {
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');
});

Route::middleware(['auth', 'user-role:1'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('home.admin');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/ajukan', [TiketController::class, 'create'])->name('tiket.ajukan');
    Route::post('/store', [TiketController::class, 'store'])->name('tiket.store');
    Route::get('/daftar', [TiketController::class, 'index'])->name('tiket.daftar');
    Route::post('/tiket/reply', [TiketController::class, 'reply'])->name('tiket.reply');
    Route::post('/tiket/close/{id}', [TiketController::class, 'close'])->name('tiket.close');
    Route::get('/tiket/{id}', [TiketController::class, 'show'])->name('tiket.show');
});

Route::resource('tiket', TiketController::class);



Route::get('/user', function () {
    return view('user');
});

Route::get('/divisi', function () {
    return view('divisi');
});

