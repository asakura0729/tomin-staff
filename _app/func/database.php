<?php
//======================================================================
// データベース送受信
//======================================================================
class appFuncDatabase
{
    //-----------------------------------------------------
    // データベース接続
    //-----------------------------------------------------
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

    //-----------------------------------------------------
    // データ取得
    //-----------------------------------------------------
    public static function getData(string $sql, array $params = []): array
    {
        try {
            $dbh = self::connect();
            $sth = $dbh->prepare($sql);
            $sth->execute($params);
            $results = $sth->fetchAll();
        } catch (PDOException $e) {
            echo 'Error:' . $e->getMessage();
            return false;
        }
        return $results;
    }

    //-----------------------------------------------------
    // データ取得（一件）
    //-----------------------------------------------------
    public static function getSingleData(string $sql, array $params = []): array
    {
        $results = self::getData($sql, $params);
        if (isset($results[0])) {
            return $results[0];
        }
        return [];
    }

    //-----------------------------------------------------
    // データ更新
    //-----------------------------------------------------
    public static function updateData(string $sql, array $params = []): bool
    {
        try {
            $dbh = self::connect();
            $sth = $dbh->prepare($sql);
            $results = $sth->execute($params);
        } catch (PDOException $e) {
            echo 'Error:' . $e->getMessage();
            return false;
        }
        return $results;
    }
}
