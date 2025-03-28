@extends('layouts.master')

@section('css')


    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    @endsection

@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')

                <div class="page-header">
                    <h1>
                       Marketing
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Registration
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    
                        <div class="align-right">
                   
                        </div>
                        {!! Form::open(['route' => $base_route.'.marketing_register', 'method' => 'POST', 'class' => 'form-horizontal',
                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                            <div class="row">
                                <div class="col-sm-4">
                                    <label>college_tutorial_name</label><br>
                                    <input type="text" name="college_tutorial_name" id="college_tutorial_name" style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>name</label><br>
                                    <input type="text" name="name" id="name" style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>area</label><br>
                                    <input type="text" name="area" id="area"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>mobile1</label><br>
                                    <input type="text" name="mobile1" id="mobile1"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>mobile2</label><br>
                                    <input type="text" name="mobile2" id="mobile2"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>email</label><br>
                                    <input type="text" name="email" id="email"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>father</label><br>
                                    <input type="text" name="father" id="father"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>father_mobile</label><br>
                                    <input type="text" name="father_mobile" id="father_mobile"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>cat</label><br>
                                    <input type="text" name="cat" id="cat"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>school_per</label><br>
                                    <input type="text" name="school_per" id="school_per"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>address</label><br>
                                    <input type="text" name="address" id="address"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>pin</label><br>
                                    <input type="text" name="pin" id="pin"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>district</label><br>
                                    <input type="text" name="district" id="district"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>stafname</label><br>
                                    <input type="text" name="stafname" id="stafname"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>remark</label><br>
                                    <input type="text" name="remark" id="remark"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>date_followup</label><br>
                                    <input type="text" name="date_followup" id="date_followup"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>date_followup</label><br>
                                    <input type="text" name="date_followup" id="date_followup"  style="width:100%" />
                                </div>
                                <div class="col-sm-4">
                                    <label>extra_info</label><br>
                                    <input type="text" name="extra_info" id="extra_info"  style="width:100%" />
                                </div>
                                
                            </div>
                       

                        <div class="clearfix form-actions">
                            <div class="col-md-12 align-right">
                                <button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    Reset
                                </button>

                                <button class="btn btn-info" type="submit">
                                    <i class="icon-ok bigger-110"></i>
                                    Register
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
    <!-- page specific plugin scripts -->
    @include('includes.scripts.jquery_validation_scripts')
    @include('inventory.vendor.registration.includes.vendor-comman-script')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')
@endsection

