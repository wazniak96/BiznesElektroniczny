<?php /* Smarty version Smarty-3.1.19, created on 2020-11-30 19:53:43
         compiled from "/var/www/html/psadmin/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8169345955fc53fb728e414-01029670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c2f707fd2dda2b0f32c7600ea42b455cba6445f' => 
    array (
      0 => '/var/www/html/psadmin/themes/default/template/content.tpl',
      1 => 1606760764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8169345955fc53fb728e414-01029670',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5fc53fb729fbb2_66740946',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fc53fb729fbb2_66740946')) {function content_5fc53fb729fbb2_66740946($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }} ?>