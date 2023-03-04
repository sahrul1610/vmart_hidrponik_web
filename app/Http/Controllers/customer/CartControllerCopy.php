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

    public function payment()
    {
        $cart = Session::get('cart', []);
        ($cart);
        return view('frontend.order.payment');
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

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction_id,
                'gross_amount' => $request->total_price,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                // 'phone' => auth()->user()->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        //dd($snapToken);
        Session::forget('cart');

        //return view('frontend.order.checkout', compact('cart'),['snap_token'=>$snapToken]);
        //return redirect()->to(\Midtrans\Snap::createTransactionUrl($snapToken))->with('success', 'Transaksi berhasil.');
        // return redirect()->route('shop')->with('success', 'Transaksi berhasil.');
        return view("frontend.order.payment", ['snap_token'=>$snapToken, 'transaction' => $transaction]);
    }

    // public function callback(Request $request){
    //     $serverKey = env("MIDTRANS_SERVER_KEY");
    //     $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    //     if($hashed == $request->signature_key);
    // }

    public function callback(Request $request){
        $serverKey = env("MIDTRANS_SERVER_KEY");
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $transaksi = Transaksi::find($request->id);
                $transaksi->update(['status' => 'Paid']);
            }
        }
    }
    public function invoice($id){
        $order = Order::find($id);
        return view('invoice', compact('order'));
    }

}
