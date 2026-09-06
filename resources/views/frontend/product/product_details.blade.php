@extends('frontend.main_master')

@section('title')
    {{ $product->product_name_en }} Product Details
@endsection

@section('content')

    {{--    for rating stars review--}}
    <style>
        .checked {
            color: gold;
        }
    </style>


    <!-- ===== ======== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">Electronics</a></li>
                    <li class='active'>Floral Print Buttoned</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n">
                            <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                        </div>



                        <!-- ============================================== HOT DEALS ============================================== -->
                        <div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
                            @include('frontend.common.hot_deals')
                        </div>
                        <!-- ============================================== HOT DEALS: END ============================================== -->

                        <!-- ============================================== NEWSLETTER ============================================== -->
                        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
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
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->
                        <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                            <div id="advertisement" class="advertisement">
                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member1.png') }}" alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">John Doe	<span>Abc Company</span>	</div><!-- /.container-fluid -->
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member3.png') }}" alt="Image"></div>
                                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member2.png') }}" alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
                                </div><!-- /.item -->

                            </div><!-- /.owl-carousel -->
                        </div>

                        <!-- ============================================== Testimonials: END ============================================== -->



                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">

                                        @foreach($multiImg as $img)
                                        <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset( $img->photo_name ) }}">
                                                <img class="img-responsive" alt="" src="{{ asset( $img->photo_name ) }}" data-echo="{{ asset( $img->photo_name ) }}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                        @endforeach


                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">

                                            @foreach($multiImg as $img)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                    <img class="img-responsive" width="85" alt="" src="{{ asset( $img->photo_name ) }}" data-echo="{{ asset( $img->photo_name ) }}" />
                                                </a>
                                            </div>
                                            @endforeach

                                        </div><!-- /#owl-single-product-thumbnails -->



                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" id="pname">
                                        @if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif
                                    </h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            @php
                                                $ratingAverage = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->avg('rating');
                                            @endphp
                                            <div class="col-sm-3">
                                                @if($ratingAverage == 0)
                                                    No Rating Yet
                                                @else
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="fa fa-star {{ $ratingAverage >= $i ? 'checked' : '' }}"></span>
                                                    @endfor
                                                @endif

                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    @php
                                                        $reviewCount = \App\Models\Review::where('product_id' , $product->id)->where('status', 1)->get();
                                                    @endphp
                                                    <a href="#review" onclick="goToReviews(event)" class="lnk">({{ count($reviewCount)  }} Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">
                                                        @if($product->product_qty == 0)
                                                            <span class="text-danger">Not Available In Stock</span>
                                                        @else
                                                            <span class="text-success">Available In Stock</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        @if(session()->get('language') == 'en') {!! $product->short_descp_en !!} @else {!! $product->short_descp_ar !!} @endif
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="price-box">

                                                    @php
                                                        $amount = $product->selling_price - $product->disconut_price;
                                                        $discount = $amount/$product->selling_price *100;
                                                    @endphp

                                                    @if ($product->discount_price == NULL)
                                                        <span class="price">EGP{{ $product->selling_price }}</span>
                                                    @else
                                                        <span class="price">EGP{{ $product->discount_price }}</span>
                                                        <span class="price-strike">EGP{{ $product->selling_price }}</span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->



                                        <!-- Start Add product color and product size -->
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="info-title control-label">@if(session()->get('language') == 'en') Choose Color @else اختر اللون @endif <span>*</span></label>
                                                    <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color">

                                                        @if(session()->get('language') == 'en')
                                                            <option selected disabled>--Choose Color--</option>

                                                            @foreach($product_color_en as $color)
                                                                <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                            @endforeach
                                                        @else
                                                            <option selected disabled>-- اختر اللون --</option>

                                                            @foreach($product_color_ar as $color)
                                                                <option value="{{ $color }}">{{ $color }}</option>
                                                            @endforeach
                                                        @endif



                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">


                                                        @if($product->product_size_en == NULL)

                                                        @else
                                                            <label class="info-title control-label">@if(session()->get('language') == 'en') Choose Size @else اختر المقاس @endif  <span>*</span></label>
                                                            <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size">

                                                            @if(session()->get('language') == 'en')
                                                                <option selected disabled>--Choose Size--</option>
                                                                @foreach($product_size_en as $size)
                                                                    <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                                @endforeach
                                                            @else
                                                                <option selected disabled>-- اختر المقاس --</option>
                                                                @foreach($product_size_ar as $size)
                                                                    <option value="{{ $size }}">{{ $size }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endif


                                                    </select>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                        <!-- End Add product color and product size -->


                                    </div><!-- /.price-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" id="qty" value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="product_id" value="{{ $product->id }}">

                                            <div class="col-sm-7">
                                                @if($product->product_qty == 0)
                                                    <button disabled type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                                @else
                                                    <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                                @endif
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->


                                    <!-- start share product -->


                                        @include('frontend.common.share-horizontal')

                                    <!-- end share product -->




                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                {{--<li><a data-toggle="tab" href="#tags">TAGS</a></li>--}}
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane active">
                                        <div class="product-tab">
                                            <p class="text">@if(session()->get('language') == 'en') {!! $product->long_descp_en !!} @else {!! $product->long_descp_ar !!} @endif</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                @php
                                                    $reviews = \App\Models\Review::where('product_id', $product->id)->latest()->limit(5)->get();
                                                @endphp

                                                <div class="reviews">

                                                    @foreach($reviews as $item)
                                                        @if($item->status == 1)
                                                            <div class="review">

                                                                <div class="row">
                                                                    <div class="col-md-6">

                                                                        <img style="border-radius: 50%" src="{{ !empty($item->user->profile_photo_path) ? url('upload/user_images/'.$item->user->profile_photo_path) : url('upload/no_image.jpg') }}"  width="40px;" height="40px;" alt="">
                                                                        <b>{{ $item->user->name }}</b>


                                                                        @if($item->rating == NULL)

                                                                        @elseif($item->rating == 1)

                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 2)

                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 3)

                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 4)

                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 5)

                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>

                                                                        @endif


                                                                    </div>
                                                                    <div class="col-md-6">

                                                                    </div>
                                                                </div>

                                                                <div class="review-title"><span class="summary">{{ $item->summary }}</span><span class="date"><i class="fa fa-calendar"></i><span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span></span></div>
                                                                <div class="text">"{{ $item->comment }}"</div>
                                                            </div>
                                                        @else

                                                        @endif
                                                    @endforeach

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->



                                            <div class="product-add-review">
                                                <h4 class="title">Write your own review</h4>


                                                <div class="review-table">

                                                </div><!-- /.review-table -->

                                                    @guest()
                                                        <p><b>For Add Product Review. You need To Login First <a href="{{ route('login') }}">Login Here</a></b></p>
                                                    @else

                                                    <div class="review-form">
                                                        <div class="form-container">

                                                            <form role="form" class="cnt-form" method="POST" action="{{ route('review.store', $product->id) }}" >
                                                                @csrf

                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="cell-label">&nbsp;</th>
                                                                            <th>1 star</th>
                                                                            <th>2 stars</th>
                                                                            <th>3 stars</th>
                                                                            <th>4 stars</th>
                                                                            <th>5 stars</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <tr>
                                                                            <td class="cell-label">Quality</td>
                                                                            <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>

                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group">
                                                                            <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                            <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                            <textarea name="comment" class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                                </div><!-- /.action -->

                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->
                                                    </div><!-- /.review-form -->

                                                    @endguest





                                            </div><!-- /.product-add-review -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    {{--<div id="tags" class="tab-pane">
                                        <div class="product-tag">

                                            <h4 class="title">Product Tags</h4>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-container">

                                                    <div class="form-group">
                                                        <label for="exampleInputTag">Add Your Tags: </label>
                                                        <input type="email" id="exampleInputTag" class="form-control txt">


                                                    </div>

                                                    <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                                </div><!-- /.form-container -->
                                            </form><!-- /.form-cnt -->

                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                                </div>
                                            </form><!-- /.form-cnt -->

                                        </div><!-- /.product-tab -->
                                    </div>--}}<!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== Related PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">
                            @if(session()->get('language') == 'en') Related products @else المنتجات المرتبطة بهذه السلعة @endif
                        </h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">


                            @foreach($relatedProduct as $product)
                            <div class="item item-carousel">
                                <div class="products">


                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ url('product/details/'. $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset( $product->product_thambnail ) }}" alt=""></a>
                                            </div><!-- /.image -->

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

                                        </div><!-- /.product-image -->


                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/'. $product->id . '/' . $product->product_slug_en) }}">
                                                    @if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif
                                                </a></h3>

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

                                            <div class="product-price">
                                                @if($product->discount_price == Null)
                                                    <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                                                @else
                                                    <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                                                @endif

                                            </div><!-- /.product-price -->

                                        </div><!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>

                                                    </li>

                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                            <i class="icon fa fa-heart"></i>
                                                        </a>
                                                    </li>

                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare">
                                                            <i class="fa fa-signal"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.action -->
                                        </div><!-- /.cart -->
                                    </div><!-- /.product -->


                                </div><!-- /.products -->
                            </div><!-- /.item -->
                            @endforeach

                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== Related PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->


        </div>



        {{--
        Activate the tab

        Scroll to the reviews section
        --}}
        <script>
            function goToReviews(e) {
                e.preventDefault();

                // Find the tab link that opens #review
                const tabTrigger = document.querySelector('a[data-toggle="tab"][href="#review"]');

                if (tabTrigger) {
                    $(tabTrigger).tab('show'); // activate tab
                }

                // Scroll after opening tab
                setTimeout(() => {
                    const reviewSection = document.getElementById('review');
                    if (reviewSection) {
                        reviewSection.scrollIntoView({ behavior: 'smooth' });
                    }
                }, 200);
            }
        </script>
@endsection



