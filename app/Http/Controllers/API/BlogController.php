<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\PostCategories;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Mobile\ProductCategory;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);

        $blogs = Posts::with('categories')->paginate($limit);
        $menu_categories = ProductCategory::all();
        $blog_categories = PostCategories::all();

        return ResponseFormatter::success([
            'blogs' => $blogs,
            'menu_categories' => $menu_categories,
            'blog_categories' => $blog_categories,
        ], 'Data blog berhasil diambil');
    }

    public function detail(Request $request, $id)
    {
        $blogs = Posts::with('categories')->find($id);
        $menu_categories = ProductCategory::all();
        $blog_categories = PostCategories::all();
        $blog = Posts::with('categories')->paginate(4);

        return ResponseFormatter::success([
            'blogs' => $blogs,
            'menu_categories' => $menu_categories,
            'blog_categories' => $blog_categories,
            'blog' => $blog,
        ], 'Detail blog berhasil diambil');
    }

    public function kategori(Request $request, $id = null)
    {
        $limit = $request->input('limit', 10);
        $blog_categories = PostCategories::all();

        $blogs = Posts::query();

        if (!is_null($id)) {
            $blogs->where('category_id', $id);
        }

        $blogs = $blogs->with('categories')->paginate($limit);
        $menu_categories = ProductCategory::all();
        $blog = Posts::with('categories')->paginate(4);

        return ResponseFormatter::success([
            'blogs' => $blogs,
            'menu_categories' => $menu_categories,
            'blog_categories' => $blog_categories,
            'blog' => $blog,
        ], 'Data blog berhasil diambil');
    }
}
