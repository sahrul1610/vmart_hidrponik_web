<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth/login');
    }

    public function authenticate(request $request)
    {
        //  $request->validate([
        //     "email" => "required",
        //     "password" => "required"
        // ]);
        // dd('berhasil');
        // if (Auth::attempt($credentials))
        // {
        //     $request->session()->regenerate();
        //     return redirect()->intended("/produk");

        // }else{
        //     return redirect()->back();
        // }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('produk');
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
        return back()->with('LoginError', 'Login Failed!!');
    }

    public function logout(){
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('/login');

    }
}
