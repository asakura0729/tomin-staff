<?php
session_start();
include_once __DIR__ . '/../_env/define.php';
include_once __DIR__ . '/config/user.php';
include_once __DIR__ . '/config/site.php';
include_once __DIR__ . '/config/page.php';
include_once __DIR__ . '/config/status.php';
include_once __DIR__ . '/config/session.php';
include_once __DIR__ . '/func/login.php';
include_once __DIR__ . '/func/database.php';
include_once __DIR__ . '/func/disp.php';
include_once __DIR__ . '/func/string.php';
include_once __DIR__ . '/func/editfile.php';
include_once __DIR__ . '/func/breadcrumb.php';
include_once __DIR__ . '/func/pager.php';

$_SESSION = appFuncLogin::logout($_SESSION, $_POST);

appConfigSession::$login = appFuncLogin::loginCheck($_SESSION, 'adminlogin');
appConfigSession::$userId = appFuncLogin::sessionUser($_SESSION);

if (isset(appConfigUser::list[appConfigSession::$userId]['username'])) {
    appConfigSession::$userName = appConfigUser::list[appConfigSession::$userId]['username'];
}else{
    $_SESSION=[]; 
}

appFuncLogin::redirect($_SESSION, appConfigSite::sitemap['login']['path'], 'adminlogin');
