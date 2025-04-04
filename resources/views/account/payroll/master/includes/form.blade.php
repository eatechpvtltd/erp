<div id="accordion" class="accordion-style1 panel-group hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter Staffs
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;
                    </h3>
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                {{--{!! Form::open(['route' => $base_route,'method' => 'GET', 'class' => 'form-horizontal', "enctype" => "multipart/form-data"]) !!}--}}
                <div class="clearfix">
                    @include('staff.includes.common.staff_search_form')
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="status"> Payroll Create Type </label>

                        <div class="col-sm-3">
                            <div class="control-group">

                                <div class="radio">
                                    <label>
                                        {!! Form::radio('payroll_type', 'manual_payroll', true, ['class' => 'ace']) !!}
                                        <span class="lbl"> Manual</span>
                                    </label>
                                    <label>
                                        {!! Form::radio('payroll_type', 'attendance_payroll', false, ['class' => 'ace']) !!}
                                        <span class="lbl"> Attendance Base </span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="align-right">
                        <button class="btn btn-info" type="submit" id="filter-btn">
                            <i class="fa fa-filter bigger-110"></i>
                            Filter
                        </button>
                    </div>
                </div>
                {{--{!! Form::close() !!}--}}

            </div>
        </div>
    </div>
</div>