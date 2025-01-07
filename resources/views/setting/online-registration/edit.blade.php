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
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('setting.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        {!! Form::model($data['row'], ['route' => [$base_route.'.update', $data['row']->id], 'method' => 'POST', 'class' => 'form-horizontal',
                            'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                            {!! Form::hidden('id', $data['row']->id) !!}

                            @include($view_path.'.includes.form')

                            <div class="clearfix form-actions">
                                <div class="align-right">
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-save bigger-110"></i>
                                        Update
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>

                        {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('setting.online-registration.includes.registration-setting-script')
    @include('includes.scripts.datepicker_script')
    {{--@include('includes.scripts.delete_confirm')--}}
    @include('includes.scripts.summarnote')



@endsection