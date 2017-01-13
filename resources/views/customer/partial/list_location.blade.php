<div class="panel-group" id="customerLocation" role="tablist" aria-multiselectable="true">
    <!--{foreach from=$locations item=location key=key}-->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<!--{$key}-->">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#customerLocation" href="#location<!--{$key}-->" aria-expanded="true" aria-controls="location<!--{$key}-->">
                        <ul class="list-inline list-customer m-b-0">
                            <!--{if !empty($location.status_name)}-->
                            <li><i class="fa fa-info-circle margin-r-5"></i><!--{$location.status_name|escape|default:''}--></li>
                            <!--{/if}-->

                            <!--{if !empty($location.site_name)}-->
                            <li><i class="fa fa-map-marker margin-r-5"></i><!--{$location.site_name|escape|default:''}--></li>
                            <!--{/if}-->

                            <!--{if !empty($location.phone_number)}-->
                            <li><i class="fa fa-phone-square margin-r-5"></i><!--{phone_number tel=$location.phone_number|escape}--></li>
                            <!--{/if}-->
                        </ul>
                    </a>
                </h4>
            </div>
            <div id="location<!--{$key}-->" class="panel-collapse collapse <!--{if $key==0}-->in<!--{/if}-->" role="tabpanel" aria-labelledby="heading<!--{$key}-->">
                <div class="panel-body p-d-10">
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>ステータス</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$location.status_name|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>拠点名称</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$location.site_name|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>郵便番号</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$location.postal_code|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>住所</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$location.address|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>電話番号</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{phone_number tel=$location.phone_number|escape}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>FAX番号</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{phone_number tel=$location.fax_number|escape}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>主担当者名</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{customer_contact name=$location.main_charge_name|escape|default:'' contact=$location.main_charge_contact|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>副担当者名</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{customer_contact name=$location.extra_charge_name|escape|default:'' contact=$location.extra_charge_contact|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>備考</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$location.remark|escape|nl2br|default:''}--></p>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 width-xs m-b-10">
                            <a href="javascript:;"
                               class="btn btn-block btn-danger x-delete-customer-local"
                               data-id="<!--{$location.id}-->"><b><i class="fa fa-trash margin-r-5"></i>削除</b></a>
                        </div>
                        <div class="col-xs-4 width-xs m-b-10">
                            <a href="<!--{$location.customer_id}-->/edit_location/<!--{$location.id}-->" class="btn btn-block btn-warning"><b><i class="fa fa-edit margin-r-5"></i>編集</b></a>
                        </div>
                        <!--{if $location.status == 'active'}-->
                            <div class="col-xs-4 width-xs">
                                <a href="javascript:;"
                                   class="btn btn-block btn-success x-button-sale-active"
                                   data-location-id="<!--{$location.id}-->">
                                    <b><i class="fa fa-check-circle margin-r-5"></i>活動登録</b></a>
                            </div>
                        <!--{/if}-->
                    </div>
                </div>
            </div>
        </div>
    <!--{foreachelse}-->
        <!--{include file='partial/list_empty_1.html'}-->
    <!--{/foreach}-->
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