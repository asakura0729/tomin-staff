<?php
require_once '../../../_app/ssl_base.php';

class appHttpTpAdminCrmAdd_text
{
    public const getInputName = 'input_name';
    public static $getInputName;
}

appHttpTpAdminCrmAdd_text::$getInputName = appFuncArray::issetKey($_GET, appHttpTpAdminCrmAdd_text::getInputName, '');
