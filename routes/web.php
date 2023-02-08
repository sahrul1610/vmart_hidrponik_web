<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriProdukController;
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

// Route::get('/', function () {
//     return view('admin.layouts.template');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('auth');
Route::get('/produk/add', [ProdukController::class, 'add'])->middleware('auth');
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->middleware('auth');
Route::post('/produk/insert', [ProdukController::class, 'insert']);
Route::post('/produk/update', [ProdukController::class, 'update']);

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/login/google', [LoginController::class, 'redirectToProvider']);
Route::get('/login/google/callback', [LoginController::class, 'handleProvideCallback']);
//Route::get('/login/google', 'LoginController@redirectToGoogle');
//Route::get('/login/google/callback', 'LoginController@handleGoogleCallback');

Route::get('/kategori', [KategoriProdukController::class, 'index'])->name('kategori')->middleware('auth');
Route::get('/kategori/edit/{id}', [KategoriProdukController::class, 'edit']);
Route::post('/kategori/insert', [KategoriProdukController::class, 'insert']);
Route::post('/kategori/update', [KategoriProdukController::class, 'update']);
Route::delete('/kategori/hapus/{id}', [KategoriProdukController::class, 'hapus']);

Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');

