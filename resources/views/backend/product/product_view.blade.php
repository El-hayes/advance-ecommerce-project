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
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $product)
                                        <tr>
                                            <td> <img src="{{ asset($product->product_thambnail) }}" alt="" style="width: 60px; height: 50px;">  </td>
                                            <td>{{ $product->product_name_en }}</td>
                                            <td>{{ $product->selling_price }} EGP</td>
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
                                            <td class="btn-adjust" style="width:25%" >
                                                <a href="{{-- route('product.edit', $product->id) --}}" class="btn btn-primary btn-sm" title="View Details Data"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                                @if($product->status == 1)
                                                    <a href="{{ route('product.inactive', $product->id) }}" class="btn btn-danger btn-sm" title="Make Product Inactive"><i class="fa fa-arrow-down"></i></a>
                                                @else
                                                    <a href="{{ route('product.active', $product->id) }}" class="btn btn-success btn-sm" title="Make Product Active"><i class="fa fa-arrow-up"></i></a>
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
