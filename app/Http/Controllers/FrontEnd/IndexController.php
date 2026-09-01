<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Blog\BlogPost;

class IndexController extends Controller
{
    // show home
    public function index()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status', 1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status', 1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Product::where('featured', 1)->orderBy('id','DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=' , NULL)->orderBy('id', 'DESC')->limit('3')->get();
        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit('6')->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        //$subcategory_mobile_id = SubCategory::where('subcategory_name_en','Mobile Phones')->get();
        //$mobiles = Product::where('subcategory_id'  , $subcategory_mobile_id->id )->orderBy('id', 'DESC')->limit('6')->get();
        //dd($subcategory_mobile_id->id);


        // To get all products related first category in DB category table
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id','DESC')->limit(10)->get();
        //dd($skip_category_0);

        // To get all products related second category in DB category table
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id','DESC')->limit(10)->get();

        // To get all products related define  brand
        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status', 1)->where('brand_id', $skip_brand_1->id)->orderBy('id','DESC')->limit(10)->get();

        // To get all products related define  Sub category Mobile Phones

       // $skip_subcategory_18 = SubCategory::skip(18)->first();
        //$mobile_phones_product = Product::where('status', 1)->where('subcategory_id', $skip_subcategory_18->id)->orderBy('id','DESC')->limit(6)->get();

        $subcategory = SubCategory::where('subcategory_name_en', 'Mobile Phones')->first();

        $mobile_phones_product = Product::where('subcategory_id', $subcategory->id)->get();

        // Best seller products
        $bestSellerProducts = Product::withSum('orderItems', 'qty')
            ->orderByDesc('order_items_sum_qty')
            ->limit(8)
            ->get();


        // Blog post
        $blogPost = BlogPost::latest()->get();


        return view('frontend.index',
            compact('categories', 'sliders', 'products', 'featured', 'hot_deals',
                'special_offer', 'special_deals', 'skip_category_0', 'skip_product_0', 'skip_category_1',
                'skip_product_1', 'skip_brand_1', 'skip_brand_product_1', 'bestSellerProducts' , 'blogPost', 'mobile_phones_product'));
    }

    // user logout
    public function userLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

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


    // show product details route
    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);
        $multiImg = MultiImg::where('product_id', $id)->get();

        $color_en = $product->product_color_en;
        $product_color_en = explode(',' , $color_en);

        $color_ar = $product->product_color_ar;
        $product_color_ar = explode(',' , $color_ar);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',' , $size_en);

        $size_ar = $product->product_size_ar;
        $product_size_ar = explode(',' , $size_ar);

        $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $id)
            ->orderBy('id', 'DESC')->get();

        return view('FrontEnd.product.product_details', compact('product', 'multiImg',
        'product_color_en', 'product_color_ar', 'product_size_en', 'product_size_ar', 'relatedProduct'));
    }


    // Start  Product Tags view
    public function tagWiseProduct($tag)
    {

        $categories = Category::orderBy('category_name_en')->get();

         $products = Product::where('status', 1)
                            ->where('product_tags_en', $tag)
                            ->orwhere('product_tags_ar', $tag)->orderBy('id','DESC')->paginate(3);
//

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }
    // End  Product Tags view


    // Subcategory wise data
    public function subcategoryWiseProduct(Request $request, $subcategory_id, $slug)
    {
        $categories = Category::orderBy('category_name_en')->get();
        $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->orderBy('id','DESC')->paginate(3);

        // for Dynamic breadcrumb
        $breadSubCat = SubCategory::where('id', $subcategory_id)->get();


      //  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product',compact('products'))->render();

            $list_view = view('frontend.product.list_view_product',compact('products'))->render();
            return response()->json([
                'grid_view' => $grid_view,
                'list_view' => $list_view
            ]);

        }
        ///  End Load More Product with Ajax



        return view('frontend.product.subcategory_view', compact('categories', 'products', 'breadSubCat'));
    }


    // SubSubcategory wise data
    public function subsubcategoryWiseProduct($subsubcategory_id, $slug)
    {
        $categories = Category::orderBy('category_name_en')->get();
        $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->orderBy('id','DESC')->paginate(6);

        // for Dynamic breadcrumb
        $breadSubSubCat = SubSubCategory::where('id', $subsubcategory_id)->get();


        return view('frontend.product.sub_subcategory_view', compact('categories', 'products', 'breadSubSubCat'));
    }


    /// Product View With Ajax function
    public function productViewAjax($id)
    {
            $product = Product::with('category', 'brand')->findOrFail($id);

            $color = $product->product_color_en;
            $product_color = explode(',' , $color);

            $size = $product->product_size_en;
            $product_size = explode(',' , $size);

            return response()->json(array(
                'product' => $product,
                'color' => $product_color,
                'size' => $product_size,
            ));
    } // End Method




    // Product Search Method
    public function productSearch(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $keyword = $request->search;
        $products = Product::where('product_name_en', 'like', "%$keyword%")->where('status', 1)->get();
        return view('frontend.product.search', compact('products' , 'categories'));
    } // End Method


    // Advanced Search product
    public function advancedSearchProduct(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $keyword = $request->search;
        $products = Product::where('product_name_en', 'like' , "%$keyword%")->where('status', 1)
            ->select('product_name_en','product_thambnail', 'selling_price', 'id', 'product_slug_en')->limit(5)->get();

        return view('frontend.product.advanced_search_product', compact('products'));

    } // ENd Method



}
