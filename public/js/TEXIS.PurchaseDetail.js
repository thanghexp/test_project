AppCore = window.AppCore || {};
var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.PurchaseDetail Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.PurchaseDetail = AppCore.Base.extend({

        el: 'body',

        events: {
            'click .x-button-pdf-request-shipping' : 'handleRequestShipping',
            'click .x-button-email-request-shipping' : 'handleRequestShipping',
            'click .x-button-fax-request-shipping' : 'handleRequestShipping',
            'click .x-button-sms-request-shipping' : 'handleRequestShipping',

            'click .x-button-pdf-request-delivery' : 'handleRequestDelivery',
            'click .x-button-email-request-delivery' : 'handleRequestDelivery',
            'click .x-button-fax-request-delivery' : 'handleRequestDelivery',
            'click .x-button-sms-request-delivery' : 'handleRequestDelivery',

            'click .x-button-email-contact-date' : 'handleContactTakingDate',
            'click .x-button-fax-contact-date' : 'handleContactTakingDate',
            'click .x-button-sms-contact-date' : 'handleContactTakingDate',
            'click .x-button-pdf-contact-date' : 'handleContactTakingDate',
            'click .x-button-phone-contact-date' : 'handleContactTakingDate',

            'click .x-button-email-contact-detail' : 'handleContactTakingDetail',
            'click .x-button-fax-contact-detail' : 'handleContactTakingDetail',
            'click .x-button-sms-contact-detail' : 'handleContactTakingDetail',
            'click .x-button-pdf-contact-detail' : 'handleContactTakingDetail',
            'click .x-button-phone-contact-detail' : 'handleContactTakingDetail',

            'click .x-button-send' : 'handleConfirmSend'
        },

        /**
         * Constructor
         *
         * @param {Object} config
         */
        initialize: function (config) {
            config = config || {};
            this.el = config.el || {};

            this.loader();
            this.render(config);
        },

        /**
         * Handle modal request shipping
         * @param e
         */
        handleRequestShipping: function(e) {
            var self = this;

            // Reload modal confirm
            self.handleInitDataModal();

            var target = $(e.currentTarget);
            var method = target.data('method');
            var from_target = $('#frm-request-shipping');
            var modal_information = $('#request_shippingModal');

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
            frm_confirm.attr('action', '/api/stock/handle_request_shipping');

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
            frm_confirm.attr('action', '/api/stock/handle_request_delivery');

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
         * Handle modal contact taking date
         * @param e
         */
        handleContactTakingDate : function(e) {

            var self = this;

            // Reload modal confirm
            self.handleInitDataModal();

            var target = $(e.currentTarget);
            var method = target.data('method');
            var from_target = $('#frm-contact-date');
            var modal_information = $('#contact_dateModal');

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
            frm_confirm.attr('action', '/api/stock/handle_contact_date');

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
                    $('#frm-phone-confirm-send').attr('action', '/api/stock/handle_contact_date');
                    modal_information.modal('hide');
                    break;
            }
        },

        /**
         * Handle modal contact taking detail
         * @param e
         */
        handleContactTakingDetail : function(e) {

            var self = this;

            // Reload modal confirm
            self.handleInitDataModal();

            var target = $(e.currentTarget);
            var method = target.data('method');
            var from_target = $('#frm-contact-detail');
            var modal_information = $('#contact_detailModal');

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
            frm_confirm.attr('action', '/api/stock/handle_contact_detail');

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
                    $('#frm-phone-confirm-send').attr('action', '/api/stock/handle_contact_detail');
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

            var supplier_customer_id = '';
            if ($('input[name=supplier_customer_id]', frm_confirm).length &&
                $('input[name=supplier_customer_id]', frm_confirm).iCheck('update')[0].checked) {
                supplier_customer_id = $('input[name=supplier_customer_id]', frm_confirm).val();
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
                    supplier_customer_id: supplier_customer_id,
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

            $('input[name=supplier_customer_id]').iCheck('uncheck');
            $('input[name=logistic_customer_id]').iCheck('uncheck');

            _.each($('input[name=method]'), function (item) {
                item.remove()
            }, frm_confirm)
        }
    });
})();