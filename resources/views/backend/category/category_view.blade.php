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
                            <h3 class="box-title">Category List <span class="badge badge-pill badge-danger">{{ count($categories) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Category Icon</th>
                                        <th>Category EN</th>
                                        <th>Category AR</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($categories as $category)
                                        <tr>
                                            <td><span><i class="{{ $category->category_icon }}"></i></span></td>
                                            <td>{{ $category->category_name_en }}</td>
                                            <td>{{ $category->category_name_ar }}</td>
                                            <td class="btn-adjust">
                                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
                            <h3 class="box-title">Add Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('category.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Category English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="category_name_en" name="category_name_en"  class="form-control"> <div class="help-block"></div></div>
                                        @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Category Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="category_name_ar" name="category_name_ar"  class="form-control"> <div class="help-block"></div></div>

                                        @error('category_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Category Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="category_icon" name="category_icon"  class="form-control"> <div class="help-block"></div></div>

                                        @error('category_icon')
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
                    <!-- Add Brand -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
