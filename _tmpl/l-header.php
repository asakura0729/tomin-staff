<header id="page-header" class="l-header w-100 color-contrast position-fixed bg-white border-bottom">
    <div class="d-flex align-items-center justify-content-between bg-contrast">
        <div class="pl-2 font-notoserif">
            <a class="btn color-white font-weight-bold p-0" <?php if (appFuncSession::loginCheck() == true) : ?><?php echo appFuncDisp::hxLink(appRoutesWeb::sitemap["admin"]); ?><?php endif; ?>>
                <span class="pl-1"><?php echo appConfigSite::siteName; ?></span>
            </a>
        </div>
        <?php if (appFuncSession::loginCheck() === true) : ?>
            <form method="post" class="dropdown">
                <button id="page-header-dropdown" class="btn dropdown-toggle color-white align-top p-0 pb-1 pl-2 pr-3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="color-white">
                        <span class="pr-2"><?php echo $_SESSION[appConfigSession::userName]; ?></span>がログイン中
                    </span>
                </button>
                <div class="dropdown-menu w-100 p-2" aria-labelledby="page-header-dropdown">
                    <button type="submit" class="btn dropdown-item"><i class="fa fa-sign-out pr-2 color-contrast" aria-hidden="true"></i>ログアウト</button>
                </div>
                <input type="hidden" name="logout" value="<?php echo appConfigSession::logoutValue; ?>">
            </form>
        <?php endif; ?>
    </div>
    <?php if (appFuncSession::loginCheck() === true) : ?>
        <nav id="page-header-gnav" class="nav">
            <?php foreach (appRoutesWeb::gNav as $key => $value): ?>
                <a id="page-header-gnav-<?php echo strtolower($key); ?>" class="mr-1 btn rounded-0 gnav-link<?php if (appConfigPage::$path === appRoutesWeb::sitemap[$key]['path']): ?> is-current<?php endif; ?>" <?php echo appFuncDisp::hxLink(appRoutesWeb::sitemap[$key]); ?>>
                    <span class="color-dgray"><?php echo appRoutesWeb::sitemap[$key][appRoutesWeb::pageTitle]; ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
    <?php endif; ?>
</header>