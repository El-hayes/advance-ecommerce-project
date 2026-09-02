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
                            <h3 class="box-title">Edit SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('subcategory.update', $subcategory->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($category->id == $subcategory->category_id) ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
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
                                            <input type="text" id="subcategory_name_en" name="subcategory_name_en"  value="{{$subcategory->subcategory_name_en}}" class="form-control" > <div class="help-block"></div></div>
                                        @error('subcategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subcategory_name_ar" name="subcategory_name_ar" value="{{$subcategory->subcategory_name_ar}}" class="form-control"> <div class="help-block"></div></div>

                                        @error('subcategory_name_ar')
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
