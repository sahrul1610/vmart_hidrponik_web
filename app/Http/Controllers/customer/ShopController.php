<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Produkgaleri;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index(){

        // $data=[
        //     "produk"
        // ];
        $produks = Produk::with('produkgaleri')->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.index', compact('produks','menu_categories', 'cart'));
        // return view('frontend.homepage');
    }
}
