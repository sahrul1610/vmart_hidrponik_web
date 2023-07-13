<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
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
            "name" => "required|min:4|max:255"
        ], $message);

        $cek_double = Kategori::where(["name" => $request->name])->count();

        if ($cek_double > 0) {
            return redirect()->back()->with("gagal", "Tidak Boleh Duplikasi Data");;
        }

        //Kategori::create($request->all());
        $data = $request->all();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        Kategori::create($data);

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
            "name" => "required|min:4|max:255"
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

    // public function hapus1(Request $request)
    // {
    //     kategori::where("id", $request->id)->delete();
    //     //return response()->json('Program deleted successfully');
    //     return redirect()->route('kategori')->with('sukses','data berhasil di hapus');
    // }

    public function delete(Request $request)
    {
        $id = $request->id;
        $kategori = kategori::find($id);

        if (!$kategori) {
            return redirect()->route('kategori')->with('gagal', 'Kategori tidak ditemukan');
        }

        // cek apakah kategori terkait sudah ada di tabel produk
        $productCount = Produk::where('categories_id', $id)->count();

        if ($productCount > 0) {
            return redirect()->route('kategori')->with('gagal', 'Kategori terkait masih digunakan di produk');
        }

        $kategori->delete();

        return redirect()->route('kategori')->with('sukses', 'Kategori berhasil dihapus');
    }
}
