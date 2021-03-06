<?php
/* Smarty version 3.1.31, created on 2017-01-25 03:57:29
  from "/Applications/MAMP/htdocs/test_project/resources/views/customer/detail.blade.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58882229e18b02_57714722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32c331d4138be8e367c744e8775e774653155be9' => 
    array (
      0 => '/Applications/MAMP/htdocs/test_project/resources/views/customer/detail.blade.php',
      1 => 1485316649,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58882229e18b02_57714722 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'demo_smarty' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/test_project/storage/smarty/compile/32c331d4138be8e367c744e8775e774653155be9_0.file.detail.blade.php.cache.php',
    'uid' => '32c331d4138be8e367c744e8775e774653155be9',
    'call_name' => 'smarty_template_function_demo_smarty_3169051758882229d907b3_86499941',
  ),
));
if (!is_callable('smarty_function_item_history')) require_once '/Applications/MAMP/htdocs/test_project/resources/smarty/plugins/function.item_history.php';
$_smarty_tpl->compiled->nocache_hash = '3169051758882229d907b3_86499941';
?>
@extends('layouts/base')


@section('content')
<div class="row" id="x-customer-detail">
    <div class="col-lg-5 col-md-6">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">
                    <p class="avatar-icon"><i class="fa fa-users margin-r-5 text-primary"></i></p>
                    <p>{{ $data_customer['name'] or '' }}</p>
                </h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <i class="fa fa-check-circle margin-r-5 text-primary"></i>ステータス
                        <span class="pull-right"><small class="label label-success">{{ $data_customer['status'] or '' }}</small></span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-cogs margin-r-5 text-primary"></i>取引先種別
                        <span class="pull-right">{{ !empty($data_customer['type']) ? implode(',', $data_types) : '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-codepen margin-r-5 text-primary"></i>郵便番号
                        <span class="pull-right">{{ $data_customer['postal_code'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-map-marker margin-r-5 text-primary"></i>住所
                        <span class="pull-right">{{ $data_customer['address'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-phone-square margin-r-5 text-primary"></i>電話番号
                        <span class="pull-right">{{ $data_customer['fax_number'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-fax margin-r-5 text-primary"></i>FAX番号
                        <span class="pull-right">{{ $data_customer['phone_number'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-calendar margin-r-5 text-primary"></i>支払請求種別
                        <span class="pull-right">{{ $data_customer['bill_type_name'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-user margin-r-5 text-primary"></i>主担当者名
                        <span class="pull-right">{{ $data_customer['main_charge_name'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-user margin-r-5 text-primary"></i>副担当者名
                        <span class="pull-right">{{ $data_customer['extra_charge_name'] or '' }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-file-text margin-r-5 text-primary"></i>備考
                        <p>{{ $data_customer['remark'] or '' }}</p>
                    </li>
                </ul>
            </div>
            <div class="box-footer">
                <a href="/customer/{{ $data_customer['id'] }}/edit" class="btn btn-warning btn-block"><b><i class="fa fa-edit margin-r-5"></i> 編集</b></a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker margin-r-5"></i>拠点情報</h3>
                <div class="box-tools pull-right">
                    <a href="/customer/{{ $data_customer['id'] }}/create_location" class="btn btn-success btn-flat btn-sm"><b><i class="fa fa-plus-circle margin-r-5"></i>追加</b></a>
                </div>
            </div>
            <div class="box-body">
                @include('customer/partial/list_location', ['locations' => $data_customer['customer_locations'] ] )
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-calendar-check-o margin-r-5"></i>担当者情報</h3>
                <div class="box-tools pull-right">
                    <a href="/customer/{{ $data_customer['id'] }}/create_contact" class="btn btn-success btn-flat btn-sm"><b><i class="fa fa-plus-circle margin-r-5"></i>追加</b></a>
                </div>
            </div>
            <div class="box-body">
                @include('customer/partial/list_contact', ['contacts' => $data_customer['customer_contacts']] )
            </div>
        </div>
    </div>

    <div class="col-lg-7 col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-clock-o margin-r-5 text-primary"></i>タイムライン</h3>
            </div>
            <div class="box-body">
                <div class="scroll scroll-customer">
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['histories']->value, 'history');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['history']->value) {
?>
                        <?php echo smarty_function_item_history(array('history'=>json_encode($_smarty_tpl->tpl_vars['history']->value)),$_smarty_tpl);?>

                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        <!-- .timeline item -->

                        <?php if ($_smarty_tpl->tpl_vars['log_limit']->value < $_smarty_tpl->tpl_vars['log_total']->value) {?>
                        <div class="timeline-loadmore">
                            <a href="javascript:;" class="uppercase x-load-more-log"
                               data-object="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['object']->value, ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
"
                               data-action='<?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['action']->value))===null||$tmp==='' ? '' : $tmp);?>
'
                               data-target="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['target_id']->value)===null||$tmp==='' ? '' : $tmp);?>
"><b><i class="fa fa-chevron-circle-down margin-r-5"></i>もっと読み込む</b></a>
                        </div>
                        <?php }?>

                        <li><i class="fa fa-clock-o bg-gray"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
     
@endsection

@section('javascript')
<?php echo '<script'; ?>
 type="text/javascript" src="/js/TEXIS.CustomerDetail.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/TEXIS.History.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function () {
        //Customer Detail
        new TEXIS.CustomerDetail({
            el: $('#x-customer-detail')
        });

        //History
        new TEXIS.History({
            el: $('#x-customer-detail')
        });
    });
<?php echo '</script'; ?>
>
@endsection

<?php }
/* smarty_template_function_demo_smarty_3169051758882229d907b3_86499941 */
if (!function_exists('smarty_template_function_demo_smarty_3169051758882229d907b3_86499941')) {
function smarty_template_function_demo_smarty_3169051758882229d907b3_86499941($_smarty_tpl,$params) {
$params = array_merge(array('param'=>"abc"), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}?>
    <?php
}}
/*/ smarty_template_function_demo_smarty_3169051758882229d907b3_86499941 */
}
