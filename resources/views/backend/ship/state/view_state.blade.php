@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-md-12 col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">State List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box text-center">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>State Name</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($state as $stat)
                                        <tr>
                                            <td>{{ $stat->division->division_name  }}</td>
                                            <td>{{ $stat->district->district_name }}</td>
                                            <td>{{ $stat->state_name }}</td>

                                            <td class="btn-adjust" style="width: 25%">
                                                <a href="{{ route('state.edit', $stat->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('state.delete', $stat->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

                <!--   ------------ Add State Page -------- -->
                <div class="col-md-12 col-lg-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('state.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Division Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="division_id"  class="form-control">
                                                <option value="" selected disabled>Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                                @endforeach

                                            </select>
                                            <div class="help-block"></div></div>

                                        @error('division_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>District Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="district_id"  class="form-control">
                                                <option value="" selected="" disabled="">Select District</option>


                                            </select>
                                            <div class="help-block"></div></div>

                                        @error('district_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <h5>State Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="state_name" name="state_name"  class="form-control">
                                        </div>
                                        @error('state_name')
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


    {{--    Fetch  Ship district for a specific ship division --}}


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                const division_id = $(this).val();
                const $districtSelect = $('select[name="district_id"]');

                if (division_id) {
                    $.ajax({
                        url: "{{ url('shipping/district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function() {
                            $districtSelect.empty().append('<option>Loading...</option>');
                        },
                        success: function(data) {
                            $districtSelect.empty();
                            $.each(data, function(key, value) {
                                $districtSelect.append('<option value="' + value.id + '">' + value.district_name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to fetch districts. Please try again.');
                        }
                    });
                } else {
                    $districtSelect.empty();
                }
            });
        });
    </script>


@endsection


