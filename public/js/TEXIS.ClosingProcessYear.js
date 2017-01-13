var TEXIS = TEXIS || {};

(function () {

    /**
     * TEXIS.ClosingProcessYear Class for all pages
     *
     * @type {void|*}
     */
    TEXIS.ClosingProcessYear = AppCore.Base.extend({

        events: {
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
         * Handle show chart follow month
         * @param config
         */
        handleChartMonth: function(config) {

            var data_total_bill = config.data_total_bill || {};
            var data_total_payment = config.data_total_payment || {};
            var data_total_industrial_waste = config.data_total_industrial_waste || {};
            var data_total_purchase = config.data_total_purchase || {};
            var data_total_sale = config.data_total_sale || {};

            Highcharts.setOptions({
                lang: {
                    thousandsSep: ','
                }
            });

            $('#container').highcharts({
                chart: {
                    zoomType: 'xy',
                    spacingTop: 50,

                },
                title: {
                    text: '',
                },
                subtitle: {
                    text: ''
                },
                exporting: { // Hidden button
                    buttons: {
                        contextButton: {
                            enabled: false
                        }
                    }
                },
                xAxis: [{
                    categories: ['1月', '2月', '3月', '4月', '5月', '6月',
                        '7月', '8月', '9月', '10月', '11月', '12月'],
                    crosshair: true
                }],
                yAxis: [{ // Column left claim, purchasing
                    labels: {
                        format: '{value}',
                        formatter: function() {
                            return val = (this.value / 1000).toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.0', '') + " 千円";
                        },
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: '金額（千円）',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }, { // Column right number of industrial waste, number of purchase, number of sales
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: '件数（回）',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
                series: [{
                    name: '請求額合計',
                    type: 'column',
                    yAxis: 0,
                    data: data_total_bill
                },{
                    name: '支払額合計',
                    type: 'column',
                    yAxis: 0,
                    data: data_total_payment
                },{
                    name: '産廃引取件数',
                    type: 'spline',
                    yAxis: 1,
                    data: data_total_industrial_waste
                },{
                    name: '仕入/在庫引取件数',
                    type: 'spline',
                    yAxis: 1,
                    data: data_total_purchase
                },{
                    name: '販売件数',
                    type: 'spline',
                    yAxis: 1,
                    data: data_total_sale
                }]
            });
        }
    });
})();