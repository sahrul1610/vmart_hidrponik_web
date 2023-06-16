<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Stock;
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
        //$produks = Produk::with('produkgaleri')->where('new_stock', '>', 0)->get();
        $produks = Produk::with('produkgaleri')->whereHas('stocks', function ($query) {
            $query->where('quantity', '>', 0);
        })->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.index', compact('produks','menu_categories', 'cart'));
        // return view('frontend.homepage');
    }

    public function detail($id){
        $produks = Produk::with('produkgaleri')->find($id);
        //$produk = Produk::with('produkgaleri')->where('new_stock', '>', 0)->get();
        $produk = Produk::with('produkgaleri')->whereHas('stocks', function ($query) {
            $query->where('quantity', '>', 0);
        })->get();
        $produks->totalStock = Stock::where('product_id', $produks->id)->sum('quantity');
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.shop_detail', compact('produks','menu_categories', 'cart', 'produk'));
        //return view('frontend.shop.shop_detail');
    }

    public function search(Request $request){
        // untuk mencari keyword nama produk
        $keyword = $request->input('keyword');
        //$produks = Produk::with('produkgaleri')->where('name', 'like', "%$keyword%")->get();
        $produks = Produk::with('produkgaleri')
                ->where('name', 'like', "%$keyword%")
                ->whereHas('stocks', function ($query) {
                    $query->where('quantity', '>', 0);
                })
                ->get();
        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.shop.index', compact('produks','menu_categories', 'cart'));
        }
}
