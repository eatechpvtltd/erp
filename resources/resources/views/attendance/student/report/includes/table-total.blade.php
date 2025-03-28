    <div class="row">
    <div class="col-xs-12">
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{ __('common.s_n')}}</th>
                    <th>{{__('form_fields.student.fields.faculty')}}</th>
                    <th>{{__('form_fields.student.fields.semester')}}</th>
                    <th>{{ __('form_fields.student.fields.reg_no') }}</th>
                    <th>{{__('form_fields.student.fields.name_of_student')}}</th>
                    @foreach($data['attendanceStatus'] as $attenStatus)
                        <th>{{ $attenStatus->title }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($data['student'] as $key => $student)
                        <tr>
                            <td>{{ $i }}</td>
                            <td> {{ $student->faculty }}</td>
                            <td> {{ $student->semester  }}</td>
                            <td>{{ $student->reg_no }}</td>
                            <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                            <td>{{ $student->PRESENT?$student->PRESENT:0 }} </td>
                            <td>{{ $student->ABSENT?$student->ABSENT:0 }} </td>
                            <td>{{ $student->LATE?$student->LATE:0 }} </td>
                            <td>{{ $student->LEAVE?$student->LEAVE:0 }} </td>
                            <td>{{ $student->HOLIDAY?$student->HOLIDAY:0 }} </td>
                        </tr>
                        @php($i++)
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
