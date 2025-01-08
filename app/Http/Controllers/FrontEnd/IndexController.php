<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    // show home
    public function index()
    {

        return view('frontend.index');
    }

    // user logout
    public function userLogout()
    {
        Auth::logout();

        $notification = array(
            'message' => 'You have been logged out!',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);
    }

    // user Profile
    public function userProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('FrontEnd.profile.user_profile', compact('user'));
    }

    // user profile store
    public function userProfileStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/^\d{11,}$/',
            'image' => 'mimes:jpeg,jpg,png,webp|max:2048',
        ]);


        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('upload/user_images/' . $user->profile_photo_path));
            $imageName = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/user_images'), $imageName);
            $user->profile_photo_path = $imageName;
        }
        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);


    }


    // change user password
    public function userChangePassword()
    {
        $user = User::find(Auth::user()->id);
        return view('FrontEnd.profile.change_password',compact('user'));
    }


    // user password update
    public function userPasswordUpdate(request $request)
    {
        request()->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ],
        [
            'password.regex' => 'The password must contain at least one uppercase letter [A-Z], one lowercase letter [a-z], one number [0-9], and one special character [@$!%*#?&].'
        ]);

        $hashPassword = Auth::user()->password;
        if(Hash::check($request->current_password ,  $hashPassword))
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'Your password has been changed successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('login')->with($notification);
        }
        return redirect()->back()->with('error' , 'The provided password does not match your current password');

    }


}
