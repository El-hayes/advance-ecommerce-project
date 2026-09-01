<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackEnd\AdminProfileController;
use App\Http\Controllers\BackEnd\AdminUserController;
use App\Http\Controllers\BackEnd\BlogController;
use App\Http\Controllers\BackEnd\BrandController;
use App\Http\Controllers\BackEnd\SubCategoryController;
use App\Http\Controllers\FrontEnd\IndexController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\ProductController;
use App\Http\Controllers\BackEnd\SliderController;
use App\Http\Controllers\FrontEnd\LanguageController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\ShopController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\BackEnd\CouponController;
use App\Http\Controllers\BackEnd\ShippingAreaController;
use App\Http\Controllers\BackEnd\OrderController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\User\StripeOrder;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\BackEnd\ReportController;
use App\Http\Controllers\BackEnd\SiteSettingController;
use  App\Http\Controllers\FrontEnd\HomeBlogController;
use App\Http\Controllers\BackEnd\ReturnController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use Laravel\Socialite\Facades\Socialite;



use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:admin'])->group(function(){   // start middleware Admin


    // All Admin Routes
    Route::middleware([
        'auth:sanctum,admin',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.index');})->name('dashboard')->middleware('auth:admin');
    });

    // admin logout
    Route::get('admin/logout', [adminController::class, 'destroy'])->name('admin.logout');
    // admin profile view
    Route::get('admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    // Admin profile Edit
    Route::get('admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    // Admin profile Store
    Route::post('admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
    // Admin Change password
    Route::get('admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
    // Update Change password
    Route::post('update/change/password', [AdminProfileController::class, 'adminUpdateChangePassword'])->name('update.change.password');


    // admin all Brand
    Route::prefix('brand')->group(function () {
       Route::get('/view', [BrandController::class, 'brandView'])->name('all.brand');
       Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');
       Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
       Route::post('/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
       route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
    });



    // admin all category
    Route::prefix('category')->group(function () {
       Route::get('/view', [CategoryController::class, 'categoryView'])->name('all.category');
       Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');
       Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
       Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
       route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');


       // all subCategory routes
        Route::get('/sub/view', [SubCategoryController::class, 'subCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'subCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update/{id}', [SubCategoryController::class, 'subCategoryUpdate'])->name('subcategory.update');
        route::get('/sub/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('subcategory.delete');


        // All Sub Sun Category Routes
        Route::get('/sub/sub/view', [SubCategoryController::class, 'subSubCategoryView'])->name('all.subsubcategory');

        //// to get subcategory when choose category
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
        //// to get subsubcategory when choose subcategory
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);



        /// resume Sub Sun Category Routes
        Route::post('/sub/sub/store', [SubCategoryController::class, 'subSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update/{id}', [SubCategoryController::class, 'subSubCategoryUpdate'])->name('subsubcategory.update');
        route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subsubcategory.delete');


    });


    ///  All products routes
    Route::prefix('product')->group(function() {
        Route::get('/add', [ProductController::class, 'productAdd'])->name('add.product');
        Route::post('/store', [ProductController::class, 'productStore'])->name('product-store');
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage-product');
        Route::get('/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::post('/data/update/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
        Route::post('/image/update', [ProductController::class, 'multiImageUpdate'])->name('update.product.image');
        Route::post('/thambnail/update/{id}', [ProductController::class, 'thambnailImageUpdate'])->name('update.product.thambnail');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'multiImageDelete'])->name('product.multiimg.delete');
        Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
        Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
    });

    // admin all Slider Routes
    Route::prefix('slider')->group(function () {
        Route::get('/view', [SliderController::class, 'sliderView'])->name('manage.slider');
        Route::post('/store', [SliderController::class, 'sliderStore'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
        route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
        Route::get('/inactive/{id}', [SliderController::class, 'sliderInactive'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
    });


    // admin all Coupons
    Route::prefix('coupons')->group(function () {
        Route::get('/view', [CouponController::class, 'couponView'])->name('manage.coupon');
        Route::post('/store', [CouponController::class, 'couponStore'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'couponEdit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'couponUpdate'])->name('coupon.update');
        route::get('/delete/{id}', [CouponController::class, 'couponDelete'])->name('coupon.delete');
    });

    // Admin Shipping All Routes
    Route::prefix('shipping')->group(function () {
        // Ship Division Routes
        Route::get('/division/view', [ShippingAreaController::class, 'divisionView'])->name('manage.division');
        Route::post('/division/store', [ShippingAreaController::class, 'divisionStore'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'divisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'divisionUpdate'])->name('division.update');
        route::get('division/delete/{id}', [ShippingAreaController::class, 'divisionDelete'])->name('division.delete');

        // Ship District Routes
        Route::get('/district/view', [ShippingAreaController::class, 'districtView'])->name('manage.district');
        Route::post('/district/store', [ShippingAreaController::class, 'districtStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'districtEdit'])->name('district.edit');
        Route::post('district/update/{id}', [ShippingAreaController::class, 'districtUpdate'])->name('district.update');
        route::get('district/delete/{id}', [ShippingAreaController::class, 'districtDelete'])->name('district.delete');

        // Ship State Routes
        Route::get('/state/view', [ShippingAreaController::class, 'stateView'])->name('manage.state');
        Route::post('/state/store', [ShippingAreaController::class, 'stateStore'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'stateEdit'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingAreaController::class, 'stateUpdate'])->name('state.update');
        route::get('state/delete/{id}', [ShippingAreaController::class, 'stateDelete'])->name('state.delete');


        Route::get('/district/ajax/{division_id}', [ShippingAreaController::class, 'getDistrict']);



    });


});  // end Middleware admin





////////////////// // All user Routes ////////////////

Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $userData = User::find(Auth::user()->id);
        return view('dashboard', compact('userData'));})->name('dashboard');
});

Route::get('/', [IndexController::class, 'index'])->name('home');

// user logout
Route::get('user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
// user profile
Route::get('user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
// update user profile
Route::post('user/profile/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
// change user password
Route::get('user/change/password', [IndexController::class, 'userChangePassword'])->name('user.change.password');
// user password update
Route::post('user/password/update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');



//// Frontend All Routes /////

/// Multi Language All Routes ////
Route::get('/language/arabic', [LanguageController::class, 'arabic'])->name('language.arabic');
Route::get('/language/english', [LanguageController::class, 'english'])->name('language.english');


// Frontend Product Details Page url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);


// Frontend Product Tags Page
Route::get('product/tag/{tag}', [IndexController::class , 'tagWiseProduct']);


// Frontend SubCategory wise Data
Route::get('subcategory/product/{subcategory_id}/{slug}', [IndexController::class, 'subcategoryWiseProduct']);


// Frontend SubSubCategory wise Data
Route::get('subsubcategory/product/{subsubcategory_id}/{slug}', [IndexController::class, 'subsubcategoryWiseProduct']);

// Product View Modal with Ajax
Route::get('product/view/modal/{id}', [IndexController::class, 'productViewAjax']);

// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

// GET DATA FROM MINI CART
Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'removeMiniCart']);

// Add To Wishlist
Route::post('/add-to-wishlist/{id}', [CartController::class, 'addToWishlist']);



/////////////////////  User Must Login  ////


////// Wishlist & myCart Page Routes //////
Route::group(['prefix'=>'user','middleware' => ['auth', 'user'], 'namespace' => 'User'], function () {
    // View Wishlist Page
    Route::get('/wishlist', [WishListController::class, 'wishlistView'])->name('wishlist');

    // Get Wishlist product
    Route::get('/get-wishlist-product', [WishListController::class, 'getWishlistProduct']);

    // Remove Wishlist product
    Route::get('/wishlist-remove/{id}', [WishListController::class, 'removeWishlistProduct']);

    // stripe payment method route
    Route::post('/stripe/order', [StripeOrder::class, 'stripeOrder'])->name('stripe.order');

    // show orders history in profile page
    Route::get('/me/orders', [AllUserController::class, 'myOrders'])->name('my.orders');

    // show order details
    Route::get('/order_details/{order_id}', [AllUserController::class, 'orderDetails']);

    // cash payment method route
    Route::post('/cash/order', [CashController::class, 'cashOrder'])->name('cash.order');

    // download order invoice
    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'invoiceDownload']);

    // return order reason route
    Route::post('/return/order/{order_id}', [AllUserController::class, 'returnOrder'])->name('return.order');

    // return order List Route
    Route::get('/return/order/list', [AllUserController::class, 'returnOrderList'])->name('return.orders.list');

    // Cancel order List Route
    Route::get('/cancel/orders', [AllUserController::class, 'cancelOrders'])->name('cancel.orders');

    ///////////////////////////////

    /// Order Tracking Route
    Route::post('/order/tracking', [AllUserController::class, 'orderTracking'])->name('order.tracking');


});


/////////////////////  End User Must Login  ////





// view myCart page
Route::get('/mycart', [CartPageController::class, 'myCart'])->name('mycart');

// view cart products
Route::get('/user/get-cart-product', [CartPageController::class, 'getCartProduct']);

// remove myCart Product
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'removeCartProduct']);

// increment product Qty in Cart
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'incrementCartProduct']);

// Decrement product Qty in Cart
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'decrementCartProduct']);


// Frontend Coupon Option

Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation']);
Route::get('/remove-coupon', [CartController::class, 'couponRemove']);

// Frontend Checkout Routes
Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'districtGetAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'stateGetAjax']);
Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name(('checkout.store'));


// Admin Order All Routes
Route::prefix('orders')->group(function () {
    Route::get('/pending/orders', [OrderController::class,'pendingOrders'])->name('pending-orders');
    Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'pendingOrdersDetails'])->name('pending.order.details');
    Route::get('/confirmed/orders', [OrderController::class,'confirmedOrders'])->name('confirmed-orders');
    Route::get('/processing/orders', [OrderController::class, 'processingOrders'])->name('processing-orders');
    Route::get('/picked/orders', [OrderController::class, 'pickedOrders'])->name('picked-orders');
    Route::get('/shipped/orders', [OrderController::class, 'shippedOrders'])->name('shipped-orders');
    Route::get('/delivered/orders', [OrderController::class, 'deliveredOrders'])->name('delivered-orders');
    Route::get('/cancel/orders', [OrderController::class, 'cancelOrders'])->name('cancel-orders');
    Route::get('/pending/confirm/{order_id}', [OrderController::class, 'pendingToConfirmOrder'])->name('pending-confirm');
    Route::get('/confirm/processing/{order_id}', [OrderController::class, 'confirmToProcessingOrder'])->name('confirm-processing');
    Route::get('/processing/picked/{order_id}', [OrderController::class, 'processingToPickedOrder'])->name('processing-picked');
    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'pickedToShippedOrder'])->name('picked-shipped');
    Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'shippedToDeliveredOrder'])->name('shipped-delivered');
    Route::get('/delivered/cancel/{order_id}', [OrderController::class, 'deliveredToCancelOrder'])->name('delivered-cancel');
    Route::get('download/invoice/{order_id}', [OrderController::class, 'adminInvoiceDownload'])->name('admin.invoice.download');
});


