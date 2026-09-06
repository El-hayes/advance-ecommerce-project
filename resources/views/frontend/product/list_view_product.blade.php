@foreach($products as $product)
    <div class="category-product-inner wow fadeInUp">
        <div class="products">
            <div class="product-list product">
                <div class="row product-list-row">
                    <div class="col col-sm-4 col-lg-4">
                        <div class="product-image">
                            <div class="image"> <img src="{{ asset( $product->product_thambnail ) }}" alt=""> </div>
                        </div>
                        <!-- /.product-image -->
                    </div>
                    <!-- /.col -->
                    <div class="col col-sm-8 col-lg-8">
                        <div class="product-info">
                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                                    @if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif
                                </a></h3>
                            <div class="rating rateit-small"></div>

                            <!-- calculate discount -->
                            @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = $amount/$product->selling_price *100;
                            @endphp

                            @if($product->discount_price == Null)
                                <div class="product-price"> <span class="price"> EGP {{ $product->selling_price }} </span> </div>
                            @else
                                <div class="product-price"> <span class="price"> EGP {{ $product->discount_price }} </span> <span class="price-before-discount">EGP {{ $product->selling_price }}</span> </div>
                            @endif                                                            <!-- /.product-price -->
                            <div class="description m-t-10">@if(session()->get('language') == 'en') {{ $product->short_descp_en }} @else {{ $product->short_descp_ar }} @endif</div>
                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                                    id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}> <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary cart-btn" type="button"
                                                    id="{{ $product->id }}" onclick="productView(this.id)" {{ $product->product_qty <= 0 ? 'disabled' : '' }}>
                                                Add to cart
                                            </button>
                                        </li>
                                        <button  class="btn btn-primary icon" type="button" title="wishlist"
                                                 id="{{ $product->id }}" onclick="addToWishList(this.id)" > <i class="fa fa-heart"></i> </button>
                                        <li class="lnk"> <a class="add-to-cart" href="{{ url('/product/details/'. $product->id .'/' . $product->product_slug_en) }}" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                    </ul>
                                </div>
                                <!-- /.action -->
                            </div>
                            <!-- /.cart -->

                        </div>
                        <!-- /.product-info -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.product-list-row -->
                <!-- Product has discount or not -->
                @if($product->discount_price == Null)
                    <div class="tag new"><span>new</span></div>
                @else
                    <div class="tag hot"><span>{{round($discount)}} %</span></div>
                @endif                                            </div>
            <!-- /.product-list -->
        </div>
        <!-- /.products -->
    </div>
    <!-- /.category-product-inner -->
@endforeach
