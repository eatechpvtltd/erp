<!DOCTYPE html>
<html lang="en">
    @include('layouts.includes.header')
    @section('top-script')
    @endsection
    <body class="no-skin">
        @include('user-staff.layouts.includes.nav')
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>
            @include('user-staff.layouts.includes.menu')
            @yield('content')
            @include('user-staff.layouts.includes.footer')
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        @include('user-staff.layouts.includes.footer-script')

        @yield('js')
    </body>
</html>




