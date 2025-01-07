
<div class="form-group">
    {!! Form::label('title', __('academic.child.grading_subject.child.subject'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('title', null, ["placeholder" => "e.g. English", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', 'Code', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('code', null, ["placeholder" => "e.g. E01", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'code'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('full_mark_theory', 'FM (T)', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('full_mark_theory', null, ["class" => "form-control border-form",'min'=>'0','step'=>'any']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'full_mark_theory'])
    </div>
    {!! Form::label('pass_mark_theory', 'PM (T)', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('pass_mark_theory', null, ["class" => "form-control border-form",'min'=>'0','step'=>'any']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'pass_mark_theory'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('full_mark_practical', 'FM (P)', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('full_mark_practical', null, ["class" => "form-control border-form",'min'=>'0','step'=>'any']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'full_mark_practical'])
    </div>
    {!! Form::label('pass_mark_practical', 'PM (P)', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('pass_mark_practical', null, ["class" => "form-control border-form",'min'=>'0','step'=>'any']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'pass_mark_practical'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('course_fee', 'Course Fee', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('course_fee', null, ["class" => "form-control border-form",'min'=>'0','step'=>'any']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'course_fee'])
    </div>

    {!! Form::label('credit_hour', 'Credit Hrs.', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('credit_hour', null, ["class" => "form-control border-form",'min'=>'0','step'=>'any',"Required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'credit_hour'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('sub_type', 'Subject Type', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('sub_type',['Compulsory'=>'Compulsory', 'Optional'=>'Optional','Major'=>'Major'], null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'sub_type'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('class_type', 'Class Type', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('class_type',['Theory'=>'Theory','Practical'=>'Practical','Both'=>'Both'], null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'class_type'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('staff_id', 'Teacher/Staff', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('staff_id',$data['staffs'], null, ["class" => "form-control border-form chosen-select","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'staffs'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description', null, ["class" => "form-control border-form upper",'rows'=>'1']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>
