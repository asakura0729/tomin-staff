<?php
require __DIR__ . '/trait/get_client.php';
require __DIR__ . '/trait/get_funeral.php';
require __DIR__ . '/trait/get_report.php';
require __DIR__ . '/trait/post.php';
//======================================================================
// CRM
//======================================================================
class appLibraryCrm
{
    use appLibraryCrmGetClient;
    use appLibraryCrmGetFuneral;
    use appLibraryCrmGetReport;
    use appLibraryCrmPost;
    //-----------------------------------------------------
    // 使用するパラメータ
    //-----------------------------------------------------
    public const postConfirm = 'confirm';
    public const confirmFuneralId = 'funeral_id';
    public const confirmFuneralData = 'funeral';
    public const confirmFuneralClientData = 'funeral_client';
    public const confirmContainerCs = 'conainer_cs';
    public const confirmReport = 'report';
    public const debug = false;
    //-----------------------------------------------------
    // キーワード検索で検索する列の指定
    //-----------------------------------------------------
    public const searchClname = 'cl_name';
    public const decdName = 'decd_name';
    public const clTel = 'cl_tel';
    public const search = [
        self::searchClname => self::searchRows[self::searchClname]['title'],
        self::decdName => self::searchRows[self::decdName]['title'],
        self::clTel => self::searchRows[self::clTel]['title'],
    ];
    public const searchRows = [
        self::searchClname => [
            'title' => '顧客名',
            'rows' => [
                appDatabaseFuneralclient::table['fc_lname'][appConfigDatabase::row],
                appDatabaseFuneralclient::table['fc_fname'][appConfigDatabase::row],
                appDatabaseFuneralclient::table['fc_lname_kana'][appConfigDatabase::row],
                appDatabaseFuneralclient::table['fc_fname_kana'][appConfigDatabase::row]
            ]
        ],
        self::decdName => [
            'title' => '故人名',
            'rows' => [
                appDatabaseFuneral::table['decd_lname'][appConfigDatabase::row],
                appDatabaseFuneral::table['decd_fname'][appConfigDatabase::row],
                appDatabaseFuneral::table['decd_lname_kana'][appConfigDatabase::row],
                appDatabaseFuneral::table['decd_fname_kana'][appConfigDatabase::row]
            ]
        ],
        self::clTel => [
            'title' => '電話番号',
            'rows' => [
                appDatabaseFuneralclient::table['fc_tel'][appConfigDatabase::row]
            ]
        ]
    ];
}
