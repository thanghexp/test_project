<div class="row">
    <div class="col-md-6 col-md-push-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title"><i class="fa fa-info-circle margin-r-5 text-primary"></i>サジェスト情報</h4>
            </div>
            <div class="box-body">
                <p><b>過去の産業廃棄物引取状況</b></p>
                <div class="no-padding scroll-800">
                    <div class="table-responsive">
                        <table class="table table-hover table-suggest" id="tb_industrial_waste_hint" data-current-id="{{ $current_id or '' }}">
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer x-box-footer">
                <a class="btn btn-info btn-block btn-load-more x-suggest-btn-load-more" href="javascript:;" title="もっと読み込む"><b><i class="fa fa-chevron-circle-down margin-r-5"></i>もっと読み込む</b></a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-md-pull-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-@if( !empty($edit_data) )edit @else plus-circle @endif margin-r-5 text-primary"></i>産業廃棄物情報</h3>
            </div>
            <form role="form" class="" method="POST" id="frm_industrial_waste">
                <div class="box-body">
                    <div class="form-group">
                        <label>産業廃棄物種別<span class="text-danger">※</span></label>
                        <select class="form-control select2 x-select2-search industrial_waste_select_has_render x-select-box-industrial-type"
                                name="type" data-placeholder="産業廃棄物種別を選択してください">
                            <option></option>
                            @foreach( $industrial_waste_type AS $row )
                                <option value="{{ $row['code'] }}"
                                    @if( isset($old_data['type']) && $old_data['type'] == $row['code'] ) selected @endif>
                                    {{ $row['value'] or '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ステータス<span class="text-danger">※</span></label>
                        <select class="form-control select2 field-need-import"
                                name="status" data-placeholder="ステータスを選択してください">
                            <option></option>
                            @foreach($industrial_waste_status AS $row)
                                <option value="<!--{$row.code|escape}-->"
                                    @if( isset($old_data['status']) && $old_data['status'] == $row['code'] )selected @endif >
                                    {{ $row['value'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>引取先（交付者）<span class="text-danger">※</span></label>
                        <select class="form-control select2 x-select2-search x-select-box-industrial-issuer industrial_waste_select_has_render"
                                name="client_customer_id" data-placeholder="引取先名（交付者）名を選択してください">
                            <option></option>>
                            @foreach( $client_customer_business AS $row )
                                <option value="{{ $row['id'] }}"
                                    @if( isset($old_data['client_customer_id']) && $old_data['client_customer_id'] == $row['id'] ) selected @endif >
                                   {{ $row['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>拠点名<span class="text-danger">※</span></label>
                        <select class="form-control select2" name="client_location_id" data-placeholder="拠点名を選択してください">
                            <option></option>
                            @foreach( $client_customer_location AS $row )
                                <option value="{{ $row['id'] }}"
                                    @if( isset($old_data['client_location_id']) && $old_data['client_location_id'] == $row['id'] )  selected @endif >
                                    {{ $row['site_name'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="hd_client_location_id" value="{{ $old_data['client_location_id'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>案件名称</label>
                        <input type="text" class="form-control field-need-import" placeholder="案件名称を入力してください。"
                               name="ticket_name" value="{{ $old_data['ticket_name'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>マニフェストNo.</label>
                        <input type="text" class="form-control field-need-import" placeholder="マニフェストNo.を入力してください"
                               name="manifest_no" value="{{ $old_data['manifest_no'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>マニフェスト交付年月日</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker1" placeholder="処理完了日を選択してください"
                                   name="manifest_issue_date" value="{{ $old_data['manifest_issue_date'] or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>入り数</label>
                        <div class="row">
                            <div class="col-xs-8">
                                <input type="text" class="form-control field-need-import" placeholder="入り数を入力してください"
                                       name="quantity_in_box" value="{{ $old_data['quantity_in_box'] or '' }}">
                            </div>
                            <div class="col-xs-4">
                                <select class="form-control select2 field-need-import" name="unit" data-placeholder="単位を選択">
                                    <option></option>
                                    @foreach( $industrial_waste_unit AS $row )
                                        <option value="<!--{$row.code|escape}-->"
                                            @if( isset($old_data['unit']) && $old_data['unit'] == $row['code'] ) selected @endif >
                                            {{ $row['valuel'] or '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ケース数</label>
                        <input type="text" class="form-control field-need-import" placeholder="引取数量は自動計算されます"
                               name="quantity_total_box" value="{{ $old_data['quantity_total_box'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>引取数量</label>
                        <input type="text" class="form-control field-need-import" readonly placeholder="引取数量は自動計算されます"
                               name="quantity" value="{{ $old_data['quantity'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>引取単価</label>
                        <input type="text" class="form-control field-need-import" placeholder="引取単価/kgを入力してください"
                               name="unit_price" value="{{ $old_data['unit_price'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>処分方法</label>
                        <select class="form-control select2 x-select2-search field-need-import" name="disposal" data-placeholder="処分方法を選択してください">
                            <option></option>
                            @foreach($industrial_waste_method_disposal AS $row )
                                <option value="{{ $row['code'] }}"
                                    @if( isset($old_data['disposal']) && $old_data['disposal'] == $row['code'] ) selected @endif >
                                    {{ $row['value'] or '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>運送会社</label>
                        <select class="form-control select2 x-select2-search field-need-import" name="logistic_customer_id" data-placeholder="運送会社を選択してください">
                            <option></option>
                            @foreach($logistic_customer_business AS $row )
                                <option value="{{ $row['id'] }}"
                                    @if( isset($old_data['logistic_customer_id']) && $old_data['logistic_customer_id'] == $row['id'] ) selected @endif >
                                    {{ $row['name'] or '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>運送業者の所在地</label>
                        <select class="form-control select2" name="logistic_location_id" data-placeholder="拠点名を選択してください">
                            <option></option>
                            @foreach( $logistic_customer_location as $row )
                            <option value="{{ $row['id'] }}"
                            @if( isset($old_data['logistic_location_id']) && $old_data['logistic_location_id'] == $row['id'] ) selected @endif>
                            {{ $row['site_name'] or '' }}
                            </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="hd_logistic_location_id" value="{{ $old_data['logistic_location_id'] or '' }}">
                    </div>
                    <!--{if $is_admin }-->
                    <div class="form-group">
                        <label>運搬方法</label>
                        <input type="text" class="form-control field-need-import" placeholder="運搬方法を入力してください"
                               name="method_deliver" value="{{ $old_data['method_deliver'] or '' }}">
                    </div>
                    <!--{/if}-->
                    <div class="form-group">
                        <label>運賃</label>
                        <input type="text" class="form-control field-need-import" placeholder="運賃を入力してください"
                               name="freight_rate" value="{{ $old_data['freight_rate'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>運賃原価</label>
                        <input type="text" class="form-control field-need-import" placeholder="運賃原価を入力してください"
                               name="freight_rate_original" value="{{ $old_data['freight_rate_original'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>引取日</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker2" placeholder="引取日を選択してください"
                                   name="take_off_at" value="{{ $old_data['take_off_at'] or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>引取時間</label>
                        <input type="text" class="form-control" placeholder="引取時間を入力してください"
                               name="take_off_time" value="{{ $old_data['take_off_time'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>車番</label>
                        <input type="text" class="form-control field-need-import" placeholder="車番を入力してください"
                               name="car_number" value="{{ $old_data['car_number'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>ドライバー名</label>
                        <input type="text" class="form-control field-need-import" placeholder="ドライバー名を入力してください"
                               name="driver_name" value="{{ $old_data['driver_name'] or '' }}">
                    </div>
                    <div class="form-group">
                        <label>引取備考</label>
                        <textarea class="form-control field-need-import" rows="5" placeholder="備考情報があれば登録してください" name="take_off_note">{{ $old_data['take_off_note'] or '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>搬入日</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker3" placeholder="搬入日を選択してください"
                                   name="installation_at" value="{{ $old_data['installation_at'] or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>個口</label>
                        <select class="form-control select2 field-need-import" name="box_number" data-placeholder="個口数を選択してください">
                            <option></option>
                            @for($box_number = 1; $box_number < 10; $box_number++)
                                <option value="<!--{$box_number}-->"
                                    @if( isset($old_data['box_number']) && $old_data['box_number'] == $box_number ) selected @endif>
                                    {{ $box_number or '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>処理完了日</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker4" placeholder="処理完了日を選択してください"
                                   name="completed_at" value="{{ $old_data['completed_at'] or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>備考1</label>
                        <textarea class="form-control field-need-import" rows="5" placeholder="備考情報があれば登録してください" id="note_1" name="received_note[]">{{ $old_data['received_note'][0] or '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>備考2</label>
                        <textarea class="form-control" rows="5" placeholder="備考情報があれば登録してください" id="note_2" name="received_note[]">{{ $old_data['received_note'][1] or '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>備考3</label>
                        <textarea class="form-control" rows="5" placeholder="備考情報があれば登録してください" id="note_3" name="received_note[]">{{ $old_data['received_note'][2] or '' }}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 col-lg-offset-2">
                            <a id="x-button-cancel" href="/industrial_waste/<{{ $old_data['id'] or '' }}" class="btn btn-block btn-default"><b><i class="fa fa-ban margin-r-5"></i>キャンセル</b></a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <button type="submit" class="btn btn-block btn-primary"><b><i class="fa fa-save margin-r-5"></i>保存</b></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--{content_for name="headjs"}-->
<script type="text/javascript" src="/js/TEXIS.IndustrialWaste.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        new TEXIS.IndustrialWaste({
            el: $('#frm_industrial_waste')
        });
    });
</script>
<!--{/content_for}-->