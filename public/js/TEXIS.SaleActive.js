var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.SaleActive Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.SaleActive = AppCore.Base.extend({

        events: {
            'change #customer_id': 'change_customer',
            'click .x-button-sale-active': 'handleSaleActive'
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
         * Handle get list location when select customer
         */
        change_customer: function (e) {
            var target = $(e.currentTarget);
            var target_location = $('#customer_location_id');
            var self = this;
            var customer_id = parseInt(target.val());
            var customer_location_id = target_location.data('select');
            var temp = '<option value="">拠点名を選択してください</option>';

            if (!isNaN(customer_id)) {

                $('#x-modal-overlay').show();
                // Handle show location when select customer
                $.ajax({
                    'type': 'POST',
                    'url': '/api/customer/get_list_location',
                    'data' : {
                        'customer_id': customer_id,
                        'status' : 'active'
                    },
                    success: function (res) {

                        // Add option of select box if exits data
                        if (res.success == true && res.submit == true) {
                            var data = res.result;
                            _.each(data, function (item) {
                                var selected = '';
                                if (customer_location_id == item.id) {
                                    selected = 'selected';
                                }
                                temp = temp + "<option value='" + item.id + "'" + selected + ">" + item.site_name + "</option>";
                            });
                        }

                        // Add data in select box
                        target_location.html(temp);
                        $('#x-modal-overlay').hide();
                    },
                    error: function (res) {
                        self.alert(res.errmsg || '問題が発生し');
                    }
                });
            } else {
                target_location.html(temp);
            }
        },

        /**
         * Handle sale active
         *
         * @param e
         */
        handleSaleActive: function (e) {
            var self = this;
            var target = $(e.currentTarget);
            var location_id = target.data('location-id');

            // Get data of location
            $.ajax({
                'type': 'POST',
                'url': '/api/customer/get_detail_location',
                'data' : {
                    'id': location_id
                },
                success: function (res) {

                    // Show error
                    if (!res.success || !res.submit) {
                        self.alert(res.errmsg || '問題が発生し');
                        return;
                    }

                    window.location.href = 'sale_active/' + location_id;
                },
                error: function (res) {
                    self.alert(res.errmsg || '問題が発生し');
                }
            });
        },
    });
})();