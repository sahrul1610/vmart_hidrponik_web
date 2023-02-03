<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KategoriProdukController extends Controller
{
    public function index(){
        $data = [
            "data" => Kategori::orderBy("id", "DESC")->get()
        ];

        return view('admin.kategori.kategori_produk', $data);
    }

    public function insert(Request $request){

        $message = [
            "required" => "Kolom :attribute wajib diisi",
            'min' => "kolom :attribute minimal harus :min karakter",
            'max' => "kolom :attribute maximal harus :max karakter"

        ];

        $this->validate($request, [
            "name" => "required|min:4"
        ], $message);

        $cek_double = Kategori::where(["name" => $request->name])->count();

        if ($cek_double > 0) {
            return redirect()->back()->with("gagal", "Tidak Boleh Duplikasi Data");;
        }

        Kategori::create($request->all());

        return redirect()->route('kategori')->with('sukses','data berhasil di tambahkan');
    }
}
