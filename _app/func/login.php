<?php
class appFuncLogin
{
    public static $postId = "";
    public static $postPassword = "";
    public static $sessionLoginStatus = "";
    public static $sessionLoginName = "";

    public function sessionLogin($array, $post, $loginStatus, $user): array
    {
        $session = [];
        if (isset($post['id']) && isset($post['password'])) {
            foreach ($array as $key => $value) {
                if ($value['id'] === $post['id'] && $value['password'] === $post['password']) {
                    $session[$loginStatus] = true;
                    $session[$user] = $value['id'];
                    break;
                }
            }
        }
        return $session;
    }

    public function sessionUser($session)
    {
        if (isset($session['user'])) {
            return $session['user'];
        } else {
            return '---';
        }
    }

    public function loginCheck($session, $loginStatus)
    {
        if (isset($session[$loginStatus])) {
            if ($session[$loginStatus] === true) {
                return true;
            }
        }
        return false;
    }

    public function redirect($session, $path, $loginStatus)
    {
        if (!isset($session[$loginStatus])) {
            header('location:' . $path);
            exit();
        }
    }

    public function loginRedirect($session, $path, $loginStatus)
    {
        if (isset($session[$loginStatus]) && $session[$loginStatus] == true) {
            header('location:' . $path);
            exit();
        }
    }

    public function logout($session, $post): array
    {
        if (isset($post['logout']) && $post['logout'] == 1) {
            return [];
        } else {
            return $session;
        }
    }
}
