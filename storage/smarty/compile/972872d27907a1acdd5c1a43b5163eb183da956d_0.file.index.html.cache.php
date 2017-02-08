<?php
/* Smarty version 3.1.31, created on 2017-02-01 22:16:20
  from "/opt/lampp/htdocs/test_project/resources/views/industrial_waste/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58925e348e6364_42217253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '972872d27907a1acdd5c1a43b5163eb183da956d' => 
    array (
      0 => '/opt/lampp/htdocs/test_project/resources/views/industrial_waste/index.html',
      1 => 1484300005,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:partial/searchbox.html' => 1,
    'file:industrial_waste/partial/item_definition.blade.php' => 8,
    'file:partial/list_empty.html' => 2,
    'file:partial/pagination.blade.php' => 1,
    'file:partial/modal/industrial_waste/change_status.html' => 1,
    'file:partial/modal/select_date.html' => 1,
  ),
),false)) {
function content_58925e348e6364_42217253 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_block_content_for')) require_once '/opt/lampp/htdocs/test_project/resources/smarty/plugins/block.content_for.php';
$_smarty_tpl->compiled->nocache_hash = '130147691158925e346708e7_54957543';
?>
<div class="row" id="x-list-industrial-waste">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <a href="/industrial_waste/create" class="btn bg-olive btn-flat btn-mobile"><b><i class="fa fa-plus-circle margin-r-5"></i>新規作成</b></a>
                    <a data-toggle="modal" data-target="#selectDateModal" class="btn btn-primary btn-flat btn-mobile"><b><i class="fa fa-file margin-r-5"></i>CSV</b></a>
                    <a href="javascript:;" class="btn btn-danger btn-flat btn-mobile x-button-delete-industrial-waste"><b><i class="fa fa-trash margin-r-5"></i>削除</b></a>
                </div>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle btn-mobile" data-toggle="dropdown" aria-expanded="false"><b><?php if (!$_smarty_tpl->tpl_vars['list_detail_page']->value) {?> ステータス <?php } else { ?> 詳細 <?php }?></b>
                            <span class="fa fa-caret-down m-l-5"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li class="<?php if (!$_smarty_tpl->tpl_vars['list_detail_page']->value) {?> active <?php }?>"><a href="/industrial_waste<?php if (!empty('conditions_view')) {?>?<?php echo $_smarty_tpl->tpl_vars['conditions_view']->value;
}?>"><b>ステータス</b></a></li>
                            <li  class="<?php if ($_smarty_tpl->tpl_vars['list_detail_page']->value) {?> active <?php }?>"><a href="/industrial_waste?view=list_detail<?php if (!empty($_smarty_tpl->tpl_vars['conditions_view']->value)) {?>&<?php echo $_smarty_tpl->tpl_vars['conditions_view']->value;
}?>"><b>詳細</b></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="no-padding">

                    <?php $_smarty_tpl->_subTemplateRender("file:partial/searchbox.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('page'=>"industrial_waste",'view'=>$_smarty_tpl->tpl_vars['view']->value,'config'=>$_smarty_tpl->tpl_vars['pagination']->value,'search_field'=>$_smarty_tpl->tpl_vars['search_field']->value,'search_value'=>$_smarty_tpl->tpl_vars['search_value']->value,'industrial_waste_types'=>$_smarty_tpl->tpl_vars['industrial_waste_types']->value), 0, false);
?>


                    

                    <?php if (empty($_smarty_tpl->tpl_vars['list_detail_page']->value)) {?>
                       <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="minimal checkAll" value=""></th>
                                    <th class="text-center" style="min-width:120px">引取日
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'take_off_at' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'take_off_at' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="take_off_at"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">引取先名
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'customer' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'customer' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="customer"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">案件名称
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'ticket_name' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'ticket_name' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="ticket_name"></a>
                                        </div>
                                    </th>
                                    <th class="text-center">引取決定</th>
                                    <th class="text-center">配送依頼済</th>
                                    <th class="text-center">引取日連絡</th>
                                    <th class="text-center">引取詳細決定</th>
                                    <th class="text-center">搬入完了</th>
                                    <th class="text-center">数量確定</th>
                                    <th class="text-center">処理完了</th>
                                    <th class="text-center">MF返送</th>
                                    <th class="text-center">メニュー</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['industrial_wastes']->value, 'industrial_waste');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['industrial_waste']->value) {
?>
                            <tr>
                            <tr>
                                <td class="check"><input type="checkbox" name="industrial_waste_id" value="<?php echo $_smarty_tpl->tpl_vars['industrial_waste']->value['id'];?>
" class="minimal check"></td>
                                <td><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['take_off_at'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['client_customer_name'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['ticket_name'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>

                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['confirm_taking_over'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['requested_to_deliver'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['contact_taking_over_date'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['contact_taking_over_detail'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['carrying_in_completion'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['confirm_quantity'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['disposal_completed'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <?php $_smarty_tpl->_subTemplateRender('file:industrial_waste/partial/item_definition.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('definition_data'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['definition_data']['return_mf'],'data_id'=>$_smarty_tpl->tpl_vars['industrial_waste']->value['id']), 0, true);
?>


                                <td>
                                    <a href="/industrial_waste/copy?id=<?php echo $_smarty_tpl->tpl_vars['industrial_waste']->value['id'];?>
" class="btn btn-success btn-flat btn-xs"><b><i class="fa fa-files-o margin-r-5"></i>複製</b></a>&nbsp;
                                    <a href="/industrial_waste/<?php echo $_smarty_tpl->tpl_vars['industrial_waste']->value['id'];?>
" class="btn btn-info btn-flat btn-xs"><b><i class="fa fa-file-text margin-r-5"></i>詳細</b></a>
                                </td>
                            </tr>
                            </tr>
                            <?php
}
} else {
?>

                                <?php $_smarty_tpl->_subTemplateRender('file:partial/list_empty.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('total_column'=>13), 0, true);
?>

                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </tbody>
                            <div class="x-table-overlay">
                                <div class="overlay">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                        </table>
                    </div>
                    <?php } else { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="minimal checkAll" name="industrial_waste_id" value=""></th>
                                    <th class="text-center" style="min-width:120px">引取日
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'take_off_at' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'take_off_at' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="take_off_at"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">引取先名
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'customer' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'customer' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="customer"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">案件名称
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'ticket_name' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'ticket_name' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="ticket_name"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:190px">マニュフェスト番号
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'manifest_no' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'manifest_no' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="manifest_no"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">産廃種別
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'type' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'type' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="type"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">引取数量
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'quantity' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'quantity' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="quantity"></a>
                                        </div>
                                    </th>
                                    <th class="text-center" style="min-width:120px">運送会社
                                        <div class="">
                                            <a class="sort
                                             <?php if ($_smarty_tpl->tpl_vars['order']->value == 'logistic_customer' && $_smarty_tpl->tpl_vars['sort']->value == 'ASC') {?>sorting_asc
                                             <?php } elseif ($_smarty_tpl->tpl_vars['order']->value == 'logistic_customer' && $_smarty_tpl->tpl_vars['sort']->value == 'DESC') {?>sorting_desc
                                             <?php } else { ?>sorting<?php }?>" style="color:#4F5155" data-order="logistic_customer"></a>
                                        </div>
                                    </th>
                                    <th class="text-center">メニュー</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['industrial_wastes']->value, 'industrial_waste');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['industrial_waste']->value) {
?>
                                <tr>
                                    <td class="check"><input type="checkbox" name="industrial_waste_id" value="<?php echo $_smarty_tpl->tpl_vars['industrial_waste']->value['id'];?>
" class="minimal check"></td>
                                    <td><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['take_off_at'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['client_customer_name'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['ticket_name'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['manifest_no'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['type_name'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['quantity'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);
echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['unit'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td class="text-left"><?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['industrial_waste']->value['logistic_customer_name'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
</td>
                                    <td>
                                        <a href="/industrial_waste/copy?id=<?php echo $_smarty_tpl->tpl_vars['industrial_waste']->value['id'];?>
" class="btn btn-success btn-flat btn-xs"><b><i class="fa fa-files-o margin-r-5"></i>複製</b></a>&nbsp;
                                        <a href="/industrial_waste/detail/<?php echo $_smarty_tpl->tpl_vars['industrial_waste']->value['id'];?>
" class="btn btn-info btn-flat btn-xs"><b><i class="fa fa-file-text margin-r-5"></i>詳細</b></a>
                                    </td>
                                </tr>
                                <?php
}
} else {
?>

                                <?php $_smarty_tpl->_subTemplateRender('file:partial/list_empty.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('total_column'=>9), 0, true);
?>

                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </tbody>
                                <div class="x-table-overlay">
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </table>
                    </div>
                    <?php }?>

                    <?php $_smarty_tpl->_subTemplateRender('file:partial/pagination.blade.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('config'=>$_smarty_tpl->tpl_vars['pagination']->value), 0, false);
?>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <?php $_smarty_tpl->_subTemplateRender('file:partial/modal/industrial_waste/change_status.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender('file:partial/modal/select_date.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('title'=>"CSVダウンロード",'action'=>"api/industrial_waste/csv",'search_field'=>$_smarty_tpl->tpl_vars['search_field']->value,'search_value'=>$_smarty_tpl->tpl_vars['search_value']->value,'order'=>$_smarty_tpl->tpl_vars['order']->value,'sort'=>$_smarty_tpl->tpl_vars['sort']->value), 0, false);
?>

</div>

<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('content_for', array('name'=>"headjs"));
$_block_repeat=true;
echo smarty_block_content_for(array('name'=>"headjs"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
?>

<?php echo '<script'; ?>
>
    $(function () {
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

    });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/TEXIS.IndustrialList.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function () {
        new TEXIS.IndustrialList({
            el: $('#x-list-industrial-waste')
        });
    });
<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo smarty_block_content_for(array('name'=>"headjs"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
