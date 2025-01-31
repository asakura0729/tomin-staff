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
    'approval_status' => [self::row => 'approval_status', 'title' => '承認状況'],
    'approval_comment' => [self::row => 'approval_by', 'title' => '承認コメント'],
    'approval_by' => [self::row => 'approval_by', 'title' => '承認者'],
    'insert_date' => [self::row => 'insert_date'],
    'update_date' => [self::row => 'update_date'],
    'insert_by' => [self::row => 'insert_by'],
    'update_by' => [self::row => 'update_by'],
    'deleteFlg' => [self::row => 'deleteFlg']
  ];
  /*approval_statusの値*/
  public const status = [
    'none' => '未承認',
    'approval'  => '承認',
    'remand'  => '差戻し'
  ];
}
