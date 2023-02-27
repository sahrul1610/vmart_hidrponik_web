<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $produk = Produk::find($request->id);
        if (!$produk) {
            abort(404);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$produk->id])) {
            $cart[$produk->id]['quantity']++;
        } else {
            $cart[$produk->id] = [
                'id' => $produk->id,
                'name' => $produk->name,
                'price' => $produk->price,
                'gambar' => $produk->produkgaleri->url,
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        //dd($cart);
        return view('frontend.cart.index', compact('cart'));
    }


    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');

            unset($cart[$request->id]);

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }
    
    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'total_price' => 'required|numeric',
            'shipping' => 'required|numeric'
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        $transaction = auth()->user()->transactions()->create([
            'address' => $request->address,
            'total_price' => $request->total_price,
            'shipping' => $request->shipping,
            'status' => 'pending',
            'payment' => 'not paid'
        ]);

        foreach ($cart as $item) {
            $transaction->transactionItems()->create([
                'produk_id' => $item['produk_id'],
                'quantity' => $item['quantity']
            ]);
        }

        Session::forget('cart');

        return redirect()->route('cart.index')->with('success', 'Transaksi berhasil.');
    }
}
