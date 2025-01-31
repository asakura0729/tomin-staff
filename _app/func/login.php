<?php
class appFuncLogin
{
    public static $postId = "";
    public static $postPassword = "";
    public static $sessionLoginStatus = "";
    public static $sessionLoginName = "";

    public static function sessionLogin(): array
    {
        $session = [];
        if (isset($_POST['id']) && isset($_POST['password'])) {
            foreach (appConfigUser::list as $key => $value) {
                if ($value['loginid'] === $_POST['id'] && $value['password'] === $_POST['password']) {
                    $session[appConfigSession::loginStatus] = true;
                    $session[appConfigSession::userId] = $value['userid'];
                    $session[appConfigSession::loginId] = $value['loginid'];
                    $session[appConfigSession::userName] = $value['username'];
                    break;
                }
            }
        }
        return $session;
    }

    public static function loginCheck(): bool
    {
        if (isset($_SESSION[appConfigSession::loginStatus])) {
            if ($_SESSION[appConfigSession::loginStatus] === true) {
                return true;
            }
        }
        return false;
    }

    public static function redirect($path)
    {
        if (!isset($_SESSION[appConfigSession::loginStatus])) {
            header('location:' . $path);
            exit();
        }
    }

    public static function loginRedirect($path)
    {
        if (isset($_SESSION[appConfigSession::loginStatus]) && $_SESSION[appConfigSession::loginStatus] == true) {
            header('location:' . $path);
            exit();
        }
    }

    public static function checkLogout($session, $post): array
    {
        if (isset($post['logout']) && $post['logout'] == 1) {
            return [];
        } else {
            return $session;
        }
    }
}
