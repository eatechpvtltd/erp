<div class="row">
    <div class="col-xs-12">
    @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
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
                        <th>Year</th>
                        <th>Month</th>
                        <th>Day in Month</th>
                        <th>Holiday</th>
                        <th>Open Day</th>
                        <th>{{ __('common.status')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['attendance_master']) && $data['attendance_master']->count() > 0)
                        @php($i=1)
                        @foreach($data['attendance_master'] as $attendance_master)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $attendance_master->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ ViewHelper::getYearById($attendance_master->year) }} </td>
                                <td>{{ ViewHelper::getMonthById($attendance_master->month) }} </td>
                                <td>{{ $attendance_master->day_in_month }} </td>
                                <td>{{ $attendance_master->holiday }} </td>
                                <td>{{ $attendance_master->open }} </td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $attendance_master->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $attendance_master->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.active', ['id' => $attendance_master->id]) }}"><i class="fa fa-check btn-primary" aria-hidden="true"></i> Active</a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.in-active', ['id' => $attendance_master->id]) }}"><i class="fa fa-remove btn-warning" aria-hidden="true"></i> In-Active</a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a class="btn btn-success btn-minier" href="{{ route($base_route.'.edit', ['id' => $attendance_master->id]) }}">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-130" title="Edit"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.delete', ['id' => $attendance_master->id]) }}" class="btn btn-danger btn-minier bootbox-confirm">
                                        <i class="ace-icon fa fa-trash-o bigger-130" title="Delete"></i>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


