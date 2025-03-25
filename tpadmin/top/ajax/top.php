<?php require_once __DIR__ . '../../../../_app/ssl_base.php'; ?>

<div class="d-flex container">
    <?php foreach (appRoutesWeb::gNav as $key => $value): ?>
        <div class="p-2">
            <div class="w-200px bg-white border rounded-lg">
                <a class="btn w-100 pb-4" <?php echo appFuncDisp::hxLink($key); ?>>
                    <div class="font-size-4 color-gray pb-2"><i class="fa <?php echo appRoutesWeb::sitemap[$key]['icon']; ?>" aria-hidden="true"></i></div>
                    <span class="color-dgray"><?php echo appRoutesWeb::sitemap[$key]['title']; ?></span>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>