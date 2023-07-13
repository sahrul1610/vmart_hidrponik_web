<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategories;
use App\Models\Posts;

class PostCategoriesController extends Controller
{
    public function index()
    {
        $categories = PostCategories::all();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:4|max:255',
            ],
            [

                "required" => "Kolom :attribute wajib diisi",
                'min' => "kolom :attribute minimal harus :min karakter",
                'max' => "kolom :attribute maximal harus :max karakter"

            ],
        );

        $category = new PostCategories([
            'name' => $request->get('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $cek_double = PostCategories::where(["name" => $request->name])->count();

        if ($cek_double > 0) {
            return redirect()->back()->with("gagal", "Tidak Boleh Duplikasi Data");;
        }
        $category->save();

        return redirect()->route('posts.kategori')->with('sukses', 'Category created successfully!');
    }

    public function show($id)
    {
        $category = PostCategories::find($id);
        return view('categories.show', compact('category'));
    }

    // public function edit($id)
    // {
    //     $categories = PostCategories::find($id);
    //     //dd($categories);
    //     return view('admin.blog-categories.edit-blog-kategori', compact('categories'));

    // }

    public function edit($id)
    {
        $data = [
            "edit" => PostCategories::where("id", $id)->first(),
            "data" => PostCategories::where("id", "!=", $id)->get()

        ];

        return view("admin.blog-categories.edit-blog-kategori", $data);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $kategori = PostCategories::find($id);

        if (!$kategori) {
            return redirect()->route('posts.kategori')->with('gagal', 'Kategori tidak ditemukan');
        }

        //cek apakah kategori terkait sudah ada di tabel produk
        $postsCount = Posts::where('category_id', $id)->count();

        if ($postsCount > 0) {
            return redirect()->route('posts.kategori')->with('gagal', 'Kategori terkait masih digunakan di blog');
        }

        $kategori->delete();

        return redirect()->route('posts.kategori')->with('sukses', 'Kategori berhasil dihapus');
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

        $cek_double = PostCategories::where(["name" => $request->name])->count();

        if ($cek_double > 0) {
            return redirect()->back()->with("gagal", "Tidak Boleh Duplikasi Data");
            ;
        }

        PostCategories::where("id", $request->id)->update([
            "name" => $request->name
        ]);

        // return response()->json(['messege' => 'request success'],200);
        // return response()->json(['messege' => 'request success'],200);
        return redirect()->route('posts.kategori')->with('sukses', 'data berhasil di ubah');
    }
}
