<?php require_once __DIR__ . '../../../../_app/ssl_base.php'; ?>
<?php require_once '../../_tmpl/ajax.php'; ?>

<div class="container animation-fadein-topslide">
    <div class="row">
        <?php foreach (appRoutesWeb::gNav as $key => $value): ?>
            <div class="col-3 p-2">
                <div class="bg-white border rounded-lg">
                    <a class="btn w-100 pb-4" <?php echo appFuncDisp::hxLink(appRoutesWeb::sitemap[$key]); ?>>
                        <div class="font-size-4 color-gray pb-2"><i class="fa <?php echo appRoutesWeb::sitemap[$key][appRoutesWeb::pageIcon]; ?>" aria-hidden="true"></i></div>
                        <span class="color-dgray"><?php echo appRoutesWeb::sitemap[$key][appRoutesWeb::pageTitle]; ?></span>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>