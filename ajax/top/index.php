<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>

<div class="container animation-fadein-topslide">
    <div class="row">
        <?php foreach (appRoutesWeb::gNav as $key => $value): ?>
            <div class="col-6 col-md-4 col-lg-3 p-2">
                <div class="bg-white border rounded-lg position-relative">
                    <a class="btn w-100 pb-4" <?php echo appFuncDisp::hxLink(appRoutesWeb::sitemap[$key]); ?>>
                        <div class="font-size-4 color-gray pb-2"><i class="fa <?php echo appRoutesWeb::sitemap[$key][appRoutesWeb::pageIcon]; ?>" aria-hidden="true"></i></div>
                        <span class="color-dgray"><?php echo appRoutesWeb::sitemap[$key][appRoutesWeb::pageTitle]; ?></span>
                    </a>
                    <?php if ($value[appRoutesWeb::pagePath] === appRoutesWeb::gNav['adminCsList_check'][appRoutesWeb::pagePath]): ?>
                        <div class="pos-top-left">
                            <div class="pl-2 font-size-1_4" hx-get="<?php echo appRoutesWeb::async['adminCount_approval']['contents']; ?>" hx-trigger="load, every 15s" hx-swap="innerHTML"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>