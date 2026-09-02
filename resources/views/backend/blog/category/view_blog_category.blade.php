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
                            <h3 class="box-title">Blog Category List <span class="badge badge-pill badge-danger">{{ count($blogCategory) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Blog Category EN</th>
                                        <th>Blog Category AR</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($blogCategory as $item)
                                        <tr>
                                            <td>{{ $item->blog_category_name_en }}</td>
                                            <td>{{ $item->blog_category_name_ar }}</td>
                                            <td class="btn-adjust">
                                                <a href=" {{route('item.edit', $item->id)}} " class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href=" {{ route('item.delete', $item->id) }} " class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

                <!-- Add Blog Category -->
                <div class="col-md-12 col-lg-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Blog Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('blog.category.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Blog Category English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="blog_category_name_en" name="blog_category_name_en"  class="form-control"> <div class="help-block"></div></div>
                                        @error('blog_category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Blog Category Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="blog_category_name_ar" name="blog_category_name_ar"  class="form-control"> <div class="help-block"></div></div>

                                        @error('blog_category_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Add New">
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
