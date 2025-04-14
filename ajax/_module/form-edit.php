<?php
//======================================================================
//対応ログ編集フォーム
//$option['dbResult']...DBから取得したデータ
//$option['postPrimaryKey']...DBに送信したデータの主キー
//======================================================================
?>

<?php if (isset($_GET['clone']) && $_GET['clone'] === 'true'): ?>
    <p class="text-danger">※既存の対応ログを転記しました。「登録」を押すと、対応ログが新しく追加されます。</p>
<?php endif; ?>

<form class="animation-fadein" data-hx-post="<?php echo appRoutesWeb::async['adminCsAjaxPost']['contents']; ?>" data-hx-target="<?php echo appConfigSite::secCsEdit; ?>">
    <div class="pos-sticky">
        <div class="overflow-x bg-lgray" data-scroll>
            <div class="d-flex flex-nowrap border l-form-cs">
                <?php $formContents = appFuncCrmDisp::renameTitles(appDatabaseCs::tableForm); ?>
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
                        'dbTable' => $formContents,
                        'dbResult' => $option['dbResult']
                    ]); ?>
                    <?php appFuncModule::component('footer-form-cs', [
                        'key' => $key,
                        'inputType' => $row['input'],
                        'dbTable' => $formContents,
                    ]); ?>
                <?php endforeach; ?>
                <?php appFuncModule::form('form-control', "true", ['inputName' => 'redirect', 'inputType' => 'hidden', 'add' => 'disabled']); ?>
            </div>
        </div>
        <div class="d-flex pt-3 align-items-center">
            <div class="w-300px pr-3">
                <?php if ($option['dbResult']['cs_id'] === '' || !isset($option['dbResult']['sheet_cs_id'])): ?>
                    <?php /*分岐1：新規作成　または　総客シート未作成 */ ?>
                    <?php appFuncModule::btn('submit', ['title' => '登録<span class="font-size-1">（送客シート作成）</span>', 'add' => 'data-submit-redirect']); ?>
                <?php else: ?>
                    <?php /*分岐2：その他 */ ?>
                    <?php appFuncModule::btn('submit', ['title' => '登録<span class="font-size-1">（送客シート作成）</span>', 'disabled' => true, 'popover' => '送客シートは作成済です']); ?>
                <?php endif; ?>
            </div>
            <div class="w-200px">
                <?php appFuncModule::btn('submit'); ?>
            </div>
        </div>
    </div>
    <?php appFuncModule::include(__DIR__ . '/modal-client_category.php', [
        'modalId' => appFuncString::exclusionHash(appConfigSite::secCsEdit . '-modal'),
        'inputName' => appDatabaseCs::table['client_category']['name'],
        'inputValue' => $option['dbResult'][appDatabaseCs::table['client_category']['name']],
    ]); ?>
</form>

<?php if ($option['postPrimaryKey'] != '' && isset($_POST['redirect'])): ?>
    <?php /*分岐1：データ更新 + リダイレクト指定あり*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('redirect', ['path' => appRoutesWeb::sitemap['adminCsSeetEdit']['contents'] . appFuncPath::setGetParam(['cs_id', 'clone'], [$option['postPrimaryKey'], 'true'])]); ?>
<?php elseif ($option['postPrimaryKey'] != ''): ?>
    <?php /*分岐2：データ更新*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('url-push', ['path' => appRoutesWeb::sitemap['adminCsEdit']['path'] . appFuncPath::setGetParam(['cs_id'], [$option['postPrimaryKey']])]); ?>
<?php endif; ?>

<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secCsEdit]); ?>
<?php appFuncModule::js('form-submit'); ?>