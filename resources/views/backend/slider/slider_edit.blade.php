@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!-- Edit Slider -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    <!-- old img -->
                                    <input type="hidden" name="old_img" value="{{ $slider->slider_img }}">

                                    <div class="form-group">
                                        <h5>Slider Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="slider_title" name="slider_title"  value="{{$slider->title}}" class="form-control" > <div class="help-block"></div></div>
                                        @error('slider_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Slider Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="slider_des" name="slider_des" value="{{$slider->description}}" class="form-control"> <div class="help-block"></div></div>

                                        @error('slider_des')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="slider_img" name="slider_img"  class="form-control"> <div class="help-block"></div></div>

                                        @error('slider_img')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update">
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- End Edit slider -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
