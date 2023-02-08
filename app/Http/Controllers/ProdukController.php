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

    public function insert(Request $request){

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
            ], $message);

        // if ($request->file("picture_name")) {

        //     $validateData['picture_name'] = $request->file("picture_name")->store("post-image");

        // }


        Produk::create($validateData);

        return redirect('/produk')->with('pesan','data berhasil di tambahkan');
    }

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

        return redirect("/produk");
    }

    public function hapus(Request $request)
    {
        Produk::where("id", $request->id)->delete();

        return redirect('/produk')->with('pesan','data berhasil di hapus');
    }
}
