<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Models\Wishlist;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;
use Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Start Add To Cart function
    public function addToCart(Request $request, $id)
    {

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }



    }
    // End Add To Cart function




    // Start Add to mini cart
    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);
    }
    // End Add to mini cart


    /// remove mini cart
    public function removeMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart']);

    } // end method


    // Add to WishList
    public function addToWishlist(Request $request, $id)
    {

        if (Auth::check()) {

            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();

            if ($exists) {
                return response()->json(['error' => 'Product Already Added to Wishlist']);
            } else {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success' => 'Successfully Added on Your Wishlist']);
            }


        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }

    } // End Method


    // Frontend Coupon Option
    public function couponApply(Request $request){


        if (Cart::count() == 0) {
            return response()->json(['error' => 'Your cart is empty.']);
        }


       $coupon = Coupon::where('coupon_name', $request->coupon_name)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();


        if ($coupon)
        {



            Session::put('coupon' , [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100 ),
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount / 100 )
            ]);

            return response()->json(array(

                'success' => 'Coupon Applied Successfully'
            ));

        } else {
            return response()->json(['error' => 'Invalid or expired coupon.']);
        }

    } // End Methods


    // Start couponCalculation method
    public function couponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => Session()->get('coupon')['coupon_name'],
                'coupon_discount' => Session()->get('coupon')['coupon_discount'],
                'discount_amount' => Session()->get('coupon')['discount_amount'],
                'total_amount' => Session()->get('coupon')['total_amount']
            ));

        } else {
            return response()->json(array(
                'total' => Cart::total()
            ));
        }

    } // End Method


    // Start remove coupon function
    public function couponRemove(){
        Session::forget('coupon');

        return response()->json(['success' => 'Coupon Remove Successfully']);
    } // End Function


    // Start Checkout Methods
    // start create checkout
    public function checkoutCreate() {

        if(Auth::check()) {

            if(Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBY('division_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view',
                        compact('carts', 'cartQty', 'cartTotal', 'divisions'));

            } else {
                $notification = array(
                    'message' => 'Sorry! You don\'t have enough items in your cart. Shopping At least One Product',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification);
            }

        } else {
            $notification = array(
                'message' => 'Please login first',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);

        }

    } // End Method






}
