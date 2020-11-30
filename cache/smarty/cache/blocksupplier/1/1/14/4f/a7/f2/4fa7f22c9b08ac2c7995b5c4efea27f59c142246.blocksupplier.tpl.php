<?php /*%%SmartyHeaderCode:6593847715fc56921f36f90-58063207%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fa7f22c9b08ac2c7995b5c4efea27f59c142246' => 
    array (
      0 => '/var/www/html/themes/default-bootstrap/modules/blocksupplier/blocksupplier.tpl',
      1 => 1606760765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6593847715fc56921f36f90-58063207',
  'variables' => 
  array (
    'display_link_supplier' => 0,
    'link' => 0,
    'suppliers' => 0,
    'text_list' => 0,
    'text_list_nb' => 0,
    'supplier' => 0,
    'form_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5fc569220f7828_90104278',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fc569220f7828_90104278')) {function content_5fc569220f7828_90104278($_smarty_tpl) {?>
<!-- Block suppliers module -->
<div id="suppliers_block_left" class="block blocksupplier">
	<p class="title_block">
					<a href="http://localhost:8080/dostawcy" title="Dostawcy">
					Dostawcy
					</a>
			</p>
	<div class="block_content list-block">
								<ul>
											<li class="last_item">
                					<a 
					href="http://localhost:8080/1__fashion-supplier" 
					title="Więcej o Fashion Supplier">
				                Fashion Supplier
                					</a>
                				</li>
										</ul>
										<form action="/index.php" method="get">
					<div class="form-group selector1">
						<select class="form-control" name="supplier_list">
							<option value="0">Wszyscy dostawcy</option>
													<option value="http://localhost:8080/1__fashion-supplier">Fashion Supplier</option>
												</select>
					</div>
				</form>
						</div>
</div>
<!-- /Block suppliers module -->
<?php }} ?>
