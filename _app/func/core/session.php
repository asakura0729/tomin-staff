<?php
//======================================================================
// セッション操作
//======================================================================
class appFuncSession
{
    public const loginStatus = appConfigSession::loginStatus;
    public const userId = appConfigSession::userId;
    public const loginId = appConfigSession::loginId;
    public const userName = appConfigSession::userName;
    public const authority = appConfigSession::authority;
    public const authorityList = appConfigUser::authority;

    //-----------------------------------------------------
    // ログインセッションを付与
    //-----------------------------------------------------
    public static function sessionLogin(): array
    {
        $session = [];
        if (isset($_POST['id']) && isset($_POST['password'])) {
            foreach (appConfigUser::list as $key => $value) {
                if ($value['loginid'] === $_POST['id'] && $value['password'] === $_POST['password']) {
                    $session[self::loginStatus] = true;
                    $session[self::userId] = $value['userid'];
                    $session[self::loginId] = $value['loginid'];
                    $session[self::userName] = $value['username'];
                    $session[self::authority] = $value['authority'];
                    break;
                }
            }
        }
        return $session;
    }

    //-----------------------------------------------------
    // ログイン状況確認
    //-----------------------------------------------------
    public static function loginCheck(): bool
    {
        if (isset($_SESSION[self::loginStatus])) {
            if ($_SESSION[self::loginStatus] === true) {
                return true;
            }
        }
        return false;
    }

    //-----------------------------------------------------
    // ログアウト状態であれば指定されたページに移動
    //-----------------------------------------------------
    public static function redirect($path)
    {
        if (!isset($_SESSION[self::loginStatus])) {
            header('location:' . $path);
            exit();
        }
    }

    //-----------------------------------------------------
    // ログイン状態であれば指定されたページに移動
    //-----------------------------------------------------
    public static function loginRedirect($path)
    {
        if (isset($_SESSION[self::loginStatus]) && $_SESSION[self::loginStatus] == true) {
            header('location:' . $path);
            exit();
        }
    }

    //-----------------------------------------------------
    // ログアウト状態であればセッション削除
    //-----------------------------------------------------
    public static function checkLogout($session, $post): array
    {
        if (isset($post['logout']) && $post['logout'] === appConfigSession::logoutValue) {
            return [];
        } else {
            return $session;
        }
    }

    //-----------------------------------------------------
    // 権限確認(true...権限あり)
    //-----------------------------------------------------
    public static function checkAuth($key): bool
    {
        $authorityKey = $_SESSION[self::authority];
        if (self::authorityList[$authorityKey] >= self::authorityList[$key]) {
            return true;
        } else {
            return false;
        }
    }
}
