<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    // view Coupon page
    function couponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.view_coupon', compact('coupons'));
    } // End Method


    // Store Coupon
    function couponStore(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required|numeric',
            'coupon_validity' => 'required',
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    // Edit Coupon
    public function couponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('backend.coupon.edit_coupon', compact('coupon'));
    } // End Method


    // Edit Coupon
    public function couponUpdate(Request $request, $id)
    {

        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required|numeric',
            'coupon_validity' => 'required',
        ]);

        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
        ]);

        $notification = array(
            'message' => 'Coupon updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.coupon')->with($notification);
    } // End Method


    // Delete Coupon
    public function couponDelete($id)
    {
        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.coupon')->with($notification);
    }



}
