@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
        <style>
            @media print {
                .table {
                    width: 98%;
                    /* max-width: 100%; */
                    margin-bottom: 10px;
                    margin: 5px auto;
                    font-size: 8px;
                    /*font-weight: 600;*/
                }

                .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                    line-height: 1.05;
                    padding: 2px !important;
                    border: 1px solid #dddddd24;
                }
            }
        </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header hidden-print">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('account.report.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.search_form')
                            {{--<div class="hr hr-18 dotted hr-double"></div>--}}
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="col-sm-12 align-right hidden-print">
                    <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                        <i class="ace-icon fa fa-print"></i> Print
                    </a>
                </div>
                <div class="space-32 hidden-print"></div>
                @include('print.includes.institution-detail')
                @if(isset($data))
                    @include($view_path.'.includes.table')
                @endif
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#filter-btn').click(function () {
                var url = '{{ $data['url'] }}';
                var flag = false;
                var report_type = $('select[name="report_type"]').val();
                var start_date = $('input[name="start_date"]').val();
                var end_date = $('input[name="end_date"]').val();

                if (report_type !== '') {
                    url += '?report_type=' + report_type;
                    flag = true;
                }

                if (start_date !== '') {

                    if (flag) {

                        url += '&start_date=' + start_date;

                    } else {

                        url += '?start_date=' + start_date;
                        flag = true;

                    }
                }

                if (end_date !== '') {

                    if (flag) {

                        url += '&end_date=' + end_date;

                    } else {

                        url += '?end_date=' + end_date;
                        flag = true;

                    }
                }

                location.href = url;

            });

        });

    </script>
    @include('includes.scripts.datepicker_script')
@endsection