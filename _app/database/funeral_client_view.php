<?php
//======================================================================
// DB：'funeral_client'　顧客情報(葬儀情報結合)
//======================================================================
class appDatabaseFuneralclientView extends appConfigDatabase
{

  /*テーブル名*/
  public const tableName = 'funeral_client_view';
  /*テーブルのインデックス*/
  public const primaryKey = 'fc_id';
  /*テーブル構成*/
  public const table = [
    appDatabaseFuneralclient::primaryKey => appDatabaseFuneralclient::table[appDatabaseFuneralclient::primaryKey],
    'funeral_id' => appDatabaseFuneralclient::table['funeral_id'],
    'fc_status' => appDatabaseFuneralclient::table['fc_status'],
    'fc_lname' => appDatabaseFuneralclient::table['fc_lname'],
    'fc_fname' => appDatabaseFuneralclient::table['fc_fname'],
    'fc_lname_kana' => appDatabaseFuneralclient::table['fc_lname_kana'],
    'fc_fname_kana' => appDatabaseFuneralclient::table['fc_fname_kana'],
    'fc_tel' => appDatabaseFuneralclient::table['fc_tel'],
    'fc_gender' => appDatabaseFuneralclient::table['fc_gender'],
    'fc_region' => appDatabaseFuneralclient::table['fc_region'],
    'fc_relation' => appDatabaseFuneralclient::table['fc_relation'],
    'funeral_status' => appDatabaseFuneral::table['funeral_status'],
    'funeral_category' => appDatabaseFuneral::table['funeral_category'],
    'decd_lname' => appDatabaseFuneral::table['decd_lname'],
    'decd_fname' => appDatabaseFuneral::table['decd_fname'],
    'decd_lname_kana' => appDatabaseFuneral::table['decd_lname_kana'],
    'decd_fname_kana' => appDatabaseFuneral::table['decd_fname_kana'],
    'decd_gender' => appDatabaseFuneral::table['decd_gender'],
    'plan' => appDatabaseFuneral::table['plan'],
    'insert_date' => appDatabaseFuneral::table['insert_date'],
    'update_date' => appDatabaseFuneral::table['update_date'],
    'insert_by' => appDatabaseFuneral::table['insert_by'],
    'update_by' => appDatabaseFuneral::table['update_by'],
    'deleteFlg' => appDatabaseFuneral::table['deleteFlg']
  ];
}
