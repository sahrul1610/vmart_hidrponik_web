<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $menu_categories = Kategori::all();
        // $cart = Session::get('cart', []);
        // $like = Session::get('like', []);
        return view('profile.edit', [
            'user' => $request->user(), 'menu_categories' => $menu_categories,
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'current_password' => ['required', function ($attribute, $value, $fail) use ($request) {
        //         if (!Hash::check($value, $request->user()->password)) {
        //             $fail(__('The current password is incorrect.'));
        //         }
        //     }],
        //     'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        $request->user()->forceFill([
            'password' => Hash::make($request->input('new_password')),
        ])->save();

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        $social = SocialAccount::where('user_id', Auth::user()->id)->first();

        Auth::logout();

        $user->delete();
        if($social == !null){
            $social->delete();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
