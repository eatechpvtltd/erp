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
                    @include('student.includes.search_form')
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Year</label>
                        <div class="col-sm-2">
                            {!! Form::select('year', $data['years'], null, ['class' => 'form-control']) !!}

                        </div>

                        <label class="col-sm-1 control-label">Month</label>
                        <div class="col-sm-2">
                            {!! Form::select('month', $data['months'], null, ['class' => 'form-control']) !!}
                        </div>


                        {!! Form::label('attendance_date', 'Date', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('attendance_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                        </div>

                        <label class="col-sm-1 control-label">{{ __('common.status')}}</label>
                        <div class="col-sm-2">
                            {!! Form::select('attendance_status', $data['attendanceStatusFilter'], null, ['class' => 'form-control']) !!}
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