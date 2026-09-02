@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <!-- Edit  State -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('state.update',$state->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Division Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="division_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ ($division->id == $state->division_id) ? 'selected' : '' }}>
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
                                        <h5>District Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="district_id"  class="form-control" aria-invalid="false">
                                                <option value="" selected disabled>Select Division</option>
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}" {{ ($district->id == $state->district_id) ? 'selected' : '' }}>
                                                        {{ $district->district_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div class="help-block"></div></div>

                                        @error('district_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <h5>State Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="state_name" name="state_name"  class="form-control" value="{{ $state->state_name }}">
                                        </div>
                                        @error('state_name')
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
