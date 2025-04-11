<?php
//======================================================================
//検索フォーム
//$option['path']...使用するページのURL（条件分岐で仕様）
//$option['dbTable']...走査するテーブルのデータ
//$option['dbResult']...DB取得結果
//======================================================================
?>
<form id="<?php echo appFuncString::exclusionHash(appConfigSite::secSearch); ?>" class="animation-fadein position-relative pb-4" data-hx-get="<?php echo appRoutesWeb::async['adminCsAjaxList']['contents']; ?>" data-hx-target="<?php echo appConfigSite::secCsIndex; ?>">
    <div class="pos-sticky">
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
                <?php if ($option['path'] === appRoutesWeb::sitemap['adminCsList_invalid']['contents']): ?>
                    <?php /*分岐：無効電話一覧の場合、検索オプションを追加*/ ?>
                    <?php appFuncModule::form('form-control', appConfigStatus::clientCategoryInvalid, ['inputName' => 'client_category_filter', 'inputType' => 'hidden']); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="pt-3 w-200px">
            <?php appFuncModule::form('form-control', $option['path'], ['inputName' => 'path', 'inputType' => 'hidden']); ?>
            <?php appFuncModule::btn('search'); ?>
        </div>
    </div>
    <?php appFuncModule::include(__DIR__ . '/modal-client_category.php', [
        'modalId' => appFuncString::exclusionHash(appConfigSite::secSearch . '-modal'),
        'inputName' => appDatabaseCs::table['client_category']['name'],
        'inputValue' => '',
    ]); ?>
</form>

<div class="minh-200px pb-4">
    <div id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsIndex); ?>"></div>
</div>

<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secSearch]); ?>
<?php if ($option['path'] != appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
    <?php /*分岐：対応ログ編集画面以外、検索を自動実行*/ ?>
    <?php appFuncModule::js('pageload-submit-search', ['target' => appConfigSite::secSearch]); ?>
<?php endif; ?>