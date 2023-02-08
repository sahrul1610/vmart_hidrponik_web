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

    public function edit($id){
        $data = [
            "edit" => Kategori::where("id", $id)->first(),
            "data" => Kategori::where("id", "!=" , $id)->get()

        ];

        return view("admin.kategori.edit-kategori-produk", $data);
    }

    public function update(Request $request)
    {
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

        Kategori::where("id", $request->id)->update([
            "name" => $request->name
        ]);

       // return response()->json(['messege' => 'request success'],200);
       // return response()->json(['messege' => 'request success'],200);
       return redirect()->route('kategori')->with('sukses','data berhasil di ubah');
    }

    public function hapus(Request $request)
    {
        kategori::where("id", $request->id)->delete();

        //return response()->json('Program deleted successfully');
        return redirect()->route('kategori')->with('sukses','data berhasil di hapus');
    }
}
