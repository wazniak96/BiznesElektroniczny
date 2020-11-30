<?php /* Smarty version Smarty-3.1.19, created on 2020-11-30 19:57:13
         compiled from "/var/www/html/psadmin/themes/default/template/controllers/modules/warning_module.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12964909655fc54089594c63-05269697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '12964909655fc54089594c63-05269697',
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
  'unifunc' => 'content_5fc540895a7223_21255570',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fc540895a7223_21255570')) {function content_5fc540895a7223_21255570($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_link']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</a>
<?php }} ?>
