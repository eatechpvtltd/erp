<div class="clearfix hidden-print" >
    <div class="easy-link-menu align-center">
        <a class="{!! request()->is('certificate/transfer*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('certificate.transfer') }}"><i class="fa fa-calendar" aria-hidden="true"></i> {{$panel}}  Detail</a>
        {{--<a class="{!! request()->is('certificate/template')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('certificate.template') }}"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Certificate Template</a>--}}
    </div>
</div>
<hr class="hr-4">