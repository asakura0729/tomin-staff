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
    self::categoryApproval =>  '承認'
  ];
  public const categoryNone = 'none';
  public const categoryCs = 'report_cs';
  public const categoryTel = 'report_tel';
  public const categoryApproval = 'report_approval';

  /*テーブル構成(JOIN)*/
  public const tableCs = [
    'report_id' => [self::row => 'report_id'],
    'funeral_id' => [self::row => 'funeral_id'],
    'cs_category' => [self::row => 'cs_category', 'title' => 'カテゴリ'],
    'cs_status' => [self::row => 'cs_status', 'title' => '状況'],
  ];
  public const tableTel = [
    'report_id' => [self::row => 'report_id'],
    'funeral_id' => [self::row => 'funeral_id'],
    'tel_date' => [self::row => 'tel_date', 'title' => '架電日時'],
    'tel_status' => [self::row => 'tel_status', 'title' => '状況'],
    'tel_by' => [self::row => 'tel_by'],
  ];
  public const tableApproval = [
    'report_id' => [self::row => 'report_id'],
    'funeral_id' => [self::row => 'tel_date', 'title' => '架電日時'],
    'approval_date' => [self::row => 'tel_status', 'title' => '状況'],
    'approval_by' => [self::row => 'tel_by'],
    'approval_status' => [self::row => 'approval_status'],
  ];

  /*cs_statusyの値*/
  public const csCategory = [
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
}
