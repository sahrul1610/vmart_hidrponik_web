<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index(){
        $data = [
            "data" => User::orderBy("id", "DESC")->get()
        ];
        return view('admin.user.pengguna', $data);
    }
}
