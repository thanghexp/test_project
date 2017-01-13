var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.CustomerList Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.CustomerList = AppCore.Base.extend({

        events: {
            'click .x-button-delete-customer': 'deleteCustomer',
            'click .x-button-download-csv': 'downloadCSV',
            'keypress .x-search-value': 'searchValue',
        },

        /**
         * Constructor
         *
         * @param {Object} config
         */
        initialize: function (config) {
            config = config || {};
            this.loader();
            this.render(config);
        },

        /**
         * Handle get value to search
         *
         * @param e
         */
        searchValue: function (e) {

            $(window).unbind('beforeunload');

            if (e.keyCode == 13) {

                var target = $(e.currentTarget);

                // Show modal loading table
                $('.x-table-overlay').show();

                setTimeout(function () {
                    $('#index-search-form').submit();
                }, 1000);
            } else {
                $(window).on('beforeunload', function(e) {
                    $('#x-modal-overlay').show();
                });
                return;
            }
        },

        /**
         * Handle delete when customer click button 削除
         *
         * @param e
         */
        deleteCustomer: function (e) {
            var target = $(e.target);
            var customer_id = [];
            var self = this;

            // Get customer id from checkbox
            _.each($("input[name=customer_id]", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked')) {
                    customer_id.push(target.val());
                }
            });

            if (customer_id.length == 0) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: '削除したいユーザーを選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
            } else {
                // Delete customer of system
                self.dialog({
                    title: "ステータス削除",
                    className: "dialog-danger",
                    message: "削除しますか？",
                    buttons: {
                        cancel: {
                            label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                            className: "btn-default btn-flat"
                        },
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-danger btn-flat",
                            callback: function () {
                                // Delete customer
                                $.ajax({
                                    'type': 'post',
                                    'url': '/api/customer/delete',
                                    data: {
                                        id: customer_id
                                    },
                                    success: function (res) {
                                        if (!res.success || !res.submit) {
                                            self.alert(res.errmsg || '問題が発生し');
                                            return;
                                        }
                                        window.location.reload();
                                    },
                                    error: function (res) {
                                        self.alert(res.errmsg || '問題が発生し');
                                    }
                                });
                            }
                        }
                    }
                });
            }

        },
    });
})();
