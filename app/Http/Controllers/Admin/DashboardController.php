<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // public function index(){

    //     $data=[
    //         "jumlah_produk" => Produk::count(),
    //         "transaksi" => Transaksi::count(),
    //         "user" => User::where('roles', 'USER')->count(),
    //     ];
    //     return view('admin.dashboard.dashboard', $data);
    // }

    // public function index()
    // {
    //     $data = [
    //         "jumlah_produk" => Produk::count(),
    //         "transaksi" => Transaksi::count(),
    //         "user" => User::where('roles', 'USER')->count(),
    //     ];

    //     // Mengambil data transaksi perbulan dari database
    //     $transaksi = Transaksi::selectRaw('SUM(total_price) as total, MONTH(created_at) as bulan')
    //                 ->groupBy('bulan')
    //                 ->get();

    //     // Menginisialisasi array data transaksi dan bulan
    //     $dataTransaksi = [];
    //     $dataBulan = [];

    //     // Mengisi array data transaksi dan bulan dengan data dari database
    //     foreach ($transaksi as $item) {
    //         array_push($dataTransaksi, $item->total);
    //         array_push($dataBulan, Carbon::createFromDate(null, $item->bulan, null)->format('F'));
    //     }

    //     // Mengirimkan data transaksi dan bulan ke view
    //     $chartTransaksi = view('admin.dashboard.chart-transaksi', compact('dataTransaksi', 'dataBulan'))->render();

    //     return view('admin.dashboard.dashboard', $data, compact('chartTransaksi'));
    // }

    public function index()
    {
        $jumlah_produk = Produk::count();
        $jumlah_transaksi = Transaksi::count();
        $jumlah_user = User::where('roles', 'USER')->count();

        // Mengambil data transaksi perbulan dari database
        $transaksi = Transaksi::selectRaw('SUM(total_price) as total, MONTH(created_at) as bulan')
                        ->groupBy('bulan')
                        ->get();

        // Menginisialisasi array data transaksi dan bulan
        $dataTransaksi = [];
        $dataBulan = [];

        // Mengisi array data transaksi dan bulan dengan data dari database
        foreach ($transaksi as $item) {
            array_push($dataTransaksi, $item->total);
            array_push($dataBulan, Carbon::createFromDate(null, $item->bulan, null)->format('F'));
        }

        // Mengirimkan data ke view
        return view('admin.dashboard.dashboard', [
            'jumlah_produk' => $jumlah_produk,
            'transaksi' => $jumlah_transaksi,
            'user' => $jumlah_user,
            'dataTransaksi' => $dataTransaksi,
            'dataBulan' => $dataBulan
        ]);
    }
}
