<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Produkgaleri;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        // $data=[
        //     "produk"
        // ];
        $produks = Produk::with('produkgaleri')->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.homepage', compact('produks','menu_categories', 'cart'));
        // return view('frontend.homepage');
    }
}
