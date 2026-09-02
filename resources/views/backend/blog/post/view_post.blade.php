@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product List <span class="badge badge-pill badge-danger">{{ count($blogposts) }}</span></h3>
                            <a href="{{ route('add.blog.post') }}" class="btn btn-success" style="float: right;">Add Post</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Post Category  </th>
                                        <th>Post Image </th>
                                        <th>Post Title En </th>
                                        <th>Post Title Ar </th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($blogposts as $post)
                                        <tr>
                                            <td>{{ $post->postCategory->blog_category_name_en }}</td>
                                            <td> <img src="{{ asset($post->post_image) }}" alt="" style="width: 60px; height: 50px;">  </td>
                                            <td>{{ $post->post_title_en }}</td>
                                            <td>{{ $post->post_title_ar }}</td>

                                            <td class="btn-adjust" style="width:25%" >
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>

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



            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
