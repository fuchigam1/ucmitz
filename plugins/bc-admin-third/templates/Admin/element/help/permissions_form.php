<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

/**
 * [ADMIN] アクセスルール一覧　ヘルプ
 *
 * @checked
 * @noTodo
 * @unitTest
 */
?>


<p><?php echo __d('baser', 'ユーザーグループごとのアクセスルールを登録します。') ?></p>
<ul>
  <li><?php echo __d('baser', 'ルールを何も追加しない状態では、全てのユーザーが全てのコンテンツにアクセスできるようになっています。') ?></li>
  <li><?php echo __d('baser', 'URL設定ではワイルドカード（*）を利用して一定のURL階層内のコンテンツに対し一度に設定を行う事ができます。') ?></li>
</ul>
<div class="example-box">
  <p class="head"><?php echo __d('baser', '（例）ページ管理全体を許可しない設定') ?></p>
  <p>　/admin/pages/*</p>
  <p class="head"><?php echo __d('baser', '（例）ブログコンテンツNo:2 の管理を許可しない設定') ?></p>
  <p>　/admin/blog/*/*/2</p>
</div>
