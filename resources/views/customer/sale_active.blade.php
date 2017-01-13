<div class="row" id="x-sale-active">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-check-circle margin-r-5 text-primary"></i>取引先情報</h3>
            </div>
            <form role="form" id="x-form-sale-active" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label>活動日<span class="text-danger">※</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text"
                                   name="activated_at"
                                   value="<!--{$data_sale_active.activated_at|default:''}-->"
                                   class="form-control pull-right datepicker" placeholder="活動日を選択してください。">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>取引先名<span class="text-danger">※</span></label>
                        <select class="form-control select2" name="customer_id" id="customer_id">
                            <option value="">取引先名を選択してください</option>
                            <!--{foreach from=$customer_lists item=customer}-->
                            <option value="<!--{$customer.id}-->" <!--{if isset($data_sale_active.customer_id) && $data_sale_active.customer_id == $customer.id}-->selected<!--{/if}-->><!--{$customer.name}--></option>
                            <!--{/foreach}-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>拠点名<span class="text-danger">※</span></label>
                        <select id="customer_location_id"
                                name="customer_location_id"
                                data-select="<!--{$data_sale_active.customer_location_id|default:''}-->"
                                class="form-control select2">
                            <option value="">拠点名を選択してください</option>
                            <!--{if isset($location_lists)}-->
                                <!--{foreach from=$location_lists item=location}-->
                                <option value="<!--{$location.id}-->" <!--{if isset($data_sale_active.customer_location_id) && $data_sale_active.customer_location_id == $location.id}-->selected<!--{/if}-->><!--{$location.site_name}--></option>
                                <!--{/foreach}-->
                            <!--{/if}-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>コメント</label>
                        <textarea name="comment"
                                  class="form-control"
                                  rows="5"
                                  placeholder="活動報告を入力してください"><!--{$data_sale_active.comment|escape|default:''}--></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-6 col-md-offset-3 col-sm-offset-2">
                            <a id="x-button-cancel" href="<!--{$redirect_url|default:'/customer'}-->" class="btn btn-block btn-default btn-md"><b><i class="fa fa-ban margin-r-5"></i>キャンセル</b></a>
                            <input type="hidden" id="redirect_back" name="redirect_back" value="<!--{$redirect_url|escape|default:'/customer'}-->">
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <button type="submit" class="btn btn-block btn-primary x-submit-sale-active" data-flag="x-page-active-sale"><b><i class="fa fa-save margin-r-5"></i>保存</b></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--{content_for name="headjs"}-->
<script type="text/javascript" src="/js/TEXIS.SaleActive.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        new TEXIS.SaleActive({
            el: $('#x-sale-active')
        })
    });
</script>
<!--{/content_for}-->