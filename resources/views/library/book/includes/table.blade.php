<div class="row">
    <div class="col-xs-12">
    @include('includes.data_table_header')
    <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-center" colspan="13">{!! $data['books']->appends($data['filter_query'])->links() !!}</td>
                    </tr>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>{{ __('common.s_n')}}</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Total</th>
                        <th>Issued</th>
                        <th>Available</th>
                        <th>{{ __('common.status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['books']) && $data['books']->count() > 0)
                    @php($i=1)
                    @foreach($data['books'] as $books)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $books->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td>
                                <a href="{{ route('library.book') }}?categories={{$books->categories}}">
                                    {{ ViewHelper::getBookCategoryById( $books->categories) }}
                                </a>
                            </td>
                            <td>
                                @if(isset($books->image) && $books->image !== '')
                                    <a href="{{ route($base_route.'.view', ['id' => $books->id]) }}">
                                        <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$books->image) }}"
                                             class="img-responsive" width="40px">
                                    </a>
                                @else
                                    <a href="{{ route($base_route.'.view', ['id' => $books->id]) }}">
                                        <img class="img-responsive" width="40px" alt="{{ $books->title }}" src="{{ asset('assets/images/avatars/book.png') }}" />
                                    </a>
                                @endif
                            </td>
                            <td><a href="{{ route($base_route.'.view', ['id' => $books->id]) }}">{{ $books->code }} </a></td>
                            <td><a href="{{ route($base_route.'.view', ['id' => $books->id]) }}">{{ $books->title }} </a></td>
                            <td>
                                <a href="{{ route('library.book') }}?author={{$books->author}}">
                                    {{ $books->author }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('library.book') }}?publisher={{$books->publisher}}">
                                    {{ $books->publisher }}
                                </a>
                            </td>
                            <td>{{ $books->bookCollection()->count() }} </td>
                            <td>{{ $books->bookCollection()->where('book_status','=',2)->count() }} </td>
                            <td>{{ $books->bookCollection()->where('book_status','=',1)->count() }} </td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $books->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $books->status == 'active'?"Active":"In Active" }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route($base_route.'.active', ['id' => $books->id]) }}" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        </li>

                                        <li>
                                            <a href="{{ route($base_route.'.in-active', ['id' => $books->id]) }}" title="In-Active"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route($base_route.'.view', ['id' => $books->id]) }}" class="btn btn-success btn-minier">
                                        <i class="ace-icon fa fa-eye bigger-130" title="View"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.edit', ['id' => $books->id]) }}" class="btn btn-success btn-minier">
                                        <i class="ace-icon fa fa-pencil-square-o bigger-130" title="Edit"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.delete', ['id' => $books->id]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
                                        <i class="ace-icon fa fa-trash-o bigger-130" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="13">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>


