<div class="form-horizontal">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Resident History List</h4>
            <div class="clearfix">
                    <span class="pull-right tableTools-container"></span>
            </div>
            <div class="table-header">
                {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
            </div>
            <!-- div.table-responsive -->
            <div class="table-responsive">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead >
                        <tr>
                            <th>{{ __('common.s_n')}}</th>
                            <th>Year</th>
                            <th>Hostel</th>
                            <th>Room</th>
                            <th>Bed</th>
                            <th>Type</th>
                            <th>Reg.No. </th>
                            <th>Name</th>
                            <th>History</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['history']) && $data['history']->count() > 0)
                        @php($i=1)
                        @foreach($data['history'] as $history)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ ViewHelper::getYearById($history->years_id) }} </td>
                                <td>{{ ViewHelper::getHostelNameById($history->hostels_id) }} </td>
                                <td>{{ ViewHelper::getRoomNumberById($history->rooms_id) }}</td>
                                <td>{{ $history->beds_id }}</td>
                                <td>{{ $history->user_type==1?"Student":"Staff" }}</td>
                                <td>
                                    @if($history->user_type==1)
                                        <a href="{{ route('student.view', ['id' => $history->member_id]) }}">
                                            {{ ViewHelper::getStudentById($history->member_id) }}
                                        </a>
                                    @else
                                        <a href="{{ route('staff.view', ['id' => $history->member_id]) }}">
                                            {{ ViewHelper::getStaffById($history->member_id) }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($history->user_type==1)
                                        {{ ViewHelper::getStudentNameById($history->member_id) }}
                                        @else
                                        {{ ViewHelper::getStaffNameById($history->member_id) }}
                                    @endif
                                </td>
                                <td>
                                    <label class="label label-primary">{{$history->history_type}}</label>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d')}} </td>
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
        </div>
    </div>
</div>
