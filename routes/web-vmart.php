<?php
//admin
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\PostCategoriesController;
//customer
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\OrderController;
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::get('/transaksi/cetak-pdf', [TransaksiController::class, 'cetakPDF'])->name('transaksi.cetak-pdf');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');

    Route::get('/posts/kategori', [PostCategoriesController::class, 'index'])->name('posts.kategori');
    Route::get('/posts/edit/{id}', [PostCategoriesController::class, 'edit']);
    Route::post('/posts/kategori/insert', [PostCategoriesController::class, 'store']);
    Route::post('/posts/kategori/update', [PostCategoriesController::class, 'update']);
    Route::delete('/posts/kategori/hapus/{id}', [PostCategoriesController::class, 'hapus']);
});
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/', [HomeController::class, 'index'])->middleware('guest');
Route::get('/login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
// Route::get('/login/google', 'LoginController@redirectToGoogle');
// Route::get('/login/google/callback', 'LoginController@handleGoogleCallback');



Route::middleware(['user', 'auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/kategori/{id}', [HomeController::class, 'indexKategori'])->name('produk.by.category');

    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/produk/search', [ShopController::class, 'search'])->name('produk.search');
    Route::get('/shop/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');

    Route::get('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [OrderController::class, 'Index'])->name('cart.checkout');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    //Route::post('/mitrans-callback', [CartController::class, 'callback'])->name('callback');

    Route::get("/checkout/{id}", [OrderController::class, "checkout_by_id"]);
    Route::get('/payment', [CartController::class, 'payment'])->name('payment');
    Route::post('/checkout/{id}', [OrderController::class, 'post_checkout']);
    Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
    Route::get('/invoice/export/{id}', [OrderController ::class, 'exportInvoice'])->name('invoice.export');
    Route::get('/myorders', [CartController::class, 'showMyOrders'])->name('myorders');

    // Route::patch('/cart/update', 'CartController@update')->name('cart.update');
});

