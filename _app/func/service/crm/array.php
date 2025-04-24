<?php
//======================================================================
// CRM＞配列の作成
//======================================================================
class appFuncCrmArray
{
    public const csList = appDatabaseCs::tableCsList;
    public const csSheet = appDatabaseCs::tableCsListJoin;
    public const rowCategory = 'rowCategory';

    public const rows = [
        'base' => ['title' => '　', 'css' => 'bg-row-base'],
        'client' => ['title' => '入電者様情報', 'css' => 'bg-row-client'],
        'dec' => ['title' => '故人様情報', 'css' => 'bg-row-dec'],
        'plan' => ['title' => '　', 'css' => 'bg-row-cs'],
        'comment' => ['title' => '　', 'css' => 'bg-row-base'],
        'sheet' => ['title' => '　', 'css' => 'bg-row-sheet'],
        'status' => ['title' => '　', 'css' => 'bg-row-status'],
        'cs_tel' => ['title' => '架電', 'css' => 'bg-row-base'],
    ];
    //-----------------------------------------------------
    // 対応ログ一覧用の配列作成
    //-----------------------------------------------------
    public static function list(): array
    {
        return [
            'cs_id' => array_merge(self::csList['cs_id'], [self::rowCategory => self::rows['base']]),
            'sheet_cs_id' => self::csList['cs_id'],
            'cs_category' => self::csList['cs_category'],
            'parent_cs_id' => self::csList['parent_cs_id'],
            'approval_status' => self::csList['approval_status'],
            'approval_by' => self::csList['approval_by'],
            'post_date' => self::csList['post_date'],
            'post_by' => self::csList['post_by'],
            'client_category' => self::csList['client_category'],
            'delivery_status' => self::csList['delivery_status'],
            'client_name' => array_merge(self::csList['client_name'], [self::rowCategory => self::rows['client']]),
            'client_region' => self::csList['client_region'],
            'client_tel' => self::csList['client_tel'],
            'dec_name' =>  array_merge(self::csList['dec_region'], [self::rowCategory => self::rows['dec']]),
            'dec_region' => self::csList['dec_region'],
            'dec_relation' => self::csList['dec_relation'],
            'plan_category' => array_merge(self::csList['plan_category'], [self::rowCategory => self::rows['plan']]),
            'ensconce_category' => self::csList['ensconce_category'],
            'dest_address' => self::csList['dest_address'],
            'ensconce_address' => self::csList['ensconce_address'],
            'funeral_date' => self::csList['funeral_date'],
            'hall_name' => self::csList['hall_name'],
            'crematory_name' => self::csList['crematory_name'],
            'option_name' => self::csList['option_name'],
            'sheet_comment' => array_merge(self::csSheet['sheet_comment'], [self::rowCategory => self::rows['comment']]),
            'comment' => self::csList['comment'],
            'sheet_approval_status' => array_merge(self::csSheet['sheet_approval_status'], [self::rowCategory => self::rows['sheet']]),
            'sheet_cs_category' => self::csSheet['sheet_cs_category'],
            'sheet_funeral_name' => self::csSheet['sheet_funeral_name'],
            'sheet_plan_category' => self::csSheet['sheet_plan_category'],
            'sheet_ensconce_category' => self::csSheet['sheet_ensconce_category'],
            'sheet_funeral_date' => self::csSheet['sheet_funeral_date'],
            'sheet_hall_name' => self::csSheet['sheet_hall_name'],
            'sheet_crematory_name' => self::csSheet['sheet_crematory_name'],
            'sheet_option_name' => self::csSheet['sheet_option_name'],
            'total_price' => self::csList['total_price'],
            'hall_price' => self::csList['hall_price'],
            'funeral_status' => array_merge(self::csList['funeral_status'], [self::rowCategory => self::rows['status']]),
            'estimate_date' => self::csList['estimate_date'],
            'invoice_date' => self::csList['invoice_date'],
            'cs_tel_status' => array_merge(self::csList['cs_tel_status'], [self::rowCategory => self::rows['cs_tel']]),
            'cs_tel_date' => self::csList['cs_tel_date']
        ];
    }
    //-----------------------------------------------------
    // 対応ログ一覧（無効顧客）で表示する配列作成
    //-----------------------------------------------------
    public static function invalidList(): array
    {
        return [
            'cs_id' => array_merge(self::csList['cs_id'], [self::rowCategory => self::rows['base']]),
            'cs_category' => self::csList['cs_category'],
            'approval_status' => self::csList['approval_status'],
            'approval_by' => self::csList['approval_by'],
            'post_date' => self::csList['post_date'],
            'post_by' => self::csList['post_by'],
            'client_category' => self::csList['client_category'],
            'client_name' => array_merge(self::csList['client_name'], [self::rowCategory => self::rows['client']]),
            'client_tel' => self::csList['client_tel'],
            'comment' => array_merge(self::csList['comment'], [self::rowCategory => self::rows['comment']]),
            'cs_tel_status' => array_merge(self::csList['cs_tel_status'], [self::rowCategory => self::rows['cs_tel']]),
            'cs_tel_date' => self::csList['cs_tel_date']
        ];
    }
    //-----------------------------------------------------
    // 送客シート一覧で使用する配列作成
    //-----------------------------------------------------
    public static function sheetList(): array
    {
        return [
            'cs_id' => array_merge(self::csList['cs_id'], [self::rowCategory => self::rows['base']]),
            'approval_status' => self::csList['approval_status'],
            'approval_by' => self::csList['approval_by'],
            'post_date' => self::csList['post_date'],
            'post_by' => self::csList['post_by'],
            'client_name' => array_merge(self::csList['client_name'], [self::rowCategory => self::rows['client']]),
            'client_tel' => self::csList['client_tel'],
            'sheet_approval_status' => array_merge(self::csSheet['sheet_approval_status'], [self::rowCategory => self::rows['sheet']]),
            'sheet_cs_category' => self::csSheet['sheet_cs_category'],
            'sheet_funeral_name' => self::csSheet['sheet_funeral_name'],
            'sheet_plan_category' => self::csSheet['sheet_plan_category'],
            'sheet_ensconce_category' => self::csSheet['sheet_ensconce_category'],
            'sheet_funeral_date' => self::csSheet['sheet_funeral_date'],
            'sheet_hall_name' => self::csSheet['sheet_hall_name'],
            'sheet_crematory_name' => self::csSheet['sheet_crematory_name'],
            'sheet_option_name' => self::csSheet['sheet_option_name'],
            'total_price' => self::csList['total_price'],
            'hall_price' => self::csList['hall_price'],
        ];
    }
    //-----------------------------------------------------
    // 入力フォームで使用する配列作成
    //-----------------------------------------------------
    public static function form(): array
    {
        return [
            'cs_id' => array_merge(self::csList['cs_id'], [self::rowCategory => self::rows['base']]),
            'cs_category' => self::csList['cs_category'],
            'approval_status' => self::csList['approval_status'],
            'approval_by' => self::csList['approval_by'],
            'post_date' => self::csList['post_date'],
            'post_by' => self::csList['post_by'],
            'client_category' => self::csList['client_category'],
            'delivery_status' => self::csList['delivery_status'],
            'client_name' => array_merge(self::csList['client_name'], [self::rowCategory => self::rows['client']]),
            'client_region' => self::csList['client_region'],
            'client_tel' => self::csList['client_tel'],
            'dec_name' =>  array_merge(self::csList['dec_region'], [self::rowCategory => self::rows['dec']]),
            'dec_region' => self::csList['dec_region'],
            'dec_relation' => self::csList['dec_relation'],
            'plan_category' => array_merge(self::csList['plan_category'], [self::rowCategory => self::rows['plan']]),
            'ensconce_category' => self::csList['ensconce_category'],
            'dest_address' => self::csList['dest_address'],
            'ensconce_address' => self::csList['ensconce_address'],
            'funeral_date' => self::csList['funeral_date'],
            'hall_name' => self::csList['hall_name'],
            'crematory_name' => self::csList['crematory_name'],
            'option_name' => self::csList['option_name'],
            'comment' => array_merge(self::csList['comment'], [self::rowCategory => self::rows['comment']]),
            'total_price' => array_merge(self::csList['total_price'], [self::rowCategory => self::rows['sheet']]),
            'hall_price' => self::csList['hall_price'],
            'funeral_status' => array_merge(self::csList['funeral_status'], [self::rowCategory => self::rows['status']]),
            'estimate_date' => self::csList['estimate_date'],
            'invoice_date' => self::csList['invoice_date'],
            'cs_tel_status' => array_merge(self::csList['cs_tel_status'], [self::rowCategory => self::rows['cs_tel']]),
            'cs_tel_date' => self::csList['cs_tel_date']
        ];
    }
}
