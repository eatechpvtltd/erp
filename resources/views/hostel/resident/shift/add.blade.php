@extends('layouts.master')

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Member Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('hostel.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('includes.flash_messages')
                    @include($view_path.'.includes.buttons')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                                @include($view_path.'.includes.form')

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-center">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-info" type="submit" id="filter-btn">
                                        <i class="fa fa-save bigger-110"></i>
                                        Add
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-18 dotted hr-double"></div>
                            {!! Form::close() !!}
                        </div>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.inputMask_script')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/
        });

        function loadRooms($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hostel.find-rooms') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    hostel_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.room_select').html('').append('<option value="0">Select Room...</option>');
                        $.each(data.rooms, function(key,valueObj){
                            $('.room_select').append('<option value="'+valueObj.id+'">'+valueObj.room_number+'</option>');
                        });
                    }
                }
            });

        }

        function loadBeds($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hostel.find-beds') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    room_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.bed_select').html('').append('<option value="0">Select Beds...</option>');
                        $.each(data.beds, function(key,valueObj){
                            $('.bed_select').append('<option value="'+valueObj.id+'">'+valueObj.bed_number+'</option>');
                        });
                    }
                }
            });

        }

    </script>
@endsection