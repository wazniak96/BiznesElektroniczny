{*
*
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Dotpay Team <tech@dotpay.pl>
*  @copyright Dotpay
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
*}

{capture name=path}
    <a href="{$link->getPageLink('my-account', true, null)}" title="{l s='My account' mod='dotpay'}">
        {l s='My account' mod='dotpay'}
    </a>
    <span class="navigation-pipe"></span>
    {l s='Saved credit cards' mod='dotpay'}
{/capture}

<h2 class="page-heading">{l s='Manage your saved credit cards' mod='dotpay'}</h2>

{if isset($cards)}
<p class="alert alert-success">{l s='Below is a list of your credit cards registered in this shop. Data identifying these cards are stored in a secure manner in Dotpay. This allows you to make payments with one click. At any time, you can deregister their cards.' mod='dotpay'}</p>
<table id="credit-cards-list">
    <tr class="ocheader">
        <th>{l s='Logo' mod='dotpay'}</th>
        <th>{l s='Card brand' mod='dotpay'}</th>
        <th>{l s='Card number' mod='dotpay'}</th>
        <th>{l s='Register date' mod='dotpay'}</th>
        <th>{l s='Delete' mod='dotpay'}</th>
    </tr>
    {foreach from=$cards item=card}
    <tr> 
        <td><img class="dotpay-card-brand-logo" src="{$card->card_brand->image}" /></td>
        <td>{$card->brand|escape:'htmlall':'UTF-8'}</td>
        <td class="dotpay-card-mask">{$card->mask|escape:'htmlall':'UTF-8'}</td>
        <td>{$card->register_date|escape:'htmlall':'UTF-8'}</td>
        <td>
            <button data-id="{$card->id|escape:'htmlall':'UTF-8'}" class="card-remove" title="{l s='Deregister card' mod='dotpay'}">
                <span class="icon-remove"></span>
            </button>
        </td>
    </tr>
    {/foreach}
</table>
{else}
    <p class="alert alert-danger">{l s='You have not saved any card.' mod='dotpay'}</p>
{/if}
<script type="text/javascript">
{literal}
    var onRemoveMessage = '{/literal}{$onRemoveMessage}{literal}';
    var onDoneMessage = '{/literal}{$onDoneMessage}{literal}';
    var onFailureMessage = '{/literal}{$onFailureMessage}{literal}';
    var removeUrl = '{/literal}{$removeUrl}{literal}';
{/literal}
</script>
{include file='./scripts/noConflict.tpl'}
{include file='./scripts/ocmanage.tpl'}