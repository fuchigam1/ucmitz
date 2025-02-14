<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link			https://basercms.net baserCMS Project
 * @package         Baser.View
 * @since           baserCMS v 4.4.0
 * @license         https://basercms.net/license/index.html
 */

use BaserCore\View\AppView;

/**
 * ヘッダー
 *
 * BcBaserHelper::header() で呼び出す
 * （例）<?php $this->BcBaser->header() ?>
 *
 * @var AppView $this
 */
$isSmartphone = $this->getRequest()->is('smartphone');
?>


<header class="bs-header">
	<div class="bs-header__inner">
		<?php $this->BcBaser->logo(['class' => 'bs-header__logo']) ?>
	</div>

	<div class="bs-header__menu-button" id="BsMenuBtn">
		<span></span>
		<span></span>
		<span></span>
	</div>

	<nav class="bs-header__nav<?php echo ($isSmartphone)? '' : ' use-mega-menu' ?>" id="BsMenuContent">
		<!-- /Elements/global_menu.php -->
		<?php if(\BaserCore\Utility\BcUtil::isInstalled()): ?>
		<?php $this->BcBaser->globalMenu(2) ?>
		<?php endif ?>
	</nav>

</header>
