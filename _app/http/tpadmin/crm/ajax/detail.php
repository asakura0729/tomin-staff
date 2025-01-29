<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxDetail
{
    public static $resultFuneral = [];
    public static $resultClient = [];
    public static $resultReportCs = [];
    public static $resultReportTel = [];
}

appHttpTpAdminCrmAjaxDetail::$resultFuneral = appLibraryCrm::getFuneralDetail();
appHttpTpAdminCrmAjaxDetail::$resultClient = appLibraryCrm::getClientData();
appHttpTpAdminCrmAjaxDetail::$resultReportCs = appLibraryCrm::getReport(appDatabaseReport::categoryCs, appDatabaseReport::tableCs);
appHttpTpAdminCrmAjaxDetail::$resultReportTel = appLibraryCrm::getReport(appDatabaseReport::categoryTel, appDatabaseReport::tableTel);
