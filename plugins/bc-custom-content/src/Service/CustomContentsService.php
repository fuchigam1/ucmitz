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

namespace BcCustomContent\Service;

use BaserCore\Error\BcException;
use BaserCore\Utility\BcContainerTrait;
use BaserCore\Utility\BcUtil;
use BcCustomContent\Model\Table\CustomContentsTable;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\EntityInterface;
use Cake\Filesystem\Folder;
use Cake\ORM\TableRegistry;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;

/**
 * CustomContentsService
 *
 * @property CustomContentsTable $CustomContents
 */
class CustomContentsService implements CustomContentsServiceInterface
{

    /**
     * Trait
     */
    use BcContainerTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CustomContents = TableRegistry::getTableLocator()->get('BcCustomContent.CustomContents');
    }

    /**
     * カスタムコンテンツの単一データ取得する
     *
     * @param int $id
     * @return EntityInterface
     */
    public function get(int $id, array $options = [])
    {
        $options = array_merge([
            'status' => ''
        ], $options);
        $conditions = [];
        if ($options['status'] === 'publish') {
            $conditions = $this->CustomContents->Contents->getConditionAllowPublish();
        }
        return $this->CustomContents->get($id, [
            'contain' => ['Contents' => ['Sites']],
            'conditions' => $conditions
        ]);
    }

    /**
     * カスタムコンテンツの初期値となるエンティティを取得する
     *
     * @return EntityInterface
     */
    public function getNew(): EntityInterface
    {
        return $this->CustomContents->newEntity([
            'list_count' => 10,
            'list_order' => 'id',
            'list_direction' => 'DESC',
            'template' => 'default',
        ]);
    }

    /**
     * カスタムコンテンツを登録する
     *
     * @param array $postData
     * @param array $options
     * @return \Cake\Datasource\EntityInterface
     * @throws \Cake\ORM\Exception\PersistenceFailedException
     * @checked
     * @noTodo
     */
    public function create(array $postData, $options = []): ?EntityInterface
    {
        $entity = $this->CustomContents->patchEntity(
            $this->getNew(),
            $postData,
            $options
        );
        return $this->CustomContents->saveOrFail($entity);
    }

    /**
     * カスタムコンテンツを更新する
     *
     * @param EntityInterface $entity
     * @param array $pageData
     * @param array $options
     * @return EntityInterface
     * @throws \Cake\ORM\Exception\PersistenceFailedException
     * @checked
     * @noTodo
     */
    public function update(EntityInterface $entity, array $pageData, $options = []): ?EntityInterface
    {
        if (BcUtil::isOverPostSize()) {
            throw new BcException(__d('baser', '送信できるデータ量を超えています。合計で %s 以内のデータを送信してください。', ini_get('post_max_size')));
        }
        $entity = $this->CustomContents->patchEntity($entity, $pageData, $options);
        return $this->CustomContents->saveOrFail($entity);
    }

    /**
     * カスタムコンテンツに関連するコントロールのソースを取得する
     *
     * @param string $field
     * @return array
     */
    public function getControlSource(string $field, array $options = []): array
    {
        switch($field) {
            case 'custom_table_id':
                // コンテンツタイプのみ取得
                return $this->getService(CustomTablesServiceInterface::class)->getList(['type' => 1]);

            case 'list_order':
                if(!isset($options['custom_table_id'])) {
                    throw new BcException(__d('baser', 'list_order のコントロールソースを取得する場合は、custom_table_id の指定が必要です。'));
                }
                return $this->getListOrders($options['custom_table_id']);
            case 'template':
                if(!isset($options['site_id'])) {
                    throw new BcException(__d('baser', 'template のコントロールソースを取得する場合は、site_id の指定が必要です。'));
                }
                return $this->getTemplates($options['site_id']);
        }
        return [];
    }

    /**
     * 並び順フィールドのリストを取得
     *
     * @param int $tableId
     * @return string[]
     */
    public function getListOrders(int $tableId): array
    {
        $list = ['id' => 'No', 'created' => '登録日', '編集日'];
        if(!$tableId) return $list;
        $table = $this->CustomContents->CustomTables->get($tableId, ['contain' => [
            'CustomLinks' => ['CustomFields']
        ]]);
        if($table->custom_links) {
            foreach($table->custom_links as $customLink) {
                if($customLink->custom_field->status && $customLink->custom_field->type !== 'group') {
                    $list[$customLink->name] = $customLink->title;
                }
            }
        }
        return $list;
    }

    /**
     * テンプレートのリストを取得
     *
     * @param int $siteId
     * @return array
     */
    public function getTemplates(int $siteId): array
    {
        $sites = TableRegistry::getTableLocator()->get('BaserCore.Sites');
        $site = $sites->get($siteId);

        $templatesPaths = array_merge(
            [Plugin::templatePath($site->theme) . 'plugin' . DS . 'BcCustomContent' . DS],
            App::path('templates'),
            [Plugin::templatePath(Configure::read('BcApp.defaultFrontTheme')) . 'plugin' . DS . 'BcCustomContent' . DS],
            [Plugin::templatePath('BcCustomContent')]
        );

        $templates = [];
        foreach($templatesPaths as $templatePath) {
            $templatePath .= 'CustomContent' . DS;
            $folder = new Folder($templatePath);
            $files = $folder->read(true, true);
            if ($files[0]) {
                if ($templates) {
                    $templates = array_merge($templates, $files[0]);
                } else {
                    $templates = $files[0];
                }
            }
        }
        return array_combine($templates, $templates);
    }

    /**
     * 関連づいたカスタムテーブルを除外する
     *
     * 全てのカスタムコンテンツを対象とする
     *
     * @param int $tableId
     */
    public function unsetTable(int $tableId): void
    {
        $entities = $this->CustomContents->find()->where(['custom_table_id' => $tableId])->all();
        if(!$entities->count()) return;
        foreach($entities as $entity) {
            $entity->custom_table_id = null;
            $this->CustomContents->save($entity);
        }
    }

}
