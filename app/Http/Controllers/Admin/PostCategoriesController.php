<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategories;
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
        $request->validate([
            'name' => 'required',
        ]);

        $category = new PostCategories([
            'name' => $request->get('name'),
        ]);

        $category->save();

        return redirect()->route('posts.kategori')->with('sukses', 'Category created successfully!');
    }

    public function show($id)
    {
        $category = PostCategories::find($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = PostCategories::find($id);
        return view('categories.edit', compact('category'));

    }

    public function hapus(Request $request)
    {
        $id = $request->id;
        $kategori = PostCategories::find($id);

        if (!$kategori) {
            return redirect()->route('posts.kategori')->with('gagal', 'Kategori tidak ditemukan');
        }

        // cek apakah kategori terkait sudah ada di tabel produk
        // $productCount = Produk::where('categories_id', $id)->count();

        // if ($productCount > 0) {
        //     return redirect()->route('posts.kategori')->with('gagal', 'Kategori terkait masih digunakan di ....');
        // }

        $kategori->delete();

        return redirect()->route('posts.kategori')->with('sukses', 'Kategori berhasil dihapus');
    }
}
