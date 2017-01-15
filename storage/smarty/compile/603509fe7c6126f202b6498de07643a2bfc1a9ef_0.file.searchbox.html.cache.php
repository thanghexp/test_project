<?php
/* Smarty version 3.1.31, created on 2017-01-15 05:02:07
  from "/opt/lampp/htdocs/test_project/resources/views/partial/searchbox.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_587b024f506c18_21558726',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '603509fe7c6126f202b6498de07643a2bfc1a9ef' => 
    array (
      0 => '/opt/lampp/htdocs/test_project/resources/views/partial/searchbox.html',
      1 => 1484456527,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587b024f506c18_21558726 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '734257078587b024f33ce81_02248666';
?>
<section class="box-dvsty row">

    <h4 class="col-md-4 font-xs"><i class="fa fa-list-ul margin-r-5"></i><?php echo (($tmp = @number_format($_smarty_tpl->tpl_vars['pagination']->value['from']))===null||$tmp==='' ? 0 : $tmp);?>
~<?php echo (($tmp = @number_format($_smarty_tpl->tpl_vars['pagination']->value['to']))===null||$tmp==='' ? 0 : $tmp);?>
Rows(Total <?php echo (($tmp = @number_format($_smarty_tpl->tpl_vars['pagination']->value['total']))===null||$tmp==='' ? 0 : $tmp);?>
Rows)</h4>

    <div class="col-md-8">
        <div class="row">
            <form id="index-search-form" action="" method="get" class="form-horizontal">
                <div class="col-sm-12 box-searchhead clearfix">
                    <?php if (!empty($_smarty_tpl->tpl_vars['view']->value)) {?>
                        <input type="hidden" name="view" value="<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
">
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value != 'customer') {?>
                    <input type="hidden" name="order">
                    <input type="hidden" name="sort">
                    <?php }?>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">

                        <?php if (!empty($_smarty_tpl->tpl_vars['page']->value) && $_smarty_tpl->tpl_vars['page']->value == 'industrial_waste' && !empty($_smarty_tpl->tpl_vars['industrial_waste_types']->value)) {?>
                        <label class="col-lg-6 col-md-5 control-label">産廃種別：</label>
                        <div class="col-lg-6 col-md-7">
                            <select class="form-control select2 x-search-field" name="search_field">
                                <option value="">選択してください</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['industrial_waste_types']->value, 'industrial_waste_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['industrial_waste_type']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['industrial_waste_type']->value['code'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['search_field']->value) && $_smarty_tpl->tpl_vars['search_field']->value == $_smarty_tpl->tpl_vars['industrial_waste_type']->value['code']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['industrial_waste_type']->value['value'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </select>
                        </div>
                        <?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['page']->value) && $_smarty_tpl->tpl_vars['page']->value == 'purchase' && !empty($_smarty_tpl->tpl_vars['purchase_types']->value)) {?>
                        <label class="col-lg-6 col-md-5 control-label">仕入種別：</label>
                        <div class="col-lg-6 col-md-7">
                            <select class="form-control select2 x-search-field" name="search_field">
                                <option value="">選択してください</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['purchase_types']->value, 'purchase_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['purchase_type']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['purchase_type']->value['code'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['search_field']->value) && $_smarty_tpl->tpl_vars['search_field']->value == $_smarty_tpl->tpl_vars['purchase_type']->value['code']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['purchase_type']->value['value'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </select>
                        </div>
                        <?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['page']->value) && $_smarty_tpl->tpl_vars['page']->value == 'sale' && !empty($_smarty_tpl->tpl_vars['product_types']->value)) {?>
                        <label class="col-lg-6 col-md-5 control-label">仕入種別：</label>
                        <div class="col-lg-6 col-md-7">
                            <select class="form-control select2 x-search-field" name="search_field">
                                <option value="">選択してください</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value['id'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['search_field']->value) && $_smarty_tpl->tpl_vars['search_field']->value == $_smarty_tpl->tpl_vars['product_type']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </select>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class=" col-sm-6">
                    <div class="form-group">
                        <label class="col-lg-4 col-md-4 control-label">検索：</label>
                        <div class="col-lg-8 col-md-8">
                            <input type="text" name="search_value" class="form-control x-search-value" placeholder="" value="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['search_value']->value, ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php }
}
