<?php
/**
 * ブログ記事詳細ページ（スマホ版）
 * 呼出箇所：ブログ記事詳細ページ
 */
$this->BcBaser->setDescription($this->Blog->getTitle() . '｜' . $this->Blog->getPostContent($post, false, false, 50));
$this->Blog->editPost($post['BlogPost']['blog_content_id'], $post['BlogPost']['id']);
?>


<h2><?php $this->Blog->title() ?></h2>

<h3><?php $this->BcBaser->contentsTitle() ?></h3>

<div class="detail-eye-catch">
	<?php $this->Blog->eyeCatch($post, array('link' => false, 'width' => 280)) ?>
</div>

<article class="post">
	<?php $this->Blog->postContent($post) ?>
	<div class="meta">
		<?php $this->Blog->category($post) ?>
		&nbsp;
		<?php $this->Blog->postDate($post) ?>
		&nbsp;
		<?php $this->Blog->author($post) ?>
		<?php $this->BcBaser->element('blog_tag', array('post' => $post)) ?>
	</div>
</article>

<div id="ContentsNavi">
	<?php $this->Blog->prevLink($post) ?>
	&nbsp;｜&nbsp;
	<?php $this->Blog->nextLink($post) ?>
</div>

<!-- /Elements/blog_related_posts.php -->
<?php $this->BcBaser->element('blog_related_posts') ?>

<!-- /Elements/blog_comennts.php -->
<?php $this->BcBaser->element('blog_comments') ?>
