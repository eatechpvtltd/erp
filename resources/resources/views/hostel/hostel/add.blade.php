@extends('layouts.master')

@section('css')

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
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('hostel.includes.buttons')
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                                @include($view_path.'.includes.form')

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-center">
                                    <div class="col-md-12 align-right">
                                        <button class="btn" type="reset">
                                            <i class="fa fa-undo bigger-110"></i>
                                            Reset
                                        </button>

                                        <button class="btn btn-primary" type="submit" value="Save" name="add_hostel" id="add-hostel">
                                            <i class="fa fa-save bigger-110"></i>
                                            Save
                                        </button>

                                        <button class="btn btn-success" type="submit" value="Save" name="add_hostel_another" id="add-hostel-another">
                                            <i class="fa fa-save bigger-110"></i>
                                            <i class="fa fa-plus bigger-110"></i>
                                            Save And Add Another
                                        </button>
                                    </div>
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

    </script>
@endsection