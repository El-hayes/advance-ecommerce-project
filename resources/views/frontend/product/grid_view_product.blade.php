@foreach($products as $product)
    <div class="col-sm-6 col-md-4 wow fadeInUp">
        <div class="products">
            <div class="product">
                <div class="product-image">
                    <div class="image"> <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img  src="{{ asset( $product->product_thambnail ) }}" alt=""></a> </div>
                    <!-- /.image -->


                    <!-- calculate discount -->
                    @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = $amount/$product->selling_price *100;
                    @endphp


                    @if($product->discount_price == Null)
                        <div class="tag new"><span>new</span></div>
                    @else
                        <div class="tag hot"><span>{{round($discount)}} %</span></div>
                    @endif


                </div>
                <!-- /.product-image -->

                <div class="product-info text-left">
                    <h3 class="name">
                        <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                            @if(session()->get('language') == 'en') {{ $product->product_name_en }} @else {{ $product->product_name_ar }} @endif
                        </a></h3>
                    <div class="rating rateit-small"></div>
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
                                <button class="btn btn-primary icon" data-toggle="modal" data-target="#exampleModal"
                                        type="button" id="{{ $product->id }}" onclick="productView(this.id)"
                                        {{ $product->product_qty <= 0 ? 'disabled' : '' }}>
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
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
@endforeach
