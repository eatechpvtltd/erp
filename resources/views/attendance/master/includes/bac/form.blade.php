<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Student</h4>

<div class="form-group">
    {!! Form::label('reg_no', __('form_fields.student.fields.reg_no'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
    </div>

    {!! Form::label('reg_date', __('form_fields.student.fields.reg_date'), ['class' => 'col-sm-2 control-label']) !!}
    <div class=" col-sm-5">
        <div class="input-group ">
            {!! Form::text('reg_start_date', null, ["placeholder" => "2074-01-01", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                <i class="fa fa-exchange"></i>
            </span>
            {!! Form::text('reg_end_date', null, ["placeholder" => "2074-01-01", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'reg_start_date'])
            @include('includes.form_fields_validation_message', ['name' => 'reg_end_date'])
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">{{ __('form_fields.student.fields.faculty')}}</label>
    <div class="col-sm-3">
        {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}

    </div>

    <label class="col-sm-1 control-label">{{__('form_fields.student.fields.semester')}}</label>
    <div class="col-sm-2">
        <select name="semester_select[]" class="form-control semester_select" >
            <option> Select {{__('form_fields.student.fields.semester')}} </option>
        </select>
    </div>

    <label class="col-sm-2 control-label">Student Status</label>
    <div class="col-sm-2">
        <select class="form-control border-form" name="status" id="cat_id">
            <option value="all"> {{ __('common.status')}} </option>
            <option value="active" >{{ __('common.active')}}</option>
            <option value="in-active" >{{ __('common.in_active')}}</option>
        </select>
    </div>

</div>


<div class="clearfix form-actions">
    <div class="col-md-12 align-center">
        <button class="btn" type="reset">
            <i class="fa fa-undo bigger-110"></i>
            Reset
        </button>
        &nbsp; &nbsp; &nbsp;
        <button class="btn btn-info" type="submit" id="filter-btn">
            <i class="fa fa-search bigger-110"></i>
                Search
        </button>
    </div>
</div>