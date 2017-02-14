AppCore = window.AppCore || {};
var TEXIS = TEXIS || {};

(function () {
    /**
     * TEXIS.Base Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.Base = AppCore.Base.extend({

        cookieName: 'texis_status_menu',
        statusMenuOn: 'ON',
        statusMenuOff: 'OFF',

        errorTemplate: _.template([
            '<span class="help-block"><%= error %></span>'
        ].join('')),

        el: 'body',

        events: {
            'click #x-button-cancel': 'handleClickCancel',
            'click .x-logout': 'handleClickLogout',
            'click .x-sidebar-toggle': 'handleDisplayMenu',
            'ifClicked .x-checkbox-change-status': 'changeStatusDefinition',
            'click #x-btn-definition-submit': 'runChangeStatus',

            'click .x-button-send-phone' : 'handleConfirmSendPhone',
            'click .select2' : 'handleSelectSearch'
        },

        /**
         * Constructor
         */
        initialize: function (config) {
            this.loader();
            this.handleLoadMenu(config);
        },

        handleSelectSearch: function (e) {
            var target = $(e.currentTarget);

            if (target.prev().hasClass('x-select2-search')) {
                $('.select2-search').addClass('select2-search--drop\-block');
            } else {
                $('.select2-search').addClass('select2-search--dropdown-none');
            }
        },

        /**
         * Display error form confirm email
         *
         * @param {object} v errorObject
         * @param {string} k name
         */
        displayError: function (v, k)
        {
            var el = this.$([
                'input[name='+k+']',
                'textarea[name='+k+']',
                'select[name='+k+']'
            ].join(','));

            var errorEl = $(this.errorTemplate({
                error: v
            }));

            var target = el.closest('.form-group');

            target
                .addClass('has-error').append(errorEl)
                .on('change', function () {
                    $(this).removeClass('has-error');
                    $(errorEl).remove();
                });
        },

        /**
         * handle click button cancel
         * @param e
         * @returns {*}
         */
        handleClickCancel: function(e) {
            e.preventDefault();
            e.stopPropagation();

            var url = $(e.currentTarget).attr('href');
            var self = this;

            self.dialog({
                title: "確認",
                className: "dialog-warning",
                message: "もう一度登録画面に戻って編集を続けますか？",
                buttons: {
                    cancel: {
                        label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                        className: "btn-default btn-flat",
                        callback: function () {
                            window.location.href = url;
                        }
                    },
                    ok: {
                        label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                        className: "btn-warning btn-flat"
                    }
                }
            });
        },

        /**
         * Show modal confirm logout
         * @param e
         */
        handleClickLogout: function (e) {
            e.preventDefault();
            e.stopPropagation();

            var url = $(e.currentTarget).attr('href');
            var self = this;

            self.dialog({
                title: "確認",
                className: "dialog-warning",
                message: "ログアウトしますか？",
                buttons: {
                    cancel: {
                        label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                        className: "btn-default btn-flat"
                    },
                    ok: {
                        label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                        className: "btn-warning btn-flat",
                        callback: function () {
                            window.location.href = url;
                        }
                    }
                }
            });
        },

        /**
         * Handle load status menu
         * @param config
         */
        handleLoadMenu: function(config) {
            var status = this.statusMenuOn;
            status = $.cookie(this.cookieName);

            // Display menu
            if (status == this.statusMenuOn) {
                $('body').remove('sidebar-collapse');
            } else {
                $('body').addClass('sidebar-collapse');
            }
        },

        /**
         * Handle save cookie menu
         * @param e
         */
        handleDisplayMenu: function(e) {
            var target = $(e.currentTarget);
            var self = this;

            // Save status menu
            $status = self.statusMenuOn;
            if (!$('body').hasClass('sidebar-collapse')) {
                $status = self.statusMenuOff;
            }

            // Add status
            $.cookie(self.cookieName, $status, {
                expires: 60 * 60 * 24 * 365,
                path: '/'
            });
        },

        /**
         * Function handle change status
         * @param e
         */
        changeStatusDefinition: function(e) {
            e.preventDefault();
            e.stopPropagation();

            var self = this;
            var target = $(e.currentTarget);

            setTimeout(function(){
                if (target.data('status') != 1 && target.data('status') != 3) {
                    target.iCheck('uncheck');
                } else {
                    target.iCheck('check');
                }
            }, 0);

            var code = target.data('code');
            var id = target.data('id');
            var type = target.data('type');
            var status = target.data('status');

            // In case of sale definition and status is confirm completion then redirect to SA05
            if (type == 'sale_definition' && code == 'confirm_completion') {
                window.location.href = '/sale/' + id;
                return;
            }

            // In case of sale definition and status is complete delivery then redirect to SA20
            if (type == 'sale_definition' && code == 'complete_delivery') {
                window.location.href = '/sale/complete_delivery/' + id;
                return;
            }

            // Show model
            var confirmModal = new TEXIS.ModalDefinition({
                data: {code:code, id_target:id, type:type, status: status},
                target_definition: target
            });
            confirmModal.render();
        },

        /**
         * Submit form confirm send phone
         * @param e
         */
        handleConfirmSendPhone: function (e) {
            var self = this;

            var modal_confirm = $('#sendPhoneConfirmModal');
            var frm_confirm = $('#frm-phone-confirm-send');
            var id = $('input[name=id]', frm_confirm).val();
            var method = $('input[name=method]', frm_confirm).val();

            var url = frm_confirm.attr('action');

            $.ajax({
                'type': 'post',
                'url': url,
                data: {
                    id: id,
                    method: method
                },
                success: function (res) {
                    modal_confirm.modal("hide");
                    if (!res.success || !res.submit) {
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }

                    window.location.reload();
                },
                error: function (res) {
                    modal_confirm.modal("hide");
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        },

        /**
         * Handle save change status
         * @param e
         */
        runChangeStatus: function(e){
            e.stopPropagation();
            e.preventDefault();
            var target_modal = $('#statusModal');
            var self = this;
            var status = $('select[name=definition_status]', target_modal).val();
            var type = $('input[name=type]', target_modal).val();
            var code = $('input[name=code]', target_modal).val();
            var target_id = $('input[name=id_target]', target_modal).val();
            var token = $('input[name=_token]', target_modal).val();

            $.ajax({
                'headers': {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                'type': 'POST',
                'url': '/api/definition/change_status',
                'data' : {
                    type: type,
                    code: code,
                    status : status,
                    target_id: target_id,
                    _token: token
                },
                success: function (res) {
                    if (!res.submit || !res.success) {
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }

                    _.each($('.x-checkbox-change-status'), function (item) {
                        var item_id = $(item).data('id');
                        var item_code = $(item).data('code');

                        if (item_id == target_id && item_code == code) {
                            $(item).data('status', status);

                            if (status == 0 || status == 2) {

                                if (status == 0) {
                                    $(item).closest('div').removeClass('unchecked');
                                }

                                if (status == 2) {
                                    $(item).closest('div').addClass('unchecked');
                                }

                                $(item).iCheck('uncheck');
                            }

                            if (status == 1) {
                                $(item).closest('div').removeClass('unchecked');
                                $(item).iCheck('check');
                            }
                        }
                    }, self)
                }
            });
            target_modal.modal('hide');
        }
    });

    // Initialize modal definition
    TEXIS.ModalDefinition = Backbone.View.extend({

        el: "#statusModal",

        initialize: function(args){
            this.data = args.data ? args.data : [];
            this.target_definition = args.target_definition;
            $('select[name=definition_status]', this.$el).val(this.data.status).change();
            $('input[name=type]', this.$el).val(this.data.type);
            $('input[name=code]', this.$el).val(this.data.code);
            $('input[name=id_target]', this.$el).val(this.data.id_target);
        },
        render: function(){
            this.$el.modal("show");
        },
        close: function() {
            this.$el.modal("hide");
        }
    });

})();
