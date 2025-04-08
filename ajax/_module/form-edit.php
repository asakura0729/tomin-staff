<?php
//======================================================================
// 汎用モジュール：対応ログ編集フォーム
//$option['dbResult']...DBから取得したデータ
//$option['postPrimaryKey']...DBに送信したデータの主キー
//======================================================================
?>
<form data-hx-post="<?php echo appRoutesWeb::sitemap['adminAjaxCsedit']['contents']; ?>" data-hx-target="#form-edit" class="animation-fadein">
    <div class="overflow-x bg-lgray">
        <div class="d-flex flex-nowrap border l-form-cs">
            <?php foreach (appDatabaseCs::form as $key => $tableRow): ?>
                <?php appFuncModule::dbForm($key, [
                    'moduleName' => 'form-cs',
                    'dbTable' => appDatabaseCs::form,
                    'dbResult' => $option['dbResult'],
                    'add' => 'data-disp'
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
</form>

<?php appFuncModule::js('form-cs', ['target' => '#form-edit']); ?>
<?php appFuncModule::js('form-submit'); ?>
<?php if ($option['postPrimaryKey'] != '' && isset($_POST['redirect'])): ?>
    <?php /*分岐1：データ更新+リダイレクト指定あり*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('redirect', ['path' => appRoutesWeb::sitemap['adminCsSeetEdit']['contents'] . appFuncPath::setGetParam(['cs_id', 'clone'], [$option['postPrimaryKey'], 'true'])]); ?>
<?php elseif ($option['postPrimaryKey'] != ''): ?>
    <?php /*分岐2：データ更新*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('url-push', ['path' => appRoutesWeb::sitemap['adminCsEdit']['path'] . appFuncPath::setGetParam(['cs_id'], [$option['postPrimaryKey']])]); ?>
<?php endif; ?>