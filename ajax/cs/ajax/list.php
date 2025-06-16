<?php
//======================================================================
// 部品：対応ログ一覧
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../../_app/http/ajax/cs/ajax/list.php'; ?>

<div data-animation="animation-fadein">

    <?php if (adminCsAjaxList::$searchString != ''): ?>
        <?php appFuncModule::heading('h2', 'h2', '検索結果', ['addCss' => 'pl-2']); ?>
        <p>検索条件：<?php echo adminCsAjaxList::$searchString; ?></p>
    <?php endif; ?>

    <?php if (count(adminCsAjaxList::$dbResultCs) <= 0) : ?>
        <?php appFuncModule::component('nodata'); ?>
        <?php exit; ?>
    <?php endif; ?>

    <div class="border">

        <header class="d-flex">
            <?php foreach (adminCsAjaxList::$tableRow as $key => $row): ?>
                <?php appFuncModule::component('header-cs-list', [
                    'key' => $key,
                    'inputType' => $row['input'],
                    'dbTable' => adminCsAjaxList::$tableRow,
                    'title' => $row['comment'],
                    'dataWidth' => appFuncCrmDisp::setListRowWidth($row['name'], $row['input']),
                    'rowCategory' => appFuncArray::issetKey($row, appFuncCrmArray::rowCategory, null)
                ]); ?>
            <?php endforeach; ?>
        </header>

        <?php foreach (adminCsAjaxList::$dbResultCs as $value): ?>
            <div data-col class="d-flex bg-hover-lgray <?php echo appFuncCrmDisp::setBgcolor($value); ?>">
                <div data-row class="font-size-0_9 m-0 text-center border-right border-bottom">
                    <button id="cs_table-<?php echo $value['cs_id']; ?>" class="btn h-100 dropdown-toggle dropdown-after-none position-relative p-3 w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="pos-middle-center d-block color-lgray text-center">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </span>
                    </button>
                    <nav class="dropdown-menu w-200px p-2" aria-labelledby="cs_table-<?php echo $value['cs_id']; ?>">
                        <?php if (adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
                            <?php /*分岐1：対応ログ編集*/ ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['css' => 'w-100', 'title' => '対応ログ編集', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                            <div class="dropdown-divider"></div>
                            <?php appFuncModule::link('chevron', appRoutesWeb::async['adminCsAjaxPost'], ['css' => 'w-100', 'title' => '転記', 'queryParam' => appFuncPath::setGetParam(['cs_id', appFuncCrmGet::getCloneFlg], [$value['cs_id'], 'true']), 'hxPush' => false, 'hxTarget' => appConfigSite::secCsEdit]); ?>
                        <?php elseif (
                            adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsIndex']['contents'] ||
                            adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsList_invalid']['contents'] ||
                            adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsList_check']['contents']
                        ): ?>
                            <?php /*分岐2：対応ログ一覧*/ ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['css' => 'w-100', 'title' => '対応ログ編集', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                            <div class="dropdown-divider"></div>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['css' => 'w-100', 'title' => '転記', 'queryParam' => appFuncPath::setGetParam(['cs_id', appFuncCrmGet::getCloneFlg], [$value['cs_id'], 'true'])]); ?>
                            <?php if (isset($value['sheet_cs_id']) && $value['sheet_cs_id'] != ''): ?>
                                <?php /*分岐2-1：送客シートあり*/ ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSheetDetail'], ['css' => 'w-100', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['sheet_cs_id']])]); ?>
                            <?php else: ?>
                                <?php /*分岐2-2：送客シートなし*/ ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSheetDetail'], ['css' => 'w-100', 'disabled' => true]); ?>
                            <?php endif; ?>
                        <?php elseif (adminCsAjaxList::$path  === appRoutesWeb::sitemap['adminCsSheet']['contents']): ?>
                            <?php /*分岐3：送客シート一覧*/ ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSheetDetail'], ['css' => 'w-100', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['sheet_cs_id']])]); ?>
                        <?php endif; ?>
                    </nav>
                </div>
                <?php foreach (adminCsAjaxList::$tableRow as $key => $row): ?>
                    <?php if (
                        adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsList_check']['contents'] &&
                        $key === appDatabaseCs::table['approval_status']['name']
                    ): ?>
                        <?php /*分岐1：対応ログ一覧＞ログチェック一覧*/ ?>
                        <div data-row class=" m-0 p-1 border-right border-bottom font-size-0_9 text-center">
                            <?php appFuncModule::btn('check', appFuncCrmDisp::btnApproval($value)); ?>
                        </div>
                    <?php elseif ($row['input'] === 'number'): ?>
                        <?php /*分岐2：価格*/ ?>
                        <div data-row class="p-1 pt-2 border-right border-bottom font-size-0_8 text-right">
                            <span class="pr-1"><?php echo appFuncString::strlenString(appFuncArray::issetKey($value, $key, ''), appFuncString::textNone); ?></span>円
                        </div>
                    <?php elseif ($row['input'] === 'textarea'): ?>
                        <?php /*分岐3：テキストエリア*/ ?>
                        <div data-row class="position-relative p-1 pt-2 border-right border-bottom font-size-0_8">
                            <div class="overflow-hidden h-50px"><?php echo appFuncCrmDisp::dbResultValue($value, $key, $row['input']); ?></div>
                            <div class="cm-resizer" data-row-resize role="separator" aria-orientation="vertical" tabindex="0"></div>
                        </div>
                    <?php elseif ($row['input'] != '' && $row['input'] != 'hidden'): ?>
                        <?php /*分岐4：その他*/ ?>
                        <div data-row class="p-1 pt-2 border-right border-bottom font-size-0_8">
                            <?php echo appFuncCrmDisp::dbResultValue($value, $key, $row['input']); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="pt-2 pb-2 w-lg-600px">
        <div class="bg-white p-2 pl-3 d-flex font-size-0_8">
            <span class="pr-2">行の背景色について：</span>
            <span class="border bg-lblue w-50px"></span>
            <span class="pl-1 pr-3">有効顧客</span>
            <span class="border bg-lpink w-50px"></span>
            <span class="pl-1 pr-3">キャンセル顧客</span>
            <span class="border bg-gray w-50px"></span>
            <span class="pl-1 pr-3">報告完了</span>
        </div>
    </div>
    <?php appFuncPager::disp(
        appRoutesWeb::async['adminCsAjaxList']['contents'],
        appConfigSite::secCsIndex,
        adminCsAjaxList::$dbResultCsCount,
        'data-add-spinner="' . appConfigSite::secCsIndex . '"'
    ); ?>
</div>

<?php if (count(adminCsAjaxList::$dbResultCs) > 0): ?>
    <?php appFuncModule::js('message', ['target' => '#message', 'msg' => '過去の対応ログが存在する電話番号です']); ?>
<?php endif; ?>
<?php if (isset($_GET[appRoutesWeb::getPage])): ?>
    <?php appFuncModule::js('totop'); ?>
<?php endif; ?>
<?php appFuncModule::js('layout-wide'); ?>
<?php appFuncModule::js('row-resize'); ?>
<?php appFuncModule::js('form-approval'); ?>