
<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state hidden-print">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div>

    <ul class="nav nav-list hidden-print">
        {{-- Dashboard --}}
        @permission('guardian-dashboard')
        <li class="{!! request()->is('user-guardian')?'active':'' !!}">
            <a href="{{ route('user-guardian') }}" >
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        @endpermission
        {{-- Students --}}
        @permission('guardian-student-list')
        <li class="{!! request()->is('user-guardian/students')?'active':'' !!}">
            <a href="{{ route('user-guardian.students') }}" >
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text"> Students With Detail </span>
            </a>
        </li>
        @endpermission

        {{-- Notice --}}
        @permission('guardian-notice')
        <li class="{!! request()->is('user-guardian/notice*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.notice') }}">
                <i class="menu-icon  fa fa-bullhorn" aria-hidden="true"></i>
                <span class="menu-text"> Notice </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

    </ul><!-- /.nav-list -->
</div>
