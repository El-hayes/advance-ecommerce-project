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
                            <h3 class="box-title">Division List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($divisions as $division)
                                        <tr>
                                            <td>{{ $division->division_name }}</td>

                                            <td class="btn-adjust" style="width: 40%">
                                                <a href="{{ route('division.edit', $division->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('division.delete', $division->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

                <!-- Add Division -->
                <div class="col-md-12 col-lg-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Division</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('division.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Division Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="division_name" name="division_name"  class="form-control"> <div class="help-block"></div>
                                        </div>
                                        @error('division_name')
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
                    <!-- Add Division -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
