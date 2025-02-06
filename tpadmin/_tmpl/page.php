<?php require_once __DIR__ . '../../../_app/ssl_base.php'; ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php appConfigPage::$title = "管理画面"; ?>
<?php require_once __DIR__ . '../../../_tmpl/header.php'; ?>
<?php require_once __DIR__ . '../../../_tmpl/l-header.php'; ?>

<main id="page-top" class="<?php if (appConfigPage::$tmpl != 'simple') : ?>l-wrap bg-lgray<?php endif; ?>">
    <?php if (appConfigSite::maintenance == true) : ?>
        <div class="container print-none">
            <div class="alert alert-danger p-2 text-center" role="alert">
                ただいまメンテナンス作業を行っています。データ登録・変更の操作は控えてください。
            </div>
        </div>
    <?php endif; ?>
    <div id="page-indicator" class="htmx-spinner">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div id="page-main" class="l-main" <?php appLibraryDisp::hxGet(); ?>></div>
</main>

<?php require_once __DIR__ . '../../../_tmpl/l-footer.php'; ?>
<?php require_once __DIR__ . '../../../_tmpl/footer.php'; ?>
<?php appFuncMinify::minifySourceEnd(); ?>