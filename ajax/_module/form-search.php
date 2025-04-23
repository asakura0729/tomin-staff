<?php
//======================================================================
//検索フォーム
//$option['path']...使用するページのURL（条件分岐で仕様）
//$option['dbTable']...走査するテーブルのデータ
//$option['dbResult']...DB取得結果
//======================================================================
?>
<form id="<?php echo appFuncString::exclusionHash(appConfigSite::secSearch); ?>" class="position-relative pb-4" data-hx-get="<?php echo appRoutesWeb::async['adminCsAjaxList']['contents']; ?>" data-hx-target="<?php echo appConfigSite::secCsIndex; ?>" data-layout-wide>
    <div class="pos-sticky">
        <p>検索ワードを入力※複数項目に入力した場合、AND検索されます。　（依頼者様氏名に「ヤマダ」、故人様氏名に「スズキ」を入力）</p>
        <div class="overflow-x bg-lgray">
            <div class="d-flex flex-nowrap border l-form-cs">
                <?php $formContents = appFuncCrmDisp::renameTitles($option['dbTable']); ?>
                <?php foreach ($formContents as $key => $row): ?>
                    <?php appFuncModule::component('header-form-cs', [
                        'key' => $key,
                        'inputName' => $row['name'],
                        'inputType' => $row['input'],
                        'dbTable' => $formContents,
                        'title' => appFuncCrmDisp::renameTitle($key, $row['comment']),
                    ]); ?>
                    <?php appFuncModule::dbForm($key, [
                        'moduleName' => 'form-cs',
                        'dbTable' => appFuncCrmDisp::renameTitles($formContents),
                        'dbResult' =>  $option['dbResult'],
                        'selectItemNoValue' => true
                    ]); ?>
                    <?php appFuncModule::component('footer-form-cs', [
                        'key' => $key,
                        'inputType' => $row['input'],
                        'dbTable' => $formContents,
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

<div class="minh-40vh pb-4">
    <div id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsIndex); ?>">
        <?php if ($option['path'] != appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
            <?php /*分岐：対応ログ編集画面以外*/ ?>
            <?php appFuncModule::component('spinners-left'); ?>
        <?php endif; ?>
    </div>
</div>

<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secSearch]); ?>
<?php if ($option['path'] != appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
    <?php /*分岐：対応ログ編集画面以外*/ ?>
    <?php appFuncModule::js('pageload-submit-search', ['target' => appConfigSite::secSearch]); ?>
    <?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) != true): ?>
        <?php /*分岐：スタッフ権限*/ ?>
        <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secSearch, 'child' => 'select[name=post_by]']); ?>
    <?php endif; ?>
<?php endif; ?>