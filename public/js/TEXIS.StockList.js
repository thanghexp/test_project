var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.StockList Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.StockList = AppCore.Base.extend({

        events: {
            'click .x-button-delete-purchase': 'deletePurchase',
            'click .x-button-download': 'downloadCsv',
            'click .x-button-create-sale' : 'createSale',
            'click .sort': 'sortList',
            'keypress .x-search-value': 'searchValue',
            'change .x-search-field': 'searchValue',
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
            this.loadPage(config);
        },

        /**
         * Load page list status
         * @param config
         */
        loadPage: function (config) {
            _.each($('.x-checkbox-change-status'), function (item) {
                if ($(item).data('status') == 0 || $(item).data('status') == 2) {
                    $(item).iCheck('uncheck');
                }

                if ($(item).data('status') == 1) {
                    $(item).iCheck('check');
                }

                if($(item).data('status') == 2) {
                    $(item).closest('div').addClass('unchecked');
                }
            }, $('#x-list-purchase'))
        },

        /**
         * Setup button create sale
         */
        createSale: function () {
            var self = this;
            var link_create = "";
            var message = "";
            var has_sale = false;

            // Get customer id from checkbox
            _.each($("input[name=purchase_id]", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked') && target.data('sale-id')) {
                    has_sale = true;
                } else if (target.is(':checked')) {
                    link_create = link_create + "purchase_id[]=" + target.val() + "&";
                }
            });

            if (has_sale) {

                message = "あなたが選択した仕入/在庫はすでに販売が決まっています。<br>他の仕入/在庫を選ぶか、販売情報から該当の仕入/在庫を先に削除してください。";

                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: message,
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
                return;
            }

            if (!link_create) {

                message = "1つ以上の仕入れまたは在庫を選択してから販売登録を行ってください。";

                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: message,
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
                return;
            }

            link_create = 'sale/create?' + link_create;
            link_create = link_create.slice(0,-1);

            window.location.href = link_create;
        },

        /**
         * Handle delete when customer click button 削除
         *
         * @param e
         */
        deletePurchase: function (e) {
            var target = $(e.target);
            var purchase_ids = [];
            var sale_ids = [];
            var delete_sale = true;
            var self = this;
            var has_sale = false;

            // Get customer id from checkbox
            _.each($("input[name=purchase_id]", this.$el), function (e) {
                var target = $(e);

                if (target.is(':checked')) {
                    purchase_ids.push(target.val());
                    if (target.data('sale-id')) {
                        sale_ids.push(target.data('sale-id'));
                    }
                }

                if (target.is(':checked') && target.data('sale-id')) {
                    has_sale = true;
                }
            });

            if (has_sale) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: "あなたが選択した仕入/在庫はすでに販売が決まっています。<br>本当に削除を行う場合は、販売情報から該当の仕入/在庫を先に削除してください。",
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
                return;
            }

            // Handle show modal confirm delete
            if (purchase_ids.length == 0) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: '削除する仕入/在庫データを1つ以上選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
            } else {
                // Delete purchase of system
                var message = '削除しますか？';

                // If remove data purchase register sale then show message
                if (sale_ids.length > 0) {
                    message = '販売登録済みの注文・ストックです。削除しますか？';
                }

                self.dialog({
                    title: "ステータス削除",
                    className: "dialog-danger",
                    message: message,
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
                                    'url': '/api/stock/delete',
                                    data: {
                                        id: purchase_ids,
                                        sale_ids: sale_ids
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

        /**
         * Download csv
         * @param e
         */
        downloadCsv: function(e) {
            e.stopPropagation();
            e.preventDefault();

            var el_form_csv = $('#x-form-csv');
            var date_from = $('#x-csv-date-from', el_form_csv);
            var date_to = $('#x-csv-date-to', el_form_csv);
            var self = this;
            var base = new TEXIS.Base();

            $.ajax({
                type: 'post',
                url: '/api/stock/validation_csv',
                data: {
                    date_from: date_from.val(),
                    date_to: date_to.val()
                },
                success: function (res) {

                    // Handle error
                    if (!res.submit || !res.success) {
                        // Delete error old
                        $('.help-block').remove();

                        // Handle show error
                        _.each(res['invalid_fields'] || {}, function (v, k) {
                            base.displayError(v, k);
                        }, self);

                    } else {
                        console.log('OK');
                        $('#selectDateModal').hide();
                        $('.modal-backdrop').hide();
                        $(window).off('beforeunload');
                        el_form_csv.submit();
                    }

                    return;
                }
            });
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
         * Handle sort order
         *
         * @param e
         */
        sortList: function (e) {

            $(window).unbind('beforeunload');

            var target = $(e.currentTarget);
            var order = $(e.currentTarget).data('order');
            var form_search = $('#index-search-form');
            var sort = null;

            if (order !== undefined) {
                sort = this.handleSwitchOrder(target);

                // Assign value sort in form
                form_search.find('input[name="sort"]').val(sort);

                // Assign value order in form
                if (sort) {
                    form_search.find('input[name="order"]').val(order);
                } else {
                    form_search.find('input[name="order"]').val('');
                }

                // Submit form search
                form_search.submit();
            }
        },

        /**
         * Handle switch icon order
         * @param target
         */
        handleSwitchOrder: function (target) {

            // Handle switch icon sorting
            var order = '';
            if (target.hasClass('sorting_asc')) {
                target.removeClass('sorting_asc');
                target.addClass('sorting');
                return order;
            }

            if (target.hasClass('sorting_desc')) {
                target.removeClass('sorting_desc');
                target.addClass('sorting_asc');

                // Assign value order
                order = 'ASC';
                return order;
            }

            if (target.hasClass('sorting')) {
                target.removeClass('sorting');
                target.addClass('sorting_desc');

                // Assign value order
                order = 'DESC';
                return order;
            }
        }

    });
})();