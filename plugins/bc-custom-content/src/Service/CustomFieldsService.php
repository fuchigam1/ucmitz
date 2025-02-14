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

use BaserCore\Utility\BcContainerTrait;
use BcCustomContent\Model\Table\CustomEntriesTable;
use BcCustomContent\Model\Table\CustomFieldsTable;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;

/**
 * CustomFieldsService
 *
 * @property CustomFieldsTable $CustomFields
 * @property CustomEntriesTable $CustomEntries
 */
class CustomFieldsService implements CustomFieldsServiceInterface
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
        $this->CustomFields = TableRegistry::getTableLocator()->get('BcCustomContent.CustomFields');
        $this->CustomEntries = TableRegistry::getTableLocator()->get('BcCustomContent.CustomEntries');
    }

    /**
     * カスタムフィールドの初期値となるエンティティを取得する
     *
     * @return EntityInterface
     */
    public function getNew()
    {
        return $this->CustomFields->newEntity([
            'status' => true,
            'placeholder' => '',
            'type' => 'BcCcText',
            'source' => '',
            'auto_convert' => ''
        ]);
    }

    /**
     * カスタムフィールドの単一データを取得する
     *
     * @param int $id
     * @return EntityInterface
     */
    public function get(int $id, array $options = [])
    {
        return $this->CustomFields->get($id, $options);
    }

    /**
     * カスタムフィールドの一覧データを取得する
     *
     * @param array $queryParams
     * @return \Cake\ORM\Query
     */
    public function getIndex(array $queryParams = [])
    {
        $options = array_merge([
            'status' => null
        ], $queryParams);
        $conditions = [];
        if(!is_null($options['status'])) $conditions = ['CustomFields.status' => $options['status']];
        return $this->CustomFields->find()->where($conditions);
    }

    /**
     * カスタムフィールドを新規登録する
     *
     * @param array $postData
     * @return EntityInterface
     */
    public function create(array $postData)
    {
        $entity = $this->CustomFields->patchEntity($this->CustomFields->newEmptyEntity(), $postData);
        return $this->CustomFields->saveOrFail($entity);
    }

    /**
     * カスタムフィールドを編集する
     *
     * @param EntityInterface $entity
     * @param array $postData
     * @return EntityInterface
     */
    public function update(EntityInterface $entity, array $postData)
    {
        $entity = $this->CustomFields->patchEntity($entity, $postData);
        return $this->CustomFields->saveOrFail($entity);
    }

    /**
     * カスタムフィールドを削除する
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        // エントリーのDBフィールドも削除するためサービスを使って削除
        /** @var CustomLinksServiceInterface $customEntriesService */
        $customLinksService = $this->getService(CustomLinksServiceInterface::class);
        $entity = $this->get($id, ['contain' => ['CustomLinks']]);
        if ($entity->custom_links) {
            foreach($entity->custom_links as $field) {
                $customLinksService->delete($field->id);
            }
        }
        return $this->CustomFields->delete($entity);
    }

    /**
     * カスタムフィールドのリストを取得する
     *
     * @return array
     */
    public function getList()
    {
        return $this->CustomFields->find('list')->toArray();
    }

    /**
     * フィールドタイプのリストを取得する
     *
     * @return array
     */
    public function getFieldTypes(): array
    {
        $categories = Configure::read('BcCustomContent.fieldCategories');
        $types = Configure::read('BcCustomContent.fieldTypes');
        $fieldTypes = [];
        foreach($categories as $category) {
            foreach($types as $key => $type) {
                if ($type['category'] === $category) {
                    $fieldTypes[$category][$key] = $type['label'];
                }
            }
        }
        return $fieldTypes;
    }

    /**
     * コントロールソースを取得する
     *
     * @param string $field
     * @return array
     */
    public function getControlSource(string $field): array
    {
        if ($field === 'field_type') {
            return $this->getFieldTypes();
        } elseif ($field === 'validate') {
            return [
                'EMAIL' => __d('baser', 'Eメール形式チェック'),
                'EMAIL_CONFIRM' => __d('baser', 'Eメール比較チェック'),
                'NUMBER' => __d('baser', '数値チェック'),
                'HANKAKU' => __d('baser', '半角英数チェック'),
                'ZENKAKU_KATAKANA' => __d('baser', '全角カタカナチェック'),
                'ZENKAKU_HIRAGANA' => __d('baser', '全角ひらがなチェック'),
                'DATETIME' => __d('baser', '日付チェック'),
                'MAX_FILE_SIZE' => __d('baser', 'ファイルアップロードサイズ制限'),
                'FILE_EXT' => __d('baser', 'ファイル拡張子チェック'),
            ];
        } elseif ($field === 'auto_convert') {
            return [
                'CONVERT_HANKAKU' => __d('baser', '半角変換'),
                'CONVERT_ZENKAKU' => __d('baser', '全角変換'),
            ];
        }
        return [];
    }

}
