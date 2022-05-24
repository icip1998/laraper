<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KembaliController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

// Route::resource('/', HomeController::class);
Route::get('/', [LoginController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::resource('/users', UsersController::class)->except('show');

Route::resource('/buku', BukuController::class);

Route::resource('/kategori', KategoriController::class)->except('show');

Route::resource('/penerbit', PenerbitController::class)->except('show');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/pinjam', PinjamController::class);
Route::resource('/kembali', KembaliController::class);

Route::get('forget-password', [ForgotPasswordController::class, 'index']);
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail']);

Route::get('reset-password/{token}', [ResetPasswordController::class, 'index']);
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword']);