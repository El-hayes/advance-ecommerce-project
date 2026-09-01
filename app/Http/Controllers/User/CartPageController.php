<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;

class CartPageController extends Controller
{
    // view myCart page
    public function myCart()
    {
        return view('frontend.mycart.view_mycart');
    }


    // get mycart page data
    public function getCartProduct()
    {
        $carts = Cart::content();
        $caerQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'caerQty' => $caerQty,
            'cartTotal' => round($cartTotal),
        ]);

    } // End method



    // Remove mycCart Product
    public function removeCartProduct($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        return response()->json(['success' => 'Successfully Remove From Cart']);
    } // End Method


    // increment Cart Product
    public function incrementCartProduct($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon' , [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100 ),
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount / 100 )
            ]);

        } // End IF

        return response()->json('increment');

    } // End Method

    // decrement Cart Product
    public function decrementCartProduct($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon' , [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100 ),
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount / 100 )
            ]);

        } // End IF

        return response()->json('decrement');

    } // End Method







}
