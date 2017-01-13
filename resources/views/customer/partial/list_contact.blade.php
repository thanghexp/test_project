<div class="panel-group" id="customerContact" role="tablist" aria-multiselectable="true">
    <!--{foreach from=$contacts item=contact key=key}-->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<!--{$key}-->">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#customerContact" href="#contact<!--{$key}-->" aria-expanded="true" aria-controls="contact<!--{$key}-->">
                        <ul class="list-inline list-customer m-b-0">
                            <!--{if !empty($contact.status_name)}-->
                            <li><i class="fa fa-info-circle margin-r-5"></i><!--{$contact.status_name|escape|default:''}--></li>
                            <!--{/if}-->

                            <!--{if !empty($contact.name)}-->
                            <li><i class="fa fa-user margin-r-5"></i><!--{$contact.name|escape|default:''}--></li>
                            <!--{/if}-->

                            <!--{if !empty($contact.position)}-->
                            <li><i class="fa fa-map-marker margin-r-5"></i><!--{$contact.position|escape|default:''}--></li>
                            <!--{/if}-->

                            <!--{if !empty($contact.phone_number)}-->
                            <li><i class="fa fa-phone-square margin-r-5"></i><!--{phone_number tel=$contact.phone_number|escape}--></li>
                            <!--{/if}-->
                        </ul>
                    </a>
                </h4>
            </div>
            <div id="contact<!--{$key}-->" class="panel-collapse collapse <!--{if $key==0}-->in<!--{/if}-->" role="tabpanel" aria-labelledby="heading<!--{$key}-->">
                <div class="panel-body p-d-10">
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>ステータス</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$contact.status_name|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>担当者名</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$contact.name|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>役職</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$contact.position|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>電話番号</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{phone_number tel=$contact.phone_number|escape}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>電話番号（携帯）</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{phone_number tel=$contact.mobile_number|escape}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>メールアドレス</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$contact.email|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>優先連絡手段</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$contact.priority_contact_name|escape|default:''}--></p>
                    </div>
                    <div class="row">
                        <p class="col-sm-5 col-xs-6 width-xs"><b>備考</b></p>
                        <p class="col-sm-7 col-xs-6 width-xs"><!--{$contact.remark|escape|nl2br|default:''}--></p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-2 col-xs-6">
                            <a href="javascript:;"
                               class="btn btn-block btn-danger x-delete-customer-contact"
                               data-id="<!--{$contact.id}-->"><b><i class="fa fa-trash margin-r-5"></i>削除</b></a>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <a href="<!--{$contact.customer_id}-->/edit_contact/<!--{$contact.id|default:''}-->" class="btn btn-block btn-warning"><b><i class="fa fa-edit margin-r-5"></i>編集</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--{foreachelse}-->
    <!--{include file='partial/list_empty_1.html'}-->
    <!--{/foreach}-->
</div>
