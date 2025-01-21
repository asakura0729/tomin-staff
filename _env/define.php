<?php
/*======================================================================

開発環境と本番環境で値が変わるものをここで定義
【！注意！】ここの情報が流出すると死にます【！注意！】

======================================================================*/

//-----------------------------------------------------
// 開発環境
//-----------------------------------------------------
define("ENV", "develop");
define("DB_DSN", "mysql:dbname=loveme;host=localhost;");
define("DB_USER", "root");
define("DB_PASSWORD", "");

//-----------------------------------------------------
// ステージング環境
//-----------------------------------------------------
/*
define("ENV", "staging");
define("DB_DSN", "mysql:dbname=g3cm5_test;host=mysql66.onamae.ne.jp;charset=utf8");
define("DB_USER", "g3cm5_test");
define("DB_PASSWORD", "BtKgb_0714");
*/


//-----------------------------------------------------
// 本番環境
//-----------------------------------------------------
/*
define("ENV", "release");
define("DB_DSN", "mysql:dbname=osoushiki-tokyo_db;host=osoushiki-tokyo;charset=utf8");
define("DB_USER", "osoushiki-tokyo");
define("DB_PASSWORD", "tsubasa017");
*/
