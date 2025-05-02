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
        <div class="overflow-x bg-lgray pr-5">
            <div class="d-flex flex-nowrap border l-form-cs">
                <?php foreach ($option['dbTable'] as $key => $row): ?>
                    <?php appFuncModule::component('header-form-cs', [
                        'key' => $key,
                        'inputName' => $row['name'],
                        'inputType' => $row['input'],
                        'dbTable' => $option['dbTable'],
                        'dbResult' =>  $option['dbResult'],
                        'title' => $row['comment'],
                        'rowCategory' => appFuncArray::issetKey($row, appFuncCrmArray::rowCategory, null),
                        'dbPost' => false
                    ]); ?>
                    <?php appFuncModule::dbForm($key, [
                        'moduleName' => 'form-cs',
                        'dbTable' => $option['dbTable'],
                        'dbResult' =>  $option['dbResult'],
                        'inputType' => appFuncCrmDisp::formSearchInputType($row),
                        'selectItemNoValue' => true
                    ]); ?>
                    <?php appFuncModule::component('footer-form-cs', [
                        'key' => $key,
                        'inputType' => $row['input'],
                        'dbTable' => $option['dbTable'],
                    ]); ?>
                <?php endforeach; ?>
                <?php if ($option['path'] === appRoutesWeb::sitemap['adminCsList_invalid']['contents']): ?>
                    <?php /*分岐：無効電話一覧の場合、検索オプションを追加*/ ?>
                    <?php appFuncModule::form('form-control', appConfigStatus::clientCategoryInvalid, ['inputName' => 'client_category_filter', 'inputType' => 'hidden']); ?>
                <?php endif; ?>
                <?php appFuncModule::form('form-control', $option['path'], ['inputName' => 'path', 'inputType' => 'hidden']); ?>
            </div>
        </div>
        <div class="d-flex justify-content-between w-100 pt-3">
            <div class="w-200px">
                <?php appFuncModule::btn('search', ['add' => 'data-add-spinner="' . appConfigSite::secCsIndex . '"']); ?>
            </div>
            <?php if (
                $option['path'] != appRoutesWeb::sitemap['adminCsEdit']['contents'] &&
                appFuncSession::checkAuth(appConfigUser::authorityManager) === true
            ): ?>
                <?php /*分岐：対応ログ編集ページ以外 + 権限管理者*/ ?>
                <div class="d-flex align-items-center">
                    <div class="w-250px text-danger pr-3 text-right">
                        ※管理者のみ表示されています
                    </div>
                    <div class="w-300px">
                        <?php appFuncModule::btn('download'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php appFuncModule::include(__DIR__ . '/modal-client_category.php', [
        'modalId' => appFuncString::exclusionHash(appConfigSite::secSearch . '-modal'),
        'inputName' => appDatabaseCs::table['client_category']['name'],
        'inputValue' => '',
    ]); ?>
</form>

<article class="minh-40vh pb-4">
    <div id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsIndex); ?>">
        <?php if ($option['path'] != appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
            <?php /*分岐：対応ログ編集画面以外*/ ?>
            <?php appFuncModule::component('spinners-left'); ?>
        <?php endif; ?>
    </div>
</article>

<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secSearch]); ?>
<?php appFuncModule::js('form-submit-download', ['target' => appConfigSite::secSearch]); ?>
<?php if ($option['path'] != appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
    <?php /*分岐：対応ログ編集画面以外*/ ?>
    <?php appFuncModule::js('pageload-submit', ['target' => '[data-submit-search]']); ?>
    <?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) != true): ?>
        <?php /*分岐：スタッフ権限*/ ?>
        <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secSearch, 'child' => 'select[name=post_by]']); ?>
    <?php endif; ?>
<?php endif; ?>