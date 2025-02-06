<?php
require_once '../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxLog
{
    public static $reportId;
    public static $result = [];
}

appHttpTpAdminCrmAjaxLog::$reportId = appLibraryCrm::getReportId();
appHttpTpAdminCrmAjaxLog::$result = appLibraryCrm::getReport(appDatabaseReport::categoryCs, appDatabaseReport::tableCs, ['report_id' => appHttpTpAdminCrmAjaxLog::$reportId]);
