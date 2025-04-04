@extends('layouts.master')

@section('css')
    @include('print.certificate.common.css')
    <style>
        .page {
            width: 210mm;
            height: 296mm;
            padding: 2mm;
            margin: 0mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            width: 200mm;
            height: 286mm;
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
                        <div class="main-content" {{--style="page-break-after:always;"--}}>
                            <div class="main-content-inner">
                                <div class="page-content">
                                    <div class="row">
                                        <div class="col-sm-12 align-center text-center">
                                            <div class="widget-box transparent">
                                                @include('print.includes.print-head')
                                                <div class="row">
                                                    <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 30px">
                                                        <strong>{{$student->certificate}} Certificate </strong>
                                                    </h3>
                                                </div>
                                                <div class="space-10"></div>
                                                <div class=row">
                                                    <div class="text-center" style="font-size: 18px;">
                                                        {!! $student->certificate_template !!}
                                                        <div class="space-10"></div>
                                                        @if($student->student_image != '')
                                                            <img class="img-thumbnail"  alt="{{ $student->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$student->student_image) }}" width="150px" />
                                                        @endif
                                                        <div class="space-4"></div>
                                                    </div>
                                                    <div class="space-28"></div>
                                                    <div class="row text-uppercase">
                                                        <div class="pull-left text-center" >
                                                            <span>
                                                                <strong style="border-bottom: 2px black solid"  >{{\Carbon\Carbon::now()}}</strong ><br>
                                                                Print Date/Time
                                                            </span>
                                                        </div>
                                                        <div class="pull-right text-center">
                                                            <br>
                                                            <span style="border-top: 2px black solid; padding: 0px 50px;">&nbsp;Signature&nbsp;</span >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
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
   {{--@include('includes.scripts.print_script')--}}
@endsection