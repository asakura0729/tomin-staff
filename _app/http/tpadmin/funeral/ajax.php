<?php
require_once '../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxIndex
{
    public static $count = 0;
    public static $result = [];
}

appHttpTpAdminCrmAjaxIndex::$count = appLibraryCrm::getFuneralCount();
appHttpTpAdminCrmAjaxIndex::$result = appLibraryCrm::getFuneral();