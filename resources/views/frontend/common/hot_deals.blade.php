@php
$hot_deals = App\Models\Product::where('hot_deals', 1)->where('discount_price', '!=' , NULL)
                                ->orderBy('id', 'DESC')->limit('3')->get();
@endphp

    <h3 class="section-title">@if(session()->get('language') == 'en') hot deals @else العروض الساخنة @endif</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">

        @foreach($hot_deals as $product)
            <div class="item">
                <div class="products">
                    <div class="hot-deal-wrapper">
                        <div class="image">
                            <a href="{{ url('product/details/'. $product->id . '/' . $product->product_slug_en) }}">
                                <img src="{{ asset($product->product_thambnail) }}" alt="">
                            </a>
                        </div>

                        <!-- calculate discount rate  -->
                        @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ( $amount / $product->selling_price ) * 100 ;
                        @endphp

                        @if($product->discount_price == NULL)
                            <div class="sale-offer-tag" style="background: #46aad7; line-height: 30px; "><span>new</span></div>
                        @else
                            <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>off</span></div>
                        @endif



                        <div class="timing-wrapper">
                            <div class="box-wrapper">
                                <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                            </div>
                            <div class="box-wrapper">
                                <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                            </div>
                            <div class="box-wrapper">
                                <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                            </div>
                            <div class="box-wrapper hidden-md">
                                <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.hot-deal-wrapper -->

                    <div class="product-info text-left m-t-20">
                        <h3 class="name"><a href="{{ url('product/details/'. $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'en')
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

                        @if ($product->discount_price == NULL)
                            <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span>  </div>
                        @else
                            <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span class="price-before-discount">${{ $product->selling_price }}</span> </div>
                        @endif
                        <!-- /.product-price -->

                    </div>
                    <!-- /.product-info -->

                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <div class="add-cart-button btn-group">
                                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                        id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i>
                                </button>
                                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary cart-btn" type="button"
                                        id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}>
                                    Add to cart
                                </button>
                            </div>
                        </div>
                        <!-- /.action -->
                    </div>
                    <!-- /.cart -->
                </div>
            </div>
            <!-- Item -->
        @endforeach


    </div>
    <!-- /.sidebar-widget -->

