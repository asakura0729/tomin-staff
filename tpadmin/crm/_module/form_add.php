<div class="pb-3 animation-fadein">
    <header class="d-flex justify-content-between align-items-center w-100 pb-2">
        <?php appLibraryDisp::globalModule('form/label', ['title' => $option['table']['title']]); ?>
        <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-add data-hx-get="/tpadmin/crm/ajax/add_text?input_name=' . $option['table'][appConfigDatabase::row] . '" data-hx-target="#' . $option['id'] . '" hx-swap="afterbegin"']); ?>
    </header>
    <div id="<?php echo $option['id']; ?>" class="item-area bg-llgray p-2">
        <?php appLibraryDisp::globalModule('comp/nodata', ['title' => '未登録']); ?>
    </div>
</div>