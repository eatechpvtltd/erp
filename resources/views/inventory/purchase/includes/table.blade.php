    <div class="col-xs-12">
        @include('includes.data_table_header')
        <!-- div.table-responsive -->
            <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-center" colspan="11">{!! $data['product']->appends($data['filter_query'])->links() !!}</td>
                    </tr>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th >Price</th>
                        <th >Stock</th>
                        <th>{{ __('common.status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['product']) && $data['product']->count() > 0)
                    @php($i=1)
                    @foreach($data['product'] as $product)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ encrypt($product->id) }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td><a href="{{ route($base_route.'.view', ['id' => encrypt($product->id)]) }}">{{ $product->code }}</a></td>
                            <td>
                                {{  ViewHelper::getProductCategory( $product->category_id ) }}
                                >>
                                {{  ViewHelper::getProductSubCategory( $product->sub_category_id ) }}

                            </td>
                            <td>
                                @if($product->product_image)
                                    <a href="{{ route($base_route.'.view', ['id' => encrypt($product->id)]) }}">
                                        <img src="{{ asset('images/product/'.$product->product_image) }}"
                                             class="img-responsive" width="50px">
                                    </a>
                                @endif
                            </td>
                            <td><a href="{{ route($base_route.'.view', ['id' => encrypt($product->id)]) }}"> {{ $product->name }}</a></td>
                            <td>
                                {{ $product->getProductSellPrice() }}
                            </td>
                            <td>
                                {{$product->getProductStock()}}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $product->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $product->status == 'active'?"Active":"In Active" }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route($base_route.'.active', ['id' => encrypt($product->id)]) }}" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        </li>

                                        <li>
                                            <a href="{{ route($base_route.'.in-active', ['id' => encrypt($product->id)]) }}" title="In-Active"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route($base_route.'.view', ['id' => encrypt($product->id)]) }}" class="btn btn-primary btn-minier btn-primary">
                                        <i class="ace-icon fa fa-eye bigger-130" title="View"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.edit', ['id' => encrypt($product->id)]) }}" class="btn btn-primary btn-minier btn-success">
                                        <i class="ace-icon fa fa-pencil-square-o bigger-130" title="Edit"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.delete', ['id' => encrypt($product->id)]) }}" class="btn btn-primary btn-minier btn-danger bootbox-confirm" >
                                        <i class="ace-icon fa fa-trash-o bigger-130" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No {{ $panel }} data found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}

        </div>
    </div>
