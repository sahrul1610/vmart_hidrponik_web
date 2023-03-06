<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(){
        $transactions = Transaksi::all();
        return view('admin.transaksi.transaksi', compact('transactions'));
    }
}
