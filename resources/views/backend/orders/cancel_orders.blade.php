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
                            <h3 class="box-title">Cancel Orders List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->invoice_no }}</td>
                                            <td>$ {{ $order->amount }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-primary">{{ $order->status }}</span>
                                            </td>
                                            <td class="btn-adjust">
                                                <a href="{{ route('pending.order.details', $order->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('admin.invoice.download', $order->id) }}" class="btn btn-danger btn-sm" title="Download Invoice" target="_blank"><i class="fa fa-download"></i></a>
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
