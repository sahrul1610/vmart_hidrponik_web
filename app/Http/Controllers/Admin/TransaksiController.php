<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
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
        $transactions = Transaksi::all()->map(function($transaction) {
            // Mengubah format created_at menjadi nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->translatedFormat('l, j F Y');

            return $transaction;
        });

        return view('admin.transaksi.transaksi', compact('transactions'));
    }

    public function cetakPDF()
    {
        $transactions = Transaksi::where('status', 'paid')->get()->map(function($transaction) {
            // Mengubah format created_at menjadi nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->translatedFormat('l, j F Y');

            return $transaction;
        });

        $pdf = PDF::loadView('admin.transaksi.cetak-pdf-paid', compact('transactions'));

        return $pdf->download('transaksi-paid.pdf');
    }

    // public function export()
    // {
    //     return Excel::download(new TransactionsExport, 'transaksi.xlsx');
    // }


}
