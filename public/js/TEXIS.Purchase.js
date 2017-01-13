var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.IndustrialWaste Class
     */
    TEXIS.Purchase = AppCore.Base.extend({

        el_target_render : $("#tb_purchase_hint"),
        el_btn_load_more : $('.btn-load-more'),
        el_product_type : $("select[name='product_type']"),
        el_supplier_customer_id : $("select[name='supplier_customer_id']"),
        edit_iw_id : $("#tb_purchase_hint").attr('data-current-id'),
        el_supplier_location_id : $("select[name='supplier_location_id']"),
        el_hd_supplier_location_id : $("input[name='hd_supplier_location_id']"),
        el_logistic_customer_id : $("select[name='logistic_customer_id']"),
        el_logistic_location_id : $("select[name='logistic_location_id']"),
        el_hd_logistic_location_id : $("input[name='hd_logistic_location_id']"),
        el_quantity_box : $("input[name=quantity_in_box]"),
        el_quantity_total_box : $("input[name=quantity_total_box]"),
        el_purchase_quantity : $("input[name=purchase_quantity]"),
        limit : 10,
        offset : 1,
        events: {
            'change .purchase_select_has_render' : 'purchaseHintRender',
            'change select[name=storage]' : 'renderStorageNote',
            'change select[name=supplier_customer_id]' : 'renderCustomerStorage',
            'change input[name=quantity_total_box]' : 'setupCalculationField',
            'change input[name=quantity_in_box]' : 'setupCalculationField',
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

            // Reset template
            this.el_target_render.html('');
            // Case validated, load page ...
            this.purchaseHintRender();
        },
        /**
         * Setup data for Client Customer Location
         */
        setupClientCustomerLocation: function (e) {
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
                                if (item.id == that.el_hd_supplier_location_id.val()) {
                                    template_buff += "selected";
                                }
                                template_buff += ">" + item.site_name + "</option>";
                            });
                        }
                        that.el_supplier_location_id.html(template_buff);
                    },
                    error: function (res) {

                        // Hide loading image
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            } else {
                that.el_supplier_location_id.html(template_buff);
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
         * Setup field autocaculation
         */
        setupCalculationField: function () {

            var that = this;
            var quantity_box = parseInt(that.el_quantity_box.val());
            var quantity_total_box = parseInt(that.el_quantity_total_box.val());
            var total = null;
            if ( !isNaN(quantity_box) && !isNaN(quantity_total_box)) {
                total = quantity_box * quantity_total_box;
                that.el_purchase_quantity.val(total);
            } else {
                that.el_purchase_quantity.val('');
            }
        },
        
        /**
         * Render customer storage
         */
        renderCustomerStorage: function (e) {

            var that = this;
            that.setupClientCustomerLocation(e);
            var customer_supplier = $('select[name=supplier_customer_id]').val();
            if (customer_supplier > 0) {
                
                $.ajax({
                    type : 'POST',
                    url : '/api/customer/get_list_location',
                    data : {
                        'customer_id': customer_supplier,
                        'get_all': 'TRUE',
                        'status': 'active'
                    },
                    success : function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {
                            var data = res.result;
                            var customer_storage = "<option value=''>保管場所を選択してください</option>";
                            _.each(data, function (item) {
                                item = that.processDataNull(item);
                                customer_storage = customer_storage + "<option value='" + item.id + "'>" + item.site_name + "</option>"
                            });
                            customer_storage = customer_storage + "<option value='-1'>その他</option>"
                        }
                        $('select[name=storage]').html(customer_storage);
                    },
                    error: function (res) {

                        // Hide loading image
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            }
        },
        
        /**
         * Render storage info when change storage value
         */
        renderStorageNote: function (e) {

            var target = $(e.target);
            var that = this;
            var el_storage_note = $('textarea[name=storage_note]');
            if (target.val() == -1) {
                el_storage_note.removeAttr('readonly');
                el_storage_note.val('');
            } else {
                el_storage_note.attr('readonly', true);
                $.ajax({
                    type : 'POST',
                    url : '/api/customer/get_detail_location',
                    data : {
                        'id' : target.val()
                    },
                    success : function (res) {

                        var customer_storage_note = "";
                        // Check success
                        if (res.success == true && res.submit == true) {
                            var data = res.result;
                            data = that.processDataNull(data);
                            customer_storage_note = data.site_name + " / " + data.postal_code + " / " + data.address + " / " + data.phone_number
                            customer_storage_note +=  " / " + data.main_charge_name + " / " + data.remark;
                        }
                        el_storage_note.val(customer_storage_note);

                    },
                    error: function (res) {

                        // Hide loading image
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
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
                var limit = that.limit;
                var type = that.el_product_type.val();
                var supplier_customer_id = that.el_supplier_customer_id.val();
                var target_render = that.el_target_render;

                $(self).attr('offset', offset);

                $.ajax({
                    'type': 'POST',
                    'url': '/api/purchase/get_list',
                    'data' : {
                        p : offset,
                        limit : limit,
                        product_type: type,
                        supplier_customer_id : supplier_customer_id,
                        not_in_id : that.edit_iw_id
                    },
                    success: function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {

                            var data = res.result.items;

                            // Append html data
                            var temp_buffer = "";
                            var tr_start = '<tr>';
                            var tr_end = '</tr>';
                            var td_start = '<td>';
                            var td_end = '</td>';

                            // Create template
                            temp_buffer = "";
                            if (that.el_product_type.val() == "") {
                                _.each(data, function (item) {
                                    item = that.processDataNull(item);
                                    temp_buffer += tr_start;
                                    temp_buffer += td_start + item.take_off_at + td_end;
                                    temp_buffer += td_start + item.product_type_name + td_end;
                                    temp_buffer += td_start + item.purchase_quantity + item.purchase_quantity_name + td_end;
                                    temp_buffer += td_start + '<a href="javascript:;" class="btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.id + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a>' + td_end;
                                    temp_buffer += tr_end;
                                });
                            } else {
                                _.each(data, function (item) {
                                    item = that.processDataNull(item);
                                    temp_buffer += tr_start;
                                    temp_buffer += td_start + item.take_off_at + td_end;
                                    temp_buffer += td_start + item.ticket_name + td_end;
                                    temp_buffer += td_start + item.purchase_quantity + item.purchase_quantity_name + td_end;
                                    temp_buffer += td_start + '<a href="javascript:;" class="btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.id + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a>' + td_end;
                                    temp_buffer += tr_end;
                                });
                            }

                            // Render template to view
                            target_render.append(temp_buffer);

                            if ((offset * limit) >= res.result.total) {
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
         * Load suggest
         */
        purchaseHintRender: function (e) {
            var that = this;
            var target_render = that.el_target_render;

            // Reset template
            target_render.html('');
            that.el_btn_load_more.hide();
            that.el_btn_load_more.removeAttr('offset');

            // If case data select not select value
            if ((that.el_product_type.val() == "") && (that.el_supplier_customer_id.val() == "")) {
                return false;
            }

            // Assign value form select type and customer id
            var type = that.el_product_type.val();
            var supplier_customer_id = that.el_supplier_customer_id.val();

            // Reset offset
            that.offset = 1;

            // Ajax call api to get list suggest
            $.ajax({
                'type': 'POST',
                'url': '/api/purchase/get_list',
                'data' : {
                    limit : that.limit,
                    p : that.offset,
                    product_type: type,
                    supplier_customer_id : supplier_customer_id,
                    not_in_id : that.edit_iw_id
                },
                success: function (res) {

                    // Check success
                    if (res.success == true && res.submit == true) {

                        var data = res.result.items;

                        // Append html data
                        var temp_buffer = "";
                        var tr_start = '<tr>';
                        var tr_end = '</tr>';
                        var td_start = '<td>';
                        var td_end = '</td>';

                        // Check in case empty data
                        if (res.result.total == 0) {

                            $error = '項目が見つかりませんでした';
                            temp_buffer = '<div class="no-result-template"><p class="text" style="text-align: center;">'+ $error +'</p></div>';
                            target_render.html(temp_buffer);
                            return;
                        }

                        // Create template
                        temp_buffer = "";
                        if (that.el_product_type.val() == "") {
                            _.each(data, function (item) {
                                item = that.processDataNull(item);
                                temp_buffer += tr_start;
                                temp_buffer += td_start + item.take_off_at + td_end;
                                temp_buffer += td_start + item.product_type_name + td_end;
                                temp_buffer += td_start + item.purchase_quantity + item.purchase_quantity_name + td_end;
                                temp_buffer += td_start + '<a href="javascript:;" class="btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.id + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a>' + td_end;
                                temp_buffer += tr_end;
                            });
                        } else {
                            _.each(data, function (item) {
                                item = that.processDataNull(item);
                                temp_buffer += tr_start;
                                temp_buffer += td_start + item.take_off_at + td_end;
                                temp_buffer += td_start + item.ticket_name + td_end;
                                temp_buffer += td_start + item.purchase_quantity + item.purchase_quantity_name + td_end;
                                temp_buffer += td_start + '<a href="javascript:;" class="btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.id + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a>' + td_end;
                                temp_buffer += tr_end;
                            });
                        }

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
        },

        /**
         * Import data from column selected
         */
        importDataToView : function () {

            $(document).on('click', '.x-btn-import-data', function (e) {

                e.preventDefault();

                var self = this;
                var data_import_id = $(self).attr('data-id');

                // Show loading image
                $('#x-modal-overlay').show();

                $.ajax({
                    'type': 'POST',
                    'url': '/api/purchase/get_detail',
                    'data' : {
                        'id' : data_import_id,
                    },
                    success: function (res) {

                        // Check success
                        if (res.success == true && res.submit == true) {

                            var data = res.result;
                            _.each($(document).find('.field-need-import'), function (e) {
                                var item = e.name;
                                $(e).val(data[item]);
                            });
                        }

                        // Show new data for case select type
                        $('select.field-need-import').trigger('change');

                        // Process active in row selected
                        $(self).closest('table').find('tr').removeClass('active');
                        $(self).closest('tr').addClass('active');
                        // Hide loading image
                        $('#x-modal-overlay').hide();
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