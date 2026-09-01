@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <!-- Edit  District -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('district.update',$district->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Division Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="division_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ ($division->id == $district->division_id) ? 'selected' : '' }}>
                                                        {{ $division->division_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div class="help-block"></div></div>

                                        @error('division_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <h5>District Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="district_name" name="district_name"  class="form-control" value="{{ $district->district_name }}">
                                        </div>
                                        @error('district_name')
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
                    <!-- Edit  District -->


                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
