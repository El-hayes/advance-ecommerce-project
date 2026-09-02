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
                            <h3 class="box-title">Product List <span class="badge badge-pill badge-danger">{{ count($products) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name EN</th>
                                        <th>product Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $product)
                                        <tr>
                                            <td> <img src="{{ asset($product->product_thambnail) }}" alt="" style="width: 60px; height: 50px;">  </td>
                                            <td>{{ $product->product_name_en }}</td>
                                            <td>{{ $product->selling_price }} $</td>
                                            <td>{{ $product->product_qty }} Pic</td>
                                            <td>
                                                @if($product->discount_price == null)
                                                    <span class="badge badge-pill badge-danger">No Discount</span>
                                                @else
                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount/$product->selling_price) * 100;
                                                    @endphp
                                                    <span class="badge badge-pill badge-danger">{{ round($discount)  }} %</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->status == 1)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Inactive</span>
                                                @endif
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
