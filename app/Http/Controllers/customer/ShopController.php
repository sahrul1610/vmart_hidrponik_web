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
        //$produks = Produk::with('produkgaleri')->get();
        $produks = Produk::with('produkgaleri')->where('new_stock', '>', 0)->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.index', compact('produks','menu_categories', 'cart'));
        // return view('frontend.homepage');
    }

    public function detail($id){
        $produks = Produk::with('produkgaleri')->find($id);
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.shop_detail', compact('produks','menu_categories', 'cart'));
        //return view('frontend.shop.shop_detail');
    }

    public function search(Request $request){
        // untuk mencari keyword nama produk
        $keyword = $request->input('keyword');
        //$produks = Produk::with('produkgaleri')->where('name', 'like', "%$keyword%")->get();
        $produks = Produk::with('produkgaleri')
                ->where('name', 'like', "%$keyword%")
                ->where('new_stock', '>', 0)
                ->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.index', compact('produks','menu_categories', 'cart'));
        }
}
