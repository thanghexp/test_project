<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-<!--{if !empty($edit_data)}-->edit<!--{else}-->plus-circle<!--{/if}--> margin-r-5 text-primary"></i>担当者情報</h3>
            </div>
            <form role="form" class="" method="POST">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <input type="hidden" name="customer_id" value="<!--{$customer_id}-->">

                            <div class="form-group">
                                <label>ステータス<span class="text-danger">※</span></label>
                                <select class="form-control select2" id="status" name="status">
                                    @foreach($contact_status AS $status )
                                    <option value="{{$status['code']}}" @if isset($data_contact['status']) && $data_contact['status'] ==$status['code']) selected @endif>{{ $status['value'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>担当者名<span class="text-danger">※</span></label>
                                <input type="text" class="form-control"
                                       id="name"
                                       placeholder="担当者名を入力してください"
                                       value="<!--{$data_contact.name|escape|default:''}-->"
                                       name="name">
                            </div>
                            <div class="form-group">
                                <label>役職</label>
                                <input type="text" class="form-control"
                                       id="position"
                                       name="position"
                                       value="<!--{$data_contact.position|escape|default:''}-->"
                                       placeholder="役職を入力してください">
                            </div>
                            <div class="form-group">
                                <label>電話番号<span class="text-danger">※</span></label>
                                <input type="text" class="form-control"
                                       id="phone_number"
                                       name="phone_number"
                                       value="<!--{$data_contact.phone_number|escape|default:''}-->"
                                       placeholder="電話番号を入力してください">
                            </div>
                            <div class="form-group">
                                <label>電話番号（携帯）</label>
                                <input type="text" class="form-control"
                                       id="mobile_number"
                                       name="mobile_number"
                                       value="<!--{$data_contact.mobile_number|escape|default:''}-->"
                                       placeholder="電話番号（携帯）を入力してください">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>メールアドレス</label>
                                <input type="text" class="form-control"
                                       id="email"
                                       name="email"
                                       value="<!--{$data_contact.email|escape|default:''}-->"
                                       placeholder="メールアドレスを入力してください">
                            </div>
                            <div class="form-group">
                                <label>LINE ID</label>
                                <input type="text" class="form-control"
                                       id="line_account"
                                       name="line_account"
                                       value="<!--{$data_contact.line_account|escape|default:''}-->"
                                       placeholder="LINE IDを入力してください">
                            </div>
                            <div class="form-group">
                                <label>Facebook アカウント名</label>
                                <input type="text" class="form-control"
                                       id="facebook_account"
                                       name="facebook_account"
                                       value="<!--{$data_contact.facebook_account|escape|default:''}-->"
                                       placeholder="Facebookアカウント名を入力してください">
                            </div>
                            <div class="form-group">
                                <label>優先連絡手段</label>
                                <select class="form-control select2" id="priority_contact_type" name="priority_contact_type">
                                    <option value="">優先連絡手段を選択してください</option>
                                    <!--{foreach from=$priority_contact item=contact}-->
                                    <option value="<!--{$contact.code|escape}-->" <!--{if isset($data_contact.priority_contact_type) && $data_contact.priority_contact_type == $contact.code}-->selected<!--{/if}-->><!--{$contact.value|escape|default:''}--></option>
                                    <!--{/foreach}-->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>備考</label>
                                <textarea class="form-control"
                                          rows="5"
                                          id="remark"
                                          name="remark"
                                          placeholder="備考情報があれば登録してください"><!--{$data_contact.remark|escape|default:''}--></textarea>
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
