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
                       Marketing
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List
                        </small>
                    </h1>
                </div><!-- /.page-header -->


                    <table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">college_tutorial_name</th>
      <th scope="col">name</th>
      <th scope="col">area</th>
	  <th scope="col">mobile1</th>
	  <th scope="col">mobile2</th>
	  <th scope="col">email</th>
	  <th scope="col">father</th>
	  <th scope="col">father_mobile</th>
	  <th scope="col">cat</th>
	  <th scope="col">school_per</th>
	  <th scope="col">address</th>
	  <th scope="col">pin</th>
	  <th scope="col">district</th>
	  <th scope="col">stafname</th>
	  <th scope="col">remark</th>
	  <th scope="col">remark</th>
	  <th scope="col">extra_info</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $post)
	<tr>
      <th> {{ $post->id }}</th>
      <td> {{ $post->college_tutorial_name }}</td>
      <td> {{ $post->name }}</td>
      <td> {{ $post->area }}</td>
	  <td> {{ $post->mobile1 }}</td>
	  <td> {{ $post->mobile2 }}</td>
	  <td> {{ $post->email }}</td>
	  <td> {{ $post->father }}</td>
	  <td> {{ $post->father_mobile }}</td>
	  <td> {{ $post->cat }}</td>
	  <td> {{ $post->school_per }}</td>
	  <td> {{ $post->address }}</td>
	  <td> {{ $post->pin }}</td>
	  <td> {{ $post->district }}</td>
	  <td> {{ $post->stafname }}</td>
	  <td> {{ $post->remark }}</td>
	  <td> {{ $post->date_followup }}</td>
	  <td> {{ $post->extra_info }}</td>
    </tr>
  @endforeach
  </tbody>
</table>

                </div><!-- /.row -->
            </div>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection

@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
 
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
 {{--   @include('includes.scripts.datepicker_script')--}}

    @endsection