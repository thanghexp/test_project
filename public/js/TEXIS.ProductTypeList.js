var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.ProductTypeList Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.ProductTypeList = AppCore.Base.extend({

        events: {
            'click .x-button-delete-product-type': 'deleteProductType'
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
         * Handle delete when product_type click button 削除
         *
         * @param e
         */
        deleteProductType: function (e) {
            var target = $(e.target);
            var product_type_id = [];
            var self = this;

            // Get product_type id from checkbox
            _.each($("input[name=product_type_id]", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked')) {
                    product_type_id.push(target.val());
                }
            });

            if (product_type_id.length == 0) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: '削除する商品タイプを選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
            } else {
                // Delete product_type
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
                                // Delete product_type
                                $.ajax({
                                    'type': 'post',
                                    'url': '/api/product_type/delete',
                                    data: {
                                        id: product_type_id
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