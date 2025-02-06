<?php
//======================================================================
// WEBサイトの各ページ設定
//======================================================================
class appRoutesWeb
{
    //======================================================================
    //GETパラメータ(汎用)
    //======================================================================
    public const getPage = 'page'; //ページ遷移番号
    public const getWords = 'words'; //検索文字列
    public const getRow = 'row'; //検索文字列の検索範囲
    //======================================================================
    // サイトマップ
    //======================================================================
    public const sitemap = [
        'login' => ['path' => '/login/', 'contents' => null, 'title' => 'ログイン'],
        'admin' => ['path' => '/tpadmin/', 'contents' => '/tpadmin/top/ajax/top', 'title' => '管理画面'],
        'adminPrint' => ['path' => '/tpadmin/print/', 'contents' => '/tpadmin/print/ajax', 'title' => '宛名印刷'],
        'adminFuneral' => ['path' => '/tpadmin/funeral/', 'contents' => '/tpadmin/funeral/ajax', 'title' => '顧客検索'],
        'adminCrmInsert' => ['path' => '/tpadmin/insert/', 'contents' => '/tpadmin/ajax_edit/index', 'title' => '顧客情報登録'],
        'adminCrmDetail' => ['path' => '/tpadmin/detail/', 'contents' => '/tpadmin/ajax_edit/index', 'title' => '顧客情報詳細', self::sitemapGetParams => ['funeral_id']],
        'adminCrmLog' => ['path' => '/tpadmin/detail/log', 'contents' => '/tpadmin/ajax_edit/log', 'title' => '過去ログ', self::sitemapGetParams => ['report_id']],
        'adminCrmTel' => ['path' => '/tpadmin/tel/', 'contents' => '/tpadmin/tel/ajax', 'title' => '架電リスト'],
    ];
    public const sitemapGetParams = 'getParams';
    //======================================================================
    // AJAXコンテンツ一覧
    //======================================================================
    public const ajax = [
        'funeralResult' => ['path' => '/tpadmin/funeral/ajax_results', 'title' => '顧客検索結果'],
        'editConfirm' => ['path' => '/tpadmin/ajax_edit/confirm', 'title' => 'データ送信'],
        'editAddtext' => ['path' => '/tpadmin/ajax_edit/add_text', 'title' => 'テキスト入力フォーム追加'],
        'editAddClient' => ['path' => '/tpadmin/ajax_edit/add_client', 'title' => '顧客情報入力フォーム追加'],
        'editAddTel' => ['path' => '/tpadmin/ajax_edit/add_tel', 'title' => '架電日時登録フォーム追加'],
        'editLogs' => ['path' => '/tpadmin/ajax_edit/logs?funeral_id=', 'title' => '過去対応ログ一覧'],
    ];
    //======================================================================
    // グローバルナビゲーション一覧
    //======================================================================
    public const headerNav = [
        'adminFuneral' => self::sitemap['adminFuneral'],
        'adminCrmInsert' => self::sitemap['adminCrmInsert'],
        'adminCrmTel' => self::sitemap['adminCrmTel'],
        'adminPrint' => self::sitemap['adminPrint'],
    ];
}
