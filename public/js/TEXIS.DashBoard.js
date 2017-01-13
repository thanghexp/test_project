var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.DashBoard Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.DashBoard = AppCore.Base.extend({

        limit: 10,
        offset : 1,

        event: {
            'click #x-button-load-more' : 'loadMoreStock',
            'select2-selecting .x-select-product-type' : 'handleSelectProductType'
        },

        /**
         * Constructor
         *
         * @param {Object} config
         */
        initialize: function (config) {
            config = config || {};
            this.limit = config.limit || {};

            this.loader();
            this.render(config);

            var events = new Events();
            new EventsView({el: $("#calendar"), collection: events}).render();
            events.fetch();

            this.handleSelectProductType(config);
            this.loadMoreStock(config);
        },

        /**
         * handle Load more stock
         * @param config
         */
        loadMoreStock: function(config) {
            var self = this;
            $('#x-button-load-more').on("click", function(e) {
                var target = $(e.currentTarget);
                var value = $('.x-select-product-type').val();

                var offset = self.offset;
                offset++;
                self.offset = offset;

                var limit = config.limit;

                $.ajax({
                    'type': 'POST',
                    'url': '/api/stock/get_list',
                    data: {
                        type : 'stock',
                        limit : limit,
                        offset: offset,
                        register_sale : false,
                        product_type : value
                    },
                    success: function (res) {

                        // Check not success
                        if (res.success != true || res.submit != true) {
                            self.alert(res.errmsg || '問題が発生し');
                            return;
                        }

                        var html = '';
                        _.each(res.result.items, function (item) {
                            item = $.formatDataNull(item);
                            html += '<tr>';
                            html += '<td>' + item.take_off_at + '</td>';
                            html += '<td><a href="/sale/create?purchase_id[]='+ item.id +'">'+ item.product_type_name +'/'+ item.supplier_customer_name +'</a></td>';
                            html += '<td class="text-right">' + item.purchase_quantity + ''+ item.purchase_quantity_name +'</td>';
                            html += '</tr>';
                        });

                        if ((offset * limit) >= res.result.total) {
                            $('.x-div-button-load-more').hide();
                        } else {
                            $('.x-div-button-load-more').show();
                        }

                        $('.x-area-product-type tbody').append(html);
                    },
                    error: function (res) {
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });

            });
        },

        /**
         * Handle filter data product type
         * @param e
         */
        handleSelectProductType: function(config) {

            var self = this;

            $('.x-select-product-type').on("select2:select", function(e) {
                var target = $(e.currentTarget);
                var value = target.val();

                var limit = config.limit;
                self.offset = 1;

                $.ajax({
                    'type': 'POST',
                    'url': '/api/stock/get_list',
                    data: {
                        type : 'stock',
                        limit : limit,
                        register_sale : false,
                        product_type : value
                    },
                    success: function (res) {
                        // Check not success
                        if (res.success != true || res.submit != true) {
                            self.alert(res.errmsg || '問題が発生し');
                            return;
                        }

                        $('.x-area-product-type').find('tr').remove();

                        var html = '';
                        if (res.result.total > 0) {
                            _.each(res.result.items, function (item) {
                                item = $.formatDataNull(item);
                                html += '<tr>';
                                html += '<td>' + item.take_off_at + '</td>';
                                html += '<td><a href="/sale/create?purchase_id[]='+ item.id +'">'+ item.product_type_name +'/'+ item.supplier_customer_name +'</a></td>';
                                html += '<td class="text-right">' + item.purchase_quantity + ''+ item.purchase_quantity_name +'</td>';
                                html += '</tr>';
                            });
                        } else {
                            html += '<tr class="text-center">';
                            html += '<td>';
                            html += '<span class="glyphicon glyphicon-ban-circle"></span>項目が見つかりませんでした';
                            html += '</td>';
                            html += '</tr>';
                        }

                        if (res.result.total <= limit) {
                            $('.x-div-button-load-more').hide();
                        } else {
                            $('.x-div-button-load-more').show();
                        }

                        $('.x-area-product-type tbody').append(html);
                    },
                    error: function (res) {
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            });
        }
    });

    var Event = Backbone.Model.extend({
        idAttribute: 'id'
    });

    var Events = Backbone.Collection.extend({
        model: Event,
        url: '/'
    });

    var EventsView = Backbone.View.extend({

        initialize: function(){
            this.collection = _.bind(this.addAll, 'reset');
        },
        render: function() {
            var self = this;
            $(this.el).fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay',
                    ignoreTimezone: false
                },
                themeButtonIcons: {
                    prev: 'fa fa-caret-left',
                    next: 'fa fa-caret-right'
                },
                weekNumbers: false ,
                navLinks: true,
                eventLimit: true,
                locale: 'ja',
                selectable: this.select,
                selectHelper: true,
                editable: true,
                eventClick: this.eventClick,
                select: this.select,
                droppable: true,
                displayEventTime: false,
                firstDay: 1, // Set first date Sunday=0, Monday=1, Tuesday=2, etc.
                fixedWeekCount : false, // true - 6 weeks tall. If false - 4, 5, or 6 weeks, depending on the month.
                loading: function (bool) {
                    // TODO SOMETHING WHEN LOADING SHOW EVENT IN CALENDAR
                },
                eventRender: function (event, element, view)
                {
                    if (event.type == 'industrial_waste')
                        $(element).css("backgroundColor", "rgb(243, 110, 13)");

                    if (event.type == 'sale')
                        $(element).css("backgroundColor", "rgb(0, 141, 76)");

                    if (event.type == 'purchase')
                        $(element).css("backgroundColor", "rgb(215, 57, 37)");
                },
                eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) {

                    var message = '';
                    if (event.type == 'industrial_waste') message = '引取日を変更しますか？';

                    if (event.type == 'sale') message = '引取日を変更しますか？';

                    if (event.type == 'purchase') message = '納品日を変更しますか？<br>また、販売する商品の引取日は変更されませんのでご注意ください。';

                    var base = new AppCore.Base();
                    base.dialog({
                        title: "確認",
                        className: "dialog-danger",
                        message: message,
                        buttons: {
                            cancel: {
                                label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                                className: "btn-default btn-flat",
                                callback: function () {
                                    revertFunc();
                                }
                            },
                            ok: {
                                label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                                className: "btn-danger btn-flat",
                                callback: function () {
                                    if (event == null) return;
                                    var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration')); // get the default and convert it to proper type
                                    var end = event.end || event.start.clone().add(defaultDuration); // If there is no end, compute it

                                    // Set delivery date for IW/PU/SA
                                    self.updateDeliveryDate(event, end.format('YYYY-MM-DD'));
                                }
                            }
                        }
                    });
                },
                events: '/api/dashboard/get_data'
            });
        },
        updateDeliveryDate: function (event, date) {

            var url = '/api/dashboard/update_delivery_date';

            data = {
                id : event.item_id,
                delivery_date : date,
                type : event.type
            };

            $.ajax({
                type: 'POST',
                url: url,
                data : data,
                success: function (res) {
                    if (res.success != true && res.submit != true) {
                        $('#x-modal-overlay').hide();
                        self.alert(res.errmsg || '問題が発生し');
                    }
                },
                error: function (res) {
                    // Hide loading image
                    $('#x-modal-overlay').hide();
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        },

        addAll: function(){
            this.el.fullCalendar('addEventSource', this.collection.toJSON());
        },

        eventClick:  function(event, jsEvent, view) {
            if(event.type == 'industrial_waste'){

                var modal_industrial_waste = $('#industrial_wasteModal');

                $.ajax({
                    type: 'POST',
                    url: '/api/industrial_waste/get_detail',
                    data: {
                        id: event.item_id
                    },
                    success: function (res) {
                        if (!res.success || !res.submit) {
                            modal_industrial_waste.modal("hide");
                            self.alert(res.errmsg || '問題が発生し');
                            return;
                        }

                        res.result = $.formatDataNull(res.result);

                        // Set data to show in modal
                        setTimeout(function(){
                            modal_industrial_waste.find('.x-iw-status').html(res.result.status_name);
                            modal_industrial_waste.find('.x-iw-client-customer-name').html(res.result.client_customer_name);
                            modal_industrial_waste.find('.x-iw-type-name').html(res.result.type_name);
                            modal_industrial_waste.find('.x-iw-ticket-name').html(res.result.ticket_name);
                            modal_industrial_waste.find('.x-iw-manifest-no').html(res.result.manifest_no);

                            var unit_name = '';
                            if (res.result.unit_name) unit_name = res.result.unit_name;
                            modal_industrial_waste.find('.x-iw-quantity').html(res.result.quantity +''+ unit_name);
                            modal_industrial_waste.find('.x-iw-unit-price').html(res.result.unit_price +'円');
                            modal_industrial_waste.find('.x-iw-disposal-name').html(res.result.disposal_name);
                            modal_industrial_waste.find('.x-iw-logistic-customer-name').html(res.result.logistic_customer_name);
                            modal_industrial_waste.find('.x-iw-method-deliver').html(res.result.method_deliver);
                            modal_industrial_waste.find('.x-iw-freight-rate').html(res.result.freight_rate +'円');
                            modal_industrial_waste.find('.x-iw-freight-rate-original').html(res.result.freight_rate_original +'円');
                            modal_industrial_waste.find('.x-iw-take-off-at').html(res.result.take_off_at);
                            modal_industrial_waste.find('.x-iw-installation-at').html(res.result.installation_at);
                            modal_industrial_waste.find('.x-iw-completed-at').html(res.result.completed_at);
                            modal_industrial_waste.find('.x-iw-note-1').html($.nl2br(res.result.note_1));
                            modal_industrial_waste.find('.x-iw-note-2').html($.nl2br(res.result.note_2));
                            modal_industrial_waste.find('.x-iw-note-3').html($.nl2br(res.result.note_3));

                            // Assign href of button

                            $('.btn-iw-detail').attr('href', '/industrial_waste/' + res.result.id);
                            $('.btn-iw-edit').attr('href', '/industrial_waste/' + res.result.id + '/edit');

                        }, 0);
                        modal_industrial_waste.modal();
                    },
                    error: function (res) {
                        modal_industrial_waste.modal("hide");
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            }

            if(event.type == 'purchase'){

                var modal_purchase = $('#stockModal');

                $.ajax({
                    type: 'POST',
                    url: '/api/purchase/get_detail',
                    data: {
                        id: event.item_id
                    },
                    success: function (res) {
                        if (!res.success || !res.submit) {
                            modal_purchase.modal("hide");
                            self.alert(res.errmsg || '問題が発生し');
                            return;
                        }

                        res.result = $.formatDataNull(res.result);

                        // Set data to show in modal
                        setTimeout(function(){
                            modal_purchase.find('.x-purchase-status-name').html(res.result.status_name);
                            modal_purchase.find('.x-purchase-type-name').html(res.result.type_name);
                            modal_purchase.find('.x-purchase-supplier-customer-name').html(res.result.supplier_customer_name);
                            modal_purchase.find('.x-purchase-ticket-name').html(res.result.ticket_name);
                            modal_purchase.find('.x-purchase-product-type-name').html(res.result.product_type_name);

                            var unit_name = '';
                            if (res.result.purchase_quantity_name) unit_name = res.result.purchase_quantity_name;
                            modal_purchase.find('.x-purchase-quantity').html(res.result.purchase_quantity +''+ unit_name);
                            modal_purchase.find('.x-purchase-price').html(res.result.purchase_price +'円');
                            modal_purchase.find('.x-purchase-logistic-customer-name').html(res.result.logistic_customer_name);
                            modal_purchase.find('.x-purchase-freight-rate').html(res.result.freight_rate + '円');
                            modal_purchase.find('.x-purchase-freight-rate-original').html(res.result.freight_rate_original + '円');
                            modal_purchase.find('.x-purchase-take-off-at').html(res.result.take_off_at);
                            modal_purchase.find('.x-purchase-take-off-note').html(res.result.take_off_note);
                            modal_purchase.find('.x-purchase-storage-name').html(res.result.storage_name);
                            modal_purchase.find('.x-purchase-storage-note').html($.nl2br(res.result.storage_note));
                            modal_purchase.find('.x-purchase-note-1').html($.nl2br(res.result.note_1));
                            modal_purchase.find('.x-purchase-note-2').html($.nl2br(res.result.note_2));
                            modal_purchase.find('.x-purchase-note-3').html($.nl2br(res.result.note_3));

                            // Assign href of button
                            $('.btn-purchase-detail').attr('href', '/stock/' + res.result.id);
                            $('.btn-purchase-edit').attr('href', '/stock/' + res.result.id + '/edit');

                        }, 0);
                        modal_purchase.modal();
                    },
                    error: function (res) {
                        modal_purchase.modal("hide");
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            }

            if(event.type == 'sale'){

                var modal_sale = $('#salesModal');

                $.ajax({
                    type: 'POST',
                    url: '/api/sale/get_detail',
                    data: {
                        id: event.item_id
                    },
                    success: function (res) {
                        if (!res.success || !res.submit) {
                            modal_sale.modal("hide");
                            self.alert(res.errmsg || '問題が発生し');
                            return;
                        }

                        res.result = $.formatDataNull(res.result);

                        // Set data to show in modal
                        setTimeout(function(){
                            modal_sale.find('.x-sale-client-customer-name').html(res.result.client_customer_name);
                            modal_sale.find('.x-sale-ticket-name').html(res.result.ticket_name);

                            var html = '';
                            if (res.result.sale_items) {
                                var key = 1;
                                _.each(res.result.sale_items, function (item) {
                                    html += '<div class="row">';
                                    html += '<p class="col-xs-4 x-sale-title-price">商品'+ key +'販売単価</p>';
                                    var sale_price = (item.sale_price) ? item.sale_price + '円' : '-';
                                    html += '<p class="col-xs-8 x-sale-price">'+ sale_price +'</p>';
                                    html += '</div>';
                                    key++;
                                });
                            }
                            $('#x-sale-ticket-name').after(html);

                            var unit_name = '';
                            if (res.result.purchase_quantity_name) unit_name = res.result.purchase_quantity_name;
                            modal_sale.find('.x-purchase-quantity').html(res.result.purchase_quantity +''+ unit_name);

                            modal_sale.find('.x-sale-client-customer-name').html(res.result.client_customer_name);
                            modal_sale.find('.x-sale-logistic-customer-name').html(res.result.logistic_customer_name);
                            modal_sale.find('.x-sale-freight-rate-original').html(res.result.freight_rate_original + '円');
                            modal_sale.find('.x-sale-freight-rate').html(res.result.freight_rate + '円');
                            modal_sale.find('.x-sale-delivery-date').html(res.result.delivery_date);
                            modal_sale.find('.x-sale-shipping-fee').html(res.result.shipping_fee);

                            modal_sale.find('.x-sale-note-1').html($.nl2br(res.result.note_1));
                            modal_sale.find('.x-sale-note-2').html($.nl2br(res.result.note_2));
                            modal_sale.find('.x-sale-note-3').html($.nl2br(res.result.note_3));

                            // Assign href of button
                            $('.btn-sale-detail').attr('href', '/sale/' + res.result.id);
                            $('.btn-sale-edit').attr('href', '/sale/' + res.result.id + '/edit');

                        }, 0);
                        modal_sale.modal();
                    },
                    error: function (res) {
                        modal_sale.modal("hide");
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            }
        },

        select: function(startDate, endDate) {
        }
    });
})();