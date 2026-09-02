@extends('frontend.main_master')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @section('title')
        My Checkout
    @endsection

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Checkout</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">


                                <div id="collapseOne" class="panel-collapse collapse in">

                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">

                                            <!-- guest-login -->


                                                <form class="register-form" action="{{ route('checkout.store') }}" method="POST">
                                                    @csrf
                                                    <div class="col-md-6 col-sm-6 already-registered-login">
                                                        <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                                        <div class="form-group">
                                                            <label class="info-title" for="exampleInputEmail1">Shipping Name <span>*</span></label>
                                                            <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{ Auth::user()->name }}" required="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                                            <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{ Auth::user()->email }}" required="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                                                            <input type="number" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{ Auth::user()->phone }}" required="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="info-title" for="exampleInputEmail1">Post Code <span>*</span></label>
                                                            <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required="">
                                                        </div>

                                                    </div>



                                                    <div class="col-md-6 col-sm-6 already-registered-login">

                                                        <div class="form-group">
                                                            <h5><b>Division Select </b><span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="division_id" class="form-control"  >
                                                                    <option value="" selected="" disabled="">Select Division</option>
                                                                    @foreach($divisions as $division)
                                                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- End form group -->

                                                        <div class="form-group">
                                                            <h5><b>District Select </b> <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="district_id" id="district_id" class="form-control"  >
                                                                    <option value="" selected="" disabled="">Select District</option>

                                                                </select>
                                                                @error('district_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- End form group -->

                                                        <div class="form-group">
                                                            <h5><b>State Select</b> <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="state_id" class="form-control" required="" >
                                                                    <option value="" selected="" disabled="">Select State</option>

                                                                </select>
                                                                @error('state_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- // end form group -->

                                                        <div class="form-group">
                                                            <h5><b>Notes </b> <span class="text-danger">*</span></h5>
                                                            <textarea class="form-control" name="notes" cols="30" rows="5" placeholder="Write notes"></textarea>
                                                        </div> <!-- End form group -->






                                                    </div> <!-- End Col-md-6 -->


                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->


                        </div><!-- /.checkout-steps -->
                    </div>
                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach($carts as $item)
                                                <li>
                                                    <strong>Image: </strong>
                                                    <img src="{{ asset($item->options->image) }}" style="height: 50px; width: 50px;" alt="Product Image">
                                                </li>

                                                <br/>

                                                <li>
                                                    <strong>Qty: </strong>
                                                    ({{ $item->qty }})

                                                    <strong> Color: </strong>
                                                    {{ $item->options->color }}

                                                    <strong> Size: </strong>
                                                    {{ $item->options->size }}
                                                </li>
                                            @endforeach

                                                <hr/>

                                                <li>
                                                    @if(Session::has('coupon'))

                                                        <strong>SubTotal: </strong> ${{ $cartTotal }} <hr>

                                                        <strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name'] }}
                                                        ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                                        <hr>

                                                        <strong>Coupon Discount : </strong> ${{ session()->get('coupon')['discount_amount'] }}
                                                        <hr>

                                                        <strong>Grand Total : </strong> ${{ session()->get('coupon')['total_amount'] }}
                                                        <hr  style="height:2px;border-width:0;color:#108bea;background-color:#108bea">


                                                    @else

                                                        <strong>SubTotal: </strong> ${{ $cartTotal }} <hr>

                                                        <strong>Grand Total : </strong> ${{ $cartTotal }} <hr>


                                                    @endif

                                                </li>



                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->

                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="">Stripe</label>
                                            <input type="radio" name="payment_method" value="stripe">
                                            <img src="{{ asset('frontEnd\assets\images\payments\4.png') }}" alt="">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="">Card</label>
                                            <input type="radio" name="payment_method" value="card">
                                            <img src="{{ asset('frontEnd\assets\images\payments\3.png') }}" alt="">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="">Cash</label>
                                            <input type="radio" name="payment_method" value="cash">
                                            <img src="{{ asset('frontEnd\assets\images\payments\6.png') }}" alt="">
                                        </div>


                                    </div>  <!-- End Row -->

                                    <hr>
                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>

                                </div>
                            </div>
                        </div>

                    </div>

                    </form>

                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->



            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div><!-- /.body-content -->


    <!--   Fetch District  for a specific Division -->

    <script type="text/javascript">


        $(document).ready(function() {
            // Handle division change
            $('select[name="division_id"]').on('change', function(){
                let division_id = $(this).val();
                if(division_id) {
                    $.ajax({
                        url: "{{  url('/district-get/ajax') }}/"+division_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('select[name="state_id"]').empty();
                            let d =$('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            // End Fetch District  for a specific Division

            //  Start Fetch state  for a specific district
            $('select[name="district_id"]').on('click', function()
                {
                    let district_id = $(this).val();
                    if (district_id) {
                        $.ajax({
                            url: "{{ url('/state-get/ajax') }}/"+district_id,
                            type: "GET",
                            dataType: "json",

                            success:function(data) {
                                let d =$('select[name="state_id"]').empty();
                                $.each(data, function (key, value) {
                                    $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                                });
                            },
                        });
                    } else  {
                        alert('danger')
                    }

                });
              // End Fetch state  for a specific district

        });
    </script>










@endsection
