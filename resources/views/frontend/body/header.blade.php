<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>@if(session()->get('language') == 'en' ) Wishlist @else المفضلة @endif</a></li>
                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>@if(session()->get('language') == 'en' ) My Cart @else عربة التسوق @endif</a></li>
                        <li><a href="{{-- route('') --}}"  type="button" data-toggle="modal" data-target="#ordertraking"><i class="icon fa fa-truck"></i>@if(session()->get('language') == 'en' ) Order Tracking @else تتبع الطلبات @endif</a></li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>@if(session()->get('language') == 'en' ) Checkout @else الدفع @endif</a></li>

                        @auth
                            <li><a href="{{ url('/user/profile') }}"><i class="icon fa fa-user"></i>@if(session()->get('language') == 'en') My Account @else الملف الشخصي @endif </a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>@if(session()->get('language') == 'en') Login/Register @else تسجيل الدخول/انشاء حساب @endif</a></li>
                        @endauth

                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">

                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value"> @if(session()->get('language') == 'en' ) Language @else اللغة @endif </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if(session()->get('language') == 'en')
                                    <li><a href="{{ route('language.arabic') }}">عربي</a></li>
                                @else
                                    <li><a href="{{ route('language.english') }}">English</a></li>
                                @endif


                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    @php
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    <div class="logo"> <a href="{{ url('/') }}"> <img src="{{asset($setting->logo)}}" alt="logo"> </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= --> </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder" style="max-width: 645px;">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="POST" action="{{ route('product.search') }}">
                            @csrf
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">@if(session()->get('language') == 'en' ) Categories @else جميع الاقسام @endif  <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu" >
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" type="text" id="search" name="search"
                                       onfocus="search_result_show()" onblur="search_result_hide()"
                                       placeholder="@if(session()->get('language') == 'en' ) Search here... @else ابحث هنا... @endif " />
                                <button type="submit" class="search-button"></button> </div>
                        </form>
                        <div id="searchProducts"></div>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row" style="min-width: 232px;">
                    <!-- =================]=========== SHOPPING CART DROPDOWN ========================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count">
                                    <span class="count"  id="cartQty" ></span>
                                </div>
                                <div class="total-price-basket">
                                    <span class="lbl">@if(session()->get('language') == 'en' ) cart  @else العربة @endif -</span>
                                    <span class="total-price"> <span class="sign">EGP </span><span class="value" id="cartSubTotal"></span> </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>

                                <!--   // Mini Cart Start with Ajax -->

                                <div id="miniCart">

                                </div>

                                <!--   // End Mini Cart Start with Ajax -->


                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span><span class="sign">EGP </span><span class='price' id="cartSubTotal"></span> </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================ SHOPPING CART DROPDOWN : END================================ --> </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ route('home') }}" >@if(session()->get('language') == 'en') Home @else الرئيسة @endif</a></li>

                                <!-- Start Get All Category data -->

                                @php
                                  $categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
                                @endphp

                                 <!-- End Get All Category data -->

                                @foreach($categories as $category)    <!-- // Start Category Foreach -->

                                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">@if(session()->get('language') == 'en' ) {{ $category->category_name_en }} @else {{ $category->category_name_ar }} @endif</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">

                                                    <!-- Start Get All SubCategory data -->

                                                    @php
                                                        $subcategories = App\Models\SubCategory::Where('category_id', $category->id)->orderBy('subcategory_name_en', 'ASC')->get();
                                                    @endphp

                                                        <!-- End Get All SubCategory data -->

                                                    @foreach($subcategories as $subcategory)  <!-- // Start SubSubCategory Foreach -->
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <a href="{{ url('subcategory/product/'. $subcategory->id . '/' . $subcategory->subcategory_slug_en) }}">
                                                        <h2 class="title">@if(session()->get('language') == 'en') {{ $subcategory->subcategory_name_en }} @else {{ $subcategory->subcategory_name_ar }} @endif</h2>
                                                        </a>
                                                        <!-- Start Get All SubSubCategory data -->

                                                        @php
                                                            $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)->orderBy('subsubcategory_name_en', 'ASC')->get();
                                                        @endphp

                                                            <!-- End Get All SubSubCategory data -->

                                                        @foreach($subsubcategories as $subsubcategory)   <!-- // Start SubSubCategory Foreach -->
                                                        <ul class="links">
                                                            <li><a href="{{ url('subsubcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en) }}">
                                                                    @if(session()->get('language') == 'en') {{ $subsubcategory->subsubcategory_name_en }} @else {{ $subsubcategory->subsubcategory_name_ar }} @endif
                                                                </a></li>
                                                        </ul>
                                                        @endforeach   <!-- // End SubSubCategory Foreach -->

                                                    </div>
                                                    <!-- /.col -->
                                                    @endforeach    <!-- // End SubSubCategory Foreach -->


{{--                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>--}}
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach  <!-- // End Category Foreach -->


                                <li class="dropdown "> <a href="{{ route('shop.page') }}">@if(session()->get('language') == 'en') Shop @else تسوق @endif</a> </li>


{{--                                <li class="dropdown  navbar-right special-menu"> <a href="#">@if(session()->get('language') == 'en') Todays offer @else عرض اليوم @endif</a> </li>--}}
                                <li class="dropdown  navbar-right special-menu"> <a href="{{ route('home.blog') }}">@if(session()->get('language') == 'en') Blog @else مدونة @endif</a> </li>

                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->


    <!-- Load Order Tracking Modal-->

    <!-- Modal -->
    <div class="modal fade" id="ordertraking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Track Your Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('order.tracking') }}">
                        @csrf
                        <div class="modal-body">
                            <label>Invoice Code</label>
                            <input type="text" name="code" required="" class="form-control" placeholder="Your Order Invoice Number">
                        </div>

                        <button class="btn btn-danger" type="submit" style="margin-left: 17px;"> Track Now </button>

                    </form>

                </div>

            </div>
        </div>
    </div>



</header>


{{--Advanced Search style--}}
<style>

    .search-area{
        position: relative;
    }

    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }


</style>

<script>
    function search_result_hide(){
        setTimeout(function(){
            $("#searchProducts").slideUp();
        }, 200);
    }

    function search_result_show(){
        $("#searchProducts").slideDown();
    }
</script>
