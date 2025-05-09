<?php
//======================================================================
// ユーザー情報
//======================================================================
class appConfigUser
{
    /*権限レベル*/
    public const authorityManager = 'manager'; // 管理者
    public const authorityStaff = 'staff'; //スタッフ
    public const authorityLevel = [
        self::authorityManager  => 3,
        self::authorityStaff => 2,
    ];

    /*ユーザー一覧*/
    public const list = [
        '1' => ['userid' => '1', 'loginid' => 'tpf', 'password' => 'tp0135', 'username' => 'スタッフ', 'authority' => self::authorityStaff],
        '2' => ['userid' => '2', 'loginid' => 'master', 'password' => 'master', 'username' => '管理者', 'authority' => self::authorityManager],
        '3' => ['userid' => '3', 'loginid' => 'test', 'password' => 'test0509', 'username' => 'TEST', 'authority' => self::authorityStaff],
    ];
}
