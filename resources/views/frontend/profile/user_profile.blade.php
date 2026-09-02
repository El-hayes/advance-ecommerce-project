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
