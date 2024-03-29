<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Produkgaleri;
use App\Models\Kategori;
use App\Models\Stock;
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
        // $data = [
        //     "data" => produk::orderBy("id", "DESC")->get()
        // ];
        $products = Produk::orderBy("id", "DESC")->get();

        foreach ($products as $product) {
            $product->totalStock = Stock::where('product_id', $product->id)->sum('quantity');
        }

        $data = [
            "data" => $products
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
            'name' => 'required|max:255|min:4',
            'description' => 'required',
            'is_available' => 'required|numeric',
            'unit' => 'required|in:kg,g',
            //'product_unit' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'tags' => 'required|max:255|min:4',
            'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ], [
            'categories_id.required' => "Kategori wajib diisi!",
            'name.required' => "Nama produk wajib diisi!",
            'name.max' => "Nama maksimal 255 karakter!",
            'name.min' => "Nama minimal 4 karakter!",
            'description.required' => "Deskripsi wajib diisi!",
            'price.required' => "Harga wajib diisi!",
            'price.numeric' => "Harga harus berupa angka!",
            'stock.required' => "Stok wajib diisi!",
            'stock.numeric' => "Stok harus berupa angka!",
            'tags.required' => "Harga wajib diisi!",
            'tags.max' => "Tag maksimal 255 karakter!",
            'tags.min' => "Tag minimal 4 karakter!",
            'is_available.required' => "Satuan wajib diisi!",
            'is_available.numeric' => "Satuan harus berupa angka!",
            'url.required' => 'Gambar wajib  diisi',
            'url.image' => 'File harus berupa gambar',
            'url.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'url.max' => 'Ukuran gambar tidak boleh melebihi 2 MB',
            'unit.required' => "Satuan wajib diisi!",
            'unit.in' => "Satuan berat tidak valid!",


        ]);

        $categories_id = $request->categories_id;

        // Cek apakah categories_id ada di tabel kategori
        $categoryExists = Kategori::where('id', $categories_id)->exists();

        if (!$categoryExists) {
            return redirect()->back();
        }

        // Memasukkan data produk ke tabel produk
        $produk = new Produk;
        $produk->categories_id = $request->categories_id;
        $produk->name = $request->name;
        $produk->description = $request->description;
        $produk->price = $request->price;
        // $produk->stock = $request->stock;
        // $produk->new_stock = $request->stock;
        $produk->tags = $request->tags;
        //$produk->is_available = $request->is_available;
        $produk->created_at = now(); // mengisi field created_at dengan waktu sekarang
        $produk->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
        // Menyimpan data berat dalam satu tabel
        $berat = $request->is_available;
        $satuan = $request->unit;
        $beratGram = $satuan === 'kg' ? $berat * 1000 : $berat;

        $produk->is_available = $beratGram;
        $produk->save();

        // Memasukkan data gambar ke tabel produk_galeri
        if ($request->hasFile('url')) {
            $img = $request->file('url');
            $path = 'gambar/';
            $filename = $img->hashName();
            $img->storeAs($path, $filename, 'public');

            $galeri = new Produkgaleri;
            $galeri->products_id = $produk->id;
            $galeri->url = $filename;
            $galeri->created_at = now(); // mengisi field created_at dengan waktu sekarang
            $galeri->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
            $galeri->save();
        }

        $stock = new Stock();
        $stock->product_id = $produk->id;
        $stock->quantity = $request->stock;
        $stock->created_at = now(); // mengisi field created_at dengan waktu sekarang
        $stock->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
        $stock->save();
        return redirect()->route('produk')->with('sukses', 'data berhasil ditambahkan');
    }

    public function update(Request $request)
    {

        $request->validate([
            "categories_id" => "required",
            'name' => 'required|max:255|min:4',
            'description' => 'required',
            'price' => 'required|numeric',
            //'stock' => 'required|numeric',
            'tags' => 'required|max:255|min:4',
            'is_available' => 'required|numeric',
            'unit' => 'required|in:kg,g',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'categories_id.required' => 'Kategori produk wajib diisi',
            'name.required' => 'Nama produk wajib diisi',
            'name.max' => "Nama maksimal 255 karakter!",
            'name.min' => "Nama minimal 4 karakter!",
            'description.required' => 'Deskripsi produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'price.numeric' => 'Harga produk harus diisi dengan angka',
            'tags.required' => 'Tag produk wajib diisi',
            'tags.max' => "Tag maksimal 255 karakter!",
            'tags.min' => "Tag minimal 4 karakter!",
            'is_available.required' => 'Satuan produk wajib diisi',
            'is_available.numeric' => 'Satuan produk harus diisi dengan angka',
            'url.image' => 'File harus berupa gambar',
            'url.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'url.max' => 'Ukuran gambar tidak boleh melebihi 2 MB',
            'unit.required' => "Satuan wajib diisi!",
            'unit.in' => "Satuan berat tidak valid!",
        ]);
        $categories_id = $request->categories_id;

        // Cek apakah categories_id ada di tabel kategori
        $categoryExists = Kategori::where('id', $categories_id)->exists();

        if (!$categoryExists) {
            return redirect()->back();
        }

        $produk = Produk::findOrFail($request->id);
        $produk->categories_id = $request->categories_id;
        $produk->name = $request->name;
        $produk->description = $request->description;
        $produk->price = $request->price;
        // $produk->stock = $request->stock;
        // $produk->new_stock = $request->stock;
        $produk->tags = $request->tags;
        //$produk->is_available = $request->is_available;

        // Perbarui berat produk
        $berat = $request->is_available;
        $satuan = $request->unit;
        // Konversi berat ke gram jika satuan kilogram
        if ($satuan == 'kg') {
            $berat *= 1000;
        }
        $produk->is_available = $berat;
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


    public function delete(Request $request)
    {
        $id = $request->id;
        $produk = Produk::findOrFail($id);
        $oldImage = $produk->produkgaleri->url ?? null;


        $transaksiCount = TransaksiItem::where('products_id', $id)->count();

        if ($transaksiCount > 0) {
            return redirect()->route('produk')->with('gagal', 'Produk terkait masih digunakan di transaksi');
        }

        if ($oldImage != null) {
            Storage::delete('public/gambar/' . $oldImage);
        }
        $produk->stocks()->delete();
        $produk->delete();

        return redirect()->route('produk')->with('sukses', 'Data berhasil dihapus');
    }

    public function addStock(Request $request, $id)
    {
        $product = Produk::findOrFail($id);

        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $stock = new Stock();
        $stock->product_id = $product->id;
        $stock->quantity = $request->quantity;
        // Setel kolom lainnya sesuai kebutuhan
        $stock->created_at = now(); // mengisi field created_at dengan waktu sekarang
        $stock->updated_at = now(); // mengisi field updated_at dengan waktu sekarang
        $stock->save();

        return redirect()->back()->with('sukses', 'Stok berhasil ditambahkan.');
    }

}
