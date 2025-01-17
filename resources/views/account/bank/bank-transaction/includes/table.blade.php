<div class="row">
    <div class="col-xs-12">
    @include('includes.data_table_header')
    <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-center" colspan="10">{!! $data['transaction']->appends($data['filter_query'])->links() !!}</td>
                    </tr>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>{{ __('common.s_n')}}</th>
                        <th>Bank</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Deposit/Withdraw ID</th>
                        <th>Debit (+)</th>
                        <th>Credit (-)</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['transaction']) && $data['transaction']->count() > 0)
                    @php($i=1)
                    @foreach($data['transaction'] as $transaction)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $transaction->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td><a href="{{ route('account.bank.view', ['id' => $transaction->banks_id]) }}">{{ ViewHelper::getBankNameById($transaction->banks_id) }} </a></td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td align="center">{{ $transaction->deposit_id }}</td>
                            <td align="right">{{ $dR = $transaction->dr_amt }}</td>
                            <td align="right">{{ $cR = $transaction->cr_amt }}</td>
                            <td align="right">{{ $dR - $cR }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route($base_route.'.delete', ['id' => $transaction->id]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
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
                <tfoot>
                <tr style="font-size: 14px; background: orangered;color: white;">
                    <td colspan="6" class="text-right">Total</td>
                    <td  class="text-right">{{ $drTotal = $data['transaction']->sum('dr_amt') }}</td>
                    <td  class="text-right">{{ $crTotal = $data['transaction']->sum('cr_amt') }}</td>
                    <td  class="text-right">{{ $drTotal - $crTotal }}</td>
                    {{--<td  class="text-right">{{ $data['transaction']->sum('amount') }}</td>--}}
                    <td class="hdidden-print"> </td>
                </tr>
                </tfoot>
            </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


