<?php
class appHttpAdminLoginIndex
{
    public const getUri = 'uri';
    public static $errorFlag = false;
    public static $getUri = "";
}

if (isset($_POST['login'])) {
    /*分岐:フォーム送信*/
    $_SESSION = appFuncSession::addSession();
    appHttpAdminLoginIndex::$errorFlag = true;
}
appHttpAdminLoginIndex::$getUri = appFuncArray::issetKey($_GET, appHttpAdminLoginIndex::getUri, appRoutesWeb::sitemap['admin']['path']);
appFuncSession::redirectLogin(appHttpAdminLoginIndex::$getUri);