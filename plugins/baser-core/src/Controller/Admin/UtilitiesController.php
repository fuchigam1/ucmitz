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

namespace BaserCore\Controller\Admin;

use BaserCore\Error\BcException;
use BaserCore\Service\Admin\UtilitiesAdminServiceInterface;
use BaserCore\Service\UtilitiesServiceInterface;
use BaserCore\Utility\BcUtil;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;

/**
 * Class UtilitiesController
 */
class UtilitiesController extends BcAdminAppController
{

    /**
     * initialize
     * @return void
     * @checked
     * @noTodo
     * @unitTest
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['credit']);
    }

    /**
     * サーバーキャッシュを削除する
     * @checked
     * @unitTest
     * @noTodo
     */
    public function clear_cache()
    {
        $this->_checkReferer();
        BcUtil::clearAllCache();
        $this->BcMessage->setInfo(__d('baser', 'サーバーキャッシュを削除しました。'));
        $this->redirect($this->referer());
    }

    /**
     * ユーティリティトップ
     * @checked
     * @noTodo
     * @unitTest
     */
    public function index()
    {
    }

    /**
     * 環境情報を表示する
     *
     * @param UtilitiesAdminServiceInterface $service
     * @checked
     * @noTodo
     * @unitTest
     */
    public function info(UtilitiesAdminServiceInterface $service)
    {
        $this->set($service->getViewVarsForInfo());
    }

    /**
     * phpinfo を表示する
     * 環境情報の表示から iframe で読み込まれる
     * @checked
     * @unitTest
     * @uses phpinfo
     */
    public function phpinfo()
    {
        $this->_checkReferer();
        $this->autoRender = false;
        phpinfo();
        exit();
    }

    /**
     * データメンテナンス
     *
     * @param UtilitiesServiceInterface $service
     * @param string $mode
     * @noTodo
     * @checked
     * @unitTest
     */
    public function maintenance(UtilitiesServiceInterface $service, string $mode = '')
    {
        $this->_checkReferer();
        switch($mode) {
            case 'backup':
                $this->autoRender = false;
                $result = $service->backupDb($this->request->getQuery('backup_encoding'));
                $result->download('baserbackup_' . str_replace(' ', '_', BcUtil::getVersion()) . '_' . date('Ymd_His'));
                $service->resetTmpSchemaFolder();
                return;
            case 'restore':
                $this->request->allowMethod(['post']);
                try {
                    $service->restoreDb($this->getRequest()->getData(), $this->getRequest()->getUploadedFiles());
                    $this->BcMessage->setInfo(__d('baser', 'データの復元が完了しました。'));
                } catch (BcException $e) {
                    $this->BcMessage->setError(__d('baser', 'データの復元に失敗しました。ログの確認を行なって下さい。') . $e->getMessage());
                }
                $this->redirect(['action' => 'maintenance']);
        }
    }

    /**
     * ログメンテナンス
     *
     * @param UtilitiesAdminServiceInterface $service
     * @param string $mode
     * @uses log_maintenance
     * @checked
     * @noTodo
     * @unitTest
     */
    public function log_maintenance(UtilitiesAdminServiceInterface $service, string $mode = '')
    {
        switch($mode) {
            case 'download':
                $this->autoRender = false;
                $result = $service->createLogZip();
                if ($result) {
                    $result->download('basercms_logs_' . date('Ymd_His'));
                    return;
                }
                $this->BcMessage->setInfo('エラーログが存在しません。');
                $this->redirect(['action' => 'log_maintenance']);
                break;
            case 'delete':
                $this->request->allowMethod(['post']);
                try {
                    $service->deleteLog();
                    $this->BcMessage->setInfo(__d('baser', 'エラーログを削除しました。'));
                } catch (BcException $e) {
                    $this->BcMessage->setError($e->getMessage());
                }
                $this->redirect(['action' => 'log_maintenance']);
                break;
        }
        $this->set($service->getViewVarsForLogMaintenance());
    }

    /**
     * コンテンツ管理のツリー構造をリセットする
     * @param UtilitiesServiceInterface $service
     * @checked
     * @noTodo
     * @unitTest
     * @uses reset_contents_tree
     */
    public function reset_contents_tree(UtilitiesServiceInterface $service)
    {
        $this->request->allowMethod(['post']);
        if ($service->resetContentsTree()) {
            $this->BcMessage->setSuccess(__d('baser', 'コンテンツのツリー構造をリセットしました。'));
        } else {
            $this->BcMessage->setError(__d('baser', 'コンテンツのツリー構造のリセットに失敗しました。'));
        }
        $this->redirect(['action' => 'index']);
    }

    /**
     * コンテンツ管理のツリー構造のチェックを行う
     *
     * 問題がある場合にはログを出力する
     * @param UtilitiesServiceInterface $service
     * @uses verity_contents_tree
     * @checked
     * @noTodo
     * @unitTest
     */
    public function verity_contents_tree(UtilitiesServiceInterface $service)
    {
        $this->request->allowMethod(['post']);
        if (!$service->verityContentsTree()) {
            $this->BcMessage->setError(__d('baser', 'コンテンツのツリー構造に問題があります。ログを確認してください。'));
        } else {
            $this->BcMessage->setSuccess(__d('baser', 'コンテンツのツリー構造に問題はありません。'), false);
        }
        $this->redirect(['action' => 'index']);
    }

    /**
     * クレジット表示用データをレンダリング
     * @param UtilitiesServiceInterface $service
     * @checked
     * @noTodo
     * @unitTest
     */
    public function credit(UtilitiesServiceInterface $service)
    {
        $this->viewBuilder()->disableAutoLayout();
        try {
            $this->set('credits', $service->getCredit());
        } catch (BcException $e) {
            $this->setResponse($this->response->withStatus(400)->withStringBody($e->getMessage()));
        }
    }

    /**
     * コアの初期データを読み込む
     *
     * @param UtilitiesServiceInterface $service
     * @return void
     * @checked
     * @noTodo
     * @unitTest
     */
    public function reset_data(UtilitiesServiceInterface $service)
    {
        $this->request->allowMethod(['post']);
        try {
            if ($service->resetData()) {
                $this->BcMessage->setInfo(__d('baser', 'データのリセットがが完了しました。'));
            } else {
                $this->BcMessage->setError(__d('baser', 'データのリセットが完了しましたが、いくつかの処理に失敗しています。ログを確認してください。'));
            }
        } catch (BcException $e) {
            $this->BcMessage->setError(__d('baser', 'データのリセットに失敗しました。' . $e->getMessage()));
        }
        $this->redirect(['action' => 'maintenance']);
    }

}
