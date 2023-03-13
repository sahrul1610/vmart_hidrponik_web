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
        return view('categories.index', compact('categories'));
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

        return redirect('/categories')->with('success', 'Category created successfully!');
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
}
