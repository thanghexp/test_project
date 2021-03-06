<div id="selectDateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><b><!--{$title|escape|default:''}--></b></h4>
            </div>
            <form role="form" id="x-form-csv" action="{{$action}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!--url route=$action-->
                @if( !empty($search_value) )
                    <input type="hidden" name="search_value" value="{{ $search_value or '' }}">
                @endif

                @if( !empty($search_field) )
                    <input type="hidden" name="search_field" value="{{ $search_field or '' }}">
                @endif

                @if( !empty($order) )
                    <input type="hidden" name="order" value="{{$order or ''}}">
                @endif

                @if( !empty($sort) )
                    <input type="hidden" name="sort" value="{{$sort or ''}}">
                @endif

                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label>から</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" placeholder="1990/01/01"
                                   id="x-csv-date-from" name="date_from">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>まで</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" placeholder="1990/01/01"
                                   id="x-csv-date-to" name="date_to">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-push-6 col-xs-6 width-xs m-b-xs-10">
                            <a href="javascript:;" class="btn btn-primary btn-block x-button-download"><b><i class="fa fa-download margin-r-5"></i>ダウンロード</b></a>
                        </div>
                        <div class="col-sm-6 col-sm-pull-6 col-xs-6 width-xs">
                            <a href="javascript:;" data-dismiss="modal" aria-label="Close" class="btn btn-default btn-block"><b><i class="fa fa-ban margin-r-5"></i>キャンセル</b></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
