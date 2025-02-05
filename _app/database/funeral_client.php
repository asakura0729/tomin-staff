<?php
//======================================================================
// DB：'funeral_client'　顧客情報
//======================================================================
class appDatabaseFuneralclient extends appConfigDatabase
{

  /*テーブル名*/
  public const tableName = 'funeral_client';
  /*テーブルのインデックス*/
  public const primaryKey = 'fc_id';
  /*テーブル構成*/
  public const table = [
    self::primaryKey => [self::row => self::primaryKey, self::auto_increment => true],
    'funeral_id' => [self::row => 'funeral_id'],
    'fc_status' => [self::row => 'fc_status', 'title' => '資料請求'],
    'fc_lname' => [self::row => 'fc_lname', 'title' => '苗字', 'placeholder' => '都民'],
    'fc_fname' => [self::row => 'fc_fname', 'title' => '名前', 'placeholder' => '太郎'],
    'fc_lname_kana' => [self::row => 'fc_lname_kana', 'title' => '苗字（カナ）', 'placeholder' => 'トミン'],
    'fc_fname_kana' => [self::row => 'fc_fname_kana', 'title' => '名前（カナ）', 'placeholder' => 'タロウ'],
    'fc_tel' => [self::row => 'fc_tel', 'title' => '電話番号', 'placeholder' => '09012345678'],
    'fc_gender' => [self::row => 'fc_gender', 'title' => '性別'],
    'fc_region' => [self::row => 'fc_region', 'title' => '住民票', 'placeholder' => '東京都港区'],
    'fc_address' => [self::row => 'fc_address', 'title' => '住所', 'placeholder' => '東京都港区○○○○'],
    'fc_relation' => [self::row => 'fc_relation', 'title' => '続柄', 'placeholder' => '長男'],
    'fc_comment' => [self::row => 'fc_comment', 'title' => 'コメント'],
    'insert_date' => [self::row => 'insert_date'],
    'update_date' => [self::row => 'update_date'],
    'insert_by' => [self::row => 'insert_by'],
    'update_by' => [self::row => 'update_by'],
    'deleteFlg' => [self::row => 'deleteFlg', 'value' => 0]
  ];
  /*顧客ステータス（資料請求）*/
  public const status = [
    'none' => 'なし',
    'doc_request' => 'あり',
  ];
}
