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
                        <th>User Detail</th>
                        <th>Image</th>
                        <th>User Type</th>
                        <th>{{ __('common.status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['rows']) && $data['rows']->count() > 0)
                        {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
                        @php($i = 1)
                        @foreach($data['rows'] as $row)
                            <tr>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $row->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>

                                <td>
                                    <b>{{ $row->name }}</b>
                                    <hr class="hr-2">
                                    {{ $row->contact_number }}
                                    <hr class="hr-2">
                                    {{ $row->email }}
                                    <hr class="hr-2">
                                    {{ $row->address }}
                                </td>
                                <td>
                                    @if ($row->profile_image)
                                        <img src="{{ asset('images/user/'.$row->profile_image) }}" width="80px">
                                    @else
                                        <p>No image</p>
                                    @endif
                                </td>
                                <td>
                                    @php($roles = $row->userRole)
                                    @if(isset($roles) && $roles->count() > 0)
                                        @foreach($roles as $role)
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $role->display_name }}
                                            </div>
                                            <hr class="hr-2">
                                        @endforeach
                                    @endif
                                </td>
                                <td class="hidden-480 ">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-minier dropdown-toggle {{ $row->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $row->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon icon-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.active', ['id' => Crypt::encryptString($row->id)]) }}" title="Active"><i class="icon-check" aria-hidden="true"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.in-active', ['id' => Crypt::encryptString($row->id)]) }}" title="In-Active"><i class="icon-remove" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="btn btn-success btn-minier" href="{{ route($base_route.'.edit', ['id' => Crypt::encryptString($row->id)]) }}">
                                            <i class="ace-icon icon-pencil bigger-130"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.delete', ['id' => $row->id]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon icon-trash bigger-130"></i>
                                        </a>
                                    </div>
                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon icon-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="{{ route($base_route.'.edit', ['id' => Crypt::encryptString($row->id)]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon icon-pencil-square-o bigger-120"></i>
                                                    </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.delete', ['id' => $row->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                    <span class="red ">
                                                        <i class="ace-icon icon-trash bigger-120"></i>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                        {!! Form::close() !!}
                    @else
                        <tr><td colspan="7">No data found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>