<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxIndex
{
    public static $result = [];
}
appHttpTpAdminCrmAjaxIndex::$result = appLibraryCrm::getFuneral();
