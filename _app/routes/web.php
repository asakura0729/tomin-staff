<?php
//======================================================================
// WEBサイトの各ページ設定
//======================================================================
class appRoutesWeb
{
    //======================================================================
    //GETパラメータ(汎用)
    //======================================================================
    public const getFuneralId = 'funeral_id';
    public const getConfirm = 'confirm';
    public const getPage = 'page'; //ページ遷移番号
    public const getRow = 'row'; //検索対象列
    public const getWords = 'words'; //検索文字列
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
        'adminCrmLog' => ['path' => '/tpadmin/crm/log', 'contents' => '/tpadmin/crm/ajax/log', 'title' => '過去ログ', self::sitemapGetParams => ['report_id']],
        'adminCrmTel' => ['path' => '/tpadmin/crm/tel', 'contents' => '/tpadmin/crm/ajax/tel', 'title' => '架電リスト'],
    ];
    public const sitemapGetParams = 'getParams';
    //======================================================================
    // AJAXコンテンツ一覧
    //======================================================================
    public const ajax = [
        'adminCrmConfirm' => ['path' => '/tpadmin/crm/ajax/confirm', 'title' => 'データ送信'],
        'adminCrmDetailAjaxAddtext' => ['path' => '/tpadmin/crm/ajax/add_text', 'title' => 'テキスト入力フォーム追加'],
        'adminCrmDetailAjaxReportCs' => ['path' => '/tpadmin/crm/ajax/report_cs?funeral_id=', 'title' => 'テキスト入力フォーム追加'],
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
