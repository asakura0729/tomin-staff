<?php
require_once '../../_app/ssl_base.php';

class appHttpTpAdminCrmAjaxIndex
{
    public static $searchWord = "";
    public static $searchRow = "";
    public static $searchConfig = [];
    public static $count = 0;
    public static $result = [];
}

appHttpTpAdminCrmAjaxIndex::$searchWord  = appFuncArray::issetKey($_GET, appRoutesWeb::getWords, '');
appHttpTpAdminCrmAjaxIndex::$searchRow  = appFuncArray::issetKey($_GET, appRoutesWeb::getRow, appLibraryCrm::searchClname);
appHttpTpAdminCrmAjaxIndex::$searchConfig = [
    appRoutesWeb::getWords => appHttpTpAdminCrmAjaxIndex::$searchWord,
    appRoutesWeb::getRow => appHttpTpAdminCrmAjaxIndex::$searchRow
];
appHttpTpAdminCrmAjaxIndex::$count = appLibraryCrm::getClientDataJoinFuneralCount(appHttpTpAdminCrmAjaxIndex::$searchConfig);
appHttpTpAdminCrmAjaxIndex::$result = appLibraryCrm::getClientDataJoinFuneral(appHttpTpAdminCrmAjaxIndex::$searchConfig);