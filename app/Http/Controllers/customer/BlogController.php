<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Posts;
use App\Models\PostCategories;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index()
    {


        //$blogs = Posts::all();
        //$blogs = Posts::with('categories')->get();
        $blogs = Posts::with('categories')->paginate(4); // menampilkan 10 data per halaman
        $blog = Posts::with('categories')->paginate(4); // menampilkan 10 data per halaman
        $menu_categories = Kategori::all();
        $blog_categories = PostCategories::all();
        //$cart = Session::get('cart', []);
        $paginationHtml = $this->renderPagination($blogs);
        // Mengirim data produk ke view untuk ditampilkan
        //return view('frontend.blog.index', compact('blogs','menu_categories'));
        return view('frontend.blog.index', compact('blogs', 'menu_categories', 'blog', 'blog_categories', 'paginationHtml'))
            ->with('i', (request()->input('page', 1) - 1) * 10);

    }

    public function detail($id)
    {
        $blogs = Posts::with('categories')->find($id);
        $menu_categories = Kategori::all();
        $blog_categories = PostCategories::all();
        //$paginationHtml = $this->renderPagination($blogs);
        $blog = Posts::with('categories')->paginate(4);

        return view('frontend.blog.blog_detail', compact('blogs', 'menu_categories', 'blog', 'blog_categories'));

    }

    public function kategori($id = null)
    {

        $blog_categories = PostCategories::all();

        $blogs = Posts::query();

        if (!is_null($id)) {
            $blogs->where('category_id', $id)->paginate(4);
        }
        $blogs = $blogs->paginate(4);
        //$blogs = Posts::with('categories')->paginate(10); // menampilkan 10 data per halaman
        $menu_categories = Kategori::all();
        $blog = Posts::with('categories')->paginate(4);
        $paginationHtml = $this->renderPagination($blogs);
        return view('frontend.blog.index', compact('blogs', 'menu_categories', 'blog', 'blog_categories', 'paginationHtml'))
            ->with('i', ($blogs->currentPage() - 1) * 4);
    }

    public function search(Request $request)
    {
        // untuk mencari keyword nama produk
        $keyword = $request->input('keyword');
        //$produks = Produk::with('produkgaleri')->where('name', 'like', "%$keyword%")->get();
        $blogs = Posts::with('categories')
            ->where('title', 'like', "%$keyword%")
            ->paginate(4);
        $blog = Posts::with('categories')->paginate(4);
        $blog_categories = PostCategories::all();
        $menu_categories = Kategori::all();

        $paginationHtml = $this->renderPagination($blogs);
        // Mengirim data produk ke view untuk ditampilkan
        return view('frontend.blog.index', compact('blogs', 'menu_categories', 'blog', 'blog_categories', 'paginationHtml'))
            ->with('i', ($blogs->currentPage() - 1) * 4);
    }


    function renderPagination($paginator)
    {
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $range = 3; // Jumlah tautan sebelum dan sesudah halaman saat ini

        $start = max($currentPage - $range, 1);
        $end = min($currentPage + $range, $lastPage);

        $html = '<div class="product__pagination blog__pagination">';
        if ($start > 1) {
            $html .= '<a href="' . $paginator->url(1) . '">1</a>';
            if ($start > 2) {
                $html .= '<span>...</span>';
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == $currentPage) {
                $html .= '<a href="' . $paginator->url($i) . '" class="current">' . $i . '</a>';
            } else {
                $html .= '<a href="' . $paginator->url($i) . '">' . $i . '</a>';
            }
        }

        if ($end < $lastPage) {
            if ($end < $lastPage - 1) {
                $html .= '<span>...</span>';
            }
            $html .= '<a href="' . $paginator->url($lastPage) . '">' . $lastPage . '</a>';
        }
        $html .= '</div>';

        return $html;
    }



}
