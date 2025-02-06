<?php
require_once '../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxDetail
{
    public static $funeralId = "";
    public static $resultFuneral = []; //葬儀情報
    public static $resultClient = []; //顧客情報
    public static $resultReportCs = []; //顧客情報
    public static $resultReportTel = []; //架電情報
}

appHttpTpAdminCrmAjaxDetail::$funeralId = appLibraryCrm::getFuneralId();
appHttpTpAdminCrmAjaxDetail::$resultFuneral = appLibraryCrm::getFuneralDetail(['funeral_id' => appHttpTpAdminCrmAjaxDetail::$funeralId]);
appHttpTpAdminCrmAjaxDetail::$resultReportCs = appLibraryCrm::getCsReportDetail(['funeral_id' => appHttpTpAdminCrmAjaxDetail::$funeralId]);
if (appHttpTpAdminCrmAjaxDetail::$funeralId != '') {
    appHttpTpAdminCrmAjaxDetail::$resultClient = appLibraryCrm::getClientData(['funeral_id' => appHttpTpAdminCrmAjaxDetail::$funeralId]);
    appHttpTpAdminCrmAjaxDetail::$resultReportTel = appLibraryCrm::getReport(
        appDatabaseReport::categoryTel,
        appDatabaseReport::tableTel,
        ['funeral_id' => appHttpTpAdminCrmAjaxDetail::$funeralId]
    );
}