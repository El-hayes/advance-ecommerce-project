@extends('admin.admin_master')

@section('admin')

    <div class="container-full">

        <!-- Main content -->
        <section class="content">


            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Change Password</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.change.password') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <h5>Current password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="current_password" name="current_password"  class="form-control"> <div class="help-block"></div></div>
                                                @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @if(session('error'))
                                                    <span class="text-danger">{{ session('error') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <h5>New password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="password" name="password"  class="form-control"> <div class="help-block"></div></div>

                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <h5>Confirm password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control"> <div class="help-block"></div></div>

                                                @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Update">
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>



@endsection
