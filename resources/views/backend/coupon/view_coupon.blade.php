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
                            <h3 class="box-title">Coupon List <span class="badge badge-pill badge-danger">{{ count($coupons) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Coupon Name</th>
                                        <th>Coupon Discount</th>
                                        <th>Coupon Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->coupon_name }}</td>
                                            <td>{{ $coupon->coupon_discount }}%</td>
                                            <td style="width: 25%">{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y')  }}</td>
                                            <td>
                                                @if($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                    <span class="badge badge-pill badge-success"> Valid </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InValid  </span>
                                                @endif
                                            </td>

                                            <td class="btn-adjust" style="width: 25%">
                                                <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('coupon.delete', $coupon->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
                            <h3 class="box-title">Add Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('coupon.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Coupon Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="coupon_name" name="coupon_name"  class="form-control"> <div class="help-block"></div>
                                        </div>
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Discount (%) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="coupon_discount" name="coupon_discount"  class="form-control"> <div class="help-block"></div>
                                        </div>

                                        @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" id="coupon_validity" name="coupon_validity"  class="form-control"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"> <div class="help-block"></div></div>

                                        @error('coupon_validity')
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
