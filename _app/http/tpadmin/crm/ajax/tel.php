<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxTel
{
    public static $result = [];
}

appHttpTpAdminCrmAjaxTel::$result = appLibraryCrm::getReport(appDatabaseReport::categoryTel, appDatabaseReport::tableTel);
