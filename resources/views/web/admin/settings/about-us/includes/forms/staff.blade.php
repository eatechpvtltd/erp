<div class="btn btn-block btn-primary">Staffs Setting</div>
<div class="space-8"></div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="status"> Staffs Status </label>
    <div class="col-sm-10">
        {!! Form::select('staffs_status', ['1'=>'Show','0'=>'Hide'], null, ['class' => 'form-control border-form']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'staffs_status'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('staffs_title', 'Staffs Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('staffs_title', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'staffs_title'])
    </div>
</div>

<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('staffs_slogan', 'Staffs Slogan', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('staffs_slogan', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'staffs_slogan'])
    </div>
</div>