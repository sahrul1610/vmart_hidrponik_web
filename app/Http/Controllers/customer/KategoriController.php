<?php

namespace App\Http\Controllers\customer;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil data kategori untuk ditampilkan di dropdown menu
        $menu_categories = Kategori::all();

        return view('layouts.mobile_menu', compact('menu_categories'));
    }
}
