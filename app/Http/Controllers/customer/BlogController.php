<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Posts;
use App\Models\PostCategories;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){


        //$blogs = Posts::all();
        //$blogs = Posts::with('categories')->get();
        $blogs = Posts::with('categories')->paginate(10); // menampilkan 10 data per halaman
        $menu_categories = Kategori::all();
        //$cart = Session::get('cart', []);

        // Mengirim data produk ke view untuk ditampilkan
        //return view('frontend.blog.index', compact('blogs','menu_categories'));
        return view('frontend.blog.index', compact('blogs', 'menu_categories'))
        ->with('i', (request()->input('page', 1) - 1) * 10);

    }

    public function detail($id){
        $blogs = Posts::with('categories')->find($id);
        $menu_categories = Kategori::all();

        return view('frontend.blog.blog_detail', compact('blogs','menu_categories'));

    }
}
