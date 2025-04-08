<?php
//======================================================================
// 汎用モジュール：検索フォーム
//$option['config']['dbTable']=[]...走査するテーブルのデータ
//$option['config']['cs_category']=""...検索対象のcs_category
//$option['config']['dropdown']=""...ドロップダウンメニューの内容を分岐
//======================================================================
?>
<form id="form-search" data-hx-get="<?php echo appRoutesWeb::sitemap['adminAjaxCstable']['contents']; ?>" data-hx-target="#<?php echo appConfigPage::secCsIndex; ?>" class="pb-4">
    <div class="overflow-x bg-lgray">
        <div class="d-flex flex-nowrap border l-form-cs">
            <?php foreach ($option['config']['dbTable'] as $key => $tableRow): ?>
                <?php appFuncModule::dbForm($key, [
                    'moduleName' => 'form-cs',
                    'dbTable' => $option['config']['dbTable'],
                    'dbResult' =>  $option['config']['dbResult'],
                    'selectItemNoValue' => true
                ]); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="pt-3 w-200px">
        <?php appFuncModule::form('form-control', $option['config']['dropdown'], ['inputName' => 'dropdown', 'inputType' => 'hidden']); ?>
        <?php appFuncModule::btn('search'); ?>
    </div>
</form>
<div class="overflow-x pb-4">
    <div id="<?php echo appConfigPage::secCsIndex; ?>"></div>
</div>
<?php appFuncModule::js('form-cs', ['target' => '#form-search']); ?>