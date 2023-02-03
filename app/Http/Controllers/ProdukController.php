<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

    public function index(){
        $data = [
            "data" => produk::orderBy("id", "DESC")->get()
        ];

        return view('admin.produk.produk', $data);
    }
    public function add(){


        return view('admin.produk.tambah-produk');
    }
    public function edit(){


        return view('admin.produk.edit-produk');
    }
}
