@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-md-12 col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sub->SubCategory List <span class="badge badge-pill badge-danger">{{ count($subsubcategories) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>SubCategory Name</th>
                                        <th>Sub->SubCategory En</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($subsubcategories as $sub_subcategory)
                                        <tr>
                                            <td style="width:20%">{{ $sub_subcategory->category->category_name_en }}</td>
                                            <td style="width:30%">{{ $sub_subcategory->subcategory->subcategory_name_en }}</td>
                                            <td style="width:30%">{{$sub_subcategory->subsubcategory_name_en }}</td>
                                            <td class="btn-adjust" style="width:20%"   >
                                                <a href="{{ route('subsubcategory.edit', $sub_subcategory->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('subsubcategory.delete', $sub_subcategory->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

                <!-- Add Sub Sub Category -->
                <div class="col-md-12 col-lg-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Sub->SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('subsubcategory.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" aria-invalid="false">
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
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select SubCategory</option>

                                            </select>
                                            <div class="help-block"></div></div>

                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="subsubcategory_name_en"  class="form-control"> <div class="help-block"></div></div>
                                        @error('subsubcategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_ar"  class="form-control"> <div class="help-block"></div></div>

                                        @error('subsubcategory_name_ar')
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
                    <!-- Add Sub Sub Category -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->


{{--    Fetch subcategories for a specific category--}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if(category_id) {
                    $.ajax({
                        url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

@endsection
