<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){

        $menu_categories = Kategori::all();
        $cart = Session::get('cart', []);
        $like = Session::get('like', []);

        return view('frontend.contact.index', compact('menu_categories', 'cart', 'like'));
    }
}
