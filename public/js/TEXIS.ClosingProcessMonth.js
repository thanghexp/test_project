var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.ClosingProcessMonth Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.ClosingProcessMonth = AppCore.Base.extend({

        events: {
            'click .x-print-invoice-pdf': 'printInvoicePDF',
            'click .x-button-download-bill': 'downloadCsvBill',
            'click .x-button-download-payment': 'downloadCsvPayment',
            'click .x-button-change-status': 'handleChangeStatus',
            'ifClicked .x-status-report' : 'handleRestoreStatus'
        },
        
        /**
         * Constructor
         *
         * @param {Object} config
         */
        initialize: function (config) {
            config = config || {};

            this.handleChartMonth(config);

            this.loader();
            this.render(config);
        },

        /**
         * Handle download pdf
         * @param e
         */
        printInvoicePDF: function(e) {
            var self = this;
            var target = $(e.currentTarget);
            var customer_ids = [];

            // Get customer
            _.each($(".x-customer-checkbox", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked')) {
                    customer_ids.push(target.val());
                }
            });

            if (customer_ids.length == 0) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: 'PDFファイルに印刷する顧客の請求書を選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
            } else {
                $('#frm-print-invoice').attr('action', '/api/chart/print_invoice_month');
                $('#frm-print-invoice').attr('target', '_blank');
                $('#frm-print-invoice').submit();
            }
        },

        /**
         * Handle download Csv Bill
         * @param e
         */
        downloadCsvBill: function(e) {
            $('#frm-print-invoice').attr('action', '/api/chart/download_csv_bill');
            $(window).off('beforeunload');
            $('#frm-print-invoice').submit();
        },

        /**
         * Handle download Csv Payment
         * @param e
         */
        downloadCsvPayment: function(e) {
            $('#frm-print-invoice').attr('action', '/api/chart/download_csv_payment');
            $(window).off('beforeunload');
            $('#frm-print-invoice').submit();
        },

        /**
         * Handle show chart follow month
         * @param config
         */
        handleChartMonth: function(config) {

            Highcharts.setOptions({
                lang: {
                    thousandsSep: ','
                }
            });

            var data_customers = config.data_customers || {};
            var data_bills = config.data_bills || {};
            var data_payments = config.data_payments || {};
            var data_max = config.data_max;

            console.log(data_bills);

            Highcharts.chart('container', {
                chart: {
                    type: 'bar',
                    marginRight: 50,
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: data_customers
                },
                yAxis: [{
                    min: 0,
                    max: data_max,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    minTickInterval: data_max / 10,
                    labels:{
                        formatter: function() {
                            return (this.value / 1000).toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.0', '') + " 千円";
                        }
                    },
                }],
                tooltip: {
                    valueSuffix: ' '
                },
                exporting: { // Hidden button
                    buttons: {
                        contextButton: {
                            enabled: false
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                if (this.y != 0) {
                                    return this.y;
                                } else {
                                    return null;
                                }
                            }
                        }
                    }
                },
                legend: {
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
                series: [{
                    name: '請求額合計',
                    data: data_bills,
                    labels: {
                        formatter: function() {
                            return (this.value).toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.0', '') + " 千円";
                        }
                    }
                }, {
                    name: '支払額合計',
                    data: data_payments,
                    labels: {
                        formatter: function() {
                            return (this.value).toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.0', '') + " 千円";
                        }
                    }
                }]
            });
        },

        /**
         * Handle change status report of customer
         *
         * @param e
         */
        handleChangeStatus: function(e) {
            var self = this;
            var target = $(e.currentTarget);
            var customer_ids = [];
            var month = $('input[name=month]', this.$el).val();

            // Get customer
            _.each($(".x-customer-checkbox", this.$el), function (e) {
                var target = $(e);
                if (target.is(':checked')) {
                    customer_ids.push(target.val());
                }
            });

            $('#confirmModal').modal('hide');
            if (customer_ids.length == 0) {
                self.dialog({
                    title: "ステータス警告",
                    className: "dialog-warning",
                    message: 'ステータスを変更するには、顧客データを選択してください。',
                    buttons: {
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>OK</b>",
                            className: "btn-warning btn-flat"
                        }
                    }
                });
            } else {
                self.dialog({
                    title: "締め処理確認",
                    className: "dialog-warning",
                    message: "選択した顧客の締め処理を完了しますか？<br>完了する場合は、「完了」ボタンをクリックしてください。<br>完了しない場合は、「キャンセル」ボタンをクリックしてください。",
                    buttons: {
                        cancel: {
                            label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                            className: "btn-default btn-flat"
                        },
                        ok: {
                            label: "<b><i class='fa fa-check-circle margin-r-5'></i>完了</b>",
                            className: "btn-warning btn-flat",
                            callback: function () {

                                $.ajax({
                                    'type': 'post',
                                    'url': '/api/chart/closing_process_confirmation',
                                    data: {
                                        customer_ids: customer_ids,
                                        month: month
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
         * Handle restore staus of closing date
         * @param e
         */
        handleRestoreStatus: function(e) {
            var self = this;
            var target = $(e.currentTarget);
            var customer_id = target.data('customer-id');
            var month = $('input[name=month]', this.$el).val();

            setTimeout(function(){
                if (target.val() == 1) {
                    target.iCheck('check');
                }
            }, 0);

            if (!target.val()) {
                return;
            }

            self.dialog({
                title: "締め処理戻し確認",
                className: "dialog-warning",
                message: "選択した顧客の締め処理を未処理状態にしますか？<br>未処理に戻す場合は、「完了」ボタンをクリックしてください。<br>戻さない場合は、「キャンセル」ボタンをクリックしてください。",
                buttons: {
                    cancel: {
                        label: "<b><i class='fa fa-ban margin-r-5'></i>キャンセル</b>",
                        className: "btn-default btn-flat"
                    },
                    ok: {
                        label: "<b><i class='fa fa-check-circle margin-r-5'></i>完了</b>",
                        className: "btn-warning btn-flat",
                        callback: function () {

                            $.ajax({
                                'type': 'post',
                                'url': '/api/chart/restore_closing_process_confirmation',
                                data: {
                                    customer_ids: [customer_id],
                                    month: month
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
    });
})();