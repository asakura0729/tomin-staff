<?php
//======================================================================
//対応ログ編集フォーム
//$option['dbResult']...DBから取得したデータ
//$option['postPrimaryKey']...DBに送信したデータの主キー
//======================================================================
?>

<form data-hx-post="<?php echo appRoutesWeb::async['adminCsAjaxPost']['contents']; ?>" data-hx-target="<?php echo appConfigSite::secCsEdit; ?>" data-layout-wide>
    <div class="pos-sticky">
        <div class="d-flex align-items-center">
            <?php appFuncModule::heading('h2', 'h2', '受電内容メモ', ['addCss' => 'pl-2 pb-2']); ?>
            <div class="pb-2 pl-4">
                <?php if (isset($_GET[appFuncCrmGet::getCloneFlg]) && $_GET[appFuncCrmGet::getCloneFlg] === 'true'): ?>
                    <?php /*分岐1：転記*/ ?>
                    <?php appFuncModule::string('exclamation', '既存の対応ログを転記しました。「登録」を押すと、新しい対応ログが「対応ログ一覧」に追加されます。'); ?>
                <?php elseif ($option['dbResult']['cs_id'] === ''): ?>
                    <?php /*分岐2：新規作成*/ ?>
                    <span <?php if (isset($_GET['tel'])): ?>id="message" <?php endif; ?> class="bg-lgreen"></span>
                <?php elseif (appFuncSession::checkAuth(appConfigUser::authorityManager) === false): ?>
                    <?php /*分岐3：既存＞権限／スタッフ*/ ?>
                    <?php if ($option['dbResult']['approval_status'] === appConfigStatus::approval_status['complete']['key']): ?>
                        <?php /*分岐3-1：既存＞権限／スタッフ＞承認済み対応ログ*/ ?>
                        <?php appFuncModule::string('exclamation', '承認済みの対応ログは編集できません'); ?>
                    <?php elseif ($option['dbResult']['post_by'] != $_SESSION[appConfigSession::userId]): ?>
                        <?php /*分岐3-2：既存＞権限／スタッフ＞他のユーザーが作成*/ ?>
                        <?php appFuncModule::string('exclamation', '他のユーザーが作成した対応ログは編集できません'); ?>
                    <?php elseif (isset($_GET[appFuncCrmGet::getOverwriteSheetFlg]) && $_GET[appFuncCrmGet::getOverwriteSheetFlg] === 'true'): ?>
                        <?php /*分岐3-3：既存＞権限／スタッフ＞上書きフラグ（対応ログの一部を送客シートの内容に書き換える）あり*/ ?>
                        <?php appFuncModule::string('exclamation', '送客シートの情報を引き継いでいます'); ?>
                    <?php endif; ?>
                <?php elseif (appFuncSession::checkAuth(appConfigUser::authorityManager) === true): ?>
                    <?php /*分岐4：既存＞権限／管理者*/ ?>
                    <?php if (isset($_GET[appFuncCrmGet::getOverwriteSheetFlg]) && $_GET[appFuncCrmGet::getOverwriteSheetFlg] === 'true'): ?>
                        <?php /*分岐4-1：既存＞権限／管理者＞上書きフラグ（対応ログの一部を送客シートの内容に書き換える）あり*/ ?>
                        <?php appFuncModule::string('exclamation', '送客シートの情報を引き継いでいます'); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="overflow-x bg-lgray" data-scroll>
            <div class="d-flex flex-nowrap border l-form-cs">
                <?php $formContents = appFuncCrmArray::form(); ?>
                <?php foreach ($formContents as $key => $row): ?>
                    <?php appFuncModule::component('header-form-cs', [
                        'key' => $key,
                        'inputName' => $row['name'],
                        'inputType' => $row['input'],
                        'dbTable' => $formContents,
                        'dbResult' => $option['dbResult'],
                        'title' => $row['comment'],
                        'rowCategory' => appFuncArray::issetKey($row, appFuncCrmArray::rowCategory, null),
                        'dbPost' => true
                    ]); ?>
                    <?php appFuncModule::dbForm($key, [
                        'moduleName' => 'form-cs',
                        'dbTable' => $formContents,
                        'dbResult' => $option['dbResult'],
                        'inputType' => appFuncCrmDisp::formEditInputType($row)
                    ]); ?>
                    <?php appFuncModule::component('footer-form-cs', [
                        'key' => $key,
                        'inputType' => $row['input'],
                        'dbTable' => $formContents,
                    ]); ?>
                <?php endforeach; ?>
                <?php appFuncModule::form('form-control', "true", ['inputName' => 'redirect_flg', 'inputType' => 'hidden', 'add' => 'disabled']); ?>
            </div>
        </div>
        <div class="d-flex pt-3 align-items-center">
            <div class="w-300px pr-3">
                <?php if ($option['dbResult']['cs_id'] === '' || !isset($option['dbResult']['sheet_cs_id'])): ?>
                    <?php /*分岐1：新規作成　または　総客シート未作成 */ ?>
                    <?php appFuncModule::btn('highlight', ['title' => '登録<span class="font-size-1">（送客シート作成）</span>', 'add' => 'data-submit-redirect data-wrap-disp="valid"']); ?>
                <?php else: ?>
                    <?php /*分岐2：その他 */ ?>
                    <?php appFuncModule::btn('highlight', ['title' => '登録<span class="font-size-1">（送客シート作成）</span>', 'disabled' => true, 'popover' => '送客シートは作成済です']); ?>
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

<?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) === false): ?>
    <?php /*分岐1：権限／スタッフ*/ ?>
    <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secCsEdit, 'child' => 'select[name=post_by]']); ?>
    <?php if ($option['dbResult']['cs_id'] === ''): ?>
        <?php /*分岐1-1：権限／スタッフ＞新規作成 */ ?>
        <?php appFuncModule::js('form-submit'); ?>
        <?php appFuncModule::js('form-submit-redirect'); ?>
    <?php elseif (
        $option['dbResult']['approval_status'] === appConfigStatus::approval_status['complete']['key'] ||
        $option['dbResult']['post_by'] != $_SESSION[appConfigSession::userId]
    ): ?>
        <?php /*分岐1-2：権限／スタッフ＞既存＞対応ログが承認済み*/ ?>
        <?php /*分岐1-3：権限／スタッフ＞既存＞自分以外のスタッフが対応*/ ?>
        <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secCsEdit]); ?>
    <?php else: ?>
        <?php /*分岐1-4：権限／スタッフ＞既存＞通常 */ ?>
        <?php appFuncModule::js('form-submit'); ?>
        <?php appFuncModule::js('form-submit-redirect'); ?>
    <?php endif; ?>
<?php else: ?>
    <?php /*分岐2：権限：管理者*/ ?>
    <?php appFuncModule::js('form-submit'); ?>
    <?php appFuncModule::js('form-submit-redirect'); ?>
<?php endif; ?>

<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secCsEdit]); ?>
<?php appFuncModule::js('message', ['target' => '[data-disp=approval_by]', 'msg' => appFuncDataformat::selectmenu($formContents, 'approval_by', $option['dbResult']['approval_by'])]); ?>