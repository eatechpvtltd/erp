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
                            Edit Role
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('user.includes.commanbuttons')
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                    {!! Form::model($data['row'], ['route' => [$base_route.'.update', encrypt($data['row']->id)], 'method' => 'POST', 'class' => 'form-horizontal',
                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                    {!! Form::hidden('id', $data['row']->id) !!}
                        <div class="clearfix form-actions">
                            <div class="align-right">
                                <button class="btn btn-info" type="submit">
                                    <i class="fa fa-save bigger-110"></i>
                                    Update
                                </button>
                            </div>
                        </div>

                            @include($view_path.'.includes.form')

                        <div class="clearfix form-actions">
                            <div class="align-right">
                                <button class="btn btn-info" type="submit">
                                    <i class="fa fa-save bigger-110"></i>
                                Update
                                </button>
                            </div>
                        </div>

                    <div class="hr hr-24"></div>

                    {!! Form::close() !!}

                    <div class="hr hr-18 dotted hr-double"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection


@section('js')

    @include('includes.scripts.jquery_validation_scripts')

    <script>
        $(document).ready(function () {
            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });

            $('.group').on('click' , function(){
                var that = this;
                $(this).closest('tr').find('input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });


        });
    </script>


@endsection
