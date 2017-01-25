@extends('layouts/base')


@section('content')
<div class="row" id="x-customer-detail">
    <div class="col-lg-5 col-md-6">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">
                    <p class="avatar-icon"><i class="fa fa-users margin-r-5 text-primary"></i></p>
                    <p>{{ $data_customer['name'] or '' }}</p>
                </h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <i class="fa fa-check-circle margin-r-5 text-primary"></i>ステータス
                        <span class="pull-right"><small class="label label-success">{{ $data_customer['status'] or '' }}</small></span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-cogs margin-r-5 text-primary"></i>取引先種別
                        <span class="pull-right">{{ !empty($data_customer['type']) ? implode(',', $data_types) : '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-codepen margin-r-5 text-primary"></i>郵便番号
                        <span class="pull-right">{{ $data_customer['postal_code'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-map-marker margin-r-5 text-primary"></i>住所
                        <span class="pull-right">{{ $data_customer['address'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-phone-square margin-r-5 text-primary"></i>電話番号
                        <span class="pull-right">{{ $data_customer['fax_number'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-fax margin-r-5 text-primary"></i>FAX番号
                        <span class="pull-right">{{ $data_customer['phone_number'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-calendar margin-r-5 text-primary"></i>支払請求種別
                        <span class="pull-right">{{ $data_customer['bill_type_name'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-user margin-r-5 text-primary"></i>主担当者名
                        <span class="pull-right">{{ $data_customer['main_charge_name'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-user margin-r-5 text-primary"></i>副担当者名
                        <span class="pull-right">{{ $data_customer['extra_charge_name'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-file-text margin-r-5 text-primary"></i>備考
                        <p>{{ $data_customer['remark'] or '' }}</p>
                    </li>
                </ul>
            </div>
            <div class="box-footer">
                <a href="/customer/{{ $data_customer['id'] }}/edit" class="btn btn-warning btn-block"><b><i class="fa fa-edit margin-r-5"></i> 編集</b></a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker margin-r-5"></i>拠点情報</h3>
                <div class="box-tools pull-right">
                    <a href="/customer/{{ $data_customer['id'] }}/create_location" class="btn btn-success btn-flat btn-sm"><b><i class="fa fa-plus-circle margin-r-5"></i>追加</b></a>
                </div>
            </div>
            <div class="box-body">
                @include('customer/partial/list_location', ['locations' => $data_customer['customer_locations'] ] )
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-calendar-check-o margin-r-5"></i>担当者情報</h3>
                <div class="box-tools pull-right">
                    <a href="/customer/{{ $data_customer['id'] }}/create_contact" class="btn btn-success btn-flat btn-sm"><b><i class="fa fa-plus-circle margin-r-5"></i>追加</b></a>
                </div>
            </div>
            <div class="box-body">
                @include('customer/partial/list_contact', ['contacts' => $data_customer['customer_contacts']] )
            </div>
        </div>
    </div>

    <div class="col-lg-7 col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-clock-o margin-r-5 text-primary"></i>タイムライン</h3>
            </div>
            <div class="box-body">
                <div class="scroll scroll-customer">
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <!--{foreach from=$histories item=history}-->
                        <!--{item_history history=$history|json_encode}-->
                        <!--{/foreach}-->
                        <!-- .timeline item -->

                        <!--{if $log_limit < $log_total}-->
                        <div class="timeline-loadmore">
                            <a href="javascript:;" class="uppercase x-load-more-log"
                               data-object="<!--{$object|escape|default:''}-->"
                               data-action='<!--{$action|@json_encode|default:""}-->'
                               data-target="<!--{$target_id|default:''}-->"><b><i class="fa fa-chevron-circle-down margin-r-5"></i>もっと読み込む</b></a>
                        </div>
                        <!--{/if}-->

                        <li><i class="fa fa-clock-o bg-gray"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    {{ smarty_demo(['demo' => 'abc']) }}
     <!--{function name="demo_smarty" param="abc"}-->
    <!--{/function}-->
@endsection

@section('javascript')
<script type="text/javascript" src="/js/TEXIS.CustomerDetail.js"></script>
<script type="text/javascript" src="/js/TEXIS.History.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //Customer Detail
        new TEXIS.CustomerDetail({
            el: $('#x-customer-detail')
        });

        //History
        new TEXIS.History({
            el: $('#x-customer-detail')
        });
    });
</script>
@endsection

