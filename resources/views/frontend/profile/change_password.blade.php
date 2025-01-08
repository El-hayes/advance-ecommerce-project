@extends('frontend.main_master')
@section('content')

    {{--@php $user = DB::table('users')->where('id', Auth::id() )->first(); @endphp--}}

    <div class="body-content">
        <div class="container">
            <div class="row">

                <div class="col-md-2"> <br/>
                    <img  class="img-circle" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" alt="user_image" width="100%" height="100%">

                    <ul class="list-group list-group-flush">
                        <a  href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a  href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block ">Profile Update</a>
                        <a  href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a  href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>

                </div> <br/><br/>


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
