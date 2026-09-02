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
                    <h4 class="box-title">Add Blog Post </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row"> <!-- start 1st row  -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Post Title En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="post_title_en" class="form-control">
                                                        @error('post_title_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->


                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Post Title Ar <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="post_title_ar" class="form-control">
                                                        @error('post_title_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->



                                        </div> <!-- end 1st row  -->



                                        <div class="row"> <!-- start 2nd row  -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Blog Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control"  >
                                                            <option value="" selected="" disabled="">Select Bolg Category</option>
                                                            @foreach($blogPostCategory as $item)
                                                                <option value="{{ $item->id }}">{{ $item->blog_category_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->


                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Post Main Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="post_image" class="form-control" onchange="mainThamUrl(this)">
                                                        @error('post_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <img id="mainThmb" src="" alt=""/>
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 6 -->


                                        </div> <!-- end 2nd row  -->




                                        <div class="row"> <!-- start 3th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Post Details English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
	                                                    <textarea id="editor1"  name="post_details_en" rows="10" cols="80">
												           Post Details English
						                                </textarea>
                                                        @error('post_details_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Post Details Arabic <span class="text-danger">*</span></h5>
                                                    <div class="controls">
	                                                    <textarea id="editor2"  name="post_details_ar" rows="10" cols="80">
												            Post Details Arabic
                                                        </textarea>
                                                        @error('post_details_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 6 -->

                                        </div> <!-- end 3th row  -->


                                        <hr>



                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Post">
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
