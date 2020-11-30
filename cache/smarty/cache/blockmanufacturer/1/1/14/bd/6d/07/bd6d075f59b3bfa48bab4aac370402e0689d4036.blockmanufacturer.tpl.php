<?php /*%%SmartyHeaderCode:14442159745fc56920b13e11-86690264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd6d075f59b3bfa48bab4aac370402e0689d4036' => 
    array (
      0 => '/var/www/html/themes/default-bootstrap/modules/blockmanufacturer/blockmanufacturer.tpl',
      1 => 1606760765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14442159745fc56920b13e11-86690264',
  'variables' => 
  array (
    'display_link_manufacturer' => 0,
    'link' => 0,
    'manufacturers' => 0,
    'text_list' => 0,
    'text_list_nb' => 0,
    'manufacturer' => 0,
    'form_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5fc56920c310b4_44628633',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fc56920c310b4_44628633')) {function content_5fc56920c310b4_44628633($_smarty_tpl) {?>
<!-- Block manufacturers module -->
<div id="manufacturers_block_left" class="block blockmanufacturer">
	<p class="title_block">
					<a href="http://localhost:8080/producenci" title="Producenci">
						Producenci
					</a>
			</p>
	<div class="block_content list-block">
								<ul>
														<li class="last_item">
						<a 
						href="http://localhost:8080/1_fashion-manufacturer" title="Około Fashion Manufacturer">
							Fashion Manufacturer
						</a>
					</li>
												</ul>
										<form action="/index.php" method="get">
					<div class="form-group selector1">
						<select class="form-control" name="manufacturer_list">
							<option value="0">Wszyscy producenci</option>
													<option value="http://localhost:8080/1_fashion-manufacturer">Fashion Manufacturer</option>
												</select>
					</div>
				</form>
						</div>
</div>
<!-- /Block manufacturers module -->
<?php }} ?>
