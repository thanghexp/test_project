AppCore = window.AppCore || {};
var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.SaleDetail Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.SaleDetail = AppCore.Base.extend({

        el: 'body',
        total_sale_item: 0,

        events: {
            'click .x-button-pdf-request-delivery' : 'handleRequestDelivery',
            'click .x-button-email-request-delivery' : 'handleRequestDelivery',
            'click .x-button-fax-request-delivery' : 'handleRequestDelivery',
            'click .x-button-sms-request-delivery' : 'handleRequestDelivery',

            'click .x-button-email-delivery-date' : 'handleDeliveryDate',
            'click .x-button-fax-delivery-date' : 'handleDeliveryDate',
            'click .x-button-sms-delivery-date' : 'handleDeliveryDate',
            'click .x-button-pdf-delivery-date' : 'handleDeliveryDate',
            'click .x-button-phone-delivery-date': 'handleDeliveryDate',

            'click .x-button-email-delivery-detail' : 'handleDeliveryDetail',
            'click .x-button-fax-delivery-detail' : 'handleDeliveryDetail',
            'click .x-button-sms-delivery-detail' : 'handleDeliveryDetail',
            'click .x-button-pdf-delivery-detail' : 'handleDeliveryDetail',
            'click .x-button-phone-delivery-detail': 'handleDeliveryDetail',

            'click .x-button-submit-note-delivery' : 'downloadPdfNoteDelivery',
            'click .x-button-confirm-sale' : 'confirmSale',

            'click .x-button-send' : 'handleConfirmSend',
            'click .x-remove-purchase-info': 'deleteItemSale'
        },

        /**
         * Constructor
         *
         * @param {Object} config
         */
        initialize: function (config) {
            config = config || {};
            this.el = config.el || {};
            this.total_sale_item = config.total_sale_item || {};

            this.loader();
            this.render(config);
        },

        /**
         * Confirm sale
         * @param e
         */
        confirmSale: function(e){
            $('#frm-confirm-sale').submit();
            $('#confirmModal').modal('hide');
        },

        /**
         * Download pdf data note delivery
         * @param e
         */
        downloadPdfNoteDelivery: function(e){
            $('#frm-delivery-notice').submit();
            $('#note_deliveryModal').modal('hide');
        },

        /**
         * Handle modal request delivery
         * @param e
         */
        handleRequestDelivery: function(e) {
            var self = this;

            // Reload modal confirm
            self.handleInitDataModal();

            var target = $(e.currentTarget);
            var method = target.data('method');
            var from_target = $('#frm-request-delivery');
            var modal_information = $('#request_deliveryModal');

            var modal_confirm = $('#sendConfirmModal');
            var frm_confirm = $('#frm-confirm-send');

            // Change tile modal confirm
            var $title = '';
            switch (method) {
                case 'fax':
                    $title = 'Faxを送信する相手を選んでください。';
                    break;
                case 'email':
                    $title = 'Emailを送信する相手を選んでください。';
                    break;
                case 'sms':
                    $title = 'SMSを送信する相手を選んでください。';
                    break;
            }
            $('.x-title-modal-send-confirm').text($title);

            from_target.append('<input type="hidden" name="method" value="'+ method +'"></input>');
            frm_confirm.append('<input type="hidden" name="method" value="'+ method +'"></input>');
            frm_confirm.attr('action', '/api/sale/handle_request_delivery');

            switch (method) {
                case 'pdf':
                    from_target.attr('target',"_blank");
                    from_target.submit();
                    modal_information.modal('hide');
                    break;
                case 'fax':
                case 'email':
                case 'sms':
                    modal_confirm.modal("show");
                    modal_information.modal('hide');
                    break;
            }
        },

        /**
         * Handle modal delivery date
         * @param e
         */
        handleDeliveryDate : function(e) {

            var self = this;

            // Reload modal confirm
            self.handleInitDataModal();

            var target = $(e.currentTarget);
            var method = target.data('method');
            var from_target = $('#frm-delivery-date');
            var modal_information = $('#delivery_dateModal');

            var modal_confirm = $('#sendConfirmModal');
            var frm_confirm = $('#frm-confirm-send');

            // Change tile modal confirm
            var $title = '';
            switch (method) {
                case 'fax':
                    $title = 'Faxを送信する相手を選んでください。';
                    break;
                case 'email':
                    $title = 'Emailを送信する相手を選んでください。';
                    break;
                case 'sms':
                    $title = 'SMSを送信する相手を選んでください。';
                    break;
            }
            $('.x-title-modal-send-confirm').text($title);

            from_target.append('<input type="hidden" name="method" value="'+ method +'"></input>');
            frm_confirm.append('<input type="hidden" name="method" value="'+ method +'"></input>');
            frm_confirm.attr('action', '/api/sale/handle_delivery_date');

            switch (method) {
                case 'pdf':
                    from_target.attr('target',"_blank");
                    from_target.submit();
                    modal_information.modal('hide');
                    break;
                case 'fax':
                case 'email':
                case 'sms':
                    modal_confirm.modal("show");
                    modal_information.modal('hide');
                    break;
                case 'phone':
                    $('#sendPhoneConfirmModal').modal("show");
                    $('#frm-phone-confirm-send').append('<input type="hidden" name="method" value="'+ method +'"></input>');
                    $('#frm-phone-confirm-send').attr('action', '/api/sale/handle_delivery_date');
                    modal_information.modal('hide');
                    break;
            }
        },

        /**
         * Handle modal contact taking detail
         * @param e
         */
        handleDeliveryDetail : function(e) {

            var self = this;

            // Reload modal confirm
            self.handleInitDataModal();

            var target = $(e.currentTarget);
            var method = target.data('method');
            var from_target = $('#frm-delivery-detail');
            var modal_information = $('#delivery_detailModal');

            var modal_confirm = $('#sendConfirmModal');
            var frm_confirm = $('#frm-confirm-send');

            // Change tile modal confirm
            var $title = '';
            switch (method) {
                case 'fax':
                    $title = 'Faxを送信する相手を選んでください。';
                    break;
                case 'email':
                    $title = 'Emailを送信する相手を選んでください。';
                    break;
                case 'sms':
                    $title = 'SMSを送信する相手を選んでください。';
                    break;
            }
            $('.x-title-modal-send-confirm').text($title);

            from_target.append('<input type="hidden" name="method" value="'+ method +'"></input>');
            frm_confirm.append('<input type="hidden" name="method" value="'+ method +'"></input>');
            frm_confirm.attr('action', '/api/sale/handle_delivery_detail');

            switch (method) {
                case 'pdf':
                    from_target.attr('target',"_blank");
                    from_target.submit();
                    modal_information.modal('hide');
                    break;
                case 'fax':
                case 'email':
                case 'sms':
                    modal_confirm.modal("show");
                    modal_information.modal('hide');
                    break;
                case 'phone':
                    $('#sendPhoneConfirmModal').modal("show");
                    $('#frm-phone-confirm-send').append('<input type="hidden" name="method" value="'+ method +'"></input>');
                    $('#frm-phone-confirm-send').attr('action', '/api/sale/handle_delivery_detail');
                    modal_information.modal('hide');
                    break;
            }
        },

        /**
         * Submit form confirm send
         * @param e
         */
        handleConfirmSend: function (e) {
            var self = this;

            var target = $(e.currentTarget);
            target.addClass('disabled');

            var modal_confirm = $('#sendConfirmModal');
            var frm_confirm = $('#frm-confirm-send');
            var id = $('input[name=id]', frm_confirm).val();
            var method = $('input[name=method]', frm_confirm).val();

            var client_customer_id = '';
            if ($('input[name=client_customer_id]', frm_confirm).length &&
                $('input[name=client_customer_id]', frm_confirm).iCheck('update')[0].checked) {
                client_customer_id = $('input[name=client_customer_id]', frm_confirm).val();
            }

            var logistic_customer_id = '';
            if ($('input[name=logistic_customer_id]', frm_confirm).length &&
                $('input[name=logistic_customer_id]', frm_confirm).iCheck('update')[0].checked) {
                logistic_customer_id = $('input[name=logistic_customer_id]', frm_confirm).val();
            }

            var url = frm_confirm.attr('action');

            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id: id,
                    method: method,
                    client_customer_id: client_customer_id,
                    logistic_customer_id: logistic_customer_id
                },
                success: function (res) {
                    if (!res.success || !res.submit) {
                        modal_confirm.modal("hide");
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }
                    $('#sendConfirmModal').modal("hide");
                    window.location.reload();
                },
                error: function (res) {
                    modal_confirm.modal("hide");
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        },

        /**
         * Reload data in modal
         * @param e
         */
        handleInitDataModal: function(e) {
            var frm_confirm = $('#frm-confirm-send');
            $('.x-title-modal-send-confirm').text();
            frm_confirm.removeAttr("action");

            $('input[name=client_customer_id]').iCheck('uncheck');
            $('input[name=logistic_customer_id]').iCheck('uncheck');

            _.each($('input[name=method]'), function (item) {
                item.remove()
            }, frm_confirm)
        },

        /**
         * Handle remove data item sale
         * @param e
         */
        deleteItemSale: function(e) {
            var self = this;
            var target = $(e.currentTarget);

            var id = target.data('id');
            var purchase_id = target.data('purchase-id');
            var flag_delete_sale = false;

            console.log(self.total_sale_item);

            // Delete sale item then show modal confirm delete data sale
            if (self.total_sale_item == 1) {
                self.dialog({
                    title: "セール解除",
                    className: "dialog-danger",
                    message: "販売レコードも削除します。宜しいでしょうか？",
                    buttons: {
                        cancel: {
                            label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                            className: "btn-default btn-flat"
                        },
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-danger btn-flat",
                            callback: function () {
                                flag_delete_sale = true;
                                self.handleDelete(id, purchase_id, flag_delete_sale);
                            }
                        }
                    }
                });
            } else {
                self.handleDelete(id, purchase_id, flag_delete_sale);
            }
        },

        /**
         * Handle delete item sale
         * @param id
         * @param purchase_id
         */
        handleDelete: function (id, purchase_id, flag_delete_sale) {
            console.log(flag_delete_sale);
            $.ajax({
                'type': 'POST',
                'url': '/api/sale/remove_item_sale',
                data: {
                    id: id,
                    purchase_id: purchase_id,
                },
                success: function (res) {
                    // Check success
                    if (res.success != true || res.submit != true) {
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }

                    // If remove sale then redirect to list sale
                    if (flag_delete_sale != true) {
                        window.location.reload();
                    } else {
                        window.location.href = '/sale';
                    }
                },
                error: function (res) {
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        }
    });
})();