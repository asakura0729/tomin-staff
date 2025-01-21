<?php
/*======================================================================

データベースまわりの関数

======================================================================*/
class appFuncDatabase
{
    //データベース接続
    public static function connect()
    {
        $dsn = sprintf(DB_DSN);
        $user = DB_USER;
        $password = DB_PASSWORD;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }
        return $dbh;
    }

    //データ取得
    public static function getData($dbh, $sql, $params = '')
    {
        $results = "";
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute($params);
            $results = $sth->fetchAll();
        } catch (PDOException $e) {
            $results = 'Error:' . $e->getMessage();
        }
        return $results;
    }

    //データ更新
    public static function updateData($dbh, $sql, $params = '')
    {
        $sth = $dbh->prepare($sql);
        $results = $sth->execute($params);
        $results = intval($results);
        return $results;
    }

    //データ挿入
    public static function insertData($dbh, $sql, $params = '')
    {
        $sth = $dbh->prepare($sql);
        $results = $sth->execute($params);
        $results = intval($results);
        return $results;
    }
}
