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
                            <h3 class="box-title">Total Users <span class="badge badge-pill badge-danger">{{ count($users) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)
                                        <tr>
                                            <td><img src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" alt="user image" width="50px" height="50px"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if($user->userOnline())
                                                    <span class="badge badge-pill badge-success">Active Now</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                                @endif
                                            </td>


                                            <td class="btn-adjust">
                                                <a href="{{-- route('brand.edit', $brand->id) --}}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{-- route('brand.delete', $brand->id) --}}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
