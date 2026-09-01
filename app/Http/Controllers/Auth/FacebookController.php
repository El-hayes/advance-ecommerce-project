<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();

    }

    public function callback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        // dd($facebookUser->id);
        $user = User::updateOrCreate(
            [
                'email' => $facebookUser->getEmail(),
            ],
            [
                'name' => $facebookUser->name,
                'facebook_id' => $facebookUser->id,
                'password' => bcrypt(Str::random(16)),
//                'profile_photo_path' => 'https://graph.facebook.com/'.$facebookUser->getId().'/picture?type=large',
            ]
        );

        Auth::login($user);

        return redirect()->to('/dashboard');
    }
}
