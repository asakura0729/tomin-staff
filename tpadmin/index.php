<?php require_once __DIR__ . '../../_app/ssl_base.php'; ?>
<?php appConfigPage::$title = appConfigSite::siteName; ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php require_once __DIR__ . '../../_tmpl/header.php'; ?>
<?php require_once __DIR__ . '../../_tmpl/l-header.php'; ?>

<main id="page-top" class="l-wrap" data-hx-history-elt>
    <div id="spinners" class="l-spinners"><?php appFuncModule::component('spinners-left'); ?></div>
    <div id="page-main" class="l-main" data-hx-get="<?php echo appFuncPath::hxGet(appRoutesWeb::async['adminApi404']['contents']); ?>" data-hx-trigger="load once"></div>
</main>

<?php require_once __DIR__ . '../../_tmpl/l-footer.php'; ?>
<?php appFuncMinify::minifySourceEnd(); ?>
<?php appFuncModule::js('common'); ?>
<?php require_once __DIR__ . '../../_tmpl/footer.php'; ?>