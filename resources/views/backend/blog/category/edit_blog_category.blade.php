@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!-- Add Blog Category -->
                <div class="col-md-12 col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Blog Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('blog.category.update' , $blogCategory->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Blog Category English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="blog_category_name_en" name="blog_category_name_en" value="{{ $blogCategory->blog_category_name_en }}" class="form-control"> <div class="help-block"></div></div>
                                        @error('blog_category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Blog Category Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="blog_category_name_ar" name="blog_category_name_ar" value="{{ $blogCategory->blog_category_name_ar }}" class="form-control"> <div class="help-block"></div></div>

                                        @error('blog_category_name_ar')
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
                    <!-- End  Blog Category -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
