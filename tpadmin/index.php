<?php
require_once '../_app/ssl_base.php'; ?>
<?php
appConfigPage::$title = "管理画面";
?>
<?php require_once '../_tmpl/header.php'; ?>
<?php require_once '../_tmpl/l-header.php'; ?>

<div class="container pt-4">
    <div class="row">
        <div class="col-12 col-md-4 pb-2">
            <a class="p-3 color-dgray border text-center d-block bg-white" href="<?php echo appConfigSite::sitemap['adminPrint']['path']; ?>">
                <span class="d-block font-size-3 pb-3"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
                <span class="d-block pb-2"><?php echo appConfigSite::sitemap['adminPrint']['title']; ?></span>
            </a>
        </div>
    </div>
</div>

<?php require_once '../_tmpl/l-footer.php'; ?>
<?php require_once '../_tmpl/footer.php'; ?>