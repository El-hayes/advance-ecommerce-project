@extends('admin.admin_master')
@section('admin')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!-- Edit Sub-Subcategory -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub-SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('subsubcategory.update', $sub_subcategory->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($category->id == $sub_subcategory->category_id) ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
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
                                            <select name="subcategory_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ ($subcategory->id == $sub_subcategory->subcategory_id) ? 'selected' : '' }}>{{ $subcategory->subcategory_name_en }}</option>
                                                @endforeach

                                            </select>
                                            <div class="help-block"></div></div>

                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subsubcategory_name_en" name="subsubcategory_name_en"  value="{{$sub_subcategory->subsubcategory_name_en}}" class="form-control" > <div class="help-block"></div></div>
                                        @error('subsubcategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subsubcategory_name_ar" name="subsubcategory_name_ar" value="{{$sub_subcategory->subsubcategory_name_ar}}" class="form-control"> <div class="help-block"></div></div>

                                        @error('subsubcategory_name_ar')
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
                    <!-- End Edit Sub-Subcategory -->



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
