@extends('layouts.master')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">

                            <div class="col-md-12 col-print-12 align-center">
                                <div class="text-center">
                                    @if(isset($generalSetting->logo))
                                        <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="100px">
                                    @endif
                                    <h2 class="no-margin-top text-uppercase" style="font-family: 'Raleway'; font-size: 35px;font-weight: 600;">
                                        {{isset($generalSetting->institute)?$generalSetting->institute:"EduFirm Web Portal Online Registration"}}
                                    </h2>
                                    <h4 class="no-margin-top">
                                        {{isset($generalSetting->address)?$generalSetting->address:""}}, {{isset($generalSetting->phone)?$generalSetting->phone:""}}, {{isset($generalSetting->email)?$generalSetting->email:""}}
                                    </h4>
                                        <h4 class="text-uppercase no-margin-top text-center" style="font-family: 'Raleway'; font-size: 25px;font-weight: 600;">
                                            Certificate Verification
                                        </h4>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
                <hr class="hr-8">

                <div class="row">

                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @include('includes.flash_messages')
                        <div id="accordion" class="accordion-style1 panel-group hidden-print">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                                            <h3 class="header large lighter blue">
                                                <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                                                Click here, To check the authenticity of the certificate.
                                                <i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;
                                            </h3>
                                        </a>
                                    </h4>
                                </div>

                                <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        {!! Form::open(['route' => 'verification.certificate', 'method' => 'GET', 'class' => 'form-horizontal',
                           'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                                        <div class="clearfix">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Certificate</label>
                                                <div class="col-sm-6">
                                                    <select name="certificate" class="form-control chosen-select"  data-placeholder="Choose a Certificate..."required>
                                                        @foreach( $data['certificate-template'] as $key => $certificate)
                                                            <option value="{{ $key }}">{{ $certificate }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {!! Form::label('issue_dte', 'Date of Issue', ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-2">
                                                    {!! Form::text('issue_dte', null, ["class" => "form-control border-form date-picker input-mask-date","required"]) !!}
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('reg_no', __('form_fields.student.fields.reg_no'), ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-2">
                                                    {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration","required"]) !!}
                                                    @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
                                                </div>

                                                {!! Form::label('first_name', __('form_fields.student.fields.first_name'), ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-2">
                                                    {!! Form::text('first_name', null, ["placeholder" => "", "class" => "form-control border-form","required"]) !!}
                                                </div>

                                                {!! Form::label('date_of_birth', 'Date of Birth', ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-2">
                                                    {!! Form::text('date_of_birth', null, ["class" => "form-control border-form date-picker input-mask-date","required"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix form-actions">
                                            <div class="center">
                                                <button class="btn btn-info" type="submit" id="filter-btn">
                                                    <i class="fa fa-search bigger-110"></i>
                                                    Verify
                                                </button>
                                            </div>
                                        </div>
                                        {{  Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(isset($data['certificateContent']))
                                <div class="book">
                                    <div class="page">
                                        <div class="subpage" >
                                            <div class="main-content">
                                                <div class="main-content-inner">
                                                    <div class="page-content">
                                                        <div class="row">
                                                            <div class="col-xs-12 align-center">
                                                                <!-- PAGE CONTENT BEGINS -->
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-12 col-print-12 align-center text-center">
                                                                        <div class="widget-box transparent">
{{--                                                                            @include('print.includes.print-head')--}}
                                                                            {{--                                                        <hr class="hr-2" style="border-bottom: #00AEEF 4px solid">--}}
                                                                            <div class="row">
                                                                                <div class="col-md-12 col-xs-12 col-sm-12 col-print-12 widget-container-col ui-sortable" id="widget-container-col-9">
                                                                                    <div class="widget-box widget-color-green ui-sortable-handle" id="widget-box-9">
                                                                                        <div class="widget-header">
                                                                                            <h5 class="widget-title">
                                                                                                <i class="1 ace-icon fa fa-certificate bigger-125"></i>
                                                                                                Valid Certificate Found
                                                                                            </h5>

                                                                                            <div class="widget-toolbar">
                                                                                                <a href="#" data-action="collapse">
                                                                                                    <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="widget-body">
                                                                                            <div class="widget-main">
                                                                                                <div class="space-16"></div>
                                                                                                <div class="row">
                                                                                                    <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 35px">
                                                                                                        <strong>
                                                                                                            {{$data['certificate_template']->certificate}}
                                                                                                        </strong>
                                                                                                    </h3>
                                                                                                    <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 60px">
                                                                                                        <strong>Certificate </strong>
                                                                                                    </h3>
                                                                                                </div>
                                                                                                <div class="space-6"></div>
                                                                                                <div class="text-center" style="padding: 5px 25px;">
                                                                                                    {!! $data['certificateContent'] !!}

                                                                                                    <div class="space-10"></div>
                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- /.col -->
                                                            </div><!-- /.row -->
                                                        </div>
                                                    </div><!-- /.page-content -->
                                                </div>
                                            </div><!-- /.main-content -->
                                        </div>
                                    </div>
                                </div>
                        @endif

                    </div>
                </div>


            </div><!-- /.page-content -->
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $('#filter-btn').click(function () {
            var url = '{{ $data['url'] }}';
            var flag = false;
            //var reg_no = $('input[name="reg_no"]').val();
            var national_id_1 = $('input[name="national_id_1"]').val();
            var date_of_birth = $('input[name="date_of_birth"]').val();
            var faculty = $('select[name="faculty"]').val();
            var semester_select = $('select[name="semester_select"]').val();
            var batch = $('select[name="batch"]').val();


            /*if (reg_no !== '') {
                url += '?reg_no=' + reg_no;
                flag = true;
            }*/

            if (national_id_1 !== '') {
                url += '?national_id_1=' + national_id_1;
                flag = true;
            }

            if (faculty >0) {
                if (flag) {
                    url += '&faculty=' + faculty;
                } else {
                    url += '?faculty=' + faculty;
                    flag = true;
                }
            }

            if (semester_select > 0) {
                if (flag) {
                    url += '&semester_select=' + semester_select;
                } else {
                    url += '?semester_select=' + semester_select;
                    flag = true;
                }
            }

            if (batch > 0) {
                if (flag) {
                    url += '&batch=' + batch;
                } else {
                    url += '?batch=' + batch;
                    flag = true;
                }
            }

            if (date_of_birth !== '') {
                if (flag) {
                    url += '&batch=' + batch;
                } else {
                    url += '?batch=' + batch;
                    flag = true;
                }
            }



            location.href = url;
        });

    </script>
    @include('includes.scripts.jquery_validation_scripts')
    @include($view_path.'.certificate.includes.student-common-script')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')
@endsection

