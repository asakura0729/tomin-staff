<?php
//======================================================================
// DB：顧客対応ログ
//======================================================================
class appDatabaseCs extends appConfigDatabase
{
  /*クラス名*/
  public const className = 'appDatabaseCs';
  /*テーブル名*/
  public const tableName = 'cs';
  /*テーブルのインデックス*/
  public const primaryKey = 'cs_id';

  /*
  テーブル構成
  name：データベースの列名,
  type：データベースのデータ型,
  constraints：データベースの制約,
  comment：データベースのコメント,
  category：列のカテゴリ
  input：フォームの入力要素,
  value：値（任意）
    item：セレクトメニュー等で使用する配列,
    string：セレクトメニュー等で表示する文字列（多次元配列でない場合省略）,
  */
  public const table = [
    'cs_id' => [
      'name' => 'cs_id',
      'type' => 'INT(4)',
      'constraints' => 'PRIMARY KEY',
      'comment' => 'ログID',
      'input' => 'hidden'
    ],
    'parent_cs_id' => [
      'name' => 'parent_cs_id',
      'type' => 'INT(4)',
      'constraints' => 'NULL',
      'comment' => '親ログID',
      'input' => 'hidden'
    ],
    'cs_category' => [
      'name' => 'cs_category',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NOT NULL',
      'comment' => 'カテゴリ',
      'input' => 'hidden',
    ],
    'approval_status' => [
      'name' => 'approval_status',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '管理者確認',
      'input' => 'select',
      'value' => ['item' => appConfigStatus::approval_status, 'string' => 'name']
    ],
    'approval_by' => [
      'name' => 'approval_by',
      'type' => 'INT(4)',
      'constraints' => 'NULL',
      'comment' => '確認者',
      'input' => 'hidden',
      'value' => ['item' => appConfigUser::list, 'string' => 'username']
    ],
    'post_date' => [
      'name' => 'post_date',
      'type' => 'datetime',
      'constraints' => 'NULL',
      'comment' => '作成日時',
      'input' => 'datetime-local'
    ],
    'post_by' => [
      'name' => 'post_by',
      'type' => 'INT(4)',
      'constraints' => 'NULL',
      'comment' => '作成者',
      'input' => 'select',
      'value' => ['item' => appConfigUser::list, 'string' => 'username'],
    ],
    'client_category' => [
      'name' => 'client_category',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '顧客ステータス',
      'input' => 'select',
      'value' => ['item' => appConfigStatus::clientCategory, 'string' => 'name'],
    ],
    'delivery_status' => [
      'name' => 'delivery_status',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '資料発送',
      'input' => 'select',
      'value' => ['item' => appConfigStatus::delivery_status, 'string' => 'name']
    ],
    'client_name' => [
      'name' => 'client_name',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '依頼者氏名',
      'input' => 'textarea'
    ],
    'client_region' => [
      'name' => 'client_region',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '依頼者住民票',
      'input' => 'textarea'
    ],
    'client_tel' => [
      'name' => 'client_tel',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '依頼者連絡先',
      'input' => 'textarea'
    ],
    'chief_mourner_name' => [
      'name' => 'chief_mourner_name',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '喪主名',
      'input' => 'text'
    ],
    'chief_mourner_relation' => [
      'name' => 'chief_mourner_relation',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '喪主続柄',
      'input' => 'text'
    ],
    'dec_name' => [
      'name' => 'dec_name',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '故人氏名',
      'input' => 'text'
    ],
    'dec_region' => [
      'name' => 'dec_region',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '故人住民票',
      'input' => 'text'
    ],
    'dec_relation' => [
      'name' => 'dec_relation',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '故人続柄',
      'input' => 'text'
    ],
    'dec_birth_date' => [
      'name' => 'dec_birth_date',
      'type' => 'date',
      'constraints' => 'NULL',
      'comment' => '故人生年月日',
      'input' => 'date'
    ],
    'dec_passing_date' => [
      'name' => 'dec_passing_date',
      'type' => 'date',
      'constraints' => 'NULL',
      'comment' => '故人命日',
      'input' => 'date'
    ],
    'religion_category' => [
      'name' => 'religion_category',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '故人宗派',
      'input' => 'textarea',
    ],
    'plan_category' => [
      'name' => 'plan_category',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => 'プラン名',
      'input' => 'select',
      'value' => ['item' => appConfigFuneral::plan, 'string' => 'name']
    ],
    'ensconce_category' => [
      'name' => 'ensconce_category',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '安置方法',
      'input' => 'select',
      'value' => ['item' => appConfigFuneral::enshrined]
    ],
    'dest_address' => [
      'name' => 'dest_address',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => 'お迎え場所',
      'input' => 'textarea'
    ],
    'ensconce_address' => [
      'name' => 'ensconce_address',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '自宅安置の場合、自宅住所',
      'input' => 'textarea'
    ],
    'funeral_date' => [
      'name' => 'funeral_date',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '葬儀日',
      'input' => 'textarea'
    ],
    'hall_name' => [
      'name' => 'hall_name',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '葬儀場',
      'input' => 'textarea'
    ],
    'crematory_name' => [
      'name' => 'crematory_name',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '火葬場',
      'input' => 'textarea'
    ],
    'option_name' => [
      'name' => 'option_name',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => 'オプション内容',
      'input' => 'textarea'
    ],
    'total_price' => [
      'name' => 'total_price',
      'type' => 'DECIMAL(10,2)',
      'constraints' => 'NULL',
      'comment' => '総計（税込）',
      'input' => 'number'
    ],
    'hall_price' => [
      'name' => 'hall_price',
      'type' => 'DECIMAL(10,2)',
      'constraints' => 'NULL',
      'comment' => '式場利用料（税込）',
      'input' => 'number'
    ],
    'funeral_status' => [
      'name' => 'funeral_status',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '報告状況',
      'input' => 'select',
      'value' => ['item' => appConfigStatus::funeral_status, 'string' => 'name']
    ],
    'estimate_date' => [
      'name' => 'estimate_date',
      'type' => 'date',
      'constraints' => 'NULL',
      'comment' => '見積書到着日',
      'input' => 'date'
    ],
    'invoice_date' => [
      'name' => 'invoice_date',
      'type' => 'date',
      'constraints' => 'NULL',
      'comment' => '報告日',
      'input' => 'date'
    ],
    'comment' => [
      'name' => 'comment',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => 'コメント',
      'input' => 'textarea'
    ],
    'comment_sheet' => [
      'name' => 'comment_sheet',
      'type' => 'longtext',
      'constraints' => 'NULL',
      'comment' => '送客シート特記事項',
      'input' => 'textarea'
    ],
    'title' => [
      'name' => 'title',
      'type' => 'VARCHAR(40)',
      'constraints' => 'NULL',
      'comment' => 'タイトル',
      'input' => 'text'
    ],
    'funeral_company_name' => [
      'name' => 'funeral_company_name',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '葬儀社名',
      'input' => 'text'
    ],
    'funeral_manager_name' => [
      'name' => 'funeral_manager_name',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '葬儀担当者名',
      'input' => 'text'
    ],
    'option_flower' => [
      'name' => 'option_flower',
      'type' => 'VARCHAR(40)',
      'constraints' => 'NULL',
      'comment' => 'お花盆（プレゼント特典）',
      'input' => 'textarea'
    ],
    'cs_tel_status' => [
      'name' => 'cs_tel_status',
      'type' => 'VARCHAR(20)',
      'constraints' => 'NULL',
      'comment' => '架電ステータス',
      'input' => 'select',
      'value' => ['item' => appConfigStatus::cs_tel_status, 'string' => 'name']
    ],
    'cs_tel_date' => [
      'name' => 'cs_tel_date',
      'type' => 'datetime',
      'constraints' => 'NULL',
      'comment' => '架電日時',
      'input' => 'datetime-local'
    ],
    'insert_date' => [
      'name' => 'insert_date',
      'type' => 'datetime',
      'constraints' => 'NOT NULL',
      'comment' => '作成日時',
      'input' => 'hidden'
    ],
    'insert_by' => [
      'name' => 'insert_by',
      'type' => 'INT(4)',
      'constraints' => 'NOT NULL',
      'comment' => '作成者（user_id)',
      'input' => 'hideen',
    ],
    'update_date' => [
      'name' => 'update_date',
      'type' => 'datetime',
      'constraints' => 'NOT NULL',
      'comment' => '変更日時',
      'input' => 'hidden'
    ],
    'update_by' => [
      'name' => 'update_by',
      'type' => 'INT(4)',
      'constraints' => 'NOT NULL',
      'comment' => '変更者（user_id)',
      'input' => 'hideen',
    ],
    'delete_flg' => [
      'name' => 'delete_flg',
      'type' => 'tinyint(4)',
      'constraints' => 'NOT NULL',
      'comment' => '削除フラグ',
      'input' => 'hidden'
    ]
  ];

