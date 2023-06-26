<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Comment;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Box\Spout\Reader\ReaderFactory;
//use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;


class TransaksiController extends Controller
{
    // public function index(){
    //     $transactions = Transaksi::all();
    //     return view('admin.transaksi.transaksi', compact('transactions'));
    // }

    public function index()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $transactions = Transaksi::all()->map(function ($transaction) {
            // Mengubah format created_at menjadi nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->translatedFormat('l, j F Y');

            return $transaction;
        });

        return view('admin.transaksi.transaksi', compact('transactions'));
    }

    public function cetakPDF()
    {
        $transactions = Transaksi::where('status', 'paid')->get()->map(function ($transaction) {
            // Mengubah format created_at menjadi nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->translatedFormat('l, j F Y');

            return $transaction;
        });

        $pdf = PDF::loadView('admin.transaksi.cetak-pdf-paid', compact('transactions'));

        return $pdf->download('transaksi-paid.pdf');
    }

    public function updateStatus(Request $request)
    {
        $status = $request->input('status');
        $transactionId = $request->input('transactionId');

        $transaction = Transaksi::find($transactionId);
        if ($transaction) {
            $transaction->status = $status;
            $transaction->save();
            return response()->json(['message' => 'Status berhasil diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

    }


    public function viewDikemas()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $transactions = Transaksi::all()->map(function ($transaction) {
            // Mengubah format created_at menjadi nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->translatedFormat('l, j F Y');

            return $transaction;
        });

        return view('admin.transaksi.view-transaksi', compact('transactions'));
    }
    public function viewTransaksiSukses()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $transactions = Transaksi::all()->map(function ($transaction) {
            // Mengubah format created_at menjadi nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->translatedFormat('l, j F Y');

            return $transaction;
        })->sortByDesc('created_at_formatted');

        return view('admin.transaksi.view-transaksi-sukses', compact('transactions'));
    }

    public function inputDeliveryReceipt(Request $request)
    {
        $transactionId = $request->input('transactionId');
        $deliveryReceipt = $request->input('deliveryReceipt');

        // Simpan resi pengiriman dan ubah status transaksi
        $transaction = Transaksi::find($transactionId);
        if ($transaction) {
            $transaction->delivery_receipt = $deliveryReceipt;
            $transaction->status = 'Dikirim';
            $transaction->save();
            return response()->json(['message' => 'Resi pengiriman berhasil disimpan dan status transaksi diubah'], 200);
        } else {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
    }

    public function delete(Request $request)
    {
        $transactionId = $request->id;
        $transaction = Transaksi::find($transactionId);

        if (!$transaction) {
            return redirect()->route('transactions')->with('gagal', 'Transaction not found');
        }

        // Menghapus item transaksi terkait
        TransaksiItem::where('transactions_id', $transactionId)->delete();

        // Menghapus transaksi
        $transaction->delete();

        return redirect()->back()->with('sukses', 'Transaksi deleted successfully');
    }

    // public function showComments()
    // {
    //     return view('admin.layouts.template', compact('comments'));
    // }

}
