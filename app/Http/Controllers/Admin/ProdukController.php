<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Produkgaleri;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;
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
    // public function edit(){


    //     return view('admin.produk.edit-produk');
    // }
    public function edit($id){
        $data = [
            "edit" => Produk::where("id", $id)->first(),
            "kategori" => Kategori::orderBy("name", "DESC")->get()

        ];

        return view("admin.produk.edit-produk", $data);
    }
    public function insert(Request $request)
    {

        // $request->validate([
        //     'nama_produk' => 'required',
        //     'deskripsi' => 'required',
        //     'harga' => 'required|numeric',
        //     'gambar' => 'required|image'
        // ]);
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
            $galeri->save();
        }

        // $path = 'img/produk/';


        // $input = [
        //     'categories_id' => $request->categories_id,
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'tags' => $request->tags,

        // ];
        // $Produk = Produk::create($input);

        // if ($request->hasFile('url')) {
        //     $img = $request->file('url');
        //     foreach ($img as $key) {
        //         $filename = $key->hashName();
        //         $key->storeAs($path, $filename, 'files');
        //         $images = Produkgaleri::create(['product_id' => $Produk->id, 'image' => $filename]);
        //     }

        //    return 1;
        // }
        return redirect()->route('produk')->with('sukses','data berhasil ditambahkan');
    }
    // public function insert(Request $request){

    //     $validateData = $request->validate([
    //         "categories_id" => "required",
    //         // 'sku' => 'required',
    //         'name' => 'required',
    //         'description' => 'required',
    //         //'picture_name' => 'required',
    //         //'product_unit' => 'required',
    //         'price' => 'required|numeric',
    //         'tags' => 'required',
    //     ]);


    //     //     $Produkgaleri = new Produkgaleri;
    //     // //$product = new product;

    //     //     $customer->user_id = $user->id;


    //     //     $customer->save();

    //     // if ($request->file("picture_name")) {

    //     //     $validateData['picture_name'] = $request->file("picture_name")->store("post-image");

    //     // }


    //     Produk::create($validateData);

    //     return redirect()->route('produk')->with('sukses','data berhasil ditambahkan');
    // }
    // public function insert(ProdukRequest $request){

    //     $validateData = $request->validate([

    //     ]);

    //     $validateData = $this->validate($request, [
    //          "categories_id" => "required",
    //         // 'sku' => 'required',
    //         'name' => 'required',
    //         'description' => 'required',
    //         //'picture_name' => 'required',
    //         //'product_unit' => 'required',
    //         'price' => 'required|numeric',
    //         'tags' => 'required',
    //         ], $message);

    //     //     $Produkgaleri = new Produkgaleri;
    //     // //$product = new product;

    //     //     $customer->user_id = $user->id;


    //     //     $customer->save();

    //     // if ($request->file("picture_name")) {

    //     //     $validateData['picture_name'] = $request->file("picture_name")->store("post-image");

    //     // }


    //     Produk::create($validateData);

    //     return redirect()->route('produk')->with('sukses','data berhasil ditambahkan');
    // }

    public function update(Request $request)
    {

        $message = [
            //'sku.required' => 'wajib diisi!!',

            'categories_id.required' => 'wajib diisi!!',
            'name.required' => 'wajib diisi!!',
            'description.required' => 'wajib diisi!!',
            //'picture_name.required' => 'wajib diisi!!',
            'price.required' => 'wajib diisi!!',
            'price.numeric' => 'harus diisi nomor!!',
            'tags.required' => 'wajib diisi!!',
            //'product_unit.required' => 'wajib diisi!!',

            ];


        $validateData = $this->validate($request, [
            "categories_id" => "required",
            // 'sku' => 'required',
            'name' => 'required',
            'description' => 'required',
            //'picture_name' => 'required',
            //'product_unit' => 'required',
            'price' => 'required|numeric',
            'tags' => 'required',
        ]);

        // product::where("id", $request->id)->update([
        //     'category_id' => $request->category_id,
        //     "sku" => $request->sku,
        //     "name" => $request->name,
        //     "description" => $request->description,
        //     "product_unit" => $request->product_unit,
        //     'price'=> $request->price,
        //     'stock'=> $request->stock,
        // ]);
        // if ($request->file("picture_name")) {

        //     if ($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //     }

        //     $validateData['picture_name'] = $request->file("picture_name")->store("image");
        // }
        Produk::where("id", $request->id)->update($validateData);
       // dd($validateData);

       return redirect()->route('produk')->with('sukses','data berhasil diubah');
    }

    public function hapus(Request $request)
    {
        Produk::where("id", $request->id)->delete();

        return redirect()->route('produk')->with('sukses','data berhasil dihapus');
    }
}
