@extends('frontend.main_master')
@section('content')

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

                        <h3 class="text-center" >Hi...<span class="text-danger"><strong>{{ Auth::user()->name }}</strong></span> Welcome to easy online shop </h3>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">Phone</label>
                                    <input class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">User Image</label>
                                    <input class="form-control" type="file" name="image" >
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit"  value="Update">
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
