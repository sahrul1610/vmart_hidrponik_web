<?php

namespace App\Http\Controllers\customer;
use PDF;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class OrderController extends Controller
{

    public function Index()
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

        $users_id = auth()->user()->id;

        $transaction = new Transaksi;
        $transaction->users_id = $users_id;
        $transaction->address = $request->address;
        $transaction->total_price = $request->total_price;
        $transaction->shipping_price = $request->shipping_price;
        $transaction->status = 'pending';
        $transaction->payment = 'not paid';
        $transaction->save();


        $transaction_id = $transaction->id;

        foreach ($cart as $item) {
            $transactionItem = new TransaksiItem;
            $transactionItem->users_id = $users_id;
            $transactionItem->products_id = $item['id'];
            $transactionItem->transactions_id = $transaction_id;
            $transactionItem->quantity = $item['quantity'];
            $transactionItem->save();
        }

        $users_id = session()->put("users_id", Auth::user()->id);
        $session = session()->put("transaksi_id", $transaction->id);

        // Set your Merchant Server Key

        //dd($snapToken);
        Session::forget('cart');

        //return view('frontend.order.checkout', compact('cart'),['snap_token'=>$snapToken]);
        //return redirect()->to(\Midtrans\Snap::createTransactionUrl($snapToken))->with('success', 'Transaksi berhasil.');
        // return redirect()->route('shop')->with('success', 'Transaksi berhasil.');
        return redirect("/checkout/". $transaction->id)->with($session, $users_id);
    }

    public function checkout_by_id($id)
    {
        $data["transaksi_id"] = session()->get("transaksi_id");
        $data["users_id"] = session()->get("users_id");

        $ambil_data = Transaksi::where("id", $data["transaksi_id"])->first();
        $ambil_user = User::where("id", $data["users_id"])->first();

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
                'gross_amount' => $ambil_data["total_price"]+$ambil_data["shipping_price"],
            ),
            'customer_details' => array(
                'first_name' => $ambil_user->name,
                'email' => $ambil_user->email,
                // 'phone' => auth()->user()->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view("frontend.order.payment", ['snap_token'=>$snapToken, 'transaction' => $ambil_data]);
    }

    public function post_checkout(Request $request)
    {   try {
        $json = json_decode($request->payment);

        $signature_hashed = hash("sha512", $json->order_id . $json->status_code . $json->gross_amount . env("MIDTRANS_SERVER_KEY"));
        // die();
        $order = Transaksi::where("id", $json->order_id)->first();

        $order->update(["status" => 'paid', 'payment' => $json->transaction_status]);
        // Rumus : Order - ID , Status Code, Gross Amount, ServerKey
        // echo $request->payment;
        //return redirect('/invoice/' . $order->id);
        return redirect('/invoice/' . encrypt($order->id));
        } catch (\Exception $e) {
            // Jika terjadi error, maka tampilkan pesan error dan redirect ke halaman sebelumnya
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function invoice($id){
        $decryptedId = decrypt($id);
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
}
