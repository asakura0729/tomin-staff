<?php
//======================================================================
// 部品：対応ログ一覧
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../../_app/http/ajax/cs/ajax/list.php'; ?>

<article class="minw-1000px animation-fadein">

    <?php if (adminCsAjaxList::$searchString != ''): ?>
        <?php appFuncModule::heading('h2', 'h2', '検索結果', ['addCss' => 'pl-2']); ?>
        <p>検索条件：<?php echo adminCsAjaxList::$searchString; ?></p>
    <?php endif; ?>

    <?php if (count(adminCsAjaxList::$dbResultCs) <= 0) : ?>
        <?php appFuncModule::component('nodata'); ?>
        <?php exit; ?>
    <?php endif; ?>

    <div class="d-table flex-nowrap border-top border-left">
        <header class="d-table-row bg-base">
            <div data-width="50" class="d-table-cell m-0 p-2 text-center font-size-0_9 border-right border-bottom"></div>
            <?php foreach (adminCsAjaxList::$tableRow as $key => $row): ?>
                <?php if ($row['input'] != '' && $row['input'] != 'hidden'): ?>
                    <div data-width="<?php echo appFuncCrmDisp::setListWidth($row['name'], $row['input']); ?>" class="d-table-cell m-0 p-2 text-center font-size-0_9 border-right border-bottom">
                        <?php echo $row['comment']; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </header>
        <?php foreach (adminCsAjaxList::$dbResultCs as $key => $value): ?>
            <div class="d-table-row bg-hover-lgray <?php echo appFuncCrmDisp::setBgcolor($value); ?>">
                <div class="d-table-cell font-size-0_9 m-0 text-center border-right border-bottom">
                    <button id="cs_table-<?php echo $value['cs_id']; ?>" class="btn h-100 dropdown-toggle dropdown-after-none position-relative p-3 w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="pos-middle-center d-block color-lgray text-center">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </span>
                    </button>
                    <nav class="dropdown-menu w-200px p-2" aria-labelledby="cs_table-<?php echo $value['cs_id']; ?>">
                        <?php if (adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsEdit']['contents']): ?>
                            <?php /*分岐1：対応ログ編集*/ ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['title' => '対応ログ編集', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::async['adminCsAjaxPost'], ['title' => '転記', 'queryParam' => appFuncPath::setGetParam(['cs_id', 'clone'], [$value['cs_id'], 'true']), 'hxPush' => false, 'hxTarget' => appConfigSite::secCsEdit]); ?>
                        <?php elseif (
                            adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsIndex']['contents'] ||
                            adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsList_invalid']['contents'] ||
                            adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsList_check']['contents']
                        ): ?>
                            <?php /*分岐2：対応ログ一覧*/ ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['title' => '対応ログ編集', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['title' => '転記', 'queryParam' => appFuncPath::setGetParam(['cs_id', 'clone'], [$value['cs_id'], 'true'])]); ?>
                            <?php if (isset($value['sheet_cs_id']) && $value['sheet_cs_id'] != ''): ?>
                                <?php /*分岐2-1：送客シートあり*/ ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSeetDetail'], ['queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['sheet_cs_id']])]); ?>
                            <?php else: ?>
                                <?php /*分岐2-2：送客シートなし*/ ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSeetDetail'], ['disabled' => true]); ?>
                            <?php endif; ?>
                        <?php elseif (adminCsAjaxList::$path  === appRoutesWeb::sitemap['adminCsSeet']['contents']): ?>
                            <?php /*分岐3：送客シート一覧*/ ?>
                            <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSeetDetail'], ['queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                        <?php endif; ?>
                    </nav>
                </div>
                <?php foreach (adminCsAjaxList::$tableRow as $row): ?>
                    <?php if (
                        adminCsAjaxList::$path === appRoutesWeb::sitemap['adminCsList_check']['contents'] &&
                        $row['name'] === appDatabaseCs::table['approval_status']['name']
                    ): ?>
                        <?php /*分岐1：対応ログ一覧＞ログチェック一覧*/ ?>
                        <div class="d-table-cell font-size-0_9 m-0 p-1 text-center border-right border-bottom">
                            <?php appFuncModule::btn('check', appFuncCrmDisp::btnApproval($value)); ?>
                        </div>
                    <?php elseif ($row['input'] != '' && $row['input'] != 'hidden'): ?>
                        <?php /*分岐2：コンテンツ*/ ?>
                        <div class="d-table-cell align-middle p-1 font-size-0_8 border-right border-bottom <?php if ($row['input'] === 'textarea'): ?>text-left<?php else: ?>text-center<?php endif; ?>">
                            <?php echo appFuncArray::issetKey($value, $row['name'], ''); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php appFuncPager::disp(appRoutesWeb::async['adminCsAjaxList']['contents'], appConfigSite::secCsIndex, adminCsAjaxList::$dbResultCsCount); ?>
</article>

<?php appFuncModule::js('cs-table-width'); ?>
<?php appFuncModule::js('form-approval'); ?>