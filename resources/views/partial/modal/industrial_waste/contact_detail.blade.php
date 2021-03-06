<div id="contact_detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><b>詳細</b></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <p class="col-xs-4">産業廃棄物種別</p>
                    <p class="col-xs-8"><!--{$data.type_name|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">マニフェストNo.</p>
                    <p class="col-xs-8"><!--{$data.manifest_no|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">引取数量</p>
                    <p class="col-xs-8"><!--{$data.quantity|escape|default:''}--><!--{$data.unit_name|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">運送会社</p>
                    <p class="col-xs-8"><!--{$data.logistic_customer_name|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">運搬方法</p>
                    <p class="col-xs-8"><!--{$data.method_deliver|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">引取日</p>
                    <p class="col-xs-8"><!--{$data.take_off_at|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">引取時間</p>
                    <p class="col-xs-8"><!--{$data.take_off_time|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">車番</p>
                    <p class="col-xs-8"><!--{$data.car_number|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">ドライバー名</p>
                    <p class="col-xs-8"><!--{$data.driver_name|escape|default:''}--></p>
                </div>
                <div class="row">
                    <p class="col-xs-4">備考</p>
                    <p class="col-xs-8"><!--{$data.take_off_note|escape|nl2br|default:''}--></p>
                </div>
            </div>

            <div class="modal-footer">
                <form id="frm-contact-detail" target="_blank" method="POST" action="/api/industrial_waste/handle_contact_detail">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <div class="row">
                        <div class="col-xs-6 m-b-10">
                            <a href="javascript:;" data-method="pdf" class="btn btn-primary btn-block x-button-pdf-contact-detail"><b><i class="fa fa-print margin-r-5"></i>印刷</b></a>
                        </div>
                        <div class="col-xs-6">
                            <a href="javascript:;" data-method="email" class="btn btn-primary btn-block x-button-email-contact-detail"><b><i class="fa fa-envelope margin-r-5"></i>Email送信</b></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 m-b-10">
                            <a href="javascript:;" data-method="fax" class="btn btn-primary btn-block x-button-fax-contact-detail"><b><i class="fa fa-fax margin-r-5"></i>FAX送信</b></a>
                        </div>
                        <div class="col-xs-6 form-group">
                            <a href="javascript:;" data-method="phone" class="btn btn-primary btn-block x-button-phone-contact-detail"><b><i class="fa fa-phone-square margin-r-5"></i>電話</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
