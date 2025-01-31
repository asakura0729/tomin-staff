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
            exit;
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
    public const updateDataBool = 'bool'; //DB登録の成否（true...成功）
    public const updateDataMsg = 'msg'; //エラーメッセージ
    public const updateDataLastInsertId = 'lastInsertId'; //登録したID
    public const updateDataResults = [
        self::updateDataBool => true,
        self::updateDataMsg => '',
        self::updateDataLastInsertId => ''
    ];
    public static function updateData(string $sql, array $params = []): array
    {
        $results = self::updateDataResults;
        $bool = true;
        $msg = "";
        $lastInsertId = "";
        try {
            $dbh = self::connect();
            $sth = $dbh->prepare($sql);
            $msg = '';
            $bool = $sth->execute($params);
            $lastInsertId = $dbh->lastInsertId();
        } catch (PDOException $e) {
            $msg = 'Error:' . $e->getMessage();
            $bool = false;
        }
        $results = [
            self::updateDataBool => $bool,
            self::updateDataMsg => $msg,
            self::updateDataLastInsertId => $lastInsertId
        ];
        return $results;
    }
}
