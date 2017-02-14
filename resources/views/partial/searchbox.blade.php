<section class="box-dvsty row">

    <h4 class="col-md-4 font-xs"><i class="fa fa-list-ul margin-r-5"></i>{{$pagination['from'] or 0}}~{{$pagination['to']}}Rows(Total {{$pagination['total']}}Rows)</h4>

    <div class="col-md-8">
        <div class="row">
            <form id="index-search-form" action="" method="get" class="form-horizontal">
                <div class="col-sm-12 box-searchhead clearfix">
                    @if(!empty($view))
                        <input type="hidden" name="view" value="<!--{$view}-->">
                    @endif

                    @if($page != 'customer')
                        <input type="hidden" name="order">
                        <input type="hidden" name="sort">
                    @endif
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        
                        @if( !empty($page) && $page == 'industrial_waste' && !empty($industrial_waste_types) )
                            <label class="col-lg-6 col-md-5 control-label">Type:</label>
                            <div class="col-lg-6 col-md-7">

                                <select class="form-control select2 x-search-field" name="search_field">
                                    <option value="">Please select</option>
                                    @foreach( $industrial_waste_types AS $industrial_waste_type )
                                    <option value="{{ $industrial_waste_type['code'] }}" @if( !empty($search_field) && $search_field == $industrial_waste_type['code'] ) selected @endif>{{ $industrial_waste_type['code'] or '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if( !empty($page) && $page == 'purchase' && !empty($purchase_types) )
                            <label class="col-lg-6 col-md-5 control-label">Type：</label>
                            <div class="col-lg-6 col-md-7">
                                <select class="form-control select2 x-search-field" name="search_field">
                                    <option value="">Please select</option>
                                    @foreach( $purchase_types AS $purchase_type )
                                    <option value="{{ $purchase_type['code'] }}" @if( !empty($search_field) && $search_field == $purchase_type['code']) selected @endif>{{ $purchase_type['code'] or '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if( !empty($page) && $page == 'sale' && !empty($product_types) )
                            <label class="col-lg-6 col-md-5 control-label">Type：</label>
                            <div class="col-lg-6 col-md-7">
                                <select class="form-control select2 x-search-field" name="search_field">
                                    <option value="">Please select</option>
                                    @foreach($product_types AS $product_type)
                                    <option value="{{ $product_type['id'] }}" @if( !empty($search_field) && $search_field == $product_type['id'] ) selected @endif>{{ $product_type['name'] or '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <div class=" col-sm-6">
                    <div class="form-group">
                        <label class="col-lg-4 col-md-4 control-label">Search：</label>
                        <div class="col-lg-8 col-md-8">
                            <input type="text" name="search_value" class="form-control x-search-value" placeholder="" value="{{$search_value}}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

