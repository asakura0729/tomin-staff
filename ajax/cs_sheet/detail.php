<?php
//======================================================================
// ページ：送客シート詳細
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs_sheet/detail.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>

<?php appFuncModule::css('print'); ?>
<style>
    .print_wrap .border,
    .print_wrap .table-bordered td,
    .print_wrap .table-bordered th {
        border: 1px solid #333 !important;
        font-size: 1.1rem;
    }

    @media screen {
        .print_wrap {
            width: 210mm;
            height: 297mm;
            padding: 10mm;
        }
    }

    @media print {
        .print_wrap {
            padding: 20mm 5mm;
            height: 100vh;
            overflow: visible;
        }
    }
</style>

<article class="l-edit">
    <section class="bg-white w-450px h-100 border <?php if (appHttpCssheetAjaxDetail::$dbResult['approval_status'] != appConfigStatus::approval_status['complete']['key']): ?>pt-4<?php endif; ?>">
        <?php if (appHttpCssheetAjaxDetail::$dbResult['approval_status'] === appConfigStatus::approval_status['complete']['key']): ?>
            <?php /*分岐：承認完了*/ ?>
            <div class="pt-1 bg-lgreen text-center">
                <p class="m-0 p-2">管理者承認済です</p>
            </div>
        <?php endif; ?>
        <div class="container pt-4">
            <?php appFuncModule::heading('h1', 'h1', appRoutesWeb::sitemap['adminCsSheetDetail']['title']); ?>
            <p class="text-center position-relative" style="top:-1rem"><?php echo appConfigPage::$titleAdd; ?></p>
            <div class="pb-3">
                <?php appFuncModule::link(
                    'chevron_btn',
                    appRoutesWeb::sitemap['adminCsSheetEdit'],
                    [
                        'css' => 'w-100 text-center',
                        'queryParam' => appFuncPath::setGetParam(
                            ['cs_id'],
                            [appHttpCssheetAjaxDetail::$dbResult['cs_id']]
                        )
                    ]
                );
                ?>
            </div>
            <div class="pb-3">
                <?php appFuncModule::link(
                    'chevron_btn',
                    appRoutesWeb::sitemap['adminCsEdit'],
                    [
                        'title' => '対応ログ編集画面へ',
                        'css' => 'w-100 text-center',
                        'queryParam' => appFuncPath::setGetParam(
                            ['cs_id'],
                            [appHttpCssheetAjaxDetail::$dbResult['parent_cs_id']]
                        )
                    ]
                );
                ?>
            </div>
        </div>
        <div class="container pt-3">
            <form data-hx-post="<?php echo appRoutesWeb::sitemap['adminCsSheetDetail']['contents'] . appFuncPath::setGetParam(['cs_id'], [appHttpCssheetAjaxDetail::$dbResult['cs_id']]); ?>" data-hx-target="<?php echo appConfigSite::pageMain; ?>">
                <?php appFuncModule::form('form-control', appHttpCssheetAjaxDetail::$dbResult['cs_id'], ['inputName' => 'cs_id', 'inputType' => 'hidden']); ?>
                <?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) != true): ?>
                    <?php /*分岐：スタッフ権限*/ ?>
                    <?php if (appHttpCssheetAjaxDetail::$dbResult['approval_status'] === appConfigStatus::approval_status['complete']['key']): ?>
                        <?php /*分岐：スタッフ権限＞承認済*/ ?>
                        <?php appFuncModule::btn('submit', ['title' => '管理者確認', 'disabled' => true, 'popover' => '管理者承認済です']); ?>
                    <?php elseif (appHttpCssheetAjaxDetail::$dbResult['approval_status'] === appConfigStatus::approval_status['progress']['key']): ?>
                        <?php /*分岐：スタッフ権限＞申請中*/ ?>
                        <?php appFuncModule::btn('submit', ['title' => '管理者確認', 'disabled' => true, 'popover' => '管理者確認中です']); ?>
                    <?php else: ?>
                        <?php /*分岐：スタッフ権限＞未申請*/ ?>
                        <?php appFuncModule::form('form-control', appConfigStatus::approval_status['progress']['key'], ['inputName' => appDatabaseCs::table['approval_status']['name'], 'inputType' => 'hidden']); ?>
                        <?php appFuncModule::btn('submit', ['title' => '管理者確認']); ?>
                    <?php endif; ?>
                <?php elseif (appFuncSession::checkAuth(appConfigUser::authorityManager) === true): ?>
                    <?php /*分岐：管理者権限*/ ?>
                    <?php if (appHttpCssheetAjaxDetail::$dbResult['approval_status'] === appConfigStatus::approval_status['complete']['key']): ?>
                        <?php /*分岐：管理者権限＞承認済*/ ?>
                        <?php appFuncModule::btn('print', ['css' => 'w-100']); ?>
                    <?php elseif (appHttpCssheetAjaxDetail::$dbResult['approval_status'] === appConfigStatus::approval_status['progress']['key']): ?>
                        <?php /*分岐：管理者権限＞申請中*/ ?>
                        <?php appFuncModule::form('form-control', appConfigStatus::approval_status['complete']['key'], ['inputName' => appDatabaseCs::table['approval_status']['name'], 'inputType' => 'hidden']); ?>
                        <?php appFuncModule::btn('print', ['css' => 'w-100', 'add' => 'data-submit']); ?>
                    <?php else: ?>
                        <?php /*分岐：管理者権限＞未申請*/ ?>
                        <?php appFuncModule::btn('print', ['css' => 'w-100', 'disabled' => true, 'popover' => '管理者確認が未送信です']); ?>
                    <?php endif; ?>
                    <div class="pt-4 font-size-0_9 pb-5">
                        【印刷時の設定について】<br>※管理者権限のみ印刷が行えます<br>※用紙サイズはA4を指定してください<br>※余白は「デフォルト」を設定してください
                    </div>
                <?php endif; ?>
            </form>

    </section>
</article>

<article class="l-prev" <?php if (appHttpCssheetAjaxDetail::$postPrimaryKey === ''): ?> data-animation="animation-fadein-leftslide" <?php endif; ?>>
    <?php appFuncModule::include('../_module/print-sheet.php', [
        'moduleName' => 'form-control',
        'dbTable' => appDatabaseCs::table,
        'dbResult' => appHttpCssheetAjaxDetail::$dbResult,
        'editFlg' => false
    ]); ?>
</article>

<?php if (appHttpCssheetAjaxDetail::$postPrimaryKey != ''): ?>
    <?php /*分岐：データ更新*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('totop'); ?>
    <?php appFuncModule::js('url-push', ['path' => appRoutesWeb::sitemap['adminCsSheetDetail']['path'] . appFuncPath::setGetParam(['cs_id'], [appHttpCssheetAjaxDetail::$postPrimaryKey])]); ?>
<?php endif; ?>
<?php appFuncModule::js('form-submit'); ?>