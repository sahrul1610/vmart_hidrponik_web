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
        //$produks = Produk::with('produkgaleri')->get();
        //$produks = Produk::with('produkgaleri')->where('new_stock', '>', 0)->get();
        $produks = Produk::with('produkgaleri')->whereHas('stocks', function ($query) {
            $query->where('quantity', '>', 0);
        })->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        $like = Session::get('like', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.homepage', compact('produks','menu_categories', 'cart', 'like'));
        // return view('frontend.homepage');
    }

    public function indexKategori($id = null){

        $menu_categories = Kategori::all();

        $produks = Produk::query();

        if(!is_null($id)){
            $produks->where('categories_id', $id);
        }

        //$produks = $produks->with('produkgaleri')->get();
        //$produks = Produk::with('produkgaleri')->where('new_stock', '>', 0)->get();
        $produks = Produk::with('produkgaleri')->whereHas('stocks', function ($query) {
            $query->where('quantity', '>', 0);
        })->get();

        $cart = Session::get('cart', []);

        return view('frontend.shop.index', compact('produks','menu_categories', 'cart'));
    }
}
