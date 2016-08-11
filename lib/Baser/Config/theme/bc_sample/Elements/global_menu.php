<?php
/**
 * グローバルメニュー
 * 呼出箇所：全ページ
 *
 * BcBaserHelper::globalMenu() で呼び出す
 * （例）<?php $this->BcBaser->globalMenu() ?>
 */
if (Configure::read('BcRequest.isMaintenance')) {
	return;
}
$prefix = '';
if (Configure::read('BcRequest.agent')) {
	$prefix = '/' . Configure::read('BcRequest.agentAlias');
}
?>

<nav>
<ul class="global-menu nav-menu clearfix">
	<?php if (empty($menuType)) $menuType = '' ?>
	<?php $globalMenus = $this->BcContents->getTree() ?>
	<?php if (!empty($globalMenus)): ?>
		<?php foreach ($globalMenus as $key => $globalMenu): ?>
			<?php if ($globalMenu['Content']['status']): ?>

				<?php
				$no = sprintf('%02d', $key + 1);
				$classies = array('menu' . $no);
				if ($this->BcArray->first($globalMenus, $key)) {
					$classies[] = 'first';
				} elseif ($this->BcArray->last($globalMenus, $key)) {
					$classies[] = 'last';
				}
				if ($this->BcBaser->isCurrentUrl($globalMenu['Content']['url'])) {
					$classies[] = 'current';
				}
				$class = ' class="' . implode(' ', $classies) . '"';
				?>

				<?php if (!Configure::read('BcRequest.agent') && $this->base == '/index.php' && $globalMenu['Content']['url'] == '/'): ?>
					<?php /* PC版トップページ */ ?>
					<li<?php echo $class ?>>
						<?php echo str_replace('/index.php', '', $this->BcBaser->link($globalMenu['Content']['title'], $globalMenu['Content']['title'])) ?>
					</li>
				<?php else: ?>
					<li<?php echo $class ?>>
						<?php $this->BcBaser->link($globalMenu['Content']['title'], $prefix . $globalMenu['Content']['url']) ?>
					</li>
				<?php endif ?>
			<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>
</ul>
</nav>