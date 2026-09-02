<!DOCTYPE html>
<html lang="en">
@php
    $seo = App\Models\Seo::find(1);
@endphp
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{ $seo->meta_author }}">
    <meta name="keywords" content="{{ $seo->meta_keyword }}">
    <meta name="robots" content="all">

    <!-- /// Google Analytics Code // -->
    <script>
        {{ $seo->google_analytics }}
    </script>
    <!-- /// Google Analytics Code // -->


    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->

    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/bootstrap-select.min.css') }}">
    <link href="{{ asset('frontEnd/assets/css/lightbox.css') }}" rel="stylesheet">


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/font-awesome.css') }}">
    <!-- font awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://js.stripe.com/clover/stripe.js"></script>

</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')
<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontEnd/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/echo.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/jquery.rateit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontEnd/assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('frontEnd/assets/js/scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    @if(Session::has('message'))
    var   type = "{{ Session::get('alert-type', 'info') }}"
    switch (type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>



<!-- Add to Cart Product Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" ><strong><span id="pname"></span></strong></h5>
        <button type="button" class="close" data-dismiss="modal" id="closeModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">

              <div class="col-md-4">
                <div class="card" style="width: 18rem; margin: auto;">
                  <img src=" " id="pimage" class="card-img-top" alt="..." style="width: 200px; height: 200px;">

                </div>
              </div><!-- // end col md -->

              <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">Product Price: <strong class="text-danger">
                                $<span id="pprice"></span></strong><del id="oldprice">$</del>
                        </li>
                        <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                        <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                        <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                        <li class="list-group-item">Stock: <span class="badge badge-pill badge-success" id="aviable" style="background: green; color: white;">
                            </span><span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;"></span>
                        </li>
                    </ul>
              </div><!-- // end col md -->

              <div class="col-md-4">

                <div class="form-group">
                    <label for="color">Choose Color </label>
                    <select class="form-control" id="color" name="color">
                    </select>
                </div>

                  <div class="form-group" id="sizeArea">
                    <label for="size">Choose Size </label>
                    <select class="form-control" id="size" name="size">
                    </select>
                </div>

                  <div class="form-group">
                    <label for="qty">Quantity </label>
                    <input type="number" class="form-control" id="qty" value="1" min="1">
                  </div>

                    <!-- to send id  -->
                    <input type="hidden" name="product_id" id="product_id">
                    <button type="submit" class="btn btn-primary" onclick="addToCart()">Add To Cart</button>


              </div><!-- // end col md -->

          </div>
      </div>

    </div>
  </div>
</div>
<!-- Add to Cart Product Modal -->

<script type="text/javascript">

    // Add CSRF token to all AJAX requests
    $.ajaxSetup({
        headers: {
            // Get CSRF token from meta tag
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    // Start Product View with Modal
        function productView(id){
        // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/'+id,
                dataType: 'json',

                success:function (data){
                    // console.log(data)
                    $('#pname').text(data.product.product_name_en);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name_en);
                    $('#pbrand').text(data.product.brand.brand_name_en);
                    $('#pimage').attr('src', '/'+data.product.product_thambnail);

                    $('#product_id').val(id);
                    $('#qty').val(1);


                    // Product Price
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);


                    }else{
                        $('#pprice').text(data.product.discount_price + " ");
                        $('#oldprice').text(data.product.selling_price);

                    } // end prodcut price

                    // Start Stock opiton

                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('available');

                    }else{
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    } // end Stock Option


                    // Color
                    $('select[name="color"]').empty();
                    $.each(data.color, function (key, value){
                        $('select[name="color"]').append('<option value="'+ value +'">' + value + '</option>');
                    }) // End Color

                    // Size
                    $('select[name="size"]').empty();
                    $.each(data.size, function (kwy, value){
                        $('select[name="size"]').append('<option value="'+ value +'">' + value + '</option>');

                        if(data.size == ""){
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }

                    }); // End size





                }
            });


    }
    // End Product View with Modal


    // Start Add To Cart Product

    function addToCart() {
        let product_name = $('#pname').text();
        let id = $('#product_id').val();
        let color = $('#color option:selected').text();
        let size = $('#size option:selected').text();
        let quantity = $('#qty').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                product_name:product_name, color:color, size:size, quantity:quantity
            },

            url: "/cart/data/store/"+id,

            success:function (data){
                miniCart();

                $('#closeModal').click();
                // console.log(data)

                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    });

                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    });
                }
                // End Message
            }

        });
    }

    // End Add To Cart Product


