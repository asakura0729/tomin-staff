<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxDetail
{
    public static $resultFuneral = [];
    public static $resultClient = [];
}

appHttpTpAdminCrmAjaxDetail::$resultFuneral = appLibraryCrm::getFuneralDetail();
appHttpTpAdminCrmAjaxDetail::$resultClient = appLibraryCrm::getClientData();
