var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.UserDetail Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.UserDetail = AppCore.Base.extend({

        events: {
            'click .x-load-more-log': 'loadLog'
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
         * Show log time line
         */
        loadLog: function (e) {
            var target = $(e.currentTarget);
            var self = this;

            // Assign data
            var offset = 2;
            if (target.data('offset')) {
                offset = target.data('offset') + 1;
            }

            var object = target.data('object');
            var action = target.data('action');
            var target_id = target.data('target');

            // Hande load more time line
            $.ajax({
                'type': 'POST',
                'url': '/api/account/load_log',
                data: {
                    p: offset,
                    object: object,
                    action: action,
                    target_id: target_id
                },
                success: function (res) {

                    // Check success
                    if (res.success == true && res.submit == true) {
                        var data = res.result.items;

                        // If not data not show button もっと読み込む
                        if (data.length == 0 || data.length < 10) {
                            target.remove();
                        }

                        // Assign data offset
                        target.data('offset', offset);

                        // Append html data
                        _.each(data, function (item) {

                            // Clone last item
                            var last_item = $(".timeline .x-timeline-item:last");
                            var new_timeline = last_item.clone();

                            // Assign data
                            $(new_timeline).find('.x-log-time').html('<i class="fa fa-clock-o"></i> ' + item.create_at);
                            $(new_timeline).find('.x-log-header').html('<strong>' + item.account_name + '</strong>');
                            $(new_timeline).find('.x-log-body').html(item.message);

                            // Append at last list
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