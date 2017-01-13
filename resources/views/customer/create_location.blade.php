<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-<!--{if !empty($edit_data)}-->edit<!--{else}-->plus-circle<!--{/if}--> margin-r-5 text-primary"></i>拠点情報</h3>
            </div>
            <form role="form" class="" method="POST">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <input type="hidden" name="customer_id" value="<!--{$customer_id}-->">

                            <div class="form-group">
                                <label>ステータス<span class="text-danger">※</span></label>
                                <select class="form-control select2" id="status" name="status">
                                    <!--{foreach from=$location_status item=status}-->
                                    <option value="<!--{$status.code|escape}-->" <!--{if isset($data_location.status) && $data_location.status==$status.code}-->selected<!--{/if}-->><!--{$status.value|escape|default:''}--></option>
                                    <!--{/foreach}-->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>拠点名<span class="text-danger">※</span></label>
                                <input type="text" class="form-control"
                                       id="site_name"
                                       name="site_name"
                                       value="<!--{$data_location.site_name|escape|default:''}-->"
                                       placeholder="拠点名を入力してください">
                            </div>
                            <div class="form-group">
                                <label>郵便番号</label>
                                <input type="text" class="form-control"
                                       id="postal_code"
                                       name="postal_code"
                                       value="<!--{$data_location.postal_code|escape|default:''}-->"
                                       placeholder="郵便番号をハイフン無しで入力してください">
                            </div>
                            <div class="form-group">
                                <label>住所</label>
                                <input type="text" class="form-control"
                                       id="address"
                                       name="address"
                                       value="<!--{$data_location.address|escape|default:''}-->"
                                       placeholder="住所をすべて入力してください">
                            </div>
                            <div class="form-group">
                                <label>電話番号</label>
                                <input type="text" class="form-control"
                                       id="phone_number"
                                       name="phone_number"
                                       value="<!--{$data_location.phone_number|escape|default:''}-->"
                                       placeholder="電話番号を入力してください">
                            </div>
                            <div class="form-group">
                                <label>FAX番号</label>
                                <input type="text" class="form-control"
                                       id="fax_number"
                                       name="fax_number"
                                       value="<!--{$data_location.fax_number|escape|default:''}-->"
                                       placeholder="ファックスを入力してください。">
                            </div>
                            <div class="form-group">
                                <label>主担当者名</label>
                                <select class="form-control select2" id="main_charge" name="main_charge">
                                    <option value="">主担当者名を選択してください</option>
                                    <!--{foreach from=$customer_contacts item=contact}-->
                                    <option value="<!--{$contact.id|escape}-->" <!--{if isset($data_location.main_charge) && $data_location.main_charge == $contact.id}-->selected<!--{/if}-->><!--{$contact.name|escape}--></option>
                                    <!--{/foreach}-->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>副担当者名</label>
                                <select class="form-control select2" id="extra_charge" name="extra_charge">
                                    <option value="">副担当者名を選択してください</option>
                                    <!--{foreach from=$customer_contacts item=contact}-->
                                    <option value="<!--{$contact.id|escape}-->" <!--{if isset($data_location.extra_charge) && $data_location.extra_charge == $contact.id}-->selected<!--{/if}-->><!--{$contact.name|escape}--></option>
                                    <!--{/foreach}-->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>商品情報</label>
                                <input type="text" class="form-control"
                                       id="product_info"
                                       name="product_info"
                                       value="<!--{$data_location.product_info|escape|default:''}-->"
                                       placeholder="取扱商品情報を入力してください">
                            </div>
                            <div class="form-group">
                                <label>発生量または消費量</label>
                                <input type="text" class="form-control"
                                       id="consumption"
                                       name="consumption"
                                       value="<!--{$data_location.consumption|escape|default:''}-->"
                                       placeholder="発生量または消費量を入力してください">
                            </div>
                            <div class="form-group">
                                <label>現在の取引単価</label>
                                <input type="text" class="form-control"
                                       id="trading_unit_price"
                                       name="trading_unit_price"
                                       value="<!--{$data_location.trading_unit_price|escape|default:''}-->"
                                       placeholder="現在の取引単価を入力してください">
                            </div>
                            <div class="form-group">
                                <label>フォークリフト有無</label>
                                <input type="text" class="form-control"
                                       id="forklift"
                                       name="forklift"
                                       value="<!--{$data_location.forklift|escape|default:''}-->"
                                       placeholder="フォークリフトの有無を入力してください">
                            </div>
                            <div class="form-group">
                                <label>備考</label>
                                <textarea class="form-control"
                                          rows="8"
                                          id="remark"
                                          name="remark"
                                          placeholder="備考情報があれば登録してください"><!--{$data_location.remark|escape|default:''}--></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                   <div class="row">
                       <div class="col-md-3 col-sm-4 col-xs-6 col-md-offset-3 col-sm-offset-2">
                           <a id="x-button-cancel" href="/customer/<!--{$customer_id|default:''}-->" class="btn btn-block btn-default"><b><i class="fa fa-ban margin-r-5"></i>キャンセル</b></a>
                       </div>
                       <div class="col-md-3 col-sm-4 col-xs-6">
                           <button type="submit" class="btn btn-block btn-primary"><b><i class="fa fa-save margin-r-5"></i>保存</b></button>
                       </div>
                   </div>
                </div>
            </form>
        </div>
    </div>
</div>
