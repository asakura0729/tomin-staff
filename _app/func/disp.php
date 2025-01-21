<?php
class appFuncDisp
{
    public function h1($tmpl, $title, $addText = null)
    {
        include $tmpl;
    }

    public function h2($tmpl, $title, $add = null)
    {
        include $tmpl;
    }

    public function form($tmpl, $title, $name, $value = null, $placeholder = null,  $add = null)
    {
        include $tmpl;
    }

    public function formChoices($tmpl, $title, $name, $value = null, $choices = array(),  $add = null)
    {
        include $tmpl;
    }

    public function btn($tmpl, $title, $classIcon = null, $add = null)
    {
        include $tmpl;
    }

    public function page404($result, $directory = './')
    {
        if (count($result) === 0) {
            appConfigPage::$title = "ページにアクセスできません";
            require_once $directory . '_tmpl/header.php';
            require_once $directory . '_tmpl/l-header.php';
            require_once $directory . '_module/404.php';
            require_once $directory . '_tmpl/l-footer.php';
            require_once $directory . '_tmpl/footer.php';
            exit();
        }
    }
}
