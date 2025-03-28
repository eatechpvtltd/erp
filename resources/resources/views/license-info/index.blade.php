@extends('layouts.master')
@section('css')
@endsection
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">

{{--
+"amount": "25.50"
  +"sold_at": "2021-01-01T15:26:37+11:00"
  +"license": "Regular License"
  +"support_amount": "0.00"
  +"supported_until": "2023-02-01T23:16:13+11:00"
  +"item": {#2661 ▶}
  +"buyer": "chotan"
  +"purchase_count": 6
--}}
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="2" class="text-uppercase text-center h3"> Unlimited Edu Firm Certification</td>

                    </tr>
                    <tr>
                        <td colspan="2" class="text-uppercase text-center">
                            @if(env('APP_STATUS')!=0)
                                <span><i class="ace-icon fa fa-certificate bigger-110 red"></i> License Expired</span>
                            @else
                                <span><i class="ace-icon fa fa-certificate bigger-110 green"></i></span>
                            @endif

                            @if(env('HELP_STATUS')!=0)
                                <span><i class="ace-icon fa fa-phone bigger-110 red"></i> Support Expired</span>
                            @else
                                <span> <i class="ace-icon fa fa-comment bigger-110 green"></i></span>
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <td class="blue text-right">License :</td>
                        <td>{{$body->license}}</td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Buy Date:</td>
                        <td>{{\Carbon\Carbon::parse($body->sold_at)->format('Y M, d')}}

                            @if(env('APP_STATUS')!=0)
                                <span><i class="ace-icon fa fa-certificate bigger-110 red"></i> License Expired</span>
                            @else
                                <span><i class="ace-icon fa fa-certificate bigger-110 green"></i> {{\Carbon\Carbon::parse($body->sold_at)->diffForHumans()}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Buyer:</td>
                        <td><a href="https://codecanyon.net/user/{{$body->buyer}}">{{$body->buyer}}</a></td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Total Purchase:</td>
                        <td>{{$body->purchase_count}}</td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Support Status:</td>
                        <td>{{\Carbon\Carbon::parse($body->supported_until)->format('Y M, d')}}
                            @if(env('HELP_STATUS')!=0)
                                <span><i class="ace-icon fa fa-phone bigger-110 red"></i> Support Expired</span>
                            @else
                                <span> <i class="ace-icon fa fa-comment bigger-110 green"></i>
                                {{\Carbon\Carbon::parse($body->supported_until)->diffForHumans()}}
                                </span>
                            @endif
                        </td>
                    </tr>
                </table>

            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection
@section('js')

@endsection