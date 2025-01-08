@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="container-full">

        <!-- Main content -->
        <section class="content">


                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Admin Profile Edit</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.profile.store') }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h5>Admin User name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="username"  value="{{ $editData->name }}" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <h5>Admin Email <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email"  value="{{ $editData->email }}" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h5>Profile Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file"  id="image" name="profile_image" class="form-control" > <div class="help-block"></div></div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="controls">
                                                         <img  id="showImage" src="{{ (!empty($editData->profile_photo_path)) ? url('upload/admin_images/'.$editData->profile_photo_path) : url('upload/no_image.jpg') }}" alt="profile_img" style="width: 100px; height: 100px">
                                                    </div>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
