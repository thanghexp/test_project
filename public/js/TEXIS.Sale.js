var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.IndustrialWaste Class
     */
    TEXIS.Sale = AppCore.Base.extend({

        el_target_render : $("#tb_suggest"),
        el_field_change_suggest : $(".field-for-change-suggest"),
        el_btn_load_more : $('.btn-load-more'),
        el_client_location_id : $("select[name='client_location_id']"),
        el_delivery_destination : $("select[name='delivery_destination']"),
        el_hd_client_location_id : $("input[name='hd_client_location_id']"),
        el_hd_delivery_destination : $("input[name='hd_delivery_destination']"),
        el_logistic_location_id : $("select[name='logistic_location_id']"),
        el_hd_logistic_location_id : $("input[name='hd_logistic_location_id']"),
        el_current : '',
        limit : 10,
        offset : 1,
        events: {
            'change select[name=client_customer_id]' : 'setupClientCustomerLocation',
            'change select[name=logistic_customer_id]' : 'setupLogisticCustomerLocation',
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
            this.importDataToView();
            this.loadMoreHint();
            this.setupChangeSuggest();
            // Reset template
            this.el_target_render.html('');
            this.setupClientCustomerLocation();

        },

        /**
         * Setup data for Client Customer Location
         */
        setupClientCustomerLocation: function () {
            var that = this;
            var client_customer_id = $("select[name=client_customer_id]").val();
            var template_buff_client_location = "<option value=''>拠点名を選択してください</option>";
            var template_buff_delivery_destimation = "<option value=''>納品先を選択してください</option>";

            if (client_customer_id) {
                $.ajax({
                    'type': 'POST',
                    'url': '/api/customer/get_list_location',
                    'data' : {
                        get_all: 'TRUE',
                        customer_id : client_customer_id
                    },
                    success: function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {
                            var data = res.result;
                            _.each(data, function (item) {
                                template_buff_client_location += "<option value='" + item.id + "'";
                                if (item.id == that.el_hd_client_location_id.val()) {
                                    template_buff_client_location += "selected";
                                }
                                template_buff_client_location += ">" + item.site_name + "</option>";

                                template_buff_delivery_destimation += "<option value='" + item.id + "'";
                                if (item.id == that.el_hd_delivery_destination.val()) {
                                    template_buff_delivery_destimation += "selected";
                                }
                                template_buff_delivery_destimation += ">" + item.site_name + "</option>";
                            });
                        }
                        that.el_client_location_id.html(template_buff_client_location);
                        that.el_delivery_destination.html(template_buff_delivery_destimation);
                    },
                    error: function (res) {

                        // Hide loading image
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            } else {
                that.el_client_location_id.html(template_buff_client_location);
                that.el_delivery_destination.html(template_buff_delivery_destimation);
            }
        },

        /**
         * Setup data for Logistic Customer Location
         */
        setupLogisticCustomerLocation: function (e) {
            var target = $(e.target);
            var that = this;
            var template_buff = "<option value=''>拠点名を選択してください</option>";
            if (target.val()) {
                $.ajax({
                    'type': 'POST',
                    'url': '/api/customer/get_list_location',
                    'data' : {
                        get_all: 'TRUE',
                        customer_id : target.val()
                    },
                    success: function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {
                            var data = res.result;
                            _.each(data, function (item) {
                                template_buff += "<option value='" + item.id + "'";
                                if (item.id == that.el_hd_logistic_location_id.val()) {
                                    template_buff += "selected";
                                }
                                template_buff += ">" + item.site_name + "</option>";
                            });
                        }
                        that.el_logistic_location_id.html(template_buff);
                    },
                    error: function (res) {

                        // Hide loading image
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            } else {
                that.el_logistic_location_id.html(template_buff);
            }
        },

        /**
         * Function load more
         */
        loadMoreHint : function (e) {

            var that = this;

            // Default not show hint
            that.el_btn_load_more.hide();

            // Assign data
            var offset = 1;
            $(document).on('click', '.btn-load-more', function (e) {

                e.preventDefault();
                offset = that.offset;
                offset ++;
                that.offset = offset;

                var self = this;
                var target_render = that.el_target_render;

                $(self).attr('offset', offset);

                $.ajax({
                    'type': 'POST',
                    'url': '/api/sale/get_list_sale_suggest',
                    'data' : {
                        p : offset,
                        limit : that.limit,
                        product_type : that.el_target_render.attr('product-type')
                    },
                    success: function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {

                            var data = res.result.items;
                            var quantity_units = res.result.purchase_quantity_units;

                            // Append html data
                            var temp_buffer = "";
                            var tr_start = '<tr>';
                            var tr_end = '</tr>';
                            var td_start = '<td>';
                            var td_end = '</td>';

                            // Create template
                            temp_buffer = "";
                            var quantity_units_buff = "";
                            _.each(data, function (item) {
                                item = that.processDataNull(item);

                                if (item.purchase_quantity_unit && quantity_units[item.purchase_quantity_unit]) {
                                    quantity_units_buff = quantity_units[item.purchase_quantity_unit];
                                } else {
                                    quantity_units_buff = " - ";
                                }
                                temp_buffer += tr_start;
                                temp_buffer += td_start + item.delivery_date + td_end;
                                temp_buffer += td_start + item.sale_ticket_name + td_end;
                                temp_buffer += td_start + item.product_name + td_end;
                                temp_buffer += td_start + item.purchase_quantity + quantity_units_buff + td_end;
                                temp_buffer += td_start + item.sale_price + '円' + td_end;
                                temp_buffer += td_start + '<a href="javascript:;" class="btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.purchase_id + '" sale-price="' + item.sale_price + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a>' + td_end;
                                temp_buffer += tr_end;
                            });

                            // Render template to view
                            target_render.append(temp_buffer);

                            if ((offset * that.limit) >= res.result.total) {
                                $(self).hide();
                            }

                            // Hide loading image
                            $('#x-modal-overlay').hide();
                        }
                    },
                    error: function (res) {

                        // Hide loading image
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            });

        },

        /**
         * Setup event need to change suggest
         */
        setupChangeSuggest: function () {

            var that = this;
            that.el_field_change_suggest.focusin(function (e) {

                $(document).find('.field-for-change-suggest').removeClass('field-need-import');
                $(this).addClass('field-need-import');
                that.el_target_render.attr('product-type', $(this).attr('product-type'));
                that.saleSuggestRender($(this));
            });
        },

        /**
         * Load suggest
         */
        saleSuggestRender: function (e) {

            var that = this;

            var target_render = that.el_target_render;
            var product_type = e.attr('product-type');

            // Reset template
            target_render.html('');
            that.el_btn_load_more.hide();
            that.el_btn_load_more.removeAttr('offset');

            // Reset offset
            that.offset = 1;

            // Ajax call api to get list suggest
            if (product_type) {
                $.ajax({
                    'type': 'POST',
                    'url': '/api/sale/get_list_sale_suggest',
                    'data': {
                        limit: that.limit,
                        p: that.offset,
                        product_type: product_type
                    },
                    success: function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {

                            var data = res.result.items;
                            var quantity_units = res.result.purchase_quantity_units;

                            // Append html data
                            var temp_buffer = "";
                            var tr_start = '<tr>';
                            var tr_end = '</tr>';
                            var td_start = '<td>';
                            var td_end = '</td>';

                            // Check in case empty data
                            if (res.result.total == 0) {

                                $error = '項目が見つかりませんでした';
                                temp_buffer = '<div class="no-result-template"><p class="text" style="text-align: center;">' + $error + '</p></div>';
                                target_render.html(temp_buffer);
                                return;
                            }

                            // Create template
                            temp_buffer = "";
                            var quantity_units_buff = "";
                            _.each(data, function (item) {
                                item = $.formatDataNull(item);

                                if (item.purchase_quantity_unit && quantity_units[item.purchase_quantity_unit]) {
                                    quantity_units_buff = quantity_units[item.purchase_quantity_unit];
                                } else {
                                    quantity_units_buff = " - ";
                                }

                                temp_buffer += tr_start;
                                temp_buffer += td_start + item.delivery_date + td_end;
                                temp_buffer += td_start + item.ticket_name + td_end;
                                temp_buffer += td_start + item.product_name + td_end;
                                temp_buffer += td_start + item.purchase_quantity + quantity_units_buff + td_end;
                                temp_buffer += td_start + item.sale_price + '円' + td_end;
                                temp_buffer += td_start + '<a href="javascript:;" class="btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.purchase_id + '" sale-price="' + item.sale_price + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a>' + td_end;
                                temp_buffer += tr_end;
                            });

                            // Render template to view
                            target_render.html(temp_buffer);

                            // In case total result then show button load more
                            if (res.result.total > that.limit) {
                                that.el_btn_load_more.show();
                            }
                        }
                    },
                    error: function (res) {
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            }
        },

        /**
         * Import data from column selected
         */
        importDataToView : function () {

            $(document).on('click', '.x-btn-import-data', function (e) {

                e.preventDefault();

                var self = this;

                $('.field-need-import').val($(self).attr('sale-price'));

                // Process active in row selected
                $(self).closest('table').find('tr').removeClass('active');
                $(self).closest('tr').addClass('active');

            });
        },

        /**
         * Process data when null
         */
        processDataNull: function (row) {
            _.each(row, function (item, key) {
                if (!item) {
                    row[key] = ' - ';
                }
            });

            return row;
        }
    });
})();