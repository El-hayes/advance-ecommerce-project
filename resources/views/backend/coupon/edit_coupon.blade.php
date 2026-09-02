@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!-- Add Coupon Page -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('coupon.update', $coupon->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Coupon Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="coupon_name" name="coupon_name"  class="form-control" value="{{ $coupon->coupon_name }}">
                                        </div>
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Discount (%) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="coupon_discount" name="coupon_discount"  class="form-control" value="{{ $coupon->coupon_discount }}">
                                        </div>

                                        @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" id="coupon_validity" name="coupon_validity"  class="form-control"
                                                   min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupon->coupon_validity }}"> </div>

                                        @error('coupon_validity')
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
                    <!-- Add Coupon Page -->



                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
