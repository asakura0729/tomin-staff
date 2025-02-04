<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxReportcs
{
    public static $funeralId = ""; //葬儀ID
    public static $result = []; //レポート一覧
}

appHttpTpAdminCrmAjaxReportcs::$funeralId = appLibraryCrm::getFuneralId();
if (appHttpTpAdminCrmAjaxReportcs::$funeralId != '') {
    appHttpTpAdminCrmAjaxReportcs::$result = appLibraryCrm::getCsReport(['funeral_id' => appHttpTpAdminCrmAjaxReportcs::$funeralId]);
}
