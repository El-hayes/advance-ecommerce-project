<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminUserController extends Controller
{


    public function allAdminRole(){

        $adminuser = Admin::where('type',2)->latest()->get();
        return view('backend.role.admin_role_all',compact('adminuser'));

    } // end method


    public function addAdminRole(){

        return view('backend.role.admin_role_create');

    } // End Method


    public function storeAdminRole(Request $request){

        if ($request->file('profile_photo_path'))
        {
            $image = $request->file('profile_photo_path');
            $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $manager->read($image)->resize(225,225)->save(public_path('upload/admin_images/' . $gen_name));
            $save_url = 'upload/admin_images/' . $gen_name;

            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'allusers' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'profile_photo_path' => $save_url,
                'created_at' => now(),

            ]);

            $notification = array(
                'message' => 'Admin User Created Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.admin.user')->with($notification);
        } else
        {
            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'allusers' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'created_at' => now(),

            ]);

            $notification = array(
                'message' => 'Admin User Created Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.admin.user')->with($notification);
        }




    } // End Method



    public function editAdminRole($id)
    {
        $adminUser = Admin::findOrFail($id);
        return view('backend.role.admin_role_edit', compact('adminUser'));
    }  // End Method


    public function updateAdminRole(Request $request, $id)
    {
        // update with image
        if ($request->file('profile_photo_path'))
        {
            $old_image = Admin::findOrFail($id)->profile_photo_path;
            @unlink(public_path($old_image));
            $image = $request->file('profile_photo_path');
            $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $manager->read($image)->resize(225,225)->save(public_path('upload/admin_images/' . $gen_name));
            $save_url = 'upload/admin_images/' . $gen_name;

            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'allusers' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'profile_photo_path' => $save_url,
                'created_at' => now(),

            ]);

            $notification = array(
                'message' => 'Admin User Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.admin.user')->with($notification);

        } else    //update without image
        {


            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'allusers' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'created_at' => now(),

            ]);

            $notification = array(
                'message' => 'Admin User Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.admin.user')->with($notification);


        }




    } // End Method



    public function deleteAdminRole($id)
    {
        $admin = Admin::findOrFail($id)->profile_photo_path;
        @unlink(public_path($admin));
        Admin::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin.user')->with($notification);

    } // End  Method


}
