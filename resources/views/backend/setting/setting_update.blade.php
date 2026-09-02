@extends('admin.admin_master')

@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="container-full">

        <!-- Main content -->
        <section class="content">


            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Site Setting Page </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.site.setting', $setting->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <h5>Site Logo  <span class="text-danger"> </span></h5>
                                                    <div class="controls">
                                                        <input type="file" id="logo" name="logo" class="form-control" >
                                                        @error('logo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <img id="mainThmb" src="" alt=""/>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group col-md-2"> <!-- start col md 2 -->
                                                <div class="controls">
                                                    <img  id="showImage" src="{{ asset($setting->logo)  }}" alt="logo" style="width: 100px; height: 100px">
                                                </div>
                                            </div>  <!-- end col md 4 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Phone One <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="phone_one" class="form-control" value="{{ $setting->phone_one }}" >
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Phone Two <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="phone_two" class="form-control"  value="{{ $setting->phone_two }}"  >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Email <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" value="{{ $setting->email }}"   >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Company Name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="company_name" class="form-control" value="{{ $setting->company_name }}"   >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Company Address <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="company_address" class="form-control" value="{{ $setting->company_address }}"   >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Facebook <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}"   >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Twitter <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="twitter" class="form-control"  value="{{ $setting->twitter }}"  >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Linkedin <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="linkedin" class="form-control"  value="{{ $setting->linkedin }}"  >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Youtube <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="youtube" class="form-control"  value="{{ $setting->youtube }}"  >
                                                    </div>
                                                </div>
                                            </div>

                                    </div>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Update">
                                        </div>

                                    </div>
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






    <!-- display Thambnail image when selected -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#logo').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>


@endsection