  //-----------------------------------------------------
  // 対応ログで取得する内容
  //-----------------------------------------------------
  public const tableCsList = [
    'cs_id' => self::table['cs_id'],
    'parent_cs_id' => self::table['parent_cs_id'],
    'cs_category' => self::table['cs_category'],
    'approval_status' => self::table['approval_status'],
    'approval_by' => self::table['approval_by'],
    'post_date' => self::table['post_date'],
    'post_by' => self::table['post_by'],
    'client_category' => self::table['client_category'],
    'delivery_status' => self::table['delivery_status'],
    'client_name' => self::table['client_name'],
    'client_region' => self::table['client_region'],
    'client_tel' => self::table['client_tel'],
    'chief_mourner_name' => self::table['chief_mourner_name'],
    'chief_mourner_relation' => self::table['chief_mourner_relation'],
    'dec_name' => self::table['dec_name'],
    'dec_region' => self::table['dec_region'],
    'dec_relation' => self::table['dec_relation'],
    'dec_birth_date' => self::table['dec_birth_date'],
    'dec_passing_date' => self::table['dec_passing_date'],
    'religion_category' => self::table['religion_category'],
    'plan_category' => self::table['plan_category'],
    'ensconce_category' => self::table['ensconce_category'],
    'dest_address' => self::table['dest_address'],
    'ensconce_address' => self::table['ensconce_address'],
    'funeral_date' => self::table['funeral_date'],
    'hall_name' => self::table['hall_name'],
    'crematory_name' => self::table['crematory_name'],
    'option_name' => self::table['option_name'],
    'total_price' => self::table['total_price'],
    'hall_price' => self::table['hall_price'],
    'funeral_status' => self::table['funeral_status'],
    'estimate_date' => self::table['estimate_date'],
    'invoice_date' => self::table['invoice_date'],
    'comment' => self::table['comment'],
    'comment_sheet' => self::table['comment_sheet'],
    'title' => self::table['title'],
    'funeral_company_name' => self::table['funeral_company_name'],
    'funeral_manager_name' => self::table['funeral_manager_name'],
    'option_flower' => self::table['option_flower'],
    'cs_tel_status' => self::table['cs_tel_status'],
    'cs_tel_date' => self::table['cs_tel_date'],
    'insert_date' => self::table['insert_date'],
    'insert_by' => self::table['insert_by'],
    'update_date' => self::table['update_date'],
    'update_by' => self::table['update_by'],
    'delete_flg' => self::table['delete_flg']
  ];
  //-----------------------------------------------------
  // 送客シートで取得する内容（左外部結合）
  //-----------------------------------------------------
  public const tableCsListJoin = [
    'sheet_cs_id' => self::table['cs_id'],
    'sheet_parent_cs_id' => self::table['parent_cs_id'],
    'sheet_cs_category' => self::table['cs_category'],
    'sheet_approval_status' => self::table['approval_status'],
    'sheet_client_name' => self::table['client_name'],
    'sheet_client_tel' => self::table['client_tel'],
    'sheet_dec_name' => self::table['dec_name'],
    'sheet_dec_region' => self::table['dec_region'],
    'sheet_dec_relation' => self::table['dec_relation'],
    'sheet_plan_category' => self::table['plan_category'],
    'sheet_ensconce_category' => self::table['ensconce_category'],
    'sheet_dest_address' => self::table['dest_address'],
    'sheet_funeral_date' => self::table['funeral_date'],
    'sheet_hall_name' => self::table['hall_name'],
    'sheet_crematory_name' => self::table['crematory_name'],
    'sheet_option_name' => self::table['option_name'],
    'sheet_comment_sheet' => self::table['comment_sheet'],
    'sheet_title' => self::table['title'],
    'sheet_funeral_company_name' => self::table['funeral_company_name'],
    'sheet_funeral_manager_name' => self::table['funeral_manager_name'],
    'sheet_option_flower' => self::table['option_flower'],
    'sheet_insert_by' => self::table['insert_by'],
    'sheet_insert_date' => self::table['insert_date']
  ];
  //-----------------------------------------------------
  // 名称変更を行う列
  //-----------------------------------------------------
  public const rename = [
    'post_date' => '日付',
    'post_by' => '受電者',
    'client_category' => 'ステータス',
    'client_name' => '氏名',
    'client_tel' => '連絡先',
    'client_region' => '住民票',
    'dec_name' =>  '氏名',
    'dec_region' => '住民票',
    'dec_relation' =>  '続柄',
    'dec_birth_date' => '生年月日',
    'dec_passing_date' => '命日',
    'religion_category' => '宗派',
    'chief_mourner_relation' => '続柄'
  ];
}