</script>

<!-- Start Minicart function -->
<script type="text/javascript">
    function miniCart() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/product/mini/cart",

            success:function (response) {
                // console.log(response)
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

                let miniCart = "";

                $.each(response.carts, function (key, value){

                    miniCart += `
                        <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                            <div class="price">${value.price} * ${value.qty}</div>
                                        </div>
                                        <div class="col-xs-1 action">
                                            <button type="submit"  id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>`;

                });
                $('#miniCart').html(miniCart);
            }

        });

    } //  Mini cart End

    miniCart();


    // Start Delete product from mini cart
    function miniCartRemove(rowId){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/minicart/product-remove/"+rowId,

            success:function (data) {
                miniCart();

                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                }

                // End Message

            }
        });
    }

    // End Delete product from mini cart

</script>

<script type="text/javascript">  <!-- Start Add To WishList -->
    function addToWishList(id) {
        $.ajax({
            type: "POST",
            url: "/add-to-wishlist/"+id,
            dataType: "json",

            success:function (data) {
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message
            }

        });
    }

</script> <!-- End Add To WishList -->

{{--Start Load Wishlist Data--}}
<script type="text/javascript">
    function wishlist() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/user/get-wishlist-product',

            success:function (response) {
                // console.log(data);
                let rows = '';
                $.each(response, function (key, value) {
                    rows +=  `
                        <tr>
                                    <td class="col-md-2"><img src="/${ value.product.product_thambnail }" alt="imga"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="#">${ value.product.product_name_en }</a></div>

                                        <div class="price">
                                            ${ value.product.discount_price == null
                                                ? `${value.product.selling_price}`
                                                : `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                                            }
                                        </div>


                                    </td>
                                    <td class="col-md-2">
                                         <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"
                                              id="${ value.product_id }" onclick="productView(this.id)" >Add to cart  <i class="fa fa-shopping-cart"></i> </button>

                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button id="${ value.id }" onclick="wishlistRemove(this.id)" class=""><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                    `;
                });

                $('#wishlist').html(rows);

            }
        });
    }

    wishlist();

    // Start Remove Wishlist product
    function wishlistRemove(id) {
        $.ajax({
            type: 'GET',
            url: '/user/wishlist-remove/'+id,
            dataType:'json',

            success:function (data) {
                wishlist(); // call function to update page without refresh

                // Start Message More actions
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message
            }

        });
    }
    // End start Remove Wishlist product

</script>
<!-- End Load Wishlist Data-->



{{--Start Load MyCart Page--}}
<script type="text/javascript">
    function cart() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/user/get-cart-product',

            success:function (response) {
                // console.log(data);
                let rows = '';
                $.each(response.carts, function (key, value) {
                    rows +=  `
                        <tr>
                                    <td class="col-md-2"><img src="/${ value.options.image }" alt="imga"  style="width:60px; height:60px;"></td>
                                    <td class="col-md-2">
                                        <div class="product-name"><a href="#">
                                            ${ value.name }</a>
                                        </div>

                                        <div class="price">
                                            ${value.price}
                                        </div>
                                    </td>

                                    <td class="col-md-2">
                                        <strong>${value.options.color} </strong>
                                    </td>

                                    <td class="col-md-2">
                                      ${value.options.size == null
                                                    ? `<span> .... </span>`
                                                    :
                                                    `<strong>${value.options.size} </strong>`
                                                }
                                      </td>

                                      <td class="col-md-2">
                                        ${
                                            value.qty > 1
                                            ? `<button type="submit" class="btn btn-danger btn-sm" id="${ value.rowId }" onclick="decrement(this.id)">-</button>`
                                            : `<button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                                        }

                                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" class="text-center" >
                                        <button type="submit" class="btn btn-success btn-sm" id="${ value.rowId }" onclick="increment(this.id)">+</button>
                                      </td>

                                      <td class="col-md-2">
                                        <strong>EGP ${value.subtotal} </strong>
                                       </td>

                                    <td class="col-md-1 close-btn">
                                        <button id="${ value.rowId }" onclick="cartRemove(this.id)" class=""><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                    `;
                });

                $('#cartPage').html(rows);

            }
        });
    }

    cart();

    // Start Remove cart product
    function cartRemove(id) {
        $.ajax({
            type: 'GET',
            url: '/user/cart-remove/'+id,
            dataType:'json',

            success:function (data) {
                couponCalculation();
                cart(); // call function to update page without refresh
                miniCart();
                $('#couponField').show();
                $('#coupon_name').val('');

                // Start Message More actions
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message
            }

        });
    }
    // End start Remove Cart product

    //Start increment product qty
    function increment(id) {
        $.ajax({
            type: 'GET',
            url: '/cart-increment/'+id,
            dataType:'json',

            success:function(response){
                miniCart();
                cart();
                couponCalculation();

            }

        });
    }
    // End increment product qty

    //Start decrement product qty
    function decrement(id) {
        $.ajax({
            type: 'GET',
            url: '/cart-decrement/'+id,
            dataType:'json',

            success:function(response){
                miniCart();
                cart();
                couponCalculation();

            }

        });
    }
    // End decrement product qty

