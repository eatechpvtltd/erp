{!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}

<div class="row">
    <div class="col-xs-12">

        <div class="clearfix table-head-menu" style="text-align: left !important;">
            <span class="easy-link-menu">
                <a class="btn-success btn-sm bulk-action-btn" attr-action-type="print-certificate"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print Certificate</a>
                <a class="btn-success btn-sm bulk-action-btn" attr-action-type="export-excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;Export</a>
{{--                <a class="btn-info btn-sm bulk-action-btn" attr-action-type="generate-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;PDF</a>--}}
                <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="active"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;{{__('common.active_button')}}</a>
                <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="in-active"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp{{__('common.in_active_button')}}</a>
                <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;{{__('common.delete_button')}}</a> |
                <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="create-reset-login"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Create/Reset Login</a>
                <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="create-reset-library-member"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Create Library Member</a>
            </span>

            <div class="col-sm-2 float-right">
                {!! Form::select('certificate-template', $data['certificate-template'], null, ['class' => 'form-control']) !!}
            </div>

            <span class="pull-right tableTools-container"></span>
        </div>

        <!-- div.table-responsive -->
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-center" colspan="10">{!! $data['student']->appends($data['filter_query'])->links() !!}</td>
                    </tr>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>{{ __('common.s_n')}}</th>
                        <th>{{__('form_fields.student.fields.faculty')}}</th>
                        <th>{{__('form_fields.student.fields.semester')}}</th>
                        <th>{{ __('form_fields.student.fields.reg_no') }}</th>
                        {{--<th>Reg.Date</th>--}}
                        <th>{{__('form_fields.student.fields.name_of_student')}}</th>
                        <th> Academic {{ __('common.status')}}</th>
                        <th>{{ __('common.status')}}</th>
                        <th>{{ __('common.actions')}}</th>
                        <th>{{ __('common.service_activation')}}</th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['student']) && $data['student']->count() > 0)
                    @php($i=1)
                    @foreach($data['student'] as $student)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ encrypt($student->id) }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td> {{  $student->faculty }}</td>
                            <td> {{ $student->semester  }}</td>
{{--                            <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>--}}
{{--                            <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>--}}
                            {{--<td>{{ \Carbon\Carbon::parse($student->reg_date)->format('Y-m-d')}} </td>--}}
                            <td><a href="{{ route($base_route.'.view', ['id' => encrypt($student->id)]) }}">{{ $student->reg_no }}</a></td>
                            <td><a href="{{ route($base_route.'.view', ['id' => encrypt($student->id)]) }}"> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</a></td>
                            <td>
                                {{ $student->academic_status}}
                            </td>
                            <td>

                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $student->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $student->status == 'active'?"Active":"In Active" }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route($base_route.'.active', ['id' => encrypt($student->id)]) }}" title="Active"><i class="fa fa-check btn-primary" aria-hidden="true"></i> Active</a>
                                        </li>

                                        <li>
                                            <a href="{{ route($base_route.'.in-active', ['id' => encrypt($student->id)]) }}" title="In-Active"><i class="fa fa-remove btn-warning" aria-hidden="true"></i> In-Active</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('account.fees.collection.view', ['id' => encrypt($student->id)]) }}" class="btn btn-primary btn-minier">
                                        <i class="ace-icon fa fa-calculator bigger-130"></i>
                                    </a>
                                    <a href="{{ route($base_route.'.generate-pdf', ['id' => encrypt($student->id)]) }}" class="btn btn-success btn-minier">
                                        <i class="ace-icon fa fa-file-pdf-o bigger-130"></i>
                                    </a>
                                    <a href="{{ route('online-registration.print', ['id' => encrypt($student->id)]) }}" class="btn btn-primary btn-minier">
                                        <i class="ace-icon fa fa-print bigger-130"></i>
                                    </a>
                                    <a href="{{ route($base_route.'.view', ['id' => encrypt($student->id)]) }}" class="btn btn-success btn-minier">
                                        <i class="ace-icon fa fa-eye bigger-130" title="View"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.edit', ['id' => encrypt($student->id)]) }}" class="btn btn-success btn-minier">
                                        <i class="ace-icon fa fa-pencil-square-o bigger-130" title="Edit"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.delete', ['id' => encrypt($student->id)]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
                                        <i class="ace-icon fa fa-trash-o bigger-130" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('library.member.quick-membership', ['reg_no' => $student->reg_no,'user_type' => 1,'status' => 'active',]) }}" class="btn btn-primary btn-minier">
                                        <i class="ace-icon fa fa-book bigger-130"></i>
                                    </a>
                                    <a class="open-ActiveAgain btn btn-primary btn-minier" data-toggle="modal"
                                       data-target="#activeAgain"
                                       data-id="{{ $student->id }}"
                                       data-reg="{{ $student->reg_no }}">
                                         <span>
                                             <i class="ace-icon fa fa-bed bigger-130"></i>
                                         </span>
                                    </a>

                                    <a class="open-TransportActiveAgain btn btn-primary btn-minier" data-toggle="modal"
                                       data-target="#TransportActiveAgain"
                                       data-id="{{ $student->id }}"
                                       data-reg="{{ $student->reg_no }}">
                                         <span>
                                             <i class="ace-icon fa fa-bus bigger-130"></i>
                                         </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
{!! Form::close() !!}
