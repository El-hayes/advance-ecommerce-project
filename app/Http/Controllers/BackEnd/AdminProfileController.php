<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // view profile
    public function adminProfile(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    // admin profile edit
    public function adminProfileEdit(){
        $editData = Admin::find(1);

        return view('admin.admin_profile_edit', compact('editData'));
    }

    // admin profile store
    public function adminProfileStore(Request $request){
        $storeData = Admin::find(1);

        $storeData->name = $request->username;
        $storeData->email = $request->email;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            @unlink(public_path('upload/admin_images/' . $storeData->profile_photo_path));
            $filename = date('YmdHi') . '.' . $file->getClientOriginalName();
            $file->move('upload/admin_images/', $filename);
            $storeData->profile_photo_path = $filename;

        }
        $storeData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);

    }

//    Admin Change password
    public function adminChangePassword(){
        return view('admin.admin_change_password');
    }

    // Admin update password
    public function adminUpdateChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ],
        [
            'password.regex' => 'The password must contain at least one uppercase letter [A-Z], one lowercase letter [a-z], one number [0-9], and one special character [@$!%*#?&].'
        ]);




        $hashPassword = Admin::find(1)->password;
        if (Hash::check($request->current_password, $hashPassword))
        {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        } else
        {
            return redirect()->back()->with('error' , 'The provided password does not match your current password');
        }

    }


}
