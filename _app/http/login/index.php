<?php
class appHttpAdminLoginIndex
{
    public static $errorFlag = false;
}

if (isset($_POST['login'])) {
    /*社員の場合*/
    $_SESSION = appFuncLogin::sessionLogin(appConfigUser::list, $_POST, 'adminlogin', 'user');
    appFuncLogin::loginRedirect($_SESSION, appConfigSite::sitemap['admin']['path'], 'adminlogin');
    /*エラーメッセージ*/
    appHttpAdminLoginIndex::$errorFlag = true;
} else {
    appFuncLogin::loginRedirect($_SESSION, appConfigSite::sitemap['admin']['path'], 'adminlogin');
}
