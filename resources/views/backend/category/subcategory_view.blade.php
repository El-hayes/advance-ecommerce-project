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
                            <h3 class="box-title">SubCategory List <span class="badge badge-pill badge-danger">{{ count($subcategories) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>SubCategory EN</th>
                                        <th>SubCategory AR</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td style="width:25%">{{ $subcategory->category->category_name_en }}</td>
                                            <td style="width:25%">{{ $subcategory->subcategory_name_en }}</td>
                                            <td style="width:25%">{{ $subcategory->subcategory_name_ar }}</td>
                                            <td class="btn-adjust" style="width:25%"   >
                                                <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('subcategory.delete', $subcategory->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
                            <h3 class="box-title">Add SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('subcategory.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                                @endforeach

                                            </select>
                                            <div class="help-block"></div></div>

                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subcategory_name_en" name="subcategory_name_en"  class="form-control"> <div class="help-block"></div></div>
                                        @error('subcategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subcategory_name_ar" name="subcategory_name_ar"  class="form-control"> <div class="help-block"></div></div>

                                        @error('subcategory_name_ar')
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
