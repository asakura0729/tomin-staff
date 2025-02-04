<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmConfirm
{
    public static $postConfirm = "";
    public static $result = [];
}

appHttpTpAdminCrmConfirm::$postConfirm = appFuncArray::issetKey($_POST, appLibraryCrm::postConfirm, '');
switch (appHttpTpAdminCrmConfirm::$postConfirm) {
    case appLibraryCrm::confirmFuneralId:
        /*分岐：葬儀ID取得*/
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::postFuneralId();
        break;
    case appLibraryCrm::confirmFuneralData:
        /*分岐：葬儀情報送信*/
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateFuneralData();
        break;
    case appLibraryCrm::confirmFuneralClientData:
        /*分岐：葬儀顧客情報送信*/
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateFuneralClientData();
        break;
    case appLibraryCrm::confirmContainerCs:
        /*分岐：コンテナ（顧客対応）+レポート（顧客対応）送信*/
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateContainerCs();
        break;
    case appLibraryCrm::confirmReport:
        /*分岐：レポート送信*/
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateReports();
        break;
}
