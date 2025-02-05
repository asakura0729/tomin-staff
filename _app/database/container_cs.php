<?php
//======================================================================
// DB：コンテナ（顧客対応）
//======================================================================
class appDatabaseContainerCs extends appConfigDatabase
{
  /*テーブル名*/
  public const tableName = 'container_cs';
  /*テーブルのインデックス*/
  public const primaryKey = 'container_cs_id';
  /*テーブル構成*/
  public const table = [
    self::primaryKey => [self::row => self::primaryKey, self::auto_increment => true],
    'funeral_id' => [self::row => 'funeral_id', 'title' => '葬儀ID'],
    'fc_id' => [self::row => 'fc_id', 'title' => '顧客ID'],
    'approval_date' => [self::row => 'approval_date', 'title' => '承認日時'],
    self::approval_status => [self::row => self::approval_status, 'title' => '承認状況', 'value' => self::statusNone],
    'approval_comment' => [self::row => 'approval_comment', 'title' => '承認コメント'],
    'approval_by' => [self::row => 'approval_by', 'title' => '承認者'],
    'insert_date' => [self::row => 'insert_date'],
    'update_date' => [self::row => 'update_date'],
    'insert_by' => [self::row => 'insert_by'],
    'update_by' => [self::row => 'update_by'],
    'deleteFlg' => [self::row => 'deleteFlg', 'value' => 0]
  ];
  public const approval_status = 'approval_status';

  /*approval_statusの値*/
  public const status = [
    self::statusNone => '未承認',
    self::statusSuccess  => '承認',
    self::statusRemand  => '差戻し'
  ];
  public const statusNone = 'none';
  public const statusSuccess = 'success';
  public const statusRemand = 'remand';
}
