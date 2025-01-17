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
                        @include($view_path.'.generate.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Generate
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('certificate.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include('certificate.generate.includes.form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                @include('certificate.generate.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                @include('student.includes.common-script.student_filter_common_script')
                    location.href = url;
            });

            $('#certificate-generate-btn').click(function () {

                certificate = $('#certificate-template').val();

                if (certificate !== '' & certificate >0) {
                    /*Check Student List Select Or not*/
                    $chkIds = document.getElementsByName('chkIds[]');
                    var $chkCount = 0;
                    $length = $chkIds.length;

                    for (var $i = 0; $i < $length; $i++) {
                        if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                            $chkCount++;
                        }
                    }

                    if ($chkCount <= 0) {
                        toastr.warning("Please, Select At Least One Student Record.", "Warning:");
                        return false;
                    }
                }else{
                    toastr.warning("Please, Select Your Certificate Template.", "Warning:");
                    return false;
                }

            });


        });


        function loadSemesters($this) {
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
                        $.notify(data.message, "warning");
                    } else {
                        $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                    }
                }
            });

        }


    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

    @endsection