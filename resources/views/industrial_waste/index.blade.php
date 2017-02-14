@extends('layouts.base')

@section('content')
<div class="row" id="x-list-industrial-waste">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <a href="/industrial_waste/create" class="btn bg-olive btn-flat btn-mobile"><b><i class="fa fa-plus-circle margin-r-5"></i>REGISTER</b></a>
                    <a data-toggle="modal" data-target="#selectDateModal" class="btn btn-primary btn-flat btn-mobile"><b><i class="fa fa-file margin-r-5"></i>CSV</b></a>
                    <a href="javascript:;" class="btn btn-danger btn-flat btn-mobile x-button-delete-industrial-waste"><b><i class="fa fa-trash margin-r-5"></i>DELETE</b></a>
                </div>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle btn-mobile" data-toggle="dropdown" aria-expanded="false"><b>@if( !$list_detail_page ) Status @else Detail @endif</b>
                            <span class="fa fa-caret-down m-l-5"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li class="@if(!$list_detail_page) active @endif"><a href="/industrial_waste @if(!empty($conditions_view)) ? $conditions_view @endif"><b>Status</b></a></li>
                            <li  class="@if($list_detail_page) active @endif"><a href="/industrial_waste?view=list_detail @if( !empty($conditions_view) )& {{ $conditions_view }} @endif"><b>Detail</b></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="no-padding">

                    @include("partial/searchbox", [
                        'page' => "industrial_waste",
                        'view' => $view,
                        'config' => $pagination,
                        'search_field' => $search_field,
                        'search_value' => $search_value,
                        'industrial_waste_types' => $industrial_waste_types
                    ])

                    {{--@include('partial/search', ['config' => $pagination])--}}

                    @if( empty($list_detail_page) )
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="minimal checkAll" value=""></th>
                                    <th class="text-center" style="min-width:120px">Ticket name
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'take_off_at' && $sort == 'ASC')sorting_asc
                                             @elseif( $order == 'take_off_at' && $sort == 'DESC') sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="take_off_at"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Recipient name
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'customer' && $sort == 'ASC' )sorting_asc
                                             @elseif( $order == 'customer' && $sort == 'DESC' )sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="customer"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Project name
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'ticket_name' && $sort == 'ASC' )sorting_asc
                                             @elseif( $order == 'ticket_name' && $sort == 'DESC' )sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="ticket_name"></a>
                                        </div>
                                    </th>
                                    <th class="text-center">To draw a decision</th>
                                    <th class="text-center">Delivery requested</th>
                                    <th class="text-center">Draw a daily contact</th>
                                    <th class="text-center">Draw a detailed decision</th>
                                    <th class="text-center">Loading complete</th>
                                    <th class="text-center">Quantity determined</th>
                                    <th class="text-center">Processing complete</th>
                                    <th class="text-center">MF return</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            @forelse( $industrial_wastes AS $industrial_waste )
                            <tr>
                            <tr>
                                <td class="check"><input type="checkbox" name="industrial_waste_id" value="{{ $industrial_waste['id'] }}" class="minimal check"></td>
                                <td>{{ $industrial_waste['ticket_name'] or '' }}</td>
                                <td class="text-left">{{ $industrial_waste['client_customer_name'] or '' }}</td>
                                <td class="text-left">{{ $industrial_waste['ticket_name'] or '' }}</td>

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['confirm_taking_over'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['requested_to_deliver'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['contact_taking_over_date'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['contact_taking_over_detail'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['carrying_in_completion'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['confirm_quantity'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['disposal_completed'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                @include('industrial_waste/partial/item_definition', [
                                    'definition_data' => $industrial_waste['definition_data']['return_mf'],
                                    'data_id' => $industrial_waste['id']
                                ])

                                <td>
                                    <a href="/industrial_waste/copy?id={{$industrial_waste['id'] or ''}}" class="btn btn-success btn-flat btn-xs"><b><i class="fa fa-files-o margin-r-5"></i>複製</b></a>&nbsp;
                                    <a href="/industrial_waste/{{$industrial_waste['id'] or ''}}" class="btn btn-info btn-flat btn-xs"><b><i class="fa fa-file-text margin-r-5"></i>詳細</b></a>
                                </td>
                            </tr>
                            </tr>
                            @empty
                                @include('partial/list_empty', ['total_column' => 13])
                            @endforelse
                            </tbody>
                            <div class="x-table-overlay">
                                <div class="overlay">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                        </table>
                    </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="minimal checkAll" name="industrial_waste_id" value=""></th>
                                    <th class="text-center" style="min-width:120px">Ticket name
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'take_off_at' && $sort == 'ASC')sorting_asc
                                             @elseif( $order == 'take_off_at' && $sort == 'DESC')sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="take_off_at"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Recipient name
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'customer' && $sort == 'ASC' )sorting_asc
                                             @elseif( $order == 'customer' && $sort == 'DESC' )sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="customer"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Project name
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'ticket_name' && $sort == 'ASC')sorting_asc
                                             @elseif( $order == 'ticket_name' && $sort == 'DESC')sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="ticket_name"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:190px">Manifest number
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'manifest_no' && $sort == 'ASC') sorting_asc
                                             @elseif( $order == 'manifest_no' && $sort == 'DESC')sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="manifest_no"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Industrial waste type
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'type' && $sort == 'ASC')sorting_asc
                                             @elseif( $order == 'type' && $sort == 'DESC')sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="type"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Acquisition quantity
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'quantity' && $sort == 'ASC')sorting_asc
                                             @elseif( $order == 'quantity' && $sort == 'DESC')sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="quantity"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">Shipping company
                                        <div class="">
                                            <a class="sort
                                             @if( $order == 'logistic_customer' && $sort == 'ASC') sorting_asc
                                             @elseif( $order == 'logistic_customer' && $sort == 'DESC') sorting_desc
                                             @else sorting @endif" style="color:#4F5155" data-order="logistic_customer"></a>
                                        </div>
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                @forelse($industrial_wastes AS $industrial_waste)
                                <tr>
                                    <td class="check"><input type="checkbox" name="industrial_waste_id" value="{{$industrial_waste['id']}}" class="minimal check"></td>
                                    <td>{{ $industrial_waste['ticket_name'] or '' }}</td>
                                    <td class="text-left">{{ $industrial_waste['client_customer_name'] or '' }}</td>
                                    <td class="text-left">{{ $industrial_waste['ticket_name'] or '' }}</td>
                                    <td class="text-left">{{ $industrial_waste['manifest_no'] or '' }}</td>
                                    <td>{{ $industrial_waste['type_name'] or '' }}</td>
                                    <td class="text-left">{{ $industrial_waste['quantity'] or '' }}{{ $industrial_waste['unit'] or '' }}</td>
                                    <td class="text-left">{{ $industrial_waste['logistic_customer_name'] or '' }}</td>
                                    <td>
                                        <a href="/industrial_waste/copy?id={{ $industrial_waste['id'] or '' }}" class="btn btn-success btn-flat btn-xs"><b><i class="fa fa-files-o margin-r-5"></i>複製</b></a>&nbsp;
                                        <a href="/industrial_waste/detail/{{ $industrial_waste['id'] or '' }}" class="btn btn-info btn-flat btn-xs"><b><i class="fa fa-file-text margin-r-5"></i>詳細</b></a>
                                    </td>
                                </tr>
                                @empty
                                    @include('partial/list_empty', ['total_column' => 9] )
                                @endforelse
                                </tbody>
                                <div class="x-table-overlay">
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </table>
                    </div>
                    @endif

                    @include('partial/pagination', ['config' => $pagination ])
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    @include('partial/modal/industrial_waste/change_status')
    @include('partial/modal/select_date', [
            'title' => "CSVダウンロード",
            'action' => "api/industrial_waste/csv",
            'search_field' => $search_field,
            'search_value' => $search_value,
            'order' => $order,
            'sort' => $sort
        ])
</div>
@endsection

@section('javascript')
<script>
    $(function () {
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

    });
</script>
<script type="text/javascript" src="/js/TEXIS.IndustrialList.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        new TEXIS.IndustrialList({
            el: $('#x-list-industrial-waste')
        });
    });
</script>
@endsection