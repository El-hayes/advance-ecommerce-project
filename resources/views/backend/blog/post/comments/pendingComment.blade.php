@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">




                <div class="col-md-12 col-lg-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pending All Comments</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Comment</th>
                                        <th>User</th>
                                        <th>Post</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($comments as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->comment }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->blogPost->post_title_en }}</td>
                                            <td>
                                                @if($item->status == 0 )
                                                    <span class="badge badge-pill badge-primary">Pending</span>
                                                @elseif($item->status == 1 )
                                                    <span class="badge badge-pill badge-success">Success</span>
                                                @endif

                                            </td>
                                            <td class="btn-adjust">
                                                <a href="{{ route('publish.comment', $item->id) }}" class="btn btn-danger" title="Approve User Comment">Approve</a>
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
