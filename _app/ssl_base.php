<?php
session_start();
include_once __DIR__ . '/../_env/define.php';
include_once __DIR__ . '/config/user.php';
include_once __DIR__ . '/config/site.php';
include_once __DIR__ . '/config/page.php';
include_once __DIR__ . '/config/status.php';
include_once __DIR__ . '/config/session.php';
include_once __DIR__ . '/config/database.php';
include_once __DIR__ . '/config/funeral.php';
include_once __DIR__ . '/func/array.php';
include_once __DIR__ . '/func/database.php';
include_once __DIR__ . '/func/string.php';
include_once __DIR__ . '/func/calc.php';
include_once __DIR__ . '/func/editfile.php';
include_once __DIR__ . '/func/pager.php';
include_once __DIR__ . '/func/path.php';
include_once __DIR__ . '/func/login.php';
include_once __DIR__ . '/database/funeral.php';
include_once __DIR__ . '/database/funeral_client.php';
include_once __DIR__ . '/database/report.php';
include_once __DIR__ . '/library/_module/editsql.php';
include_once __DIR__ . '/library/_module/disp.php';
include_once __DIR__ . '/library/_module/dataformat.php';
include_once __DIR__ . '/library/crm.php';

$_SESSION = appFuncLogin::logout($_SESSION, $_POST);

appConfigSession::$login = appFuncLogin::loginCheck($_SESSION, 'adminlogin');
appConfigSession::$userId = appFuncLogin::sessionUser($_SESSION);

if (isset(appConfigUser::list[appConfigSession::$userId]['username'])) {
    appConfigSession::$userName = appConfigUser::list[appConfigSession::$userId]['username'];
} else {
    $_SESSION = [];
}

appFuncLogin::redirect($_SESSION, appConfigSite::sitemap['login']['path'], 'adminlogin');