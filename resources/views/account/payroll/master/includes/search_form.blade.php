<div id="accordion" class="accordion-style1 panel-group hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter {{$panel}}
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
                        {!! Form::label('payroll_due_date', 'Date', ['class' => 'col-sm-1 control-label']) !!}
                        <div class=" col-sm-3">
                            <div class="input-group ">
                                {!! Form::text('payroll_due_date_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-exchange"></i>
                                </span>
                                {!! Form::text('payroll_due_date_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'payroll_due_date_start'])
                                @include('includes.form_fields_validation_message', ['name' => 'payroll_due_date_end'])
                            </div>
                        </div>

                        <label class="col-sm-1 control-label">Head</label>
                        <div class="col-sm-4">
                            {!! Form::select('payroll_heads', $data['payroll_heads'], null, ['class' => 'form-control  chosen-select']) !!}
                        </div>

                        {!! Form::label('amount', 'Amount', ['class' => 'col-sm-1 control-label']) !!}
                        <div class=" col-sm-2">
                            <div class="input-group ">
                                {!! Form::number('amount_start', null, ["class" => "input-sm form-control border-form "]) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-exchange"></i>
                                </span>
                                {!! Form::number('amount_end', null, ["class" => "input-sm form-control border-form"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'amount_start'])
                                @include('includes.form_fields_validation_message', ['name' => 'amount_end'])
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
                </div>
                {{--{!! Form::close() !!}--}}
            </div>
        </div>
    </div>
</div>