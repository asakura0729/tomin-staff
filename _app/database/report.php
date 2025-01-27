<?php
//======================================================================
// DB：'repost'　レポート関係全般
//======================================================================

class appDatabaseReport extends appConfigDatabase
{

  /*テーブル名*/
  public const tableName = 'funeral';
  /*テーブルのインデックス*/
  public const primaryKey = 'funeral_id';
  /*テーブル構成*/
  public const table = [
    self::primaryKey => [self::row => self::primaryKey, self::auto_increment => true],
    'report_category' => [self::row => 'report_category', 'title' => 'カテゴリ'],
    'disp_flg' => [self::row => 'disp_flg', 'title' => '表示_非表示'],
    'title' => [self::row => 'decd_fname', 'title' => 'タイトル', 'placeholder' => 'タイトル'],
    'comment' => [self::row => 'funeral_comment', 'title' => 'コメント', 'placeholder' => '任意の文章を入力'],
    'insert_date' => [self::row => 'insert_date'],
    'update_date' => [self::row => 'update_date'],
    'insert_by' => [self::row => 'insert_by'],
    'update_by' => [self::row => 'update_by'],
    'deleteFlg' => [self::row => 'deleteFlg']
  ];
  public const tableCs = [
    'report_id' => [self::row => 'report_id', self::auto_increment => true],
    'client_id' => [self::row => 'client_id', 'title' => '顧客ID'],
    'cs_category' => [self::row => 'cs_category', 'title' => 'カテゴリ'],
    'cs_status' => [self::row => 'cs_status', 'title' => '状況'],
  ];
  public const tableTel = [
    'report_id' => [self::row => 'report_id', self::auto_increment => true],
    'tel_date' => [self::row => 'tel_date', 'title' => '架電日時'],
    'tel_status' => [self::row => 'tel_status', 'title' => '状況'],
    'tel_by' => [self::row => 'tel_by'],
  ];
}
