<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-center">
        <a class="{!! request()->is('user-student/application')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('user-student.application') }}"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Application Detail</a>
        <a class="{!! request()->is('user-student/application/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-student.application.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Application</a>
    </div>
</div>
<hr class="hr-4">