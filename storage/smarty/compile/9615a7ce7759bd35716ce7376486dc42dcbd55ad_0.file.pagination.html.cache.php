<?php
/* Smarty version 3.1.31, created on 2017-01-13 09:03:26
  from "/Applications/MAMP/htdocs/test_project/resources/views/partial/pagination.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_587897dee0f5f9_33027874',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9615a7ce7759bd35716ce7376486dc42dcbd55ad' => 
    array (
      0 => '/Applications/MAMP/htdocs/test_project/resources/views/partial/pagination.html',
      1 => 1484297191,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587897dee0f5f9_33027874 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1554543628587897ded31cb3_44545930';
if (!empty($_smarty_tpl->tpl_vars['pagination']->value['total'])) {?>
<div class="row">
    <div class="col-sm-6 col-xs-12 pull-right">
       <ul class="pagination pagination-sm pull-right">
            <li <?php if ($_smarty_tpl->tpl_vars['pagination']->value['page']-1 <= 0) {?> class="disabled" <?php }?>>
                <a href="<?php if ($_smarty_tpl->tpl_vars['pagination']->value['page']-1 <= 0) {?> javascript:;<?php } else { ?>?<?php if (!empty($_smarty_tpl->tpl_vars['pagination']->value['conditions'])) {
echo $_smarty_tpl->tpl_vars['pagination']->value['conditions'];?>
&<?php }?>p=<?php echo $_smarty_tpl->tpl_vars['pagination']->value['page']-1;
}?>"><b><i class="fa fa-angle-left"></i></b></a>
            </li>

            <li <?php if ($_smarty_tpl->tpl_vars['pagination']->value['page']+1 > $_smarty_tpl->tpl_vars['pagination']->value['total_page']) {?> class="disabled" <?php }?>>
                <a href="<?php if ($_smarty_tpl->tpl_vars['pagination']->value['page']+1 > $_smarty_tpl->tpl_vars['pagination']->value['total_page']) {?> javascript:;<?php } else { ?>?<?php if (!empty($_smarty_tpl->tpl_vars['pagination']->value['conditions'])) {
echo $_smarty_tpl->tpl_vars['pagination']->value['conditions'];?>
&<?php }?>p=<?php echo $_smarty_tpl->tpl_vars['pagination']->value['page']+1;
}?>"><b><i class="fa fa-angle-right"></i></b></a>
            </li>
        </ul>
    </div>
</div>
<?php }
}
}
