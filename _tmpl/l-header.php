<?php if (appConfigPage::$tmpl != 'simple') : ?>
    <header id="page-header" class="l-header w-100 color-contrast position-fixed bg-white border-bottom">
        <div class="d-flex align-items-center justify-content-between bg-contrast">
            <div class="pl-4 font-notoserif">
                <?php if (appFuncLogin::loginCheck() == true) : ?>
                    <a class="color-white d-block" href="<?php echo appRoutesWeb::sitemap['admin']['path']; ?>">都民のお葬式</a>
                <?php else: ?>
                    <span class="color-white d-block">都民のお葬式</span>
                <?php endif; ?>
            </div>
            <?php if (appFuncLogin::loginCheck() == true) : ?>
                <form method="post" class="dropdown">
                    <button class="btn dropdown-toggle color-white align-top p-0 pb-1 pl-2 pr-3" type="button" id="page-header-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="color-white"><span class="pr-2"><?php echo $_SESSION[appConfigSession::userName]; ?></span>がログイン中</span>
                    </button>
                    <div class="dropdown-menu w-100" aria-labelledby="page-header-dropdown">
                        <button type="submit" class="dropdown-item">ログアウト</button>
                    </div>
                    <input type="hidden" name="logout" value="1">
                </form>
            <?php endif; ?>
        </div>
        <?php if (appFuncLogin::loginCheck() == true) : ?>
            <nav class="nav">
                <?php foreach (appRoutesWeb::headerNav as $key => $value): ?>
                    <?php appLibraryDisp::globalModule('btn/hx-gnav', ['page' => $key]); ?>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>
    </header>
<?php endif; ?>