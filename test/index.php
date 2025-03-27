<?php
require_once '../_app/ssl_base.php'; ?>
<?php appConfigPage::$title = "TEST"; ?>
<?php require_once '../_tmpl/header.php'; ?>

<?php echo appLibraryCrm::getCsReportSql('10'); ?>

<section id="form" class="pb-3 animation-fadein">
    <?php echo $_SERVER['REQUEST_URI']; ?>
    <form class="bg-white p-3" data-hx-get="test" data-hx-target="#test">
        <div class="row align-items-center no-gutters">
            <div class="col-2 pb-1">
                <h1 class="font-size-2 text-center m-0 p-0 line-height-0">顧客検索</h1>
            </div>
            <div class="col-4 d-flex">
                <?php appFuncModule::form('radio_nav', 'str', '', 'cl_name', ['selectItem' => appLibraryCrm::search]); ?>
            </div>
            <div class="col-6">
                <?php appFuncModule::form('search', 'search', '検索', '', ['placeholder' => '検索したい文字列を入力']); ?>
            </div>
        </div>
    </form>
</section>

<div id="test" class="pb-5 animation-fadein delay-0_5">

</div>

<?php require_once '../_tmpl/l-footer.php'; ?>
<?php require_once '../_tmpl/footer.php'; ?>