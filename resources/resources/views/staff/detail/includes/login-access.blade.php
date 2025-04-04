@ability('super-admin', 'user-add')
{{--staff user--}}
<div class="row">

    @if( !$data['staff_login'])
    {{--create--}}
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;Create Staff Login Access</h4>

        {!! Form::open(['route' => 'staff.user.create', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
            {!! Form::hidden('role_id', 5) !!}
            {!! Form::hidden('hook_id', encrypt($data['staff']->id)) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('name', $data['staff']->first_name.' '.
                        $data['staff']->middle_name.' '.$data['staff']->last_name, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'name'])
                </div>

                {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::email('email', $data['staff']->email, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'email'])
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form", "id"=>"pass", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'password'])
                </div>

                {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
                </div>
            </div>
            <div class="space-4"></div>

            <div class="clearfix form-actions">
                <div class="col-md-12 align-right">
                    <button class="btn" type="reset">
                        <i class="fa fa-undo bigger-110"></i>
                        Reset
                    </button>

                    <button class="btn btn-info" type="submit">
                        <i class="fa fa-save bigger-110"></i>
                        Create Login Access
                    </button>
                </div>
            </div>

            <div class="hr hr-24"></div>
        {!! Form::close() !!}
    </div>
    @else
    {{--edit--}}
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;Edit Staff Login Access</h4>
        <a href="{{ route('staff.user.active', ['id' => $data['staff_login']->id]) }}" title="Active" class="btn-success btn-sm"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Un-Lock User</a>
        <a href="{{ route('staff.user.in-active', ['id' => $data['staff_login']->id]) }}" title="In-Active" class="btn-warning btn-sm"><i class="fa fa-lock" aria-hidden="true"></i> Lock User</a>
        <a href="{{ route('staff.user.delete', ['id' => $data['staff_login']->id]) }}" title="Delete" class="btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete User</a>
        <div class="hr hr-24"></div>

        {!! Form::model($data['staff_login'], ['route' => ['staff.user.update', encrypt($data['staff_login']->id)], 'method' => 'POST', 'class' => 'form-horizontal',
                  'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
        {!! Form::hidden('id', encrypt($data['staff_login']->id)) !!}
        {!! Form::hidden('role_id', 5) !!}
        {!! Form::hidden('hook_id', $data['staff']->id) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'name'])
            </div>

            {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::email('email', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'email'])
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form", "id"=>"pass", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'password'])
            </div>

            {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
            </div>
        </div>
        <div class="col-sm-4">
            <label data-toggle="dropdown" class="label {{ $data['staff_login']->status == 'active'?"label-success":"label-danger" }}" >
                {{ $data['staff_login']->status == 'active'?"Active User":"User Locked" }}
            </label>
        </div>
       <div class="clearfix hr-8"></div>

        <div class="clearfix form-actions">
            <div class="col-md-12 align-right">
                <button class="btn" type="reset">
                    <i class="fa fa-undo bigger-110"></i>
                    Reset
                </button>

                <button class="btn btn-info" type="submit">
                    <i class="fa fa-save bigger-110"></i>
                Update Detail
                </button>
            </div>
        </div>


        <div class="hr hr-24"></div>
        {!! Form::close() !!}
    </div>
    @endif

</div>
@endability