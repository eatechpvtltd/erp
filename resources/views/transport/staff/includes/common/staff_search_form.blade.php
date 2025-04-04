<div class="form-group">
    {!! Form::label('reg_no', __('form_fields.student.fields.reg_no'), ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
    </div>

    {!! Form::label('join_date', 'Join Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class=" col-sm-3">
        <div class="input-group ">
            {!! Form::text('join_date_start', null, ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                    <i class="fa fa-exchange"></i>
                </span>
            {!! Form::text('join_date_end', null, ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'join_date_start'])
            @include('includes.form_fields_validation_message', ['name' => 'join_date_end'])
        </div>
    </div>

    <label class="col-sm-1 control-label">Designation</label>
    <div class="col-sm-2">
        {!! Form::select('designation', $data['designation'], null, ['class' => 'form-control chosen-select']) !!}

    </div>

    <label class="col-sm-1 control-label">{{ __('common.status')}}</label>
    <div class="col-sm-1">
        <select class="form-control border-form" name="status" id="cat_id">
            <option value="all"> {{ __('common.status')}} </option>
            <option value="active" >{{ __('common.active')}}</option>
            <option value="in-active" >{{ __('common.in_active')}}</option>
        </select>
    </div>
</div>