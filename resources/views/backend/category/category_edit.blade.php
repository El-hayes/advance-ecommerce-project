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
                            <h3 class="box-title">Edit Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('category.update', $category->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Category English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="category_name_en" name="category_name_en"  value="{{$category->category_name_en}}" class="form-control" > <div class="help-block"></div></div>
                                        @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Category Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="category_name_ar" name="category_name_ar" value="{{$category->category_name_ar}}" class="form-control"> <div class="help-block"></div></div>

                                        @error('category_name_ar')
                                        <span> class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Category icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="category_icon" name="category_icon"  class="form-control" value="{{ $category->category_icon }}"> <div class="help-block"></div></div>

                                        @error('category_icon')
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
                    <!-- Add Brand -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
