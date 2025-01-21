<?php if (appConfigPage::$tmpl != 'simple') : ?>
    <header id="page-header" class="l-header w-100 bg-contrast color-contrast position-fixed box-shadow-l">
        <div class="container-fluid">
            <div class="row align-items-center no-gutters">
                <div class="col-4 col-lg-6 pl-4">
                    <?php if (isset($_SESSION) && appFuncLogin::loginCheck($_SESSION, 'adminlogin') == true) : ?>
                        <a class="navbar-brand color-white" href="<?php echo appConfigSite::sitemap['admin']['path']; ?>">
                            都民のお葬式
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (isset($_SESSION) && appFuncLogin::loginCheck($_SESSION, 'adminlogin') == true) : ?>
                    <div class="col-8 col-lg-6 text-right p-2">
                        <div class="d-inline-block pr-3 color-white">
                            <div class="d-inline-block align-middle">
                                <span class="pr-2">
                                    <?php echo appConfigSession::$userName; ?>
                                </span>
                                がログイン中
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <form method="post">
                                <input type="hidden" name="logout" value="1">
                                <button type="submit" class="btn border"><span class="color-white">ログアウト</span></button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
<?php endif; ?>

<article id="page-top" class="<?php if (appConfigPage::$tmpl != 'simple') : ?>l-wrap bg-lgray<?php endif; ?>">
    <?php if (appConfigSite::maintenance == true) : ?>
        <div class="container print-none">
            <div class="alert alert-danger p-2 text-center" role="alert">
                ただいまメンテナンス作業を行っています。データ登録・変更の操作は控えてください。
            </div>
        </div>
    <?php endif; ?>