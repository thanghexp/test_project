var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.IndustrialWaste Class
     */
    TEXIS.IndustrialCreate = AppCore.Base.extend({

        el: 'body',
        limit: 10,

        events: {
            'change .x-select-box-industrial-type' : 'getSuggest',
            'change .x-select-box-industrial-issuer' : 'getSuggest',
            'click .x-btn-import-data': 'selectSuggest',
            'click .x-suggest-btn-load-more': 'loadMoreSuggest',
        },

        /**
         * Constructor
         *
         * @param {Object} config
         */
        initialize: function (config) {
            config = config || {};

            if(config.el) this.el = config.el;
            if(config.limit) this.limit = config.limit;

            this.loader();
            this.render(config);
        },

        /**
         * Function load suggest data
         * @param e
         */
        getSuggest: function (e) {
            var target = $(e.currentTarget);
            var el = $(this.el);
            var self = this;
            var flag_data_type = false;
            var target_suggest = $('#tb_industrial_waste_hint tbody');

            // Build data filter suggest
            var data_filter = [];
            if (target.hasClass('x-select-box-industrial-type')) {
                flag_data_type = true;
                data_filter['type'] = target.val();
                data_filter['client_customer_id'] = $('.x-select-box-industrial-issuer').val();
            }

            if (target.hasClass('x-select-box-industrial-issuer')) {
                data_filter['client_customer_id'] = target.val();
                data_filter['type'] = $('.x-select-box-industrial-type').val();
            }

            // Get data follow condition filter
            $.ajax({
                'type': 'POST',
                'url': '/api/industrial_waste/get_list',
                'data' : {
                    limit: self.limit,
                    type: data_filter['type'],
                    client_customer_id : data_filter['client_customer_id']
                },
                success: function (res) {

                    // Error
                    if (!res.success || !res.submit) {
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }

                    // Success
                    var data_suggest = res.result.items;

                    // Check conditions show button load more
                    $('.x-suggest-btn-load-more').removeAttr('data-id');
                    if (data_suggest.length > self.limit) {
                        $('.x-box-footer').css('display', 'none');
                    } else {
                        $('.x-box-footer').css('display', 'block');
                    }

                    $html = '';
                    if (data_suggest.length == 0) {
                        $error = '項目が見つかりませんでした';
                        $html = '<div class="no-result-template"><p class="text" style="text-align: center;">'+ $error +'</p></div>';
                        target_suggest.html($html);
                    } else {
                        _.each(data_suggest, function (item) {
                            if (flag_data_type) {
                                $html += '<tr>';
                                $html += '<td class="x-take-off-date">' + item.take_off_date + '</td>';
                                $html += '<td class="x-client-customer-name">' + item.client_customer_name + '</td>';
                                $html += '<td class="x-quantity">' + item.quantity + '</td>';
                                $html += '<td><a href="javascript:;" class="x-industrial-waste-id btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.id + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a></td>';
                                $html += '</tr>'
                            } else {
                                $html += '<tr>';
                                $html += '<td class="x-take-off-date">' + item.take_off_date + '</td>';
                                $html += '<td class="x-ticket-name">' + item.ticket_name + '</td>';
                                $html += '<td class="x-quantity">' + item.quantity + '</td>';
                                $html += '<td class="x-unit">' + item.unit + '</td>';
                                $html += '<td><a href="javascript:;" class="x-industrial-waste-id btn btn-xs btn-success btn-flat x-btn-import-data" data-id="' + item.id + '"> <b><i class="fa fa-plus-circle margin-r-5"></i>挿入</b></a></td>';
                                $html += '</tr>'
                            }
                        });

                        target_suggest.html($html);
                    }
                },
                error: function (res) {
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        },

        /**
         * Function handle filter data to from when click button insert of suggest data
         * @param e
         */
        selectSuggest: function(e) {
            var target = $(e.currentTarget);
            var el = $(this.el);
            var id = target.data('id');

            // Get data follow condition filter
            $.ajax({
                'type': 'POST',
                'url': '/api/industrial_waste/get_detail',
                'data' : {
                    id: id
                },
                success: function (res) {

                    // Error
                    if (!res.success || !res.submit) {
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }

                    // Filter data to form
                    var data = res.result;
                    $('select[name=type]', el).val(data.type).change();
                    $('select[name=status]', el).val(data.status).change();
                    $('select[name=client_customer_id]', el).val(data.client_customer_id).change();
                    $('input[name=ticket_name]', el).val(data.ticket_name);
                    $('input[name=manifest_no]', el).val(data.manifest_no);
                    $('input[name=quantity]', el).val(data.quantity);
                    $('select[name=unit]', el).val(data.unit).change();
                    $('input[name=unit_price]', el).val(data.unit_price);
                    $('select[name=disposal]', el).val(data.disposal).change();
                    $('select[name=logistic_customer_id]', el).val(data.logistic_customer_id).change();
                    $('select[name=method_deliver]', el).val(data.method_deliver).change(); // TODO CHECK ADMIN THIS FIELD
                    $('input[name=freight_rate]', el).val(data.freight_rate);
                    $('input[name=freight_rate_original]', el).val(data.freight_rate_original);
                    $('input[name=car_number]', el).val(data.car_number);
                    $('input[name=driver_name]', el).val(data.driver_name);
                    $('input[name=take_off_note]', el).val(data.take_off_note);
                    $('select[name=box_number]', el).val(data.box_number).change();
                    $('#note_1', el).val(data.note_1);
                    $('#note_2', el).val(data.note_2);
                    $('#note_3', el).val(data.note_3);
                },
                error: function (res) {
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        },

        /**
         * Function load more suggest
         * @param e
         */
        loadMoreSuggest: function(e) {
            var target = $(e.currentTarget);
            var self = this;

            // Assign data
            var offset = 2;
            if (target.data('offset')) {
                offset = target.data('offset') + 1;
            }

            // Handle load more time line
            $.ajax({
                'type': 'POST',
                'url': '/api/industrial_waste/get_list',
                data: {
                    p: offset,
                    limit: self.limit,
                    type: $('.x-select-box-industrial-type').val(),
                    client_customer_id : $('.x-select-box-industrial-issuer').val()
                },
                success: function (res) {
                    // Check success
                    if (res.success == true && res.submit == true) {
                        var data = res.result.items;

                        // If not data not show button もっと読み込む
                        if (data.length == 0 || data.length < self.limit) {
                            target.remove();
                        }

                        // Assign data offset
                        target.data('offset', offset);

                        // Append html data
                        _.each(data, function (item) {

                            // Clone last item
                            var last_item = $("#tb_industrial_waste_hint tbody tr:last");
                            var new_timeline = last_item.clone();

                            // Assign data
                            $(new_timeline).find('.x-take-off-date').html(item.take_off_date);
                            $(new_timeline).find('.x-client-customer-name').html(item.client_customer_name);
                            $(new_timeline).find('.x-quantity').html(item.quantity);
                            $(new_timeline).find('.x-ticket-name').html(item.ticket_name);
                            $(new_timeline).find('.x-unit').html(item.unit);
                            $(new_timeline).find('.x-industrial-waste-id').data('id', item.id);

                            //// Append at last list
                            last_item.after(new_timeline);
                        });
                    }
                },
                error: function (res) {
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        }
    });
})();