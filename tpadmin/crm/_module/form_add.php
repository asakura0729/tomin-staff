<div class="pb-3 animation-fadein">
    <header class="d-flex justify-content-between align-items-center w-100 pb-2">
        <?php appLibraryDisp::globalModule('form/label', ['title' => $option['table']['title']]); ?>
        <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-additem data-hx-get="/tpadmin/crm/ajax/add_text" data-hx-target="#' . $option['id'] . '" hx-swap="afterbegin"']); ?>
    </header>
    <?php /*要改善*/ ?>
    <div id="<?php echo $option['id']; ?>" class="item-area bg-llgray p-2" data-additem-push='[name="<?php echo $option['table'][appConfigDatabase::row]; ?>"]'>
        <?php if (isset($option['result'][$option['table'][appConfigDatabase::row] . '_jd']) && count($option['result'][$option['table'][appConfigDatabase::row] . '_jd']) > 0) : ?>
            <?php foreach ($option['result'][$option['table'][appConfigDatabase::row] . '_jd'] as $value): ?>
                <?php appLibraryDisp::module('../_module/form_add_text.php', ['inputName' => 'item', 'value' => $value]); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?php appLibraryDisp::globalModule('comp/nodata', ['title' => '未登録']); ?>
        <?php endif; ?>
    </div>
    <?php appLibraryDisp::dbform('hidden',  [$option['table'][appConfigDatabase::row]], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
</div>