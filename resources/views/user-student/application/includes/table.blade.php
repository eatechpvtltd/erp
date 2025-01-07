{{--<h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>--}}
<div class="clearfix">
    <span class="pull-right tableTools-container"></span>
</div>
{{--<div class="table-header">
    {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
</div>--}}
<!-- div.table-responsive -->
<div class="table-responsive">
    {!! Form::open(['route' => 'application.bulk-action', 'id' => 'bulk_action_form']) !!}
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                <label class="pos-rel">
                    <input type="checkbox" class="ace" />
                    <span class="lbl"></span>
                </label>
            </th>
            <th>{{ __('common.s_n')}}</th>
            <th>Type</th>
            <th>Date</th>
            <th>Subject</th>
            <th width="40%">Message</th>
            <th>{{ __('common.status')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if (isset($data['application']) && $data['application']->count() > 0)
            @php($i=1)
            @foreach($data['application'] as $application)
                <tr>
                    <td class="center first-child">
                        <label>
                            <input type="checkbox" name="chkIds[]" value="{{ $application->id }}" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td>{{ $i }}</td>
                    <td>{{ isset($application->application_type_id)?ViewHelper::getApplicationTypeById($application->application_type_id):'' }}</td>
                    <td>
                        {{\Carbon\Carbon::parse($application->date)->format('Y-m-d')}}
                        {{--                            TO--}}
                        {{--                                {{\Carbon\Carbon::parse($application->end_date)->format('Y-m-d')}}--}}
                    </td>
                    <td>{{ $application->subject }}</td>
                    <td>{{ $application->message }}</td>
                    <td>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $application->status == 'active'?"btn-info":"btn-warning" }}" >
                                {{ $application->status == 'active'?"Accept":"Pending" }}
                            </button>
                        </div>
                    </td>
                    <td>
                        @if($application->status != 'active')
                            <div class="action-buttons">
                                {{--                                    <a href="{{ route('aplication.view', ['id' => encrypt($application->id)]) }}" class="btn btn-success btn-minier">--}}
                                {{--                                        <i class="ace-icon fa fa-eye bigger-130" title="View"></i>--}}
                                {{--                                    </a>--}}

                                <a href="{{ route('user-student.application.edit', ['id' => encrypt($application->id)]) }}" class="btn btn-success btn-minier">
                                    <i class="ace-icon fa fa-pencil-square-o bigger-130" title="Edit"></i>
                                </a>

                                <a href="{{ route('user-student.application.delete', ['id' => encrypt($application->id)]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
                                    <i class="ace-icon fa fa-trash-o bigger-130" title="Delete"></i>
                                </a>
                            </div>
                        @endif
                    </td>

                </tr>
                @php($i++)
            @endforeach
        @else
            <tr>
                <td colspan="12">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
{!! Form::close() !!}
</div>