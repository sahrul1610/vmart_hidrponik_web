<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\PostCategories;
use Illuminate\Support\Str;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::all();
        return view('Admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategories::all();
        return view('Admin.blog.tambah_blog', compact('categories'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'summary' => 'required',
        //     'description' => 'required',
        //     'photo' => 'required',
        // ]);
        // //dd($request);
        // $post = new Posts([
        //     'title' => $request->get('title'),
        //     'slug' => Str::slug($request->get('title')),
        //     'summary' => $request->get('summary'),
        //     'description' => $request->get('description'),
        //     'quote' => $request->get('quote'),
        //     'photo' => $request->get('photo'),
        //     'category_id' => $request->get('category_id')
        // ]);

        // $post->save();
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'quote' => 'required',
            'category_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
                        'category_id.required' => 'Kategori  wajib diisi',
                        'title.required' => 'title wajib diisi',
                        'description.required' => 'Deskripsi  wajib diisi',
                        'quote.required' => 'qoute  wajib diisi',
                        'summary.required' => 'summary wajib diisi',
                        'photo.required' => 'photo wajib  diisi',
                        'photo.image' => 'File harus berupa gambar',
                        'photo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                        'photo.max' => 'Ukuran gambar tidak boleh melebihi 2 MB'

        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $path = 'images/';
            $filename = $img->hashName();
            $img->storeAs($path, $filename, 'public');
        }

        $post = new Posts([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'summary' => $request->get('summary'),
            'description' => $request->get('description'),
            'quote' => $request->get('quote'),
            'photo' => $filename,
            'category_id' => $request->get('category_id')
        ]);

        $post->save();

        return redirect('/posts')->with('sukses', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        $categories = PostCategories::all();
        return view('Admin.blog.edit_blog', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);

        $post = Posts::find($id);
        $post->title = $request->get('title');
        $post->slug = str_slug($request->get('title'));
        $post->summary = $request->get('summary');
        $post->description = $request->get('description');
        $post->photo = $request->get('photo');
        $post->category_id = $request->get('category_id');
        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }
}
