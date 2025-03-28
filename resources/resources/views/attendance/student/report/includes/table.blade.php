    <div class="row">
    <div class="col-xs-12">
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr style="border-top: 3px #346da5 solid;border-bottom: 2px #346da5 solid !important;">
                    <th>{{ __('common.s_n')}}</th>
                    <th>Year</th>
                    <th>Month</th>
{{--                    <th>{{__('form_fields.student.fields.faculty')}}</th>--}}
                    <th>{{__('form_fields.student.fields.semester')}}</th>
                    <th>{{ __('form_fields.student.fields.reg_no') }}</th>
                    <th>{{__('form_fields.student.fields.name_of_student')}}</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                    <th>19</th>
                    <th>20</th>
                    <th>21</th>
                    <th>22</th>
                    <th>23</th>
                    <th>24</th>
                    <th>25</th>
                    <th>26</th>
                    <th>27</th>
                    <th>28</th>
                    <th>29</th>
                    <th>30</th>
                    <th>31</th>
                    <th>32</th>
                    @if(isset($data['attendanceStatus']) && $data['attendanceStatus']->count()>0)
                        @foreach($data['attendanceStatus'] as $attenStatus)
                            <th>{{ substr($attenStatus->title,0,2) }}</th>
                        @endforeach
                    @endif
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($data['student'] as $student)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ ViewHelper::getYearById($student->years_id) }} </td>
                            <td>{{ ViewHelper::getMonthById($student->months_id) }} </td>
{{--                            <td> {{ $student->faculty }}</td>--}}
                            <td> {{ $student->semester  }}</td>
                            <td>{{ $student->reg_no }}</td>
                            <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_1)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_2)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_3)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_4)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_5)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_6)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_7)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_8)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_9)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_10)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_11)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_12)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_13)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_14)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_15)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_16)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_17)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_18)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_19)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_20)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_21)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_22)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_23)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_24)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_25)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_26)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_27)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_28)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_29)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_30)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_31)}}</td>
                            <td>{{ ViewHelper::getAttendanceStatus($student->day_32)}}</td>
                            <td>{{ $student->PRESENT?$student->PRESENT:'-' }} </td>
                            <td>{{ $student->ABSENT?$student->ABSENT:'-' }} </td>
                            <td>{{ $student->LATE?$student->LATE:'-' }} </td>
                            <td>{{ $student->LEAVE?$student->LEAVE:'-' }} </td>
                            <td>{{ $student->HOLIDAY?$student->HOLIDAY:'-' }} </td>
                        </tr>
                        @php($i++)
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top: 2px #346da5 solid;border-bottom: 3px #346da5 solid;font-weight: 600;">
                        <td colspan="38" class="text-right"><b>Total&nbsp;&nbsp;</b></td>
                        <td>{{ $data['student']->sum('PRESENT')?$data['student']->sum('PRESENT'):'-' }} </td>
                        <td>{{ $data['student']->sum('ABSENT')?$data['student']->sum('ABSENT'):'-' }} </td>
                        <td>{{ $data['student']->sum('LATE')?$data['student']->sum('LATE'):'-' }} </td>
                        <td>{{ $data['student']->sum('LEAVE')?$data['student']->sum('LEAVE'):'-' }} </td>
                        <td>{{ $data['student']->sum('HOLIDAY')?$data['student']->sum('HOLIDAY'):'-' }} </td>
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
