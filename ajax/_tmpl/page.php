<?php foreach (appRoutesWeb::sitemap as $key => $value): ?>
    <?php if ($value['contents'] != appConfigPage::$path): ?>
        <?php continue; ?>
    <?php elseif (appFuncSession::checkAuth($value['authority']) === false): ?>
        <?php appFuncModule::component('401'); ?>
        <?php exit; ?>
    <?php elseif (isset($value['route'])): ?>
        <?php appConfigPage::$title = $value['title'] . appConfigPage::$titleAdd; ?>
        <title><?php echo appConfigPage::$title . '｜' . appConfigSite::siteName; ?></title>
        <nav id="breadcrumb" class="l-breadcrumb print-none" aria-label="breadcrumb" data-layout-wide>
            <ol class="pos-sticky d-flex pl-3 bg-none">
                <li class="breadcrumb-item"><a <?php echo appFuncDisp::hxLink(appRoutesWeb::sitemap['admin']); ?>><?php echo appRoutesWeb::sitemap['admin']['title']; ?></a></li>
                <?php foreach ($value['route'] as $routeKey): ?>
                    <li class="breadcrumb-item"><a <?php echo appFuncDisp::hxLink(appRoutesWeb::sitemap[$routeKey]); ?>><?php echo appRoutesWeb::sitemap[$routeKey]['title']; ?></a></li>
                <?php endforeach; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $value['title']; ?></li>
            </ol>
        </nav>
        <?php break; ?>
    <?php endif; ?>
<?php endforeach; ?>

