<?php 
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxReportcs
{
    public static $result = [];
}

appHttpTpAdminCrmAjaxReportcs::$result = appLibraryCrm::getReport(appDatabaseReport::categoryCs, appDatabaseReport::tableCs);
