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
                        <label class="col-sm-1 control-label">User</label>
                        <div class="col-sm-3">
                            {!! Form::select('user', $data['users'], null, ['class' => 'form-control chosen-select']) !!}
                        </div>

                        <label class="col-sm-1 control-label">Event</label>
                        <div class="col-sm-2">
                            {!! Form::select('event', [""=>"Events","created"=>"Created","updated"=>"Updated","deleted"=>"Deleted"], null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::label('url', 'URL', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('url', null, ["class" => "form-control border-form"]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('ip', 'IP Address', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('ip', null, ["class" => "form-control border-form"]) !!}
                        </div>

                        {!! Form::label('user_agent', 'User Agent', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('user_agent', null, ["class" => "form-control border-form"]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('created_at', 'Created At', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            <div class="input-group ">
                                {!! Form::text('created_at_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                                {!! Form::text('created_at_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                            </div>
                        </div>

                        {!! Form::label('updated_at', 'Updated At', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            <div class="input-group ">
                                {!! Form::text('updated_at_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                                {!! Form::text('updated_at_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
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

