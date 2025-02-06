<?php
require_once '../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxClient
{
    public static $resultFuneral = [];
    public static $resultClient = [];
}

appHttpTpAdminCrmAjaxDetail::$resultFuneral = appLibraryCrm::getFuneral();
appHttpTpAdminCrmAjaxDetail::$resultClient = appLibraryCrm::getClientData();
