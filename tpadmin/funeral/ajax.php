<?php require_once '../../_app/ssl_base.php'; ?>

<section id="form-search" class="pb-3 animation-fadein">
    <form class="bg-white p-4 p-lg-3" data-hx-get="<?php echo appLibraryDisp::ajaxPath('funeralResult'); ?>" data-hx-target="#form-results">
        <div class="row align-items-center no-gutters">
            <div class="col-12 col-lg-2 p-4 p-lg-0 pb-lg-1">
                <h1 class="font-size-2 text-center m-0 p-0 line-height-0">
                    <a class="cursor-pointer" <?php appLibraryDisp::hxLink('adminFuneral'); ?>>顧客検索</a>
                </h1>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <?php appLibraryDisp::form('radio_nav', appRoutesWeb::getRow, '', 'cl_name', ['selectItem' => appLibraryCrm::search]); ?>
            </div>
            <div class="col-12 col-lg-6">
                <?php appLibraryDisp::form('search', appRoutesWeb::getWords, '検索', '', ['placeholder' => '検索したい文字列を入力']); ?>
            </div>
        </div>
    </form>
</section>

<div id="form-results" class="pb-5" data-hx-get="<?php echo appLibraryDisp::ajaxPath('funeralResult', appFuncPath::getQuery()); ?>" data-hx-trigger="load once"></div>

<script>
    if (typeof searchForm === 'undefined') {
        const searchForm = (function() {
            const newElement = document.createElement("div");
            newElement.innerHTML = document.getElementById("form-search").innerHTML;
            document.getElementById("form-search").innerHTML = newElement.innerHTML;
            htmx.process(newElement);
        })();
    }
</script>