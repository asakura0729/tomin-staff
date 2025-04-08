<?php
//======================================================================
// ページ：送客シート詳細
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs_sheet/detail.php'; ?>
<?php require_once '../_tmpl/ajax.php'; ?>

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

<div id="form-edit" class="l-edit">
    <div class="bg-white w-450px h-100 border pt-4">
        <div class="container pt-4">
            <?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
            <div class="pb-3">
                <?php appFuncModule::link(
                    'chevron_btn',
                    appRoutesWeb::sitemap['adminCsSeetEdit'],
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
            <?php if (appHttpCssheetAjaxDetail::$dbResult['approval_status'] != appConfigStatus::approval_status['complete']['key']): ?>
                <form data-hx-post="<?php echo appRoutesWeb::sitemap['adminCsSeetDetail']['contents'] . appFuncPath::setGetParam(['cs_id'], [appHttpCssheetAjaxDetail::$dbResult['cs_id']]); ?>" data-hx-target="<?php echo appConfigPage::pageMain; ?>">
                    <?php appFuncModule::form('form-control', appHttpCssheetAjaxDetail::$dbResult['cs_id'], ['inputName' => 'cs_id', 'inputType' => 'hidden']); ?>
                    <?php appFuncModule::form('form-control', appConfigStatus::approval_status['complete']['key'], ['inputName' => appDatabaseCs::table['approval_status']['name'], 'inputType' => 'hidden']); ?>
                    <?php appFuncModule::btn('print', ['css' => 'w-100', 'add' => 'data-submit']); ?>
                    <?php appFuncModule::js('form-submit'); ?>
                </form>
            <?php endif; ?>
            <div class="pt-4 font-size-0_9 pb-5">
                【印刷時の設定について】<br>※用紙サイズはA4を指定してください<br>※余白は「デフォルト」を設定してください
            </div>
        </div>
    </div>
</div>

<div class="l-prev animation-fadein-leftslide">
    <?php appFuncModule::localModule('../_module/print-sheet', [
        'moduleName' => 'form-control',
        'dbTable' => appDatabaseCs::table,
        'dbResult' => appHttpCssheetAjaxDetail::$dbResult,
        'editFlg' => false
    ]); ?>
</div>