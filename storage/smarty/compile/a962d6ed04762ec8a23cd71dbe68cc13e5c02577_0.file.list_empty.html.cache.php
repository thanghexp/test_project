<?php
/* Smarty version 3.1.31, created on 2017-02-01 16:04:30
  from "/opt/lampp/htdocs/test_project/resources/views/partial/list_empty.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5892070e1c45d3_50175567',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a962d6ed04762ec8a23cd71dbe68cc13e5c02577' => 
    array (
      0 => '/opt/lampp/htdocs/test_project/resources/views/partial/list_empty.html',
      1 => 1484300005,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5892070e1c45d3_50175567 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1551819495892070e08a368_18917888';
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