// Admin Reports Routes
Route::prefix('reports')->group(function (){
    Route::get('/view', [ReportController::class, 'reportView'])->name('all-reports');
    Route::post('/search/by/date', [ReportController::class, 'reportByDate'])->name('search-by-date');
    Route::post('/search/by/month', [ReportController::class, 'reportByMonth'])->name('search-by-month');
    Route::post('/search/by/year', [ReportController::class, 'reportByYear'])->name('search-by-year');
});

// Admin Get All User Routes
Route::prefix('allusers')->group(function () {
    Route::get('/view', [AdminProfileController::class, 'allUsers'])->name('all-users');
});


// All Blog Management Routes
Route::prefix('blog')->group(function () {
    Route::get('/category', [BlogController::class, 'blogCategory'])->name('blog.category');
    Route::post('/category/store', [BlogController::class, 'blogCategoryStore'])->name('blog.category.store');
    Route::get('/category/edit/{id}', [BlogController::class, 'blogCategoryEdit'])->name('item.edit');
    Route::post('/category/update/{id}', [BlogController::class, 'blogCategoryUpdate'])->name('blog.category.update');
    Route::get('/category/delete/{id}' , [BlogController::class, 'blogCategoryDelete'])->name('item.delete');

    // Admin View Blog Post Routes
    Route::get('/view/post', [BlogController::class, 'postView'])->name('post.view');
    Route::get('/add/post', [BlogController::class, 'addBlogPost'])->name('add.blog.post');
    Route::post('/post/store', [BlogController::class, 'blogPostStore'])->name('post.store');
    Route::get('/post/edit/{id}', [BlogController::class, 'blogPostEdit'])->name('post.edit');
    Route::post('/post/update/{id}', [BlogController::class, 'blogPostUpdate'])->name('post.update');
    Route::get('/post/delete/{id}', [BlogController::class, 'blogPostDelete'])->name('post.delete');

});

