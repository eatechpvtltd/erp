@extends('web.admin.layouts.master')

@section('content')

    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
                @include($view_path.'.includes.breadcrumb-primary')
            </ul><!-- .breadcrumb -->


        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    {{ $panel }}
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        View
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @include('web.admin.includes.buttons.view-page-button')
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20%">Column</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $data['row']->title }}</td>
                                        </tr>

                                        <tr>
                                            <td>Description</td>
                                            <td>{!! $data['row']->description !!}</td>
                                        </tr>

                                        <tr>
                                            <td>Link</td>
                                            <td><a href="{{ $data['row']->title }}" target="_blank">{{ $data['row']->link }}</a></td>
                                        </tr>

                                        <tr>
                                            <td>Image</td>
                                            <td>
                                                @if ($data['row']->image)
                                                    <img src="{{ asset('web/'.$folder_name.'/'. $data['row']->image) }}" class="img-responsive">
                                                @else
                                                    <p>No image</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Create at</td>
                                            <td>{{ $data['row']->created_at }}</td>
                                        </tr>

                                        <tr>
                                            <td>Last updated at</td>
                                            <td>{{ $data['row']->updated_at }}</td>
                                        </tr>

                                        <tr>
                                            <td>Created by</td>
                                            <td>{{ $data['row']->created_by_name }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /span -->
                    </div><!-- /row -->

                    <div class="hr hr-18 dotted hr-double"></div>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->

@endsection


@section('js')

@endsection
