@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">

                {{--   Include user sidebar--}}
                @include('frontend.common.user_sidebar')


                <div class="col-md-2"></div>

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center" >Hi...<span class="text-danger"><strong>{{ Auth::user()->name }}</strong></span> Welcome to easy online shop </h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        if (window.location.hash && window.location.hash == '#_=_') {
            history.replaceState
                ? history.replaceState(null, null, window.location.href.split('#')[0])
                : window.location.hash = '';
        }
    </script>
@endsection
