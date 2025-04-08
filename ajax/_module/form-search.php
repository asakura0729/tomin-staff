<?php
//======================================================================
// 汎用モジュール：検索フォーム
//$option['path']...使用するページのURL（条件分岐で仕様）
//$option['dbTable']...走査するテーブルのデータ
//$option['dbResult']...DB取得結果
//$option['client_category_filter']...ステータス絞り込み
//======================================================================
?>

<form id="form-search" class="animation-fadein pb-4" data-hx-get="<?php echo appRoutesWeb::sitemap['adminAjaxCstable']['contents']; ?>" data-hx-target="#<?php echo appConfigPage::secCsIndex; ?>">
    <div class="overflow-x bg-lgray">
        <div class="d-flex flex-nowrap border l-form-cs">
            <?php foreach ($option['dbTable'] as $key => $tableRow): ?>
                <?php appFuncModule::dbForm($key, [
                    'moduleName' => 'form-cs',
                    'dbTable' => $option['dbTable'],
                    'dbResult' =>  $option['dbResult'],
                    'selectItemNoValue' => true
                ]); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="pt-3 w-200px">
        <?php appFuncModule::form('form-control', $option['path'], ['inputName' => 'path', 'inputType' => 'hidden']); ?>
        <?php if (isset($option['client_category_filter'])): ?>
            <?php appFuncModule::form('form-control', $option['client_category_filter'], ['inputName' => 'client_category_filter', 'inputType' => 'hidden']); ?>
        <?php endif; ?>
        <?php appFuncModule::btn('search'); ?>
    </div>
</form>
<div class="minh-200px pb-4 overflow-x">
    <div id="<?php echo appConfigPage::secCsIndex; ?>"></div>
</div>
<?php appFuncModule::js('form-cs', ['target' => '#form-search']); ?>