<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxDetail
{
    public static $resultFuneral = []; //葬儀情報
    public static $resultClient = []; //顧客情報
    public static $resultReportCs = []; //顧客情報
    public static $resultReportTel = [];
}

appHttpTpAdminCrmAjaxDetail::$resultFuneral = appLibraryCrm::getFuneralDetail();
appHttpTpAdminCrmAjaxDetail::$resultClient = appLibraryCrm::getClientData();
appHttpTpAdminCrmAjaxDetail::$resultReportCs = appLibraryCrm::getCsReportLatest();
appHttpTpAdminCrmAjaxDetail::$resultReportTel = appLibraryCrm::getReport(appDatabaseReport::categoryTel, appDatabaseReport::tableTel);
