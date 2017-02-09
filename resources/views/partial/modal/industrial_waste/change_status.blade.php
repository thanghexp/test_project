<div id="statusModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><b>Change status</b></h4>
            </div>
            <form role="form" action="/api/definition/change_status" method="POST">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="row">

                        <p class="col-md-12">Would you like to change the status of the takeover decision?<br/>
                            To change, set the status you want to change,<br>
                            Please click "change" button.、</p>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control select2" name="definition_status">
                                    <option value="0">Not finished</option>
                                    <option value="1">Finished</option>
                                    <option value="2">Do not</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="type" value="">
                        <input type="hidden" name="code" value="">
                        <input type="hidden" name="id_target" value="">

                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-push-6 col-xs-6 width-xs m-b-xs-10">
                            <a href="javascript:;" id="x-btn-definition-submit" class="btn btn-primary btn-block"><b><i class="fa fa-save margin-r-5"></i>Save</b></a>
                        </div>
                        <div class="col-sm-6 col-sm-pull-6 col-xs-6 width-xs">
                            <a href="javascript:;" class="btn btn-default btn-block" data-dismiss="modal" aria-label="Close"><b><i class="fa fa-ban margin-r-5"></i>Cancel</b></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
