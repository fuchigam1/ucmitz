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

/**
 * ブログアーカイブ一覧
 * 呼出箇所：カテゴリ別ブログ記事一覧、タグ別ブログ記事一覧、年別ブログ記事一覧、月別ブログ記事一覧、日別ブログ記事一覧
 *
 * @var \BaserCore\View\BcFrontAppView $this
 * @var \BcBlog\Model\Entity\BlogCategory $blogCategory
 * @var \BcBlog\Model\Entity\BlogTag $blogTag
 * @var \BaserCore\Model\Entity\User $author
 * @var \Cake\ORM\ResultSet $posts
 * @var string $blogArchiveType
 * @var string $year
 * @var string $month
 * @var string $day
 * @checked
 * @noTodo
 * @unitTest
 */
$title = '';
if($blogArchiveType === 'category') $title = $blogCategory->title;
if($blogArchiveType === 'author') $title = $author->getDisplayName();
if($blogArchiveType === 'tag') $title = rawurldecode($blogTag->name);
if($blogArchiveType === 'daily') $title = sprintf(__('%s年%s月%s日'), $year, $month, $day);
if($blogArchiveType === 'monthly') $title = sprintf(__('%s年%s月'), $year, $month);
if($blogArchiveType === 'yearly') $title = sprintf(__('%s年'), $year);
$this->BcBaser->setTitle($title);
$this->BcBaser->setDescription($this->Blog->getTitle() . '｜' . $this->BcBaser->getContentsTitle() . __('のアーカイブ一覧です。'));
$this->BcUpload->setTable('BcBlog.BlogPosts');
?>


<h2 class="bs-blog-title"><?php echo h($this->Blog->getTitle()) ?></h2>

<h3 class="bs-blog-category-title"><?php $this->BcBaser->contentsTitle() ?></h3>

<section class="bs-blog-post">
<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $post): ?>
	<article class="bs-blog-post__item clearfix">
		<?php if(!empty($post->eye_catch)): ?>
		<a href="<?php echo $this->Blog->getPostLinkUrl($post) ?>" class="bs-blog-post__item-eye-catch">
			<?php $this->Blog->eyeCatch($post, ['width' => 150, 'link' => false]) ?>
		</a>
		<?php endif ?>
		<span class="bs-blog-post__item-date"><?php $this->Blog->postDate($post, 'Y.m.d') ?></span>
		<?php $this->Blog->category($post, ['class' => 'bs-blog-post__item-category']) ?>
		<span class="bs-blog-post__item-title"><?php $this->Blog->postTitle($post) ?></span>
		<?php if(strip_tags($post->content . $post->detail)): ?>
		<div class="bs-top-post__item-detail"><?php $this->Blog->postContent($post, true, false, 46) ?>...</div>
		<?php endif ?>
	</article>
	<?php endforeach; ?>
<?php else: ?>
<p class="bs-blog-no-data"><?php echo __('記事がありません。'); ?></p>
<?php endif ?>
</section>

<!-- /Elements/paginations/simple.php -->
<?php $this->BcBaser->pagination('simple'); ?>
