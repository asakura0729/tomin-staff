<?php require_once __DIR__ . '../../_app/ssl_base.php'; ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php appConfigPage::$title = appConfigSite::siteName; ?>
<?php require_once __DIR__ . '../../_tmpl/header.php'; ?>
<?php require_once __DIR__ . '../../_tmpl/l-header.php'; ?>

<main id="page-top" class="l-wrap" data-hx-history-elt>
    <?php if (appConfigSite::maintenance == true) : ?>
        <div class="container print-none">
            <div class="alert alert-danger p-2 text-center" role="alert">
                ただいまメンテナンス作業を行っています。データ登録・変更の操作は控えてください。
            </div>
        </div>
    <?php endif; ?>
    <?php $includeFile = appFuncPath::hxGet(); ?>
    <?php if ($includeFile != ''): ?>
        <div id="page-main" class="l-main" data-hx-get="<?php echo $includeFile; ?>" data-hx-trigger="load once"></div>
    <?php else: ?>
        <div id="page-main" class="l-main"><?php appFuncModule::component('404'); ?></div>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '../../_tmpl/l-footer.php'; ?>
<?php appFuncMinify::minifySourceEnd(); ?>
<?php appFuncModule::js('common'); ?>
<?php require_once __DIR__ . '../../_tmpl/footer.php'; ?>