<?php
//======================================================================
// WEBサイトの設定//labu:tpst2025
//======================================================================
class appConfigSite
{
    public const getFuneralId = 'funeral_id';

    public const maintenance = false;
    public const siteName = '都民のお葬式';
    public const website = "https://tomin-osohshiki.jp/";
    public const tel = "03-6419-2012";
    public const sitemap = [
        'login' => ['path' => '/login/', 'contents' => null, 'title' => 'ログイン'],
        'admin' => ['path' => '/tpadmin/', 'contents' => '/tpadmin/top/ajax/top', 'title' => '管理画面'],
        'adminPrint' => ['path' => '/tpadmin/print/', 'contents' => '/tpadmin/print/ajax/index', 'title' => '宛名印刷'],
        'adminCrm' => ['path' => '/tpadmin/crm/', 'contents' => '/tpadmin/crm/ajax/index', 'title' => '顧客管理'],
        'adminCrmInsert' => ['path' => '/tpadmin/crm/insert', 'contents' => '/tpadmin/crm/ajax/detail', 'title' => '顧客情報登録'],
        'adminCrmDetail' => ['path' => '/tpadmin/crm/detail', 'contents' => '/tpadmin/crm/ajax/detail',  'title' => '顧客情報詳細', 'getParams' => ['funeral_id']],
        'adminCrmConfirm' => ['path' => '/tpadmin/crm/confirm', 'contents' => '/tpadmin/crm/confirm', 'title' => 'データ送信'],
    ];
    public const ajax = [
        'adminCrmDetailAjaxAddtext' => ['path' => '/tpadmin/crm/ajax/add_text?input_name=', 'title' => 'テキスト入力フォーム追加'],
    ];
    public const headerNav = [
        'adminCrm' => self::sitemap['adminCrm'],
        'adminCrmInsert' => self::sitemap['adminCrmInsert'],
        'adminPrint' => self::sitemap['adminPrint']
    ];
}
