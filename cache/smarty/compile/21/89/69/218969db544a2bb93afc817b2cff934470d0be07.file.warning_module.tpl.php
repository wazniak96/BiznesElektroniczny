<?php /* Smarty version Smarty-3.1.19, created on 2020-12-01 18:46:08
         compiled from "/var/www/html/psadmin/themes/default/template/controllers/modules/warning_module.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15469572065fc68160afa1e0-43377965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '218969db544a2bb93afc817b2cff934470d0be07' => 
    array (
      0 => '/var/www/html/psadmin/themes/default/template/controllers/modules/warning_module.tpl',
      1 => 1606760765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15469572065fc68160afa1e0-43377965',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_link' => 0,
    'text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5fc68160b0d8a2_30153068',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fc68160b0d8a2_30153068')) {function content_5fc68160b0d8a2_30153068($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_link']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</a>
<?php }} ?>
