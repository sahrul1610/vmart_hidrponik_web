<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index(){
        $data = [
            "data" => User::orderBy("id", "DESC")->where('roles', 'USER')->get()
        ];
        return view('admin.user.pengguna', $data);
    }
}
