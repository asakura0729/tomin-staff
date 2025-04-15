<?php
//======================================================================
// ユーザー情報
//======================================================================
class appConfigUser
{
    public const authorityManager = 'manager';
    public const authorityStaff = 'staff';
    public const authorityLevel = [
        self::authorityManager  => 3,
        self::authorityStaff => 2,
    ];

    public const list = [
        '1' => ['userid' => '1', 'loginid' => 'tpf', 'password' => 'tp0135', 'username' => 'スタッフ', 'authority' => self::authorityStaff],
        '2' => ['userid' => '2', 'loginid' => 'master', 'password' => 'master', 'username' => '管理者', 'authority' => self::authorityManager],
    ];
}
