<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiItem;
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

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);


        $transaksiCount = TransaksiItem::where('users_id', $id)->count();

        if ($transaksiCount > 0) {
            return redirect()->route('pengguna')->with('gagal', 'User terkait masih digunakan di transaksi');
        }

        $user->delete();

        return redirect()->route('pengguna')->with('sukses', 'Data berhasil dihapus');
    }
}
