<div id="sendConfirmModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><b>送信確認</b></h4>
            </div>
            <form id="frm-confirm-send" action="" method="POST">
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="modal-body">
                    <div class="row">
                        <p class="col-md-12 x-title-modal-send-confirm"></p>
                        <div class="col-md-12">

                            @if( !empty($data['client_location_id']) )
                            <div class="form-group m-b-10 row">
                                <div class="col-xs-2 text-right p-t-2">
                                    <input type="checkbox" name="customer_id" class="minimal margin-r-5" value=<!--{$data.client_customer_id}-->>
                                </div>
                                <div class="col-xs-10 p-l-0">
                                    <label class="label-custom">引取先　：{{ $data['client_customer_name'] or '' }}, {{ $data['client_customer_main_charge']['name'] or '' }}</label>
                                </div>
                            </div>
                            @endif

                            @if( !empty($data['logistic_location_id']) )
                            <div class="form-group row">
                                <div class="col-xs-2 text-right p-t-2">
                                    <input type="checkbox" name="logistic_customer_id" class="minimal margin-r-5" value=<!--{$data.logistic_customer_id}-->>
                                </div>
                                <div class="col-xs-10 p-l-0">
                                    <label class="label-custom">運送会社 ：{{ $data['logistic_customer_name'] or '' }}, {{ $data['logistic_customer_main_charge']['name'] or '' }}</label>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                            <a href="javascript:;" class="btn btn-primary btn-block x-button-send"><b><i class="fa fa-exchange margin-r-5"></i>送信</b></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>