@extends('frontend.main_master')

@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>Login</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Sign in</h4>
                        <p class="">Hello, Welcome to your account.</p>
                        <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div>


                        <form class="register-form outer-top-xs" role="form" method="POST" action="{{ isset($guard) ? url($guard.'/login'): route('login') }}">
                            @csrf


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" id="email" name="email" class="form-control unicase-form-control text-input" required autofocus autocomplete="email">
                                <!-- Display specific error for email -->
                                @error('email')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" required >
                                <!-- Display specific error for password -->
                                @error('password')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="radio outer-xs">
                                <label>
                                    <input type="radio" id="remember_me" name="remember" value="option2">Remember me!
                                </label>
                                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        </form>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Create a new account</h4>
                        <p class="text title-tag-line">Create your new account.</p>
                        <form class="register-form outer-top-xs" method="POST" action="{{ route('register') }}" role="form">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                <input type="text" id="name" name="name" class="form-control unicase-form-control text-input">
                                <!-- Display specific error for name -->
                                @error('name')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" id="email" name="email" class="form-control unicase-form-control text-input" >
                                <!-- Display specific error for email -->
                                @error('email')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control unicase-form-control text-input">
                                <!-- Display specific error for phone -->
                                @error('phone')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                                <input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
                                <!-- Display specific error for password -->
                                @error('password')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input">
                                <!-- Display specific error for password confirmation -->
                                @error('password_confirmation')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->

            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
