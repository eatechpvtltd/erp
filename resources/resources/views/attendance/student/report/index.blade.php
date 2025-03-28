@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
    <style>
        .page-header{
            font-size: 16px;
        }
        .table {
            width: 98%;
            /* max-width: 100%; */
            margin-bottom: 10px;
            margin: 5px auto;
            font-size: 10px;
            /*font-weight: 600;*/
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            line-height: 1.1;
            padding: 2px !important;
        }
        table tfoot {
            display: table-row-group;
        }
    </style>
@endsection

@section('content')
    <div class="main-content A4 landscape">
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
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                        @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
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
                @if (isset($data['student']) && $data['student']->count() > 0)
                    @include('print.includes.institution-detail')
                    <hr class="hr hr-2 hidden-print">
                    <div class="row align-center">
                        <span class="receipt-copy text-uppercase page-header" style="font-size: 16px;">STUDENT ATTENDANCE REPORT</span>
                    </div>
                    <hr class="hr hr-2 hidden-print">
                    @if($data['tag'] == 'date-status')
                        @include($view_path.'.includes.table-date-status')
                    @else
                        @include($view_path.'.includes.table')
                        {{--@include($view_path.'.includes.table-total')--}}
                    @endif
                @endif

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')

    <script>
        function loadSemesters($this) {
            var faculty = $('select[name="faculty"]').val();
            if (faculty == 0) {
                toastr.info("Please, Select Faculty/Program/Class", "Info:");
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('student.find-semester') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    faculty_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        toastr.warning(data.error, "Warning");
                    } else {
                        $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                        // toastr.success(data.success, "Success:");
                    }
                }
            });

        }

        $(document).ready(function () {

            $('#filter-btn').click(function () {
                @include('student.includes.common-script.student_filter_common_script')

                var year = $('select[name="year"]').val();
                var month = $('select[name="month"]').val();

                if (year !== '' &  year > 0) {

                    if (flag) {
                        url += '&year=' + year;
                    } else {
                        url += '?year=' + year;
                        flag = true;
                    }
                }

                if (month !== '' &  month > 0) {

                    if (flag) {
                        url += '&month=' + month;
                    } else {
                        url += '?month=' + month;
                        flag = true;
                    }
                }

                var attendance_status = $('select[name="attendance_status"]').val();
                if (attendance_status >0) {
                    if (flag) {
                        url += '&attendance_status=' + attendance_status;
                    } else {
                        url += '?attendance_status=' + attendance_status;
                        flag = true;
                    }
                }

                var attendance_date = $('input[name="attendance_date"]').val();
                if (attendance_date !== '') {
                    if (flag) {
                        url += '&attendance_date=' + attendance_date;
                    } else {
                        url += '?attendance_date=' + attendance_date;
                        flag = true;
                    }
                }

                location.href = url;
            });
        });

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')

@endsection