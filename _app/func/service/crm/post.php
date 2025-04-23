<?php
//======================================================================
// CRM＞データ送信
//======================================================================
class appFuncCrmPost
{
    //-----------------------------------------------------
    // データベースに対応ログを追加／更新
    //-----------------------------------------------------
    public static function csData($post): string
    {
        $result = "";
        if (!isset($post[appDatabaseCs::primaryKey])) {
            return $result;
        }
        if ($post[appDatabaseCs::primaryKey] != '') {
            /*分岐1：更新*/
            $dbResult = self::updateCsData($post);
            $result = $post[appDatabaseCs::primaryKey];
        } else {
            /*分岐2：新規追加*/
            $dbResult = self::insertCsData($post);
            $result = $dbResult[appFuncDatabase::updateDataLastInsertId];
        }
        if ($dbResult['bool'] === false) {
            echo "エラー：" . $dbResult['msg'];
            exit;
        }
        return $result;
    }
    //-----------------------------------------------------
    // データベースに対応ログを追加
    //-----------------------------------------------------
    private static function insertCsData($post): array
    {
        $result = [];
        $dbPost = appFuncDataformat::dbPostParam(appDatabaseCs::className, $post);
        $sql = appFuncSql::insertSql(appDatabaseCs::className, $dbPost);
        $param = appFuncDataformat::bindParam($dbPost);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
    //-----------------------------------------------------
    // データベース内の対応ログを更新
    //-----------------------------------------------------
    private static function updateCsData($post)
    {
        $primaryKey = $post[appDatabaseCs::primaryKey];
        $dbPost = appFuncDataformat::dbPostParam(appDatabaseCs::className, $post);
        $sql = appFuncSql::updateSql(appDatabaseCs::className, $dbPost);
        $sql .= ' WHERE ';
        $sql .= appDatabaseCs::primaryKey . '="' .  $primaryKey . '"';
        $param = appFuncDataformat::bindParam($dbPost);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
}
