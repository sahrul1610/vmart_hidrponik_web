<?php
//admin
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\KategoriProdukController;
//customer
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\CartController;
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
Route::middleware(['admin','auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('/produk/add', [ProdukController::class, 'add']);
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::post('/produk/insert', [ProdukController::class, 'insert']);
    Route::post('/produk/update', [ProdukController::class, 'update']);
    Route::delete('/produk/hapus/{id}', [ProdukController::class, 'hapus']);


    Route::get('/kategori', [KategoriProdukController::class, 'index'])->name('kategori')->middleware('auth');
    Route::get('/kategori/edit/{id}', [KategoriProdukController::class, 'edit']);
    Route::post('/kategori/insert', [KategoriProdukController::class, 'insert']);
    Route::post('/kategori/update', [KategoriProdukController::class, 'update']);
    Route::delete('/kategori/hapus/{id}', [KategoriProdukController::class, 'hapus']);
});
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
// Route::get('/login/google', 'LoginController@redirectToGoogle');
// Route::get('/login/google/callback', 'LoginController@handleGoogleCallback');


Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
Route::middleware(['user', 'auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkoutIndex'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');


    // Route::patch('/cart/update', 'CartController@update')->name('cart.update');
});

