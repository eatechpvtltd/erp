@extends('layouts.master')

@section('css')
    @include('print.certificate.common.css')
    <style>
        .main-content{
            font-family: Roboto !important;
            font-size:16px ;
        }
        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid #ddd0;
        }
        p{
            margin-bottom: 5px;
        }

    </style>
    <style>
        @if($data['certificate_template']->background_status == 1)
            @if(@isset($data['certificate_template']->background_image))
                .subpage{
                background-image: url({{ asset('images/certificateBackground/'.$data['certificate_template']->background_image) }}) !important;
                background-repeat: round !important;
                background-size: cover !important;
            }
            @endif
        @endif

        {{$data['certificate_template']->custom_css}}
    </style>
@endsection

@section('content')
    @include('print.certificate.common.print-button')
    @if($data['student'] && $data['student']->count() > 0)
        @foreach($data['student'] as $student)
            <div class="book">
                <div class="page">
                    <div class="subpage">
                        <div class="main-content">
                            <div class="main-content-inner">
                                <div class="page-content">
                                    <div class="row">
                                        <div class="col-xs-12 align-center">
                                            <!-- PAGE CONTENT BEGINS -->
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-print-12 align-center text-center">
                                                    <div class="widget-box transparent ">
                                                        @include('print.includes.print-head')
                                                        <div class="row">
                                                            <h3 class="no-margin no-margin-top text-uppercase hidden-print" style="font-family: 'Black Ops One', cursive;font-size: 30px">
                                                                <strong>{{$student->certificate}} Certificate </strong>
                                                            </h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12 col-sm-12 col-print-12">
                                                                <div class="text-right hidden-print">
                                                                    <div class="space-10"></div>
                                                                    <strong> Issue Date : {{ \Carbon\Carbon::parse($student->date_of_issue)->format('d-m-Y') }}</strong >
                                                                </div>

                                                                <div class="space-16"></div>
                                                                <div class="" style="padding: 5px 25px;">
                                                                    {!! $student->certificate_template !!}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-10"></div>
                                                </div><!-- /.col -->
                                            </div><!-- /.row -->
                                        </div><!-- /.page-content -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.main-content -->
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection