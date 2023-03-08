<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){

        $data=[
            "jumlah_produk" => Produk::count(),
            "transaksi" => Transaksi::count(),
            "user" => User::where('roles', 'USER')->count(),
        ];
        return view('admin.dashboard.dashboard', $data);
    }
}
