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
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::getFuneralId();
        break;
    case appLibraryCrm::confirmFuneralData:
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateFuneralData();
        break;
    case appLibraryCrm::confirmFuneralClientData:
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateFuneralClientData();
        break;
    case appLibraryCrm::confirmReport:
        appHttpTpAdminCrmConfirm::$result = appLibraryCrm::updateReport();
        break;
}
