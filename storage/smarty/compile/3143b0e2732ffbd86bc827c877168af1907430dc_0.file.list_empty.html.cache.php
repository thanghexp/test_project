<?php
/* Smarty version 3.1.31, created on 2017-01-13 09:05:21
  from "/Applications/MAMP/htdocs/test_project/resources/views/partial/list_empty.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_587898513032d8_74714370',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3143b0e2732ffbd86bc827c877168af1907430dc' => 
    array (
      0 => '/Applications/MAMP/htdocs/test_project/resources/views/partial/list_empty.html',
      1 => 1481781238,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587898513032d8_74714370 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '47841868858789851170765_58931806';
if (isset($_smarty_tpl->tpl_vars['total_column']->value) && !empty($_smarty_tpl->tpl_vars['total_column']->value)) {?>
<tr class="text-center">
    <td colspan="<?php echo $_smarty_tpl->tpl_vars['total_column']->value;?>
">
        <span class="glyphicon glyphicon-ban-circle"></span>
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['errmsg']->value)===null||$tmp==='' ? '項目が見つかりませんでした' : $tmp);?>

    </td>
</tr>
<?php } else { ?>
<div class="no-result-template page-padding">
    <span class="glyphicon glyphicon-ban-circle"></span>
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['errmsg']->value)===null||$tmp==='' ? '項目が見つかりませんでした' : $tmp);?>

</div>
<?php }
}
}
