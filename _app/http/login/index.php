<?php
class appHttpAdminLoginIndex
{
    public static $errorFlag = false;
}

if (isset($_POST['login'])) {
    $_SESSION = appFuncSession::sessionLogin();
    appFuncSession::loginRedirect(appRoutesWeb::sitemap['admin']['path']);
    appHttpAdminLoginIndex::$errorFlag = true;
} else {
    appFuncSession::loginRedirect(appRoutesWeb::sitemap['admin']['path']);
}
