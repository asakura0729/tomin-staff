<?php
//======================================================================
// WEBサイトの設定//labu:tpst2025
//======================================================================
class appConfigSite
{
    //======================================================================
    // メンテナンスモード
    //======================================================================
    public const maintenance = false;
    //======================================================================
    // サイト基本情報
    //======================================================================
    public const siteName = '都民のお葬式';
    public const website = "https://tomin-osohshiki.jp/";
    public const tel = "03-6419-2012";
    //======================================================================
    //GETパラメータ
    //======================================================================
    public const getFuneralId = 'funeral_id';
    public const getConfirm = 'confirm';
    //======================================================================
    // サイトマップ
    //======================================================================
    public const sitemap = [
        'login' => ['path' => '/login/', 'contents' => null, 'title' => 'ログイン'],
        'admin' => ['path' => '/tpadmin/', 'contents' => '/tpadmin/top/ajax/top', 'title' => '管理画面'],
        'adminPrint' => ['path' => '/tpadmin/print/', 'contents' => '/tpadmin/print/ajax/index', 'title' => '宛名印刷'],
        'adminCrm' => ['path' => '/tpadmin/crm/', 'contents' => '/tpadmin/crm/ajax/index', 'title' => '顧客検索'],
        'adminCrmInsert' => ['path' => '/tpadmin/crm/insert', 'contents' => '/tpadmin/crm/ajax/detail', 'title' => '顧客情報登録'],
        'adminCrmDetail' => ['path' => '/tpadmin/crm/detail', 'contents' => '/tpadmin/crm/ajax/detail', 'title' => '顧客情報詳細', self::sitemapGetParams => [self::getFuneralId]],
        'adminCrmTel' => ['path' => '/tpadmin/crm/tel', 'contents' => '/tpadmin/crm/ajax/tel', 'title' => '架電リスト'],
    ];
    public const sitemapGetParams = 'getParams';
    //======================================================================
    // AJAXコンテンツ一覧
    //======================================================================
    public const ajax = [
        'adminCrmConfirm' => ['path' => '/tpadmin/crm/ajax/confirm', 'title' => 'データ送信'],
        'adminCrmDetailAjaxAddtext' => ['path' => '/tpadmin/crm/ajax/add_text?input_name=', 'title' => 'テキスト入力フォーム追加'],
    ];
    //======================================================================
    // グローバルナビゲーション一覧
    //======================================================================
    public const headerNav = [
        'adminCrm' => self::sitemap['adminCrm'],
        'adminCrmInsert' => self::sitemap['adminCrmInsert'],
        'adminCrmTel' => self::sitemap['adminCrmTel'],
        'adminPrint' => self::sitemap['adminPrint'],
    ];
}
