<?php
//======================================================================
// DB：'repost'　レポート関係全般
//======================================================================

class appDatabaseReport extends appConfigDatabase
{

  /*テーブル名*/
  public const tableName = 'report';
  /*テーブルのインデックス*/
  public const primaryKey = 'report_id';
  /*テーブル構成*/
  public const table = [
    self::primaryKey => [self::row => self::primaryKey, self::auto_increment => true],
    'report_category' => [self::row => 'report_category', 'title' => 'カテゴリ'],
    'disp_flg' => [self::row => 'disp_flg', 'title' => '表示_非表示'],
    'title' => [self::row => 'title', 'title' => 'タイトル', 'placeholder' => 'タイトル'],
    'comment' => [self::row => 'comment', 'title' => 'コメント', 'placeholder' => '任意の文章を入力'],
    'insert_date' => [self::row => 'insert_date'],
    'update_date' => [self::row => 'update_date'],
    'insert_by' => [self::row => 'insert_by'],
    'update_by' => [self::row => 'update_by'],
    'deleteFlg' => [self::row => 'deleteFlg']
  ];

  /*report_categoryの値*/
  public const category = [
    self::categoryNone => '未設定',
    self::categoryCs => '顧客対応',
    self::categoryTel =>  '架電',
  ];
  public const categoryNone = 'none';
  public const categoryCs = 'report_cs';
  public const categoryTel = 'report_tel';

  /*テーブル構成(JOIN)*/
  public const tableCs = [
    'report_id' => [self::row => 'report_id'],
    'funeral_id' => [self::row => 'funeral_id'],
    'fc_id' => [self::row => 'fc_id', 'title' => '顧客ID'],
    'cs_category' => [self::row => 'cs_category', 'title' => 'カテゴリ'],
    'approval_date' => [self::row => 'approval_date', 'title' => '承認日時'],
    'approval_status' => [self::row => 'approval_status', 'title' => '承認状況'],
    'approval_by' => [self::row => 'approval_by', 'title' => '承認者'],
  ];

  public const tableTel = [
    'report_id' => [self::row => 'report_id'],
    'funeral_id' => [self::row => 'funeral_id'],
    'tel_date' => [self::row => 'tel_date', 'title' => '架電日時'],
    'tel_status' => [self::row => 'tel_status', 'title' => '状況'],
    'tel_by' => [self::row => 'tel_by'],
  ];

  /*cs_categoryの値*/
  public const csCategory = [
    'none' => 'なし',
    'inquiry' => '問い合わせ（初回）',
    'inquiry_r' => '問い合わせ（再）',
    'order'  => 'ご依頼（初回）',
    'order_r'  => 'ご依頼（再）',
    'reservation'  => '事前予約（初回）',
    'reservation_r' => '事前予約（再）',
    'consult'  => '対面相談（初回）',
    'consult_r'  => '対面相談（再）',
    'document'  => '資料請求',
    'cancel'  => 'キャンセル',
    'other'  => 'その他'
  ];

  /*cs_Statusの値*/
  public const csStatus = [
    'none' => '未承認',
    'approval'  => '承認',
    'remand'  => '差戻し'
  ];
}
