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
 * アクセスルール初期値
 */

return [
    'permission' => [

        /**
         * 管理画面
         */
        'ContentLinksAdmin' => [
            'title' => __d('baser', 'コンテンツリンク管理'),
            'plugin' => 'BcContentLink',
            'type' => 'Admin',
            'items' => [
                'Edit' => ['title' => __d('baser', '編集'), 'url' => '/baser/admin/bc-content-link/content_links/edit/*', 'method' => 'POST', 'auth' => true],
            ]
        ],

        /**
         * Web API
         */
        'ContentLinksApi' => [
            'title' => __d('baser', 'コンテンツリンクAPI'),
            'plugin' => 'BcContentLink',
            'type' => 'Api',
            'items' => [
                'Add' => ['title' => __d('baser', '新規登録'), 'url' => '/baser/api/bc-content-link/content_links/add.json', 'method' => 'POST', 'auth' => true],
                'Delete' => ['title' => __d('baser', '削除'), 'url' => '/baser/api/bc-content-link/content_links/delete/*.json', 'method' => 'POST', 'auth' => true],
                'Edit' => ['title' => __d('baser', '編集'), 'url' => '/baser/api/bc-content-link/content_links/edit/*.json', 'method' => 'POST', 'auth' => true],
                'View' => ['title' => __d('baser', '単一取得'), 'url' => '/baser/api/bc-content-link/content_links/view/*.json', 'method' => 'GET', 'auth' => true],
            ]
        ],
    ]
];

