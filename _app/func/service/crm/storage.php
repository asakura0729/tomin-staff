<?php
//======================================================================
// CRM＞ストレージファイル作成
//======================================================================
class appFuncCrmStorage
{
    //-----------------------------------------------------
    // キャッシュ生成するか否か
    //-----------------------------------------------------
    public static function cacheFlg(): bool
    {
        if (appConfigSite::cache === true) {
            /*分岐：キャッシュの設定有効*/
            if (count($_GET) > 0) {
                /*分岐：GETパラメータあり*/
                return false;
            } else {
                /*分岐：GETパラメータなし*/
                return true;
            }
        } else {
            /*分岐：キャッシュの設定無効*/
            return false;
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
