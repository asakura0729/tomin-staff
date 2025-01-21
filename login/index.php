<?php session_start(); ?>
<?php require_once '../_app/base.php'; ?>
<?php require_once '../_app/http/login/index.php'; ?>
<?php appConfigPage::$title = "宛名印刷"; ?>
<?php require_once '../_tmpl/header.php'; ?>
<?php require_once '../_tmpl/l-header.php'; ?>

<div class="container">
    <?php
    $errorFlag = appHttpAdminLoginIndex::$errorFlag;
    $title = "宛名印刷";
    require_once '../_module/form/login.php';
    ?>
</div>

<?php require_once '../_tmpl/l-footer.php'; ?>
<?php require_once '../_tmpl/footer.php'; ?>