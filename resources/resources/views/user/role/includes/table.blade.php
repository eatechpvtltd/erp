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
                    <tr>
                        <th>{{ __('common.s_n')}}</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['roles']) && $data['roles']->count() > 0)
                        @php($i = 1)
                        @foreach($data['roles'] as $role)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> {{ $role->name }} </td>
                                <td>{{ $role->display_name.' [ '.$role->id.' ]' }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a class="btn btn-success btn-minier" href="{{ route($base_route.'.edit', ['id' => encrypt($role->id)]) }}">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-130" title="Edit"></i>
                                        </a>
                                        @role('super-admin')
                                        <a href="{{ route($base_route.'.delete', ['id' => encrypt($role->id)]) }}" class="btn btn-danger btn-minier bootbox-confirm">
                                        <i class="ace-icon fa fa-trash-o bigger-130" title="Delete"></i>
                                    </a>
                                        @endrole
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr><td colspan="7">No data found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>