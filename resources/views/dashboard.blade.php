@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">

                <div class="col-md-2"> <br/>
                    <img  class="img-circle" src="{{ (!empty($userData->profile_photo_path)) ? url('upload/user_images/'.$userData->profile_photo_path) : url('upload/no_image.jpg') }}" alt="user_image" width="100%" height="100%">

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
                        <h3 class="text-center" >Hi...<span class="text-danger"><strong>{{ Auth::user()->name }}</strong></span> Welcome to easy online shop </h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
