var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.IndustrialList Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.IndustrialList = AppCore.Base.extend({

        events: {
            'click .x-button-delete-industrial-waste': 'deleteIndustrialWaste',
            'click .x-button-download': 'downloadCsv',
            'change .x-input-search': 'handleSearchField',
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

                setTimeout(function(){
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
         * Handle search field
         *
         * @param field
         * @param value
         */
        handleSearch: function (field, value) {
            if (!field || !value) return;

            $('#index-search-form').submit();
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

            }, $('#x-list-industrial-waste'))

        },

        /**
         * Handle delete when customer click button 削除
         *
         * @param e
         */
        deleteIndustrialWaste: function (e) {
            var target = $(e.target);
            var industrial_waste_ids = [];
            var self = this;

            // Get customer id from checkbox
            _.each($("input[name=industrial_waste_id]", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked')) {
                    industrial_waste_ids.push(target.val());
                }
            });

            if (industrial_waste_ids.length == 0) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: '削除する産業廃棄物データを1つ以上選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
            } else {
                // Delete industrial waste of system

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
                                    'url': '/api/industrial_waste/delete',
                                    data: {
                                        id: industrial_waste_ids,
                                        _token: $('input[name=_token]').val()
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
                url: '/api/industrial_waste/validation_csv',
                data: {
                    date_from: date_from.val(),
                    date_to: date_to.val(),
                    _token: $('input[name=_token]').val()
                },
                success: function (res) {
                    //Handle error
                    if (!res.submit || !res.success) {
                        // Delete error old
                        $('.help-block').remove();

                        // Handle show error
                        _.each(res['invalid_fields'] || {}, function (v, k) {
                            base.displayError(v, k);
                        }, self);

                    } else {
                        $('#selectDateModal').hide();
                        $('.modal-backdrop').hide();
                        $(window).off('beforeunload');
                        el_form_csv.submit();
                    }
                    return;
                }
            });
        }
    });
})();