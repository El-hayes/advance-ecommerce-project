@extends('frontend.main_master')

@section('title')
    Home Easy Online Shop
@endsection



@section('content')
    {{--    for rating stars review--}}
    <style>
        .checked {
            color: gold;
        }
    </style>


    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('frontend.common.vertical_menu')
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS ============================================== -->
                    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                        @include('frontend.common.hot_deals')
                    </div>
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== SPECIAL OFFER ============================================== -->

                    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'en') Special Offer @else عرض خاص @endif</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">


                                <div class="item">
                                    <div class="products special-product">

                                        @foreach($special_offer as $product)
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"> <img src="{{ asset($product->product_thambnail) }}" alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en')
                                                                        {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif</a>
                                                            </h3>

                                                            <!--Rating-->
                                                            <div >
                                                                @php
                                                                    $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                                @endphp
                                                                @if($ratingAverage == 0)
                                                                    No Rating Yet
                                                                @else
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                                    @endfor
                                                                @endif
                                                            </div>

                                                            <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <!-- End product -->
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Item -->



                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->


                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    @include('frontend.common.product_tags')
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->


                    <!-- ============================================== SPECIAL DEALS ============================================== -->

                    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'en') Special Deals @else عروض خاصة @endif</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">


                                <div class="item">
                                    <div class="products special-product">

                                        @foreach($special_deals as $product)
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"> <img src="{{ asset($product->product_thambnail) }}"  alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en')
                                                                        {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif</a>
                                                            </h3>

                                                            <!--Rating-->
                                                            <div >
                                                                @php
                                                                    $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                                @endphp
                                                                @if($ratingAverage == 0)
                                                                    No Rating Yet
                                                                @else
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                                    @endfor
                                                                @endif
                                                            </div>

                                                            <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>  <!-- End product -->
                                        @endforeach

                                    </div>
                                </div> <!-- End item -->

                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
                        <h3 class="section-title">Newsletters</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                                </div>
                                <button class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ==================== Start Testimonials============================== -->

                    @include('frontend.common.testimonials')

                    <!-- ================ Testimonials: END ======================= -->

                    <div class="home-banner"> <img src="{{ asset('frontEnd/assets/images/banners/LHS-banner.jpg') }}" alt="Image"> </div>
                </div>
                <!-- /.sidemenu-holder -->
                <!-- ============================================== SIDEBAR : END ============================================== -->

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                            @foreach($sliders as $slider) <!-- Start foreach slider -->
                            <div class="item" style="background-image: url({{ asset( $slider->slider_img ) }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="big-text fadeInDown-1"> {{ $slider->title }} </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a href="#" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->
                            @endforeach <!-- End Foreach Slider -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                    <!-- ============================================== INFO BOXES ============================================== -->
                    <div class="info-boxes wow fadeInUp">
                        <div class="info-boxes-inner">
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">money back</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">30 Days Money Back Guarantee</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="hidden-md col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">free shipping</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Shipping on orders over $99</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Special Sale</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Extra $5 off on all items </h6>
                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.info-boxes-inner -->

                    </div>
                    <!-- /.info-boxes -->
                    <!-- ============================================== INFO BOXES : END ============================================== -->
                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">@if(session()->get('language') == 'en' ) New Products @else المنتجات الجديدة @endif</h3>
                            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">@if(session()->get('language') == 'en' ) All @else الكل @endif</a></li>

                                @foreach($categories as $category)
                                <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">@if(session()->get('language') == 'en' ) {{ $category->category_name_en  }} @else {{ $category->category_name_ar  }} @endif </a></li>
                                @endforeach

                                {{--<li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                                <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>--}}
                            </ul>
                            <!-- /.nav-tabs -->
                        </div>

                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                        @foreach($products as $product )    <!-- Start Get product foreach -->
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                                        <!-- /.image -->

                                                        <!-- calculate discount -->
                                                        @php
                                                            $amount = $product->selling_price - $product->discount_price;
                                                            $discount = $amount/$product->selling_price *100;
                                                        @endphp

                                                        <!-- Product has discount or not -->
                                                        @if($product->discount_price == Null)
                                                            <div class="tag new"><span>new</span></div>
                                                        @else
                                                            <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                                        @endif


                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif </a></h3>

                                                        <div >
                                                            @php
                                                                $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                            @endphp
                                                            @if($ratingAverage == 0)
                                                                No Rating Yet
                                                            @else
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                                @endfor
                                                            @endif
                                                        </div>
                                                        <div class="description"></div>
                                                        @if($product->discount_price == Null)
                                                            <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                                        @else
                                                            <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                                        @endif
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                            id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                </li>

                                                                <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                                         id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        <!-- /.item -->
                                        @endforeach   <!-- End Get product foreach -->


                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->

                            <!-- End All category -->






                            <!-- start select define category -->

                            @foreach($categories as $category)
                            <div class="tab-pane" id="category{{$category->id }}">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">


                                        <!-- start Get category wise product -->
                                        @php
                                        $catwiseproduct = App\Models\Product::where('category_id', $category->id)->orderBy('id', 'DESC')->get();

                                        @endphp
                                        <!-- End Get category wise product -->


                                        @forelse($catwiseproduct as $product )    <!-- Start Get product foreach -->
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                                        <!-- /.image -->

                                                        <!-- calculate discount -->
                                                        @php
                                                            $amount = $product->selling_price - $product->discount_price;
                                                            $discount = $amount/$product->selling_price *100;
                                                        @endphp

                                                            <!-- Product has discount or not -->
                                                        @if($product->discount_price == Null)
                                                            <div class="tag new"><span>new</span></div>
                                                        @else
                                                            <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif</a></h3>


                                                        <!--Rating-->
                                                        <div >
                                                            @php
                                                                $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                            @endphp
                                                            @if($ratingAverage == 0)
                                                                No Rating Yet
                                                            @else
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                                @endfor
                                                            @endif
                                                        </div>

                                                        <div class="description"></div>

                                                        @if($product->discount_price == Null)
                                                            <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                                        @else
                                                            <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                                        @endif                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                            id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                </li>

                                                                <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                                         id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>

                                        @empty
                                            <h5 class="text-danger">No Product Found</h5>

                                        <!-- /.item -->
                                        @endforelse   <!-- End Get product foreach -->


                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->




                            @endforeach

                            <!-- End select define category -->






                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.scroll-tabs -->
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive" src="{{ asset('frontEnd/assets/images/banners/home-banner1.jpg') }}" alt=""> </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-5 col-sm-5">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive" src="{{ asset('frontEnd/assets/images/banners/home-banner2.jpg') }}" alt=""> </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->

                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'en') Featured products @else المنتجات المميزة @endif</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                            {{-- <!-- Start Item -->--}}
                            @foreach($featured as $product )    {{--<!-- Start Get Featured product foreach -->--}}
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                            <!-- /.image -->

                                            <!-- calculate discount -->
                                            @php
                                                $amount = $product->selling_price - $product->discount_price;
                                                $discount = $amount/$product->selling_price *100;
                                            @endphp

                                                <!-- Product has discount or not -->
                                            @if($product->discount_price == Null)
                                                <div class="tag new"><span>new</span></div>
                                            @else
                                                <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                            @endif


                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif </a></h3>

                                            <!--Rating-->
                                            <div >
                                                @php
                                                    $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                @endphp
                                                @if($ratingAverage == 0)
                                                    No Rating Yet
                                                @else
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                    @endfor
                                                @endif
                                            </div>

                                            <div class="description"></div>
                                            @if($product->discount_price == Null)
                                                <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                            @else
                                                <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                            @endif
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>

                                                    <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                            id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button"> Add to cart </button>

                                                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->
                            @endforeach   <!-- End Get Featured product foreach -->
                            <!-- /.item -->


                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->


                    <!-- == === skip_product_0 PRODUCTS == Start ==== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'en') {{ $skip_category_0->category_name_en }} @else {{ $skip_category_0->category_name_ar }} @endif</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                            <!-- Start Item -->
                            @foreach($skip_product_0 as $product )    <!-- Start Get Featured product foreach -->
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                            <!-- /.image -->

                                            <!-- calculate discount -->
                                            @php
                                                $amount = $product->selling_price - $product->discount_price;
                                                $discount = $amount/$product->selling_price *100;
                                            @endphp

                                                <!-- Product has discount or not -->
                                            @if($product->discount_price == Null)
                                                <div class="tag new"><span>new</span></div>
                                            @else
                                                <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                            @endif


                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif </a></h3>


                                            <!--Rating-->
                                            <div >
                                                @php
                                                    $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                @endphp
                                                @if($ratingAverage == 0)
                                                    No Rating Yet
                                                @else
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                    @endfor
                                                @endif
                                            </div>

                                            <div class="description"></div>
                                            @if($product->discount_price == Null)
                                                <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                            @else
                                                <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                            @endif
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>

                                                    <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                             id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->
                            @endforeach   <!-- End Get Featured product foreach -->
                            <!-- /.item -->


                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- == === skip_product_0 PRODUCTS == End ==== -->






                    <!-- == === skip_product_1 PRODUCTS == Start ==== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'en') {{ $skip_category_1->category_name_en }} @else {{ $skip_category_1->category_name_ar }} @endif</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                            <!-- Start Item -->
                            @foreach($skip_product_1 as $product )    <!-- Start Get Featured product foreach -->
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                            <!-- /.image -->

                                            <!-- calculate discount -->
                                            @php
                                                $amount = $product->selling_price - $product->discount_price;
                                                $discount = $amount/$product->selling_price *100;
                                            @endphp

                                                <!-- Product has discount or not -->
                                            @if($product->discount_price == Null)
                                                <div class="tag new"><span>new</span></div>
                                            @else
                                                <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                            @endif


                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif </a></h3>


                                            <!--Rating-->
                                            <div >
                                                @php
                                                    $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                @endphp
                                                @if($ratingAverage == 0)
                                                    No Rating Yet
                                                @else
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                    @endfor
                                                @endif
                                            </div>

                                            <div class="description"></div>
                                            @if($product->discount_price == Null)
                                                <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                            @else
                                                <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                            @endif
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>

                                                    <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                             id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->
                            @endforeach   <!-- End Get Featured product foreach -->
                            <!-- /.item -->


                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- == === skip_product_1 PRODUCTS == End ==== -->






                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive" src="{{ asset('frontEnd/assets/images/banners/home-banner.jpg') }}" alt=""> </div>
                                    <div class="strip strip-text">
                                        <div class="strip-inner">
                                            <h2 class="text-right">New Mens Fashion<br>
                                                <span class="shopping-needs">Save up to 40% off</span></h2>
                                        </div>
                                    </div>
                                    <div class="new-label">
                                        <div class="text">NEW</div>
                                    </div>
                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->




                    <!-- == === skip define brand PRODUCTS == Start ==== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'en') {{ $skip_brand_1->brand_name_en }} @else {{ $skip_brand_1->brand_name_ar }} @endif</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                            <!-- Start Item -->
                            @foreach($skip_brand_product_1 as $product )    <!-- Start Get Featured product foreach -->
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                            <!-- /.image -->

                                            <!-- calculate discount -->
                                            @php
                                                $amount = $product->selling_price - $product->discount_price;
                                                $discount = $amount/$product->selling_price *100;
                                            @endphp

                                                <!-- Product has discount or not -->
                                            @if($product->discount_price == Null)
                                                <div class="tag new"><span>new</span></div>
                                            @else
                                                <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                            @endif


                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif </a></h3>


                                            <!--Rating-->
                                            <div >
                                                @php
                                                    $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                @endphp
                                                @if($ratingAverage == 0)
                                                    No Rating Yet
                                                @else
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                    @endfor
                                                @endif
                                            </div>

                                            <div class="description"></div>
                                            @if($product->discount_price == Null)
                                                <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                            @else
                                                <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                            @endif
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>

                                                    <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                             id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->
                            @endforeach   <!-- End Get Featured product foreach -->
                            <!-- /.item -->


                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- == === skip define brand PRODUCTS == End ==== -->





                    <!-- ============================================== BEST SELLER ============================================== -->

                    <div class="best-deal wow fadeInUp outer-bottom-xs">
                        <h3 class="section-title">Best seller</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">

                                @foreach($bestSellerProducts->chunk(2) as $chunk)

                                <div class="item">

                                    <div class="products best-product">

                                        @foreach($chunk as $product)
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image">
                                                                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                                                                        <img src="{{ asset($product->product_thambnail) }}" alt="">
                                                                    </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name">
                                                                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                                                                        @if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif
                                                                    </a>
                                                                </h3>

                                                                <!--Rating-->
                                                                <div >
                                                                    @php
                                                                        $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                                    @endphp
                                                                    @if($ratingAverage == 0)
                                                                        No Rating Yet
                                                                    @else
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                                        @endfor
                                                                    @endif
                                                                </div>

                                                                <div class="product-price"> <span class="price">EGP {{ $product->selling_price }} </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                        <h3 class="section-title">latest form blog</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">

                                @foreach($blogPost as $blog)
                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a href="{{ route('post.details', $blog->id) }}"><img src="{{ asset($blog->post_image) }}" alt=""></a> </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a href="{{ route('post.details', $blog->id) }}">{{ (Session()->get('language') == 'en') ?  $blog->post_title_en : $blog->post_title_ar  }}</a></h3>
                                                <span class="info">{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} </span>
                                                <p class="text">{!! (Session()->get('language') == 'en') ?  Str::limit($blog->post_details_en , 100) : Str::limit($blog->post_details_ar , 100)  !!}</p>
                                                <a href="{{ route('post.details', $blog->id) }}" class="lnk btn btn-primary">{{ (session()->get('language') == 'en' ) ? 'Read More' : 'أقرا المزيد' }}</a> </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach










                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== Mobile Phones PRODUCTS ============================================== -->
                    <section class="section wow fadeInUp new-arriavls">
                        <h3 class="section-title">{{ (session()->get('language') == 'en') ? 'Mobile Phones' : 'التليفونات المحمولة' }}</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                            @foreach($mobile_phones_product as $product)


                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                                                        <img  src="{{ asset($product->product_thambnail) }}" alt="">
                                                    </a>
                                                </div>
                                                <!-- /.image -->

                                                <!-- Discount Calculation -->
                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = $amount/$product->selling_price *100;
                                                @endphp

                                                    <!-- Product has discount or not -->
                                                @if($product->discount_price == Null)
                                                    <div class="tag new"><span>new</span></div>
                                                @else
                                                    <div class="tag hot"><span>{{round($discount)}} %</span></div>
                                                @endif

                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                                                        {{ (session()->get('language') == 'en') ? $product->product_name_en : $product->product_name_en }}
                                                    </a>
                                                </h3>

                                                <div >
                                                    @php
                                                        $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                                    @endphp
                                                    @if($ratingAverage == 0)
                                                        No Rating Yet
                                                    @else
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                        @endfor
                                                    @endif
                                                </div>

                                                <div class="description"></div>
                                                @if($product->discount_price == Null)
                                                    <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                                @else
                                                    <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                                @endif
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                                    id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                        </li>

                                                        <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                                 id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>

                                                        <li class="lnk"> <a class="add-to-cart" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                            <!-- /.item -->
                        @endforeach

                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                </div>
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>

@endsection
