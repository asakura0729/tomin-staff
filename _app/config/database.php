<?php
//======================================================================
// データベースの設定
//======================================================================
class appConfigDatabase
{
  public const row = 'name';
  public const rowType = 'type';
  public const rowConstraints = 'constraints';
  public const rowInput = 'input';
  public const primaryKey = 'PRIMARY KEY';

  public const deleteFlgTrue = 1;
  public const deleteFlgFalse = 0;

  public const pageColCount = 20;
  public const pagerCount = 8;
}
