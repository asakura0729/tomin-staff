<?php
session_start();
include_once __DIR__ . '/class.php';
$_SESSION = appFuncSession::formatSession($_SESSION, $_POST);
appFuncSession::redirectNotLogin(appFuncPath::redirectUri());
appConfigPage::$path = appFuncPath::getPath();
appFuncDebug::error_report(appConfigSite::debug);