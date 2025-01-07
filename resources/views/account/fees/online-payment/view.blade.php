@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            View
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('account.fees.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <table id="dynamic-table-1" class="table table-striped table-bordered table-hover" style="width:100%;table-layout:fixed; ">
                            <tbody>
                                @if (isset($data['student']) && $data['student']->count() > 0)
                                    @php($i=1)
                                    @foreach($data['student'] as $student)
                                        <tr>
                                            <td width="15%"></td>

                                            <td class="text-center hidden-print">
                                                @if($student->payment_status == 0)
                                                    <span class="label label-danger">Not Verify</span>
                                                    {{--<div class="btn btn-primary btn-minier action-buttons">
                                                        <a class="white" href="{{ route('account.fees.online-payment.verify', ['id' => encrypt($student->payment_id)]) }}">
                                                            <i class="ace-icon fa fa-check bigger-130"></i>&nbsp;Verify
                                                        </a>
                                                    </div>--}}
                                                    <hr class="hr-2">
                                                    {!! Form::model($student, ['route' => [$base_route.'.verify', encrypt($student->payment_id)], 'method' => 'POST', 'class' => 'form-horizontal',
                                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                                                    <input type="hidden" name="verifyMethod" class="form-control modal_method" value="manually" >
                                                    <button type="submit" class="btn btn-xs btn-primary" data-method="manually">
                                                        <i class="ace-icon fa fa-check bigger-130"></i>&nbsp;Mark As Manuall Verify
                                                    </button>
                                                    {!! Form::close() !!}
                                                <hr class="hr-2">
                                                    <button type="button" class="btn btn-xs btn-primary open-AddFeeDialog" data-toggle="modal"
                                                            data-target="#feeCollectionModal"
                                                            data-students-id="{{ encrypt($student->id) }}"
                                                            data-id="{{ encrypt($student->payment_id) }}"
                                                            data-date="{{ \Carbon\Carbon::parse($student->date)->format('Y-m-d') }}"
                                                            data-amount="{{ $student->amount }}"
                                                            data-gateway="{{ $student->payment_gateway }}"
                                                            data-method="Automatic - Quick Receive & Verify">
                                                        <i class="ace-icon fa fa-check bigger-130"></i>&nbsp;Automatic - Quick Receive & Verify
                                                    </button>
                                                @else
                                                    <span class="label label-success text-uppercase">{{ $student->verify_method}} - Verified</span>
                                                @endif
                                                    <a class="btn btn-xs btn-warning" href="{{ route('account.fees.online-payment') }}"> <i class="ace-icon fa fa-close bigger-130"></i> Close</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="15%">{{__('form_fields.student.fields.faculty')}}</td>
                                            <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%">{{__('form_fields.student.fields.semester')}}</td>
                                            <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%">{{ __('form_fields.student.fields.reg_no') }}</td>
                                            <td><a href="{{ route('student.view', ['id' => encrypt($student->id)]) }}" target="_blank">{{ $student->reg_no }}</a></td>
                                        </tr>
                                        <tr>
                                            <td width="15%">{{__('form_fields.student.fields.name_of_student')}}</td>
                                            <td><a href="{{ route('student.view', ['id' => encrypt($student->id)]) }}" target="_blank"> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</a></td>
                                        </tr>
                                        <tr>
                                            <td width="15%">Payment Date</td>
                                            <td>{{ $student->date }} </td>
                                        </tr>

                                        <tr>
                                            <td width="15%">Amount</td>
                                            <td>{{ $student->amount }} </td>
                                        </tr>

                                        <tr>
                                            <td width="15%">Paid BY</td>
                                            <td> {{ ViewHelper::getUserNameId($student->paid_by) }} </td>
                                        </tr>
                                        <tr>
                                            <td width="15%">Gateway</td>
                                            <td>{{ $student->payment_gateway }} </td>
                                        </tr>

                                        @if(isset($data['khaltiStatus']))
                                            <tr>
                                                <td width="15%">KhaltiPaymentStatus</td>
                                                <td>
                                                    <table class="table">
                                                        @php($refText  = json_decode($data['khaltiStatus']))
                                                        @foreach($refText as $keyfield => $text)
                                                            <tr>
                                                                <td class="text-uppercase" width="15%" style="font-weight: 600">{{str_replace('_',' ',$keyfield)}}</td>
                                                                <td>
                                                                    @if($keyfield =='transaction_id')
                                                                        <a href="https://test-admin.khalti.com/#/transaction/{{$text}}" target="_blank">{{$text}}</a>
                                                                    @else
                                                                        @if($keyfield =='total_amount' || $keyfield =='fee')
                                                                            {{$text/100}}
                                                                        @else
                                                                            {{$text}}
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>

                                        @endif

                                        <tr>
                                            <td width="15%">REF TEXT</td>
                                            <td style="overflow: scroll; text-overflow: ellipsis">
                                                @if($student->ref_text)
                                                    <table class="table">
                                                        @php($refText  =json_decode($student->ref_text))
                                                        @foreach($refText as $keyfield => $text)
                                                            <tr>
                                                                    <td class="text-uppercase" width="15%" style="font-weight: 600">{{str_replace('_',' ',$keyfield)}}</td>
                                                                    <td> {{$text}} </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="15%">Note</td>
                                            <td>{{ $student->note}} </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">No {{ $panel }} data found. </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @include($view_path.'.includes.add_model')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.datepicker_script')
    @include('includes.scripts.inputMask_script')
    @include($view_path.'.includes.modal_values_script')
@endsection