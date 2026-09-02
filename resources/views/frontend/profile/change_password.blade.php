@extends('frontend.main_master')
@section('content')

    {{--@php $user = DB::table('users')->where('id', Auth::id() )->first(); @endphp--}}

    <div class="body-content">
        <div class="container">
            <div class="row">

                {{--   Include user sidebar--}}
                @include('frontend.common.user_sidebar')


                <div class="col-md-2"></div>

                <div class="col-md-6">
                    <div class="card">

                        <h3 class="text-center" ><span class="text-danger"><strong>Change Your Password</strong></span></h3>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.password.update') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title">Current Password</label>
                                    <input class="form-control" id="current_password" name="current_password" type="password">
                                    @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    @if(session('error'))
                                        <span class="text-danger">{{ session('error') }}</span>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="info-title">New Password</label>
                                    <input class="form-control" type="password" id="password" name="password" >
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">Confirm Password</label>
                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" >
                                    @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <input class="btn btn-danger" type="submit"  value="Update">
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
