<?php

namespace App\Http\Controllers\customer;

use App\Models\Comment;
use App\Models\Stock;
use PDF;
use App\Http\Controllers\Controller;
use App\Http\Controllers\customer\RajaOngkirController;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Courier;



class OrderController extends RajaOngkirController
{

    public function Index()
    {
        $cart = Session::get('cart', []);
        ($cart);
        // $cities = [];
        try {
            $province = $this->getProvince();
        } catch (\Throwable $th) {
            return redirect('/cart')->with('gagal', 'Mohon periksa jaringan anda!');
        }

        $courier = Courier::all();

        //$city = $this->getCity();
        // dd($cities);
        return view('frontend.order.checkout', compact('cart', 'province', 'courier'));
    }

    public function payment()
    {
        $cart = Session::get('cart', []);
        ($cart);
        return view('frontend.order.payment');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'total_price' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'province_origin' => 'required',
            'city_origin' => 'required',
            'courier' => 'required',
        ]);
        //dd($request);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        $users_id = auth()->user()->id;

        $transaction = new Transaksi;
        $transaction->id = time();
        $transaction->users_id = $users_id;
        $transaction->address = $request->address;
        $transaction->total_price = $request->total_price;
        $transaction->shipping_price = (int) $request->shipping_cost;
        $transaction->status = 'pending';
        $transaction->payment = 'not paid';
        $transaction->created_at = now(); // mengisi field created_at dengan waktu sekarang
        $transaction->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
        $transaction->save();


        $transaction_id = $transaction->id;

        foreach ($cart as $item) {
            $transactionItem = new TransaksiItem;
            $transactionItem->users_id = $users_id;
            $transactionItem->products_id = $item['id'];
            $transactionItem->transactions_id = $transaction_id;
            $transactionItem->quantity = $item['quantity'];
            $transactionItem->save();

            $product = Produk::find($item['id']);
            // Mengecek apakah produk memiliki entri stok dalam tabel stok
            //$stock = Stock::where('product_id', $product->id)->first();
            $quantityToReduce = $item['quantity']; // Jumlah yang akan dikurangi dari stok

            // Mengambil stok terkait dengan produk
            $stocks = $product->stocks()->orderBy('created_at')->get();

            // Memeriksa stok yang tersedia dan mengurangi stok
            foreach ($stocks as $stock) {
                if ($stock->quantity >= $quantityToReduce) {
                    $stock->quantity -= $quantityToReduce;
                    $stock->save();
                    break; // Keluar dari perulangan setelah mengurangi stok yang cukup
                } else {
                    // Mengurangi stok yang tersedia dan mengupdate jumlah yang perlu dikurangi
                    $quantityToReduce -= $stock->quantity;
                    $stock->quantity = 0;
                    $stock->save();

                    if ($quantityToReduce > 0 && $stock === $stocks->last()) {
                        // Jika stok habis sebelum jumlah yang perlu dikurangi selesai dan ini adalah stok terakhir, tampilkan pesan stok habis menggunakan Swal.fire
                        return redirect()->back()->with('error', 'Maaf, stok habis.');
                    }
                }
            }

        }

        $users_id = session()->put("users_id", Auth::user()->id);
        $session = session()->put("transaksi_id", $transaction->id);

        // Set your Merchant Server Key

        //dd($snapToken);
        Session::forget('cart');

        //return view('frontend.order.checkout', compact('cart'),['snap_token'=>$snapToken]);
        //return redirect()->to(\Midtrans\Snap::createTransactionUrl($snapToken))->with('success', 'Transaksi berhasil.');
        // return redirect()->route('shop')->with('success', 'Transaksi berhasil.');
        return redirect("/checkout/" . $transaction->id)->with($session, $users_id);
    }
    // public function checkout1(Request $request)
    // {
    //     $request->validate([
    //         'address' => 'required',
    //         'total_price' => 'required|numeric',
    //         'shipping_cost' => 'required|numeric',
    //         'province_origin' => 'required',
    //         'city_origin' => 'required',
    //         'courier' => 'required',
    //     ]);
    //     //dd($request);

    //     $cart = Session::get('cart', []);

    //     if (empty($cart)) {
    //         return redirect()->back()->with('error', 'Keranjang belanja kosong.');
    //     }

    //     $users_id = auth()->user()->id;

    //     $transaction = new Transaksi;
    //     $transaction->id = time();
    //     $transaction->users_id = $users_id;
    //     $transaction->address = $request->address;
    //     $transaction->total_price = $request->total_price;
    //     $transaction->shipping_price = (int) $request->shipping_cost;
    //     $transaction->status = 'pending';
    //     $transaction->payment = 'not paid';
    //     $transaction->created_at = now(); // mengisi field created_at dengan waktu sekarang
    //     $transaction->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
    //     $transaction->save();


    //     $transaction_id = $transaction->id;

    //     foreach ($cart as $item) {
    //         $transactionItem = new TransaksiItem;
    //         $transactionItem->users_id = $users_id;
    //         $transactionItem->products_id = $item['id'];
    //         $transactionItem->transactions_id = $transaction_id;
    //         $transactionItem->quantity = $item['quantity'];
    //         $transactionItem->save();

    //         $product = Produk::find($item['id']);
    //         $stok_awal = $product->new_stock;
    //         $stok_baru = $stok_awal - $item['quantity'];
    //         $product->new_stock = $stok_baru;
    //         $product->save();
    //     }

    //     $users_id = session()->put("users_id", Auth::user()->id);
    //     $session = session()->put("transaksi_id", $transaction->id);

    //     // Set your Merchant Server Key

    //     //dd($snapToken);
    //     Session::forget('cart');

    //     //return view('frontend.order.checkout', compact('cart'),['snap_token'=>$snapToken]);
    //     //return redirect()->to(\Midtrans\Snap::createTransactionUrl($snapToken))->with('success', 'Transaksi berhasil.');
    //     // return redirect()->route('shop')->with('success', 'Transaksi berhasil.');
    //     return redirect("/checkout/" . $transaction->id)->with($session, $users_id);
    // }

    public function checkout_by_id($id)
    {
        $data["transaksi_id"] = session()->get("transaksi_id");
        $data["users_id"] = session()->get("users_id");

        $ambil_data = Transaksi::where("id", $data["transaksi_id"])->first();
        $ambil_user = User::where("id", $data["users_id"])->first();

        // Pengecekan apakah order_id sudah digunakan
        if ($ambil_data->status == 'paid') {
            return redirect('/')->with('error', 'Order ID sudah digunakan!');
        }

        \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $data["transaksi_id"],
                //'order_id' => 'ORDER-' . time(),
                'gross_amount' => $ambil_data["total_price"] + $ambil_data["shipping_price"],
            ),
            'customer_details' => array(
                'first_name' => $ambil_user->name,
                'email' => $ambil_user->email,
                // 'phone' => auth()->user()->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);


        return view("frontend.order.payment", ['snap_token' => $snapToken, 'transaction' => $ambil_data]);
    }

    public function post_checkout(Request $request)
    {
        try {
            $json = json_decode($request->payment);

            $signature_hashed = hash("sha512", $json->order_id . $json->status_code . $json->gross_amount . env("MIDTRANS_SERVER_KEY"));
            // die();
            $order = Transaksi::where("id", $json->order_id)->first();

            $order->update(["status" => 'paid', 'payment' => $json->transaction_status]);

            if ($json->transaction_status == 'settlement') {
                return redirect('/invoice/' . $order->id);
            } else {
                return redirect('/home');
            }
            // Rumus : Order - ID , Status Code, Gross Amount, ServerKey
            // echo $request->payment;
            //return redirect('/invoice/' . $order->id);
        } catch (\Exception $e) {
            // Jika terjadi error, maka tampilkan pesan error dan redirect ke halaman sebelumnya
            //return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            return redirect('/home')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function invoice($id)
    {
        $decryptedId = $id;
        $transaction = Transaksi::find($decryptedId);
        return view('frontend.order.invoice', compact('transaction'));
        // $transaction = Transaksi::find($id);
        // return view('frontend.order.invoice', compact('transaction'));
    }

    public function exportInvoice($id)
    {
        $transaction = Transaksi::findOrFail($id);
        $pdf = PDF::loadView('frontend.order.invoice_pdf', compact('transaction'));
        return $pdf->stream('invoice.pdf');
    }

    public function showMyOrders()
    {
        $users_id = auth()->user()->id;
        // $transactions = Transaksi::with('transactionItems.product')
        //     ->where('users_id', $users_id)
        //     ->where('status', '!=', 'paid')
        //     ->get();
        $transactions = Transaksi::with('transactionItems.product')
            ->where('users_id', $users_id)
            ->where('status', '!=', 'paid')
            ->orderByRaw("FIELD(status, 'Dikemas', 'Dikirim', 'Selesai')")
            ->get();



        return view('frontend.order.myorders', compact('transactions'));
    }

    public function markOrderAsCompleted($transactionId)
    {
        $transaction = Transaksi::find($transactionId);

        if (!$transaction) {
            // Handle error: Transaksi tidak ditemukan
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Ubah status transaksi menjadi "selesai"
        $transaction->status = 'Selesai';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaksi berhasil ditandai sebagai selesai.');
    }

    public function submitComment(Request $request, $transactionId)
    {
        $transaction = Transaksi::findOrFail($transactionId);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $transaction->comments()->save($comment);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }
}
