<!-- ====== Javascript ====== -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/dist/js/app.min.js"></script>
<script src="/js/underscore-min.js"></script>
<script src="/js/backbone-min.js"></script>
<script src="/core/base/Base.js"></script>
<script src="/core/form/Form.js"></script>
<script src="/js/TEXIS.Base.js"></script>

<!-- ====== Plugin ====== -->
<script src="/plugins/iCheck/icheck.min.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/plugins/datepicker/locales/bootstrap-datepicker.ja.js"></script>
<script src="/plugins/notify/notify.min.js"></script>
<script src="/js/common.js"></script>
<script src="/third_party/jquery.cookie-1.4.1.min.js"></script>

<!--{if isset($form_errors) && (!isset($load_form_js) || (isset($load_form_js) && $load_form_js === TRUE) )}-->
<script type="text/javascript">
    (function () {
        $(document).ready(function () {
            var form = new AppCore.Form({
                el: $('form'),
                errorObject: $.parseJSON('<!--{$form_errors|json_encode|default:"{}"}-->')
            });
        });
    })();
</script>
<!--{/if}-->

<script type="text/javascript">
    $(document).ready(function () {
        new TEXIS.Base({
            el: $('body')
        });
    });
</script>

<!-- ====== JS show modal load ====== -->
<script type="text/javascript">
    $(window).on('beforeunload', function(e) {
        $('#x-modal-overlay').show();
    });
</script>