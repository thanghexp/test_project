/**
 * Created by Tuanna on 10/21/16.
 */

$(function () {
    $(document).ready(function () {
        //Initialize Select2 Elements
        $(".select2").select2({ width: '100%' });

        // Show calendar
        $('.datepicker').datepicker({
            orientation: "left",
            autoclose: true,
            language: 'ja',
            format: 'yyyy/mm/dd'
        });
        $('.input-group').find('.fa-calendar').on('click', function(){
            $(this).parent().siblings('.datepicker').trigger('focus');
        });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        // Checkall
        $('input.checkAll').on('ifChecked', function(event){
            $('input.check').iCheck('check');
        });
        $('input.checkAll').on('ifUnchecked', function(event){
            $('input.check').iCheck('uncheck');
        });

        // scroll modal by device screen
        function setModalMaxHeight(element) {
            this.$element     = $(element);
            this.$content     = this.$element.find('.modal-content');
            var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin  = $(window).width() < 768 ? 20 : 60;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight     = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });

            this.$element
                .find('.modal-body').css({
                'max-height': maxHeight,
                'overflow-y': 'auto'
            });
        }

        $('.modal').on('show.bs.modal', function() {
            $(this).show();
            setModalMaxHeight(this);
        });

        $(window).resize(function() {
            if ($('.modal.in').length != 0) {
                setModalMaxHeight($('.modal.in'));
            }
        });
    });
});

/**
 * @namespace
 */
var TEXIS = TEXIS || {};

/**
 * @namespace Mixins
 * @memberof Spice
 */
TEXIS.ModalManifest = TEXIS.ModalManifest || {};

(function() {

    // Initialize modal definition
    TEXIS.ModalManifest  = Backbone.View.extend({

        el: "#manifestModal",

        event: {
            'click #x-button-modal-manifest' : 'downloadPdfMenifest'
        },

        initialize: function(args){
            this.data = args.data ? args.data : [];
        },
        render: function(){
            this.$el.modal("show");
        },
        close: function() {
            this.$el.modal("hide");
        },

        downloadPdfMenifest: function(e) {
            console.log('Modal');
        }
    });

})();

$(document).ajaxComplete(function() {

    var sum_row = $('.check > .icheckbox_minimal-blue').size();
    $('.check .icheckbox_minimal-blue .iCheck-helper').on('click',function(){
        var sum_row_check = $('.check >.icheckbox_minimal-blue.checked').size();
        if( sum_row_check == sum_row){
            $('th .icheckbox_minimal-blue').addClass('checked');
        }else{
            $('th .icheckbox_minimal-blue').removeClass('checked');
        }
    });

    // Loading table
    $('tr .sort').on('click', function () {
        $('.x-table-overlay').show();
    });
});