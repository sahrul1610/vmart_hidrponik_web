<?php

namespace App\Http\Controllers;
//use Socialite;
use App\Models\SocialAccount;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Providers\RouteServiceProvider;

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

            if(Auth::user()->roles == "USER"){
                return redirect()->intended(RouteServiceProvider::HOME);
            } elseif (Auth::user()->roles == "ADMIN") {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }else {
                return abort(403);
            }
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
        return redirect('/');

    }
    #terbaru login google
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){

        $user = Socialite::driver('google')->user();

    // Do whatever you want with the user information
    // Store the user in the database, log them in, etc.
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->back();
        }
        // find or create user and send params user get from socialite and provider
        $authUser = $this->findOrCreateUser($user, $provider);

        // login user
        Auth()->login($authUser, true);

        // setelah login redirect ke dashboard
        // return redirect()->route('produk');
        if(Auth::user()->roles == "USER"){
            return redirect()->intended(RouteServiceProvider::HOME);
        } elseif (Auth::user()->roles == "ADMIN") {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }else {
            return abort(403);
        }
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        // Get Social Account
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // Jika sudah ada
        if ($socialAccount) {
            // return user
            return $socialAccount->user;

            // Jika belum ada
        } else {

            // User berdasarkan email
            $user = User::where('email', $socialUser->getEmail())->first();
            // Jika Tidak ada user
            if (!$user) {
                // Create user baru
                $user = User::create([
                    'name'  => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password'          => Hash::make(0),
                    //'status' => 1,
                    'email_verified_at' => now()
                ]);

                // $leader = Leader::create(
                //     [
                //         'user_id' => $user->id,
                //         'role_id' => $user->role_id,
                //     ]
                // );
            }

            // Buat Social Account baru
            $user->socialAccounts()->create([
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider
            ]);

            // return user
            return $user;
        }
    }
}
