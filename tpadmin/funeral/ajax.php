<?php require_once '../../_app/http/tpadmin/funeral/ajax.php'; ?>

<section id="form-search" class="pb-3 animation-fadein">
    <form class="bg-white p-3" data-hx-get="<?php echo appLibraryDisp::ajaxPath('funeralResult'); ?>" data-hx-target="#form-results">
        <div class="row align-items-center no-gutters">
            <div class="col-2 pb-1">
                <h1 class="font-size-2 text-center m-0 p-0 line-height-0">顧客検索</h1>
            </div>
            <div class="col-4 d-flex">
                <?php appLibraryDisp::form('radio_nav', 'str', '', 'cl_name', ['selectItem' => appLibraryCrm::search]); ?>
            </div>
            <div class="col-6">
                <?php appLibraryDisp::form('search', 'search', '検索', '', ['placeholder' => '検索したい文字列を入力']); ?>
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