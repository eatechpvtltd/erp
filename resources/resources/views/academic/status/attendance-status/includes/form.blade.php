<div class="form-group">
    {!! Form::label('title', 'Attendance Status', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('title', null, ["placeholder" => "", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="form-group">

    {!! Form::label('display_class', 'DisplayColor', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::radio('display_class', false, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        {!! Form::label('COLOR-1', '', ['class' => 'btn btn-sm btn-danger p-5'])  !!}
        <hr class="hr-2">
        {!! Form::radio('display_class', false, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        {!! Form::label('COLOR-2', '', ['class' => 'btn btn-sm btn-info p-5'])  !!}
        <hr class="hr-2">
        {!! Form::radio('display_class', false, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        {!! Form::label('COLOR-3', '', ['class' => 'btn btn-sm btn-warning']) !!}
        <hr class="hr-2">
        {!! Form::radio('display_class', false, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        {!! Form::label('COLOR-4', '', ['class' => 'btn btn-sm btn-success']) !!}
        <hr class="hr-2">
        {!! Form::radio('display_class', false, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        {!! Form::label('COLOR-5', '', ['class' => 'btn btn-sm btn-primary p-5']) !!}

        @include('includes.form_fields_validation_message', ['name' => 'display_class'])
    </div>
</div>

