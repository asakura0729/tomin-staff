<?php
//======================================================================
// 部品：CSログ一覧
//======================================================================
?>
<?php require_once '../_app/ssl_base.php'; ?>
<?php require_once '../_app/http/tpadmin/ajax/cs-table.php'; ?>

<article class="animation-fadein">
    <?php if (appHttpAjaxCstable::$searchString != ''): ?>
        <?php appFuncModule::heading('h2', 'h2', '検索結果', ['addCss' => 'pl-2']); ?>
        <p>検索条件：<?php echo appHttpAjaxCstable::$searchString; ?></p>
    <?php endif; ?>

    <?php if (count(appHttpAjaxCstable::$dbResultCs) <= 0) : ?>
        <?php appFuncModule::component('nodata'); ?>
        <?php exit; ?>
    <?php endif; ?>

    <div class="d-table flex-nowrap border">
        <div class="d-table-row">
            <div data-width="50" class="d-table-cell m-0 p-2 text-center font-size-0_9 bg-base border-right border-bottom"></div>
            <?php foreach (appHttpAjaxCstable::$tableRow as $row): ?>
                <?php if ($row['input'] != '' && $row['input'] != 'hidden'): ?>
                    <div data-width="<?php if ($row['input'] === 'textarea'): ?>300<?php elseif ($row['input'] === 'datetime-local'): ?>200<?php else: ?>150<?php endif; ?>" class="d-table-cell m-0 p-1 bg-base border-right text-center font-size-0_9">
                        <?php echo $row['comment']; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php foreach (appHttpAjaxCstable::$dbResultCs as $value): ?>
            <div class="d-table-row bg-white bg-hover-lgray">
                <div class="d-table-cell font-size-0_9 m-0 text-center border-right border-bottom">
                    <button id="cs-table-<?php echo $value['cs_id']; ?>" class="btn dropdown-toggle dropdown-after-none position-relative p-3 w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="pos-middle-center d-block color-lgray text-center">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </span>
                    </button>
                    <div class="dropdown-menu w-200px p-2" aria-labelledby="cs-table-<?php echo $value['cs_id']; ?>">
                        <?php if (isset($_GET['dropdown'])): ?>
                            <?php if ($_GET['dropdown'] === appRoutesWeb::sitemap['adminCsEdit']['path']): ?>
                                <?php /*対応ログ編集*/ ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['title' => '対応ログ編集', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminAjaxCsedit'], ['title' => '転記', 'queryParam' => appFuncPath::setGetParam(['cs_id', 'clone'], [$value['cs_id'], 'true']), 'hxPush' => false, 'hxTarget' => '#' . appConfigPage::secCsEdit]); ?>
                            <?php elseif ($_GET['dropdown'] === appRoutesWeb::sitemap['adminCsIndex']['path']): ?>
                                <?php /*対応ログ一覧*/ ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['title' => '対応ログ編集', 'queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsEdit'], ['title' => '転記', 'queryParam' => appFuncPath::setGetParam(['cs_id', 'clone'], [$value['cs_id'], 'true'])]); ?>
                                <?php if (isset($value['sheet_cs_id']) && $value['sheet_cs_id'] != ''): ?>
                                    <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSeetDetail'], ['queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['sheet_cs_id']])]); ?>
                                <?php else: ?>
                                    <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSeetDetail'], ['disabled' => true]); ?>
                                <?php endif; ?>
                            <?php elseif ($_GET['cs_category'] === appConfigStatus::csCategorySheet): ?>
                                <?php appFuncModule::link('chevron', appRoutesWeb::sitemap['adminCsSeetDetail'], ['queryParam' => appFuncPath::setGetParam(['cs_id'], [$value['cs_id']])]); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php foreach (appHttpAjaxCstable::$tableRow as $row): ?>
                    <?php if ($row['input'] != '' && $row['input'] != 'hidden'): ?>
                        <div class="d-table-cell align-middle p-1 font-size-0_9 border-right border-bottom <?php if ($row['input'] === 'textarea'): ?>text-left<?php else: ?>text-center<?php endif; ?>">
                            <?php echo appFuncArray::issetKey($value, $row['name'], ''); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php appFuncPager::disp(appRoutesWeb::sitemap['adminAjaxCstable']['contents'], appHttpAjaxCstable::$target, appHttpAjaxCstable::$dbResultCsCount); ?>
</article>

<?php appFuncModule::js('cs-table-width'); ?>