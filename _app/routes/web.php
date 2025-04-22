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
    //======================================================================
    // サイトマップ
    //======================================================================
    public const pagePath = 'path';
    public const pageContents = 'contents';
    public const pageTitle = 'title';
    public const pageRoute = 'route';
    public const pageIcon = 'icon';
    public const pageAuthority = 'authority';
    public const sitemap = [
        'login' => [
            self::pagePath => '/login/',
            self::pageContents => null,
            self::pageTitle => 'ログイン',
            self::pageAuthority => '',
            self::pageIcon => '',
        ],
        'admin' => [
            self::pagePath => '/tpadmin/',
            self::pageContents => '/ajax/top/index',
            self::pageTitle => '管理画面',
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-home',
        ],
        'adminCsIndex' => [
            self::pagePath => '/tpadmin/cs/',
            self::pageContents => '/ajax/cs/index',
            self::pageTitle => '対応ログ一覧',
            self::pageRoute => [],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-list-ol',
        ],
        'adminCsEdit' => [
            self::pagePath => '/tpadmin/cs/edit',
            self::pageContents => '/ajax/cs/edit',
            self::pageTitle => '対応ログ編集',
            self::pageRoute => ['adminCsIndex'],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-pencil',
        ],
        'adminCsList_invalid' => [
            self::pagePath => '/tpadmin/cs/list_invalid',
            self::pageContents => '/ajax/cs/list_invalid',
            self::pageTitle => '無効電話一覧',
            self::pageRoute => ['adminCsIndex'],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-list-ol',
        ],
        'adminCsList_check' => [
            self::pagePath => '/tpadmin/cs/list_check',
            self::pageContents => '/ajax/cs/list_check',
            self::pageTitle => 'ログチェック一覧',
            self::pageRoute => ['adminCsIndex'],
            self::pageAuthority => appConfigUser::authorityManager,
            self::pageIcon => 'fa-list-ol',
        ],
        'adminCsSheet' => [
            self::pagePath => '/tpadmin/cs_sheet/',
            self::pageContents => '/ajax/cs_sheet/index',
            self::pageTitle => '送客シート一覧',
            self::pageRoute => [],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-file-text',
        ],
        'adminCsSheetDetail' => [
            self::pagePath => '/tpadmin/cs_sheet/detail',
            self::pageContents => '/ajax/cs_sheet/detail',
            self::pageTitle => '送客シート閲覧',
            self::pageRoute => ['adminCsSheet'],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-file-text',
        ],
        'adminCsSheetEdit' => [
            self::pagePath => '/tpadmin/cs_sheet/edit',
            self::pageContents => '/ajax/cs_sheet/edit',
            self::pageTitle => '送客シート編集',
            self::pageRoute => ['adminCsSheet'],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-file-text',
        ],
        'adminPrint' => [
            self::pagePath => '/tpadmin/print/',
            self::pageContents => '/ajax/print/index',
            self::pageTitle => '宛名印刷',
            self::pageRoute => [],
            self::pageAuthority => appConfigUser::authorityStaff,
            self::pageIcon => 'fa-envelope',
        ],
    ];
    public const async = [
        'adminCount_approval' => [self::pagePath => null, self::pageContents => '/ajax/count_approval', self::pageTitle => '未承認ログの数', self::pageRoute => [], self::pageIcon => ''],
        'adminCsAjaxList' => [self::pagePath => null, self::pageContents => '/ajax/cs/ajax/list', self::pageTitle => '対応ログ一覧', self::pageRoute => [], self::pageIcon => ''],
        'adminCsAjaxPost' => [self::pagePath => null, self::pageContents => '/ajax/cs/ajax/post', self::pageTitle => '対応ログ編集', self::pageRoute => [], self::pageIcon => ''],
        'adminCsAjaxPost_approval' => [self::pagePath => null, self::pageContents => '/ajax/cs/ajax/post_approval', self::pageTitle => '対応ログ編集（承認）', self::pageRoute => [], self::pageIcon => ''],
    ];
    //======================================================================
    // グローバルナビゲーション
    //======================================================================
    public const gNav = [
        'adminCsEdit' => self::sitemap['adminCsEdit'],
        'adminCsIndex' => self::sitemap['adminCsIndex'],
        'adminCsList_invalid' => self::sitemap['adminCsList_invalid'],
        'adminCsList_check' => self::sitemap['adminCsList_check'],
        'adminCsSheet' => self::sitemap['adminCsSheet'],
        'adminPrint' => self::sitemap['adminPrint'],
    ];
}
