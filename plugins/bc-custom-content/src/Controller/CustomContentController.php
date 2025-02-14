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

namespace BcCustomContent\Controller;

use BaserCore\Controller\BcFrontAppController;
use BcCustomContent\Service\Front\CustomContentFrontServiceInterface;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;

/**
 * CustomContentController
 */
class CustomContentController extends BcFrontAppController
{

    /**
     * initialize
     *
     * コンポーネントをロードする
     *
     * @return void
     * @checked
     * @noTodo
     * @unitTest
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BaserCore.BcFrontContents', ['viewContentCrumb' => true]);
    }

    /**
     * カスタムエントリーの一覧ページを表示する
     *
     * @param CustomContentFrontServiceInterface $service
     * @return \Cake\Http\Response
     */
    public function index(CustomContentFrontServiceInterface $service)
    {
        $customContent = $service->getCustomContent(
            (int)$this->getRequest()->getAttribute('currentContent')->entity_id
        );

        if(!$customContent->custom_table_id) {
            $this->BcMessage->setWarning(__d('baser', 'カスタムコンテンツにカスタムテーブルが紐付けられていません。カスタムコンテンツの編集画面よりカスタムテーブルを選択してください。'));
            $this->notFound();
        }

        $this->set($service->getViewVarsForIndex(
            $customContent,
            $this->paginate($service->getCustomEntries($customContent, $this->getRequest()->getQueryParams()))
        ));
        $this->setRequest($this->getRequest()->withParsedBody($this->getRequest()->getQueryParams()));
        $this->render($service->getIndexTemplate($customContent));
    }

    /**
     * カスタムエントリーの詳細ページを表示する
     *
     * @param CustomContentFrontServiceInterface $service
     * @return \Cake\Http\Response
     */
    public function view(CustomContentFrontServiceInterface $service, $entryId)
    {
        if(!$this->getRequest()->getAttribute('currentContent')->entity_id) {
            $this->BcMessage->setWarning(__d('baser', 'カスタムコンテンツにカスタムテーブルが紐付けられていません。カスタムコンテンツの編集画面よりカスタムテーブルを選択してください。'));
            $this->notFound();
        }
        $customContent = $service->getCustomContent(
            (int)$this->getRequest()->getAttribute('currentContent')->entity_id
        );

        if(!$customContent->custom_table_id) {
            $this->BcMessage->setWarning(__d('baser', 'カスタムコンテンツにカスタムテーブルが紐付けられていません。カスタムコンテンツの編集画面よりカスタムテーブルを選択してください。'));
            $this->notFound();
        }

        $this->set($service->getViewVarsForView(
            $customContent,
            $entryId
        ));

        $this->render($service->getViewTemplate($customContent));
    }

}
