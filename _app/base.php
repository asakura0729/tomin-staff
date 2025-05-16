<?php
include_once __DIR__ . '/class.php';
appConfigPage::$path = appFuncPath::getPath();
appFuncDebug::error_report(appConfigSite::debug);