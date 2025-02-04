<?php
//======================================================================
// DB：'funeral'　葬儀情報
//======================================================================
class appDatabaseFuneral extends appConfigDatabase
{

  /*テーブル名*/
  public const tableName = 'funeral';
  /*テーブルのインデックス*/
  public const primaryKey= 'funeral_id';
  /*テーブル構成*/
  public const table = [
    self::primaryKey => [self::row => self::primaryKey, self::auto_increment => true],
    'funeral_status' => [self::row => 'funeral_status', 'title' => '進捗状況'],
    'decd_lname' => [self::row => 'decd_lname', 'title' => '苗字', 'placeholder' => '都民'],
    'decd_fname' => [self::row => 'decd_fname', 'title' => '名前', 'placeholder' => '太郎'],
    'decd_lname_kana' => [self::row => 'decd_lname_kana', 'title' => '苗字（カナ）', 'placeholder' => 'トミン'],
    'decd_fname_kana' => [self::row => 'decd_fname_kana', 'title' => '名前（カナ）', 'placeholder' => 'タロウ'],
    'decd_gender' => [self::row => 'decd_gender', 'title' => '性別'],
    'decd_region' => [self::row => 'decd_region', 'title' => '住民票', 'placeholder' => '東京都港区'],
    'plan' => [self::row => 'plan', 'title' => '葬儀プラン'],
    'ensconce' => [self::row => 'ensconce', 'title' => '安置方法', 'placeholder' => '自宅安置'],
    'ensconce_address' => [self::row => 'ensconce_address', 'title' => '安置場所', 'placeholder' => '自宅'],
    'dest_name' => [self::row => 'dest_name', 'title' => 'お迎え先', 'placeholder' => '病院'],
    'dest_address' => [self::row => 'dest_address', 'title' => 'お迎え先住所', 'placeholder' => '東京都港区○○'],
    'funeral_date' => [self::row => 'funeral_date', 'title' => '葬儀希望日'],
    'hall' => [self::row => 'hall', 'title' => '葬儀式場', 'placeholder' => 'セレモニーホール都民'],
    'crematory' => [self::row => 'crematory', 'title' => '希望火葬場', 'placeholder' => '都民火葬場'],
    'option' => [self::row => 'option', 'title' => 'オプション'],
    'totalpeople' => [self::row => 'totalpeople', 'title' => '葬儀参列人数', 'placeholder' => '0'],
    'funeral_comment' => [self::row => 'funeral_comment', 'title' => 'コメント'],
    'insert_date' => [self::row => 'insert_date', 'value' => 'datetime'],
    'update_date' => [self::row => 'update_date', 'value' => 'datetime'],
    'insert_by' => [self::row => 'insert_by', 'value' => 'int'],
    'update_by' => [self::row => 'update_by', 'value' => 'int'],
    'deleteFlg' => [self::row => 'deleteFlg', 'value' => false]
  ];
}
