<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Easy Online Shop</title>

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

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontEnd/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
</body>
</html>