</script>
{{-- End Load MyCart Page --}}


<!--  //////////////// =========== Coupon Apply Start ================= ////  -->
<script type="text/javascript">
    function applyCoupon()
    {
        let coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: { coupon_name:coupon_name },
            url: "{{ url('/coupon-apply') }}",

            success:function (data){
                couponCalculation();
                if(data.success){
                    $('#couponField').hide();
                }


                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message

            }
        });
    }


    function couponCalculation(){
        $.ajax({
            type: 'GET',
            url: '{{ url('/coupon-calculation') }}',
            dataType: 'json',

            success:function (data) {

                if(data.total) {
                    $('#couponCalField').html(
                        `<tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">$ ${ data.total }</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">$ ${ data.total }</span>
                                    </div>
                                </th>
                            </tr>
                        `
                    );
                } else {

                    $('#couponCalField').html(
                        `<tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">$ ${ data.subtotal }</span>
                                    </div>

                                    <div class="cart-sub-total">
                                        Coupon<span class="inner-left-md">${ data.coupon_name }</span>
                                        <button title="Remove Coupon" onclick="removeCoupon()"><i class="fa fa-times"></i></button>
                                    </div>

                                    <div class="cart-sub-total">
                                        Discont Amount<span class="inner-left-md">$ ${ data.discount_amount }</span>
                                    </div>

                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">$ ${ data.total_amount }</span>
                                    </div>
                                </th>
                            </tr>
                        `
                    );

                }

            }
        });


    } /// End function

    couponCalculation();
</script>
<!--  //////////////// =========== Coupon Apply End ================= ////  -->



<!--  //////////////// =========== Start Coupon Remove ================= ////  -->
<script type="text/javascript">
    function removeCoupon(){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: "{{ url('/remove-coupon') }}",

            success:function (data){
                couponCalculation();
                $('#couponField').show();
                $('#coupon_name').val('');

                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message
            }

        });
    } // End method
</script>
<!--  //////////////// =========== End Coupon Remove ================= ////  -->





</body>
</html>
