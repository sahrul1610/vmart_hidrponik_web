<?php

namespace App\Http\Controllers\customer;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class LikeController extends Controller
{
    public function addToLike(Request $request)
    {
        $produk = Produk::find($request->id);
        if (!$produk) {
            abort(404);
        }

        $like = Session::get('like', []);

        if (isset($like[$produk->id])) {
            $like[$produk->id]['quantity']++;
        } else {
            $like[$produk->id] = [
                'id' => $produk->id,
                'name' => $produk->name,
                'price' => $produk->price,
                'gambar' => $produk->produkgaleri->url,
                'tersedia' => $produk->is_available,
                'quantity' => 1
            ];
        }

        Session::put('like', $like);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke favorit.');
    }

        public function index()
        {
            $like = Session::get('like', []);
            $cart = Session::get('cart', []);
            //dd($like);
            $menu_categories = Kategori::all();
            return view('frontend.like.like', compact('like', 'menu_categories', 'cart'));
        }
}
