<?php
//======================================================================
// 部品：入力フォーム
//======================================================================
class appHttpAjaxCsEdit
{
    public static $dbResult = []; //DBから取得した値
}
appHttpAjaxCsEdit::$dbResult = appFuncCrmGet::tpadminCsAjax($_GET);
if (appHttpAjaxCsEdit::$dbResult[appDatabaseCs::primaryKey] != '') {
    /*分岐1：既存データ*/
    appConfigPage::$titleAdd = '（依頼者：' . appHttpAjaxCsEdit::$dbResult['client_name'] . '&nbsp;様）';
} else {
    /*分岐2：新規作成*/
    appConfigPage::$titleAdd = '（新規作成）';
}
