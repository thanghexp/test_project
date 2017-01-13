var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.UserDetail Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.CustomerDetail = AppCore.Base.extend({

        events: {
            'click .x-delete-customer-local': 'deleteCustomerLocation',
            'click .x-delete-customer-contact' : 'deleteCustomerContact'
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
         * Function delete customer location
         *
         * @param e
         */
        deleteCustomerLocation: function (e) {
            var target = $(e.target);
            var self = this;
            var id = target.data('id');

            // Delete
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
                            $.ajax({
                                'type': 'post',
                                'url': '/api/customer/delete_location',
                                data: {
                                    id: id
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
        },

        /**
         * Function delete customer contact
         *
         * @param e
         */
        deleteCustomerContact: function (e) {
            var target = $(e.target);
            var self = this;
            var id = target.data('id');

            // Delete
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
                            $.ajax({
                                'type': 'post',
                                'url': '/api/customer/delete_contact',
                                data: {
                                    id: id
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
    });
})();