@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!-- Add Brand -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    <!-- old img -->
                                    <input type="hidden" name="old_img" value="{{ $brand->brand_image }}">

                                    <div class="form-group">
                                        <h5>Brand Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="brand_name_en" name="brand_name_en"  value="{{$brand->brand_name_en}}" class="form-control" > <div class="help-block"></div></div>
                                        @error('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Brand Name Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="brand_name_ar" name="brand_name_ar" value="{{$brand->brand_name_ar}}" class="form-control"> <div class="help-block"></div></div>

                                        @error('brand_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Brand Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="brand_img" name="brand_img"  class="form-control"> <div class="help-block"></div></div>

                                        @error('brand_img')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update Brand">
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- Add Brand -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
