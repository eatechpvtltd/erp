    <div class="row">
    <div class="col-xs-12">
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr style="border-top: 3px #346da5 solid;border-bottom: 2px #346da5 solid !important;">
                    <th>{{ __('common.s_n')}}</th>
                    <th>Date</th>
{{--                    <th>Year</th>--}}
{{--                    <th>Month</th>--}}
<!--                    <th>{{__('form_fields.student.fields.faculty')}}</th>-->
                    <th>{{__('form_fields.student.fields.semester')}}</th>
                    <th>{{ __('form_fields.student.fields.reg_no') }}</th>
                    <th>{{__('form_fields.student.fields.name_of_student')}}</th>
                    <th>{{ __('common.status')}}</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($data['student'] as $student)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$data['date']}}</td>
{{--                            <td>{{ ViewHelper::getYearById($student->years_id) }} </td>--}}
{{--                            <td>{{ ViewHelper::getMonthById($student->months_id) }} </td>--}}
{{--                            <td> {{ $student->faculty }}</td>--}}
                            <td> {{ $student->semester  }}</td>
                            <td>{{ $student->reg_no }}</td>
                            <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                            <td>{{ ViewHelper::getAttendanceStatusFullText($student->attendance_status)}}</td>
                        </tr>
                        @php($i++)
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top: 2px #346da5 solid;border-bottom: 3px #346da5 solid;font-weight: 600;">
                        <td colspan="5" class="text-right"><b>Total&nbsp;&nbsp;</b></td>
                        <td>{{ $data['student']->count()>0?$data['student']->count():'-' }} </td>
                    </tr>
                </tfoot>
            </table>
            @if(isset($data['attendanceStatus']) && $data['attendanceStatus']->count()>0)
                @foreach($data['attendanceStatus'] as $attenStatus)
                    | {{  substr($attenStatus->title,0,2) .'-'. $attenStatus->title}}
                @endforeach
            @endif
        </div>
    </div>
</div>