//  Frontend Blog Show Routes

Route::get('/blog', [HomeBlogController::class, 'addBlogPost'])->name('home.blog');
Route::get('/blog/details/{id}', [HomeBlogController::class, 'blogPostDetails'])->name('post.details');
Route::get('blog/category/post/{category_id}', [HomeBlogController::class, 'homeBlogCatPost']);
Route::post('/blog/post/comment/store/{post_id}', [HomeBlogController::class, 'blogPostCommentStore'])->name('blog.post.comment');


// Admin Site Setting Routes
Route::prefix('setting')->group(function(){

    Route::get('/site', [SiteSettingController::class, 'siteSetting'])->name('site.setting');
    Route::post('/site/update/{id}', [SiteSettingController::class, 'siteSettingUpdate'])->name('update.site.setting');
    Route::get('/seo', [SiteSettingController::class, 'seoSetting'])->name('seo.setting');
    Route::post('/seo/update/{id}', [SiteSettingController::class, 'seoSettingSetting'])->name('update.seo.setting');
});


// Admin Return Order Routes
Route::prefix('return')->group(function () {
    Route::get('/admin/request', [ReturnController::class, 'returnRequest'])->name('return.request');
    Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'returnRequestApprove'])->name('return.approve');
    Route::get('/admin/all/request', [ReturnController::class, 'returnAllRequest'])->name('return.all.request');
});


/// Frontend Product Review Routes
Route::post('/review/store/{product_id}', [ReviewController::class, 'reviewStore'])->name('review.store');

// Admin Manage Review Routes
Route::prefix('review')->group(function () {
    Route::get('/pending', [ReviewController::class, 'pendingReview'])->name('pending.review');
    Route::get('/approve/{id}', [ReviewController::class, 'reviewApprove'])->name('review.approve');
    Route::get('/publish', [ReviewController::class, 'publishReview'])->name('publish.review');
    Route::get('/delete/{id}', [ReviewController::class, 'deleteReview'])->name('delete.review');
});


// Admin Manage Stock Routes
Route::prefix('stock')->group(function () {
    Route::get('/product', [ProductController::class, 'productStock'])->name('product.stock');
});


// Admin User Role Routes
Route::prefix('adminuserrole')->group(function(){

    Route::get('/all', [AdminUserController::class, 'allAdminRole'])->name('all.admin.user');
    Route::get('/add', [AdminUserController::class, 'addAdminRole'])->name('add.admin.user');
    Route::post('/store', [AdminUserController::class, 'storeAdminRole'])->name('admin.user.store');
    Route::get('/store/{id}', [AdminUserController::class, 'editAdminRole'])->name('admin.user.edit');
    Route::post('/update/{id}', [AdminUserController::class, 'updateAdminRole'])->name('admin.user.update');
    Route::get('/delete/{id}', [AdminUserController::class, 'deleteAdminRole'])->name('admin.user.delete');

});

// Product Search Route
Route::match(['get', 'post'],'/search', [IndexController::class, 'productSearch'])->name('product.search');

// Product Advanced search Route
Route::post('search-product', [IndexController::class, 'advancedSearchProduct']);

// Shop page route
Route::get('/shop', [ShopController::class, 'shopPage'])->name('shop.page');
Route::post('/shop/filter', [ShopController::class, 'shopFilter'])->name('shop.filter');


//  Facebook Login Routes
Route::get('/auth/facebook', [FacebookController::class, 'redirect'])->name('facebook.login');

Route::get('/auth/facebook/callback', [FacebookController::class, 'callback']);


// Login Using Gmail

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


// Amin Post Comments All Routes
Route::prefix('post')->group(function () {
    Route::get('/pending/comment', [BlogController::class, 'pendingComment'])->name('pending.comment');
    Route::get('/publish/comment/{comment_id}', [BlogController::class, 'publishComment'])->name('publish.comment');
    Route::get('/approved/comment', [BlogController::class, 'approvedComment'])->name('approved.comment');
    Route::get('/delete/comment/{comment_id}', [BlogController::class, 'deleteComment'])->name('delete.comment');
});
