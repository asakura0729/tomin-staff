<?php
/*======================================================================

WEBサイトの設定

======================================================================*/
class appConfigSite
{
    const maintenance = false;
    const siteName = '都民のお葬式';
    const website = "https://tomin-osohshiki.jp/";
    const tel = "03-6419-2012";
    const sitemap = [
        'login' => ['path' => '/login/', 'title' => 'ログイン'],
        'admin' => ['path' => '/tpadmin/', 'title' => '管理画面'],
        'adminPrint' => ['path' => '/tpadmin/print/', 'title' => '印刷物作成'],
    ];
}
