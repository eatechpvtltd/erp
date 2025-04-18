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
                    <div class="form-group">
                        {!! Form::label('years_id', 'Year', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::select('years_id', $data['years'], null, ["class" => "form-control border-form","required"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'years_id'])
                        </div>
                        {!! Form::label('months_id', 'Month', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::select('months_id', $data['months'], null, ["class" => "form-control border-form","required"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'months_id'])
                        </div>

                        {!! Form::label('exams_id', 'Exam', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('exams_id', $data['exams'], null, ["class" => "form-control border-form chosen-select","required"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'exams_id'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">{{ __('form_fields.student.fields.faculty')}}</label>
                        <div class="col-sm-2">
                            {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}

                        </div>

                        <label class="col-sm-1 control-label">{{__('form_fields.student.fields.semester')}}</label>
                        <div class="col-sm-2">
                            <select name="semester_select" class="form-control semester_select" onChange="loadSubject(this)">
                                <option value="0"> Select {{__('form_fields.student.fields.semester')}} </option>
                            </select>
                        </div>

                        <label class="col-sm-1 control-label">Subject</label>
                        <div class="col-sm-2">
                            <select name="schedule_subject" class="form-control schedule_subject">
                                <option> Select Subject </option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label">{{__('form_fields.student.fields.batch')}}</label>
                        <div class="col-sm-2">
                            {!! Form::select('batch', $data['batch'], null, ['class' => 'form-control']) !!}
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