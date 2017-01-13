var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.UserList Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.UserList = AppCore.Base.extend({

        events: {
            'click .x-button-delete-user': 'deleteUser'
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
         * Handle delete when user click button 削除
         *
         * @param e
         */
        deleteUser: function (e) {
            var target = $(e.target);
            var user_id = [];
            var self = this;

            // Get user id from checkbox
            _.each($("input[name=user_id]", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked')) {
                    user_id.push(target.val());
                }
            });

            if (user_id.length == 0) {
                self.dialog({
                    title: "確認",
                    className: "dialog-warning",
                    message: '削除したいユーザーを選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    },
                });
            } else {
                // Delete user of system
                self.dialog({
                    title: "ユーザー削除確認",
                    message: "削除しますか？",
                    className: "dialog-danger",
                    buttons: {
                        cancel: {
                            label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                            className: "btn-default btn-flat"
                        },
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-danger btn-flat",
                            callback: function () {
                                // Delete user
                                $.ajax({
                                    'type': 'post',
                                    'url': '/api/account/delete',
                                    data: {
                                        ids: user_id
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
        }
    });
})();