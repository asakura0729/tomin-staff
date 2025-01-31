<?php
class appHttpAdminLoginIndex
{
    public static $errorFlag = false;
}

if (isset($_POST['login'])) {
    /*社員の場合*/
    $_SESSION = appFuncLogin::sessionLogin();
    appFuncLogin::loginRedirect(appRoutesWeb::sitemap['admin']['path']);
    /*エラーメッセージ*/
    appHttpAdminLoginIndex::$errorFlag = true;
} else {
    appFuncLogin::loginRedirect(appRoutesWeb::sitemap['admin']['path']);
}
