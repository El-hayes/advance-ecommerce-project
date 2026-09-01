@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Product </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row"> <!-- start 1st row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control"  >
                                                            <option value="" selected="" disabled="">Select Brand</option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{ $brand->id }}" {{ ($brand->id == $product->brand_id) ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control"  >
                                                            <option value="" selected="" disabled="">Select Category</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control"  >
                                                            <option value="" selected="" disabled="">Select SubCategory</option>
                                                            @foreach($subcategories as $subcategory)
                                                                <option value="{{ $subcategory->id }}" {{ ($subcategory->id == $product->subcategory_id) ? 'selected' : '' }}>{{ $subcategory->subcategory_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 1st row  -->



                                        <div class="row"> <!-- start 2nd row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>SubSubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" class="form-control"  >
                                                            <option value="" selected="" disabled="">Select SubSubCategory</option>
                                                            @foreach($subsubcategories as $subsubcategory)
                                                                <option value="{{ $subsubcategory->id }}" {{ ($subsubcategory->id == $product->subsubcategory_id) ? 'selected' : '' }}>{{ $subsubcategory->subsubcategory_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('subsubcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Name En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_en" class="form-control" value="{{ $product->product_name_en }}">
                                                        @error('product_name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Name AR <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_ar" class="form-control" value="{{ $product->product_name_ar }}">
                                                        @error('product_name_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 2nd row  -->



                                        <div class="row"> <!-- start 3RD row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}">
                                                        @error('product_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control" value="{{ $product->product_qty }}">
                                                        @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Tags En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_en" class="form-control" value="{{ $product->product_tags_en }}" data-role="tagsinput">
                                                        @error('product_tags_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 3RD row  -->



                                        <div class="row"> <!-- start 4th row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Tags AR <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_ar" class="form-control" value="{{ $product->product_tags_ar }}" data-role="tagsinput">
                                                        @error('product_tags_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Size En </h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_en" class="form-control" value="{{ $product->product_size_en }}" data-role="tagsinput">
                                                        @error('product_size_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Size AR </h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_ar" class="form-control" value="{{ $product->product_size_ar }}" data-role="tagsinput">
                                                        @error('product_size_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 4th row  -->



                                        <div class="row"> <!-- start 5th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Product Color En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_en" class="form-control" value="{{ $product->product_color_en }}" data-role="tagsinput">
                                                        @error('product_color_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Product Color AR <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_ar" class="form-control" value="{{ $product->product_color_ar }}" data-role="tagsinput">
                                                        @error('product_color_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 5th row  -->


                                        <div class="row"> <!-- start 6th row  -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="selling_price" class="form-control" value="{{ $product->selling_price }}">
                                                        @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->



                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Product Discount Price </h5>
                                                    <div class="controls">
                                                        <input type="text" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                                                        @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 6th row  -->




                                        <div class="row"> <!-- start 7th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp_en" id="textarea" class="form-control"  placeholder="Textarea text">{!! $product->short_descp_en !!}</textarea>
                                                    </div>
                                                    @error('short_descp_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Short Description Arabic <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp_ar" id="textarea" class="form-control"  placeholder="Textarea text">{!! $product->short_descp_ar !!}</textarea>
                                                        @error('short_descp_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 6 -->

                                        </div> <!-- end 7th row  -->





                                        <div class="row"> <!-- start 8th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
	                                                    <textarea id="editor1"  name="long_descp_en" rows="10" cols="80">
												           {!! $product->long_descp_en !!}
						                                </textarea>
                                                        @error('long_descp_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Long Description Arabic <span class="text-danger">*</span></h5>
                                                    <div class="controls">
	                                                    <textarea id="editor2"  name="long_descp_ar" rows="10" cols="80">
												            {!! $product->long_descp_ar !!}
                                                        </textarea>
                                                        @error('long_descp_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 6 -->

                                        </div> <!-- end 8th row  -->


                                        <hr>



                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ ($product->hot_deals == 1) ? 'checked' : ''}}>
                                                            <label for="checkbox_2">Hot Deals</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ ($product->featured == 1) ? 'checked' : ''}}>
                                                            <label for="checkbox_3">Featured</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ ($product->special_offer == 1) ? 'checked' : ''}}>
                                                            <label for="checkbox_4">Special Offer</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ ($product->special_deals == 1) ? 'checked' : ''}}>
                                                            <label for="checkbox_5">Special Deals</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Edit Product">
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                        <!-- /.col -->

                    </div>


                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>

            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>



    <!-- ///////////////// Start Multiple Image Update Area ///////// -->

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                    </div>


                    <form method="POST" action="{{ route('update.product.image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm p-2">
                            @foreach($multiImgs as $img)
                                <div class="col-md-3">

                                    <div class="card">
                                        <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 140px; width: 100%;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                            </h5>
                                            <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span class="text-danger">*</span></label>
                                                <input class="form-control" type="file" name="multi_img[ {{ $img->id }} ]">
                                            </div>
                                            </p>

                                        </div>
                                    </div>

                                </div><!--  end col md 3		 -->
                            @endforeach

                        </div>

                        <div class="text-xs-right ml-3">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>


                    </form>


                </div>
            </div>



        </div> <!-- // end row  -->

    </section>


    {{-- End multi image section --}}


    <!-- ///////////////// Start Thambnail Image Update Area ///////// -->

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
                    </div>


                    <form method="POST" action="{{ route('update.product.thambnail', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm p-2">
                                <div class="col-md-3">

                                    <input type="hidden" name="old_img" value="{{ $product->product_thambnail }}">

                                    <div class="card">
                                        <img src="{{ asset($product->product_thambnail) }}" class="card-img-top" style="height: 140px; width: 100%;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                            </h5>
                                            <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span class="text-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_thambnail" onchange="mainThamUrl(this)">
                                                <img id="mainThmb" src="" alt=""/>
                                            </div>
                                            </p>

                                        </div>
                                    </div>

                                </div><!--  end col md 3		 -->


                        </div>

                        <div class="text-xs-right ml-3">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>


                    </form>


                </div>
            </div>



        </div> <!-- // end row  -->

    </section>


    {{-- End thambnail image section --}}




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
                            $('select[name="subsubcategory_id"]').html('');
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


    {{--    Fetch subsubcategories for a specific subcategory--}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="subcategory_id"]').on('change', function(){
                var subcategory_id = $(this).val();
                if(subcategory_id) {
                    $.ajax({
                        url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <!-- display Thambnail image when selected -->
    <script type="text/javascript">
        function mainThamUrl(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>





@endsection
