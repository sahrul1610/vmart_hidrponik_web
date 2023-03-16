<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Produkgaleri;
use App\Models\Kategori;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;
use Illuminate\Support\Facades\Storage; // tambahkan ini
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

    // public function index(){
    //     $data = [
    //         "data" => produk::orderBy("id", "DESC")->get()
    //     ];

    //     return view('admin.produk.produk', $data);
    // }
    public function index()
    {
        $data = [
            "data" => produk::orderBy("id", "DESC")->get()
        ];

        return view('admin.produk.produk', $data);
    }
    public function add()
    {

        $data = [

            "kategori" => Kategori::orderBy("name", "DESC")->get()
        ];
        return view('admin.produk.tambah-produk', $data);
    }
    // public function edit(){


    //     return view('admin.produk.edit-produk');
    // }
    public function edit($id)
    {
        $data = [
            "edit" => Produk::where("id", $id)->first(),
            "kategori" => Kategori::orderBy("name", "DESC")->get()

        ];

        return view("admin.produk.edit-produk", $data);
    }
    public function insert(Request $request)
    {
        $request->validate([
            "categories_id" => "required",
            // 'sku' => 'required',
            'name' => 'required',
            'description' => 'required',
            //'picture_name' => 'required',
            //'product_unit' => 'required',
            'price' => 'required',
            'tags' => 'required',

        ]);

        // Memasukkan data produk ke tabel produk
        $produk = new Produk;
        $produk->categories_id = $request->categories_id;
        $produk->name = $request->name;
        $produk->description = $request->description;
        $produk->price = $request->price;
        $produk->tags = $request->tags;
        $produk->created_at = now(); // mengisi field created_at dengan waktu sekarang
        $produk->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
        $produk->save();

        // Memasukkan data gambar ke tabel produk_galeri
        if ($request->hasFile('url')) {
            $img = $request->file('url');
            $path = 'gallery/';
            $filename = $img->hashName();
            $img->storeAs($path, $filename, 'public');

            $galeri = new Produkgaleri;
            $galeri->products_id = $produk->id;
            $galeri->url = $path . $filename;
            $galeri->save();
        }
        return redirect()->route('produk')->with('sukses', 'data berhasil ditambahkan');
    }


    // public function update(Request $request)
    // {

    //     $request->validate([
    //         "categories_id" => "required",
    //         'name' => 'required',
    //         'description' => 'required',
    //         'price' => 'required|numeric',
    //         'tags' => 'required',
    //         'url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ], [
    //         'categories_id.required' => 'Kategori produk wajib diisi',
    //         'name.required' => 'Nama produk wajib diisi',
    //         'description.required' => 'Deskripsi produk wajib diisi',
    //         'price.required' => 'Harga produk wajib diisi',
    //         'price.numeric' => 'Harga produk harus diisi dengan angka',
    //         'tags.required' => 'Tag produk wajib diisi',
    //         'url.image' => 'File harus berupa gambar',
    //         'url.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
    //         'url.max' => 'Ukuran gambar tidak boleh melebihi 2 MB'
    //     ]);

    //     $produk = Produk::findOrFail($request->id);
    //     $produk->categories_id = $request->categories_id;
    //     $produk->name = $request->name;
    //     $produk->description = $request->description;
    //     $produk->price = $request->price;
    //     $produk->tags = $request->tags;

    //     $produk->save();
    //     // Menghapus gambar lama jika ada gambar baru yang diupload
    //     if ($request->hasFile('url')) {
    //         $oldImage = $produk->galeri->url ?? null;

    //         if ($oldImage != null) {
    //             Storage::delete('public/gambar/' . $oldImage);
    //         }

    //         $img = $request->file('url');
    //         $path = 'gambar/';
    //         $filename = $img->hashName();
    //         $img->storeAs($path, $filename, 'public');

    //         // Memasukkan data gambar ke tabel produk_galeri
    //         $galeri = new Produkgaleri;
    //         $galeri->products_id = $produk->id;
    //         $galeri->url = $filename;
    //         $galeri->save();
    //         // var_dump($galeri);exit;
    //         // Update nama gambar di dalam database
    //         $produk->galeri->url = $filename;
    //         $produk->galeri->save();
    //     }

    //     return redirect()->route('produk')->with('sukses','Data berhasil diubah');
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         "categories_id" => "required",
    //         'name' => 'required',
    //         'description' => 'required',
    //         'price' => 'required|numeric',
    //         'tags' => 'required',
    //         'url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ], [
    //         'categories_id.required' => 'Kategori produk wajib diisi',
    //         'name.required' => 'Nama produk wajib diisi',
    //         'description.required' => 'Deskripsi produk wajib diisi',
    //         'price.required' => 'Harga produk wajib diisi',
    //         'price.numeric' => 'Harga produk harus diisi dengan angka',
    //         'tags.required' => 'Tag produk wajib diisi',
    //         'url.image' => 'File harus berupa gambar',
    //         'url.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
    //         'url.max' => 'Ukuran gambar tidak boleh melebihi 2 MB'
    //     ]);

    //     $produk = Produk::findOrFail($request->id);
    //     $produk->categories_id = $request->categories_id;
    //     $produk->name = $request->name;
    //     $produk->description = $request->description;
    //     $produk->price = $request->price;
    //     $produk->tags = $request->tags;
    //     $produk->save();

    //     // Menghapus gambar lama jika ada gambar baru yang diupload
    //     if ($request->hasFile('url')) {
    //         //$oldImage = $produk->galeri->url ?? null;
    //         $oldImage = $produk->galeri->url ?? null;

    //         if ($oldImage != null) {
    //             Storage::delete('public/gambar/' . $oldImage);
    //         }

    //         $img = $request->file('url');
    //         $path = 'gambar/';
    //         $filename = $img->hashName();
    //         $img->storeAs($path, $filename, 'public');

    //         // Memasukkan data gambar ke tabel produk_galeri
    //         $galeri = new Produkgaleri;
    //         $galeri->products_id = $produk->id;
    //         $galeri->url = $filename;
    //         $galeri->save();

    //         // // Update nama gambar di dalam database
    //         // $produk->galeri->url = $filename;
    //         // $produk->galeri->save();
    //     }

    //     return redirect()->route('produk')->with('sukses','Data berhasil diubah');
    // }

    public function update(Request $request)
    {
        $request->validate([
            "categories_id" => "required",
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'tags' => 'required',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'categories_id.required' => 'Kategori produk wajib diisi',
            'name.required' => 'Nama produk wajib diisi',
            'description.required' => 'Deskripsi produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'price.numeric' => 'Harga produk harus diisi dengan angka',
            'tags.required' => 'Tag produk wajib diisi',
            'url.image' => 'File harus berupa gambar',
            'url.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'url.max' => 'Ukuran gambar tidak boleh melebihi 2 MB'
        ]);

        $produk = Produk::findOrFail($request->id);
        $produk->categories_id = $request->categories_id;
        $produk->name = $request->name;
        $produk->description = $request->description;
        $produk->price = $request->price;
        $produk->tags = $request->tags;
        $produk->save();

        // Menghapus gambar lama jika ada gambar baru yang diupload
        if ($request->hasFile('url')) {
            $oldImage = $produk->produkgaleri->url ?? null;

            if ($oldImage != null) {
                Storage::delete('public/gambar/' . $oldImage);
            }

            $img = $request->file('url');
            $path = 'gambar/';
            $filename = $img->hashName();
            $img->storeAs($path, $filename, 'public');

            // Memasukkan data gambar ke tabel produk_galeri
            $produk->produkgaleri()->updateOrCreate(
                ['products_id' => $produk->id],
                ['url' => $filename]
            );
        }

        return redirect()->route('produk')->with('sukses', 'Data berhasil diubah');
    }


    public function hapus(Request $request)
    {
        $id = $request->id;
        $produk = Produk::findOrFail($id);
        $oldImage = $produk->produkgaleri->url ?? null;

        if ($oldImage != null) {
            Storage::delete('public/gambar/' . $oldImage);
        }

        $transaksiCount = TransaksiItem::where('products_id', $id)->count();

        if ($transaksiCount > 0) {
            return redirect()->route('produk')->with('gagal', 'Produk terkait masih digunakan di transaksi');
        }

        $produk->delete();

        return redirect()->route('produk')->with('sukses', 'Data berhasil dihapus');
    }
}
