<?php
//======================================================================
// CRM＞ストレージファイル作成
//======================================================================
class appFuncCrmStorage
{
    //-----------------------------------------------------
    // 対応ログストレージ保存（開始）
    //-----------------------------------------------------
    public static function start()
    {
        if (count($_GET) <= 0) {
            /*分岐:新規作成*/
            appFuncStorage::start();
        }
    }
    //-----------------------------------------------------
    // 対応ログストレージ保存（終了）
    //-----------------------------------------------------
    public static function end($minify = false)
    {
        if (count($_GET) <= 0) {
            /*分岐:新規作成*/
            appFuncStorage::end($minify);
        }
    }
    //-----------------------------------------------------
    // ファイル作成
    //-----------------------------------------------------
    public static function createCountFile($postPrimaryKey, $asynPath, $csCategory)
    {
        if ($postPrimaryKey != '') {
            /*分岐：DB送信あり*/
            $countApproval = appFuncCrmGet::countApproval($csCategory);
            if ($countApproval === 0) {
                /*分岐：データ総数0*/
                $countApproval = '';
            } elseif ($countApproval > 99) {
                /*分岐：データ総数99以上*/
                $countApproval = '99+';
            }
            appFuncEditFile::createFile(
                appFuncStorage::createPath($asynPath),
                $countApproval
            );
        }
    }
}
