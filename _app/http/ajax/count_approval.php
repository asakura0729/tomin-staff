<?php
//======================================================================
// 部品：ログチェック
//======================================================================

class adminAjaxCount_approval
{
    public static $dbResultCsCount = 0; //DBから取得した対応ログの総数
}

adminAjaxCount_approval::$dbResultCsCount = appFuncCrmGet::count([
    'cs_category' => appConfigStatus::csCategoryLog,
    'approval_status' => appConfigStatus::approval_status['progress']['key']
]);
if (adminAjaxCount_approval::$dbResultCsCount > 99) {
    adminAjaxCount_approval::$dbResultCsCount = '99+';
}
