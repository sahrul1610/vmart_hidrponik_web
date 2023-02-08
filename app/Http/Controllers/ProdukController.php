<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

    // public function index(){
    //     $data = [
    //         "data" => produk::orderBy("id", "DESC")->get()
    //     ];

    //     return view('admin.produk.produk', $data);
    // }
    public function index(){
        $data = [
            "data" => produk::orderBy("id", "DESC")->get()
        ];

        return view('admin.produk.coba', $data);
    }
    public function add(){

        $data= [

            "kategori" => Kategori::orderBy("name", "DESC")->get()
        ];
        return view('admin.produk.tambah-produk', $data);
    }
    public function edit(){


        return view('admin.produk.edit-produk');
    }
}
