<?php
//======================================================================
// 部品：入力フォーム
//======================================================================
class appHttpTpadminAjaxCsEdit
{
    public static $dbResult = []; //DBから取得した値
}
appHttpTpadminAjaxCsEdit::$dbResult = appFuncCrmGet::tpadminCsAjax($_GET);
if (appHttpTpadminAjaxCsEdit::$dbResult[appDatabaseCs::primaryKey] != '') {
    /*分岐1：既存データ*/
    appConfigPage::$titleAdd = '（依頼者：' . appHttpTpadminAjaxCsEdit::$dbResult['client_name'] . '&nbsp;様）';
} else {
    /*分岐2：新規作成*/
    appConfigPage::$titleAdd = '（新規作成）';
}
