@extends('layouts.master')

@section('css')

    @include('print.student-fee.includes.receipt-css')
@endsection

@section('content')
    @include('print.student-fee.includes.print-header')

    @if($data['student'] && $data['student']->count() > 0 )
        @foreach($data['student'] as $student)
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="space-6"></div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="widget-box transparent">
                                            @include('print.student-fee.includes.institution-detail')
                                            <div class="row align-center">
                                                <span class="receipt-copy"> DUE-SLIP </span>
                                            </div>
                                            <hr class="hr hr-2">
                                            @include('print.student-fee.includes.studentinfo-due')
                                            <div>
                                                <table class="table table-striped table-bordered no-margin-bottom">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Due Amount On {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                            </td>

                                                            <td>
                                                                {{ number_format($student->balance, 2) }}/-
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-uppercase">
                                                                Balance In Word:<strong> {{ ViewHelper::convertNumberToWord($student->balance) }}.</strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                            @include('print.student-fee.includes.print-footer')
                                        </div>
                                    </div>
                                </div>

                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
        @endforeach
    @endif
@endsection


@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection