<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxIndex
{
    public static $count = 0;
    public static $result = [];
    public const search = [
        'cl_name' =>'顧客名',
        'decd_name' => '故人名',
        'cl_tel' => '電話番号'
    ];
}

appHttpTpAdminCrmAjaxIndex::$count = appLibraryCrm::getFuneralCount();
appHttpTpAdminCrmAjaxIndex::$result = appLibraryCrm::getFuneral();
