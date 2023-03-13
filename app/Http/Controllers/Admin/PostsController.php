<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategories::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);

        $post = new Posts([
            'title' => $request->get('title'),
            'slug' => str_slug($request->get('title')),
            'summary' => $request->get('summary'),
            'description' => $request->get('description'),
            'photo' => $request->get('photo'),
            'category_id' => $request->get('category_id')
        ]);

        $post->save();

        return redirect('/posts')->with('success', 'Post created successfully!');
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
        return view('posts.edit', compact('post', 'categories'));
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
