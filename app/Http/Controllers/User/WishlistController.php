<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // View wishlist Page
    public function wishlistView()
    {
        return view('frontend.wishlist.view_wishlist');
    }  // End Method



    // Get Wishlist Products
    public function getWishlistProduct()
    {
        $wishList = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        return response()->json($wishList);

    }   // End Method


    // Remove Wishlist Products
    public function removeWishlistProduct($id)
    {
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
		return response()->json(['success' => 'Successfully Product Remove']);

    }   // End Method








}
