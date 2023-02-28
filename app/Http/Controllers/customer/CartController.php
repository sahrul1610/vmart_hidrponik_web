<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
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

    public function checkoutIndex()
    {
        $cart = Session::get('cart', []);
        ($cart);
        return view('frontend.order.checkout', compact('cart'));
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


    // public function checkout(Request $request)
    // {

    //     $request->validate([
    //         'address' => 'required',
    //         'total_price' => 'required|numeric',
    //         'shipping' => 'required|numeric'
    //     ]);

    //     $cart = Session::get('cart', []);
    //     var_dump($cart); exit;
    //     if (empty($cart)) {
    //         return redirect()->back()->with('error', 'Keranjang belanja kosong.');
    //     }

    //     $user_id = auth()->user()->id;

    //     $transaction = auth()->user()->transactions()->create([
    //         'user_id' => $user_id,
    //         'address' => $request->address,
    //         'total_price' => $request->total_price,
    //         'shipping' => $request->shipping_price,
    //         'status' => 'pending',
    //         'payment' => 'not paid'
    //     ]);

    //     $transaction_id = $transaction->id;

    //     foreach ($cart as $item) {
    //         $transaction->transactionItems()->create([
    //             'transactions_id' => $transaction_id,
    //             'products_id' => $item['id'],
    //             'quantity' => $item['quantity']
    //         ]);
    //     }
    //     dd($transaction);
    //     Session::forget('cart');

    //     return redirect()->route('shop')->with('success', 'Transaksi berhasil.');
    // }

    public function checkout(Request $request)
    {

            $request->validate([
            'address' => 'required',
            'total_price' => 'required|numeric',
            'shipping_price' => 'required|numeric'
            ]);
            //dd($request);

            $cart = Session::get('cart', []);

            if (empty($cart)) {
                return redirect()->back()->with('error', 'Keranjang belanja kosong.');
            }

            $user_id = auth()->user()->id;

            $transaction = new Transaksi;
            $transaction->user_id = $user_id;
            $transaction->address = $request->address;
            $transaction->total_price = $request->total_price;
            $transaction->shipping_price = $request->shipping_price;
            $transaction->status = 'pending';
            $transaction->payment = 'not paid';
            $transaction->save();

            $transaction_id = $transaction->id;

            foreach ($cart as $item) {
                $transactionItem = new TransaksiItem;
                $transactionItem->user_id = $user_id;
                $transactionItem->products_id = $item['id'];
                $transactionItem->transactions_id = $transaction_id;
                $transactionItem->quantity = $item['quantity'];
                $transactionItem->save();
            }


            Session::forget('cart');

            return redirect()->route('shop')->with('success', 'Transaksi berhasil.');
    }

}
