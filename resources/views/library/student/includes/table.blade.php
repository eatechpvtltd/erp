<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    {{--<tr>
                        <td class="text-center" colspan="11">{!! $data['student']->appends($data['filter_query'])->links() !!}</td>
                    </tr>--}}
                    <tr>
                        <th>{{ __('common.s_n')}}</th>
                        <th>{{__('form_fields.student.fields.faculty')}}</th>
                        <th>{{__('form_fields.student.fields.semester')}}</th>
                        <th>{{ __('form_fields.student.fields.reg_no') }}</th>
                        <th>{{__('form_fields.student.fields.name_of_student')}}</th>
                        <th>Book Taken</th>
                        <th>Eligible</th>
                        <th>{{ __('common.status')}}</th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['student']) && $data['student']->count() > 0)
                    @php($i=1)
                    @foreach($data['student'] as $student)
                        <tr>
                            <td>{{ $i }}</td>
                            <td> {{ ViewHelper::getFacultyTitle($student->faculty)}} </td>
                            <td>{{ ViewHelper::getSemesterById($student->semester) }}</td>
                            <td><a href="{{ route($base_route.'.view', ['id' => $student->member_id]) }}">{{ ViewHelper::getStudentById($student->member_id) }}</a></td>
                            <td><a href="{{ route($base_route.'.view', ['id' => $student->member_id]) }}"> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</a></td>
                            <td> {{ $student->taken }}</td>
                            <td> {{ $student->eligible }}</td>
                            <td>
                                <div class="btn-group">
                                    <span data-toggle="dropdown" class="btn btn-primary btn-minier {{ $student->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $student->status == 'active'?"Active":"In Active" }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>