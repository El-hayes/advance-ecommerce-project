@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

        <div class="container-full">


            <!-- Main content -->
            <section class="content">
                <div class="row">



                    <div class="col-md-12 col-lg-8">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Brand List <span class="badge badge-pill badge-danger">{{ count($brands) }}</span></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body box text-center">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Brand Name EN</th>
                                            <th>Brand Name AR</th>
                                            <th>Brand image</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($brands as $brand)
                                                <tr>
                                                    <td>{{ $brand->brand_name_en }}</td>
                                                    <td>{{ $brand->brand_name_ar }}</td>
                                                    <td><img src="{{ asset($brand->brand_image) }}" alt="brand_img" width="70px" height="40px"></td>
                                                    <td class="btn-adjust">
                                                        <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ route('brand.delete', $brand->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->

                    <!-- Add Brand -->
                    <div class="col-md-12 col-lg-4">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Brand</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                        @csrf

                                            <div class="form-group">
                                                <h5>Brand Name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="brand_name_en" name="brand_name_en"  class="form-control"> <div class="help-block"></div></div>
                                                @error('brand_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <h5>Brand Name Arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="brand_name_ar" name="brand_name_ar"  class="form-control"> <div class="help-block"></div></div>

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
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Add New Brand">
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
