<div class="panel-group" id="customerLocation" role="tablist" aria-multiselectable="true">

   @foreach($locations as $key => $location )
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{$key}}">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#customerLocation" href="#location{{$key}}" ar{a-expanded="true" aria-controls="location{{$key}}">
                        <ul class="list-inline list-customer m-b-0">
                            @if(!empty($location['status']) )
                                <li><i class="fa fa-info-circle margin-r-5"></i>{{ $location['status'] }}</li>
                            @endif

                            @if( !empty($location['site_name']) )
                                <li><i class="fa fa-map-marker margin-r-5"></i>{{ $location['site_name'] }}</li>
                            @endif

                            @if( !empty($location['phone_number']) )
                                <li><i class="fa fa-phone-square margin-r-5"></i>{{ $location['phone_number'] }}</li>
                            @endif
                        </ul>
                    </a>
                </h4>
            </div>
            <div id="location{{ $key }}" class="panel-collapse collapse @if( $key==0 )in @endif" role="tabpanel" aria-labelledby="heading {{ $key }}">
                <div class="panel-body p-d-10">
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Status</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['status'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Site name</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['site_name'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Postal code</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['postal_code'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Address</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['address'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Phone number</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['phone_number'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Fax number</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['fax_number'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Main charge name</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['main_charge_name'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Secondary charge name</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['extra_charge_name'] or '' }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>Remark</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs">{{ $location['remark'] or '' }}</p>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 width-xs m-b-10">
                            <a href="javascript:;"
                               class="btn btn-block btn-danger x-delete-customer-local"
                               data-id="<!--{$location.id}-->"><b><i class="fa fa-trash margin-r-5"></i>削除</b></a>
                        </div>
                        <div class="col-xs-4 width-xs m-b-10">
                            <a href="{{ $location['id'] }}/edit_location/{{ $location['id'] }}" class="btn btn-block btn-warning"><b><i class="fa fa-edit margin-r-5"></i>編集</b></a>
                        </div>
                        @if( $location['status'] == 'active' )
                            <div class="col-xs-4 width-xs">
                                <a href="javascript:;"
                                   class="btn btn-block btn-success x-button-sale-active"
                                   data-location-id="{{ $location['id'] }}">
                                    <b><i class="fa fa-check-circle margin-r-5"></i>活動登録</b></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--{include file='partial/list_empty_1.html'}-->
   @endforeach

</div>
<!--{content_for name="headjs"}-->
<script type="text/javascript" src="/js/TEXIS.SaleActive.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        new TEXIS.SaleActive({
            el: $('#customerLocation')
        });
    });
</script>
<!--{/content_for}-->