<?php require_once '../../_app/http/tpadmin/funeral/ajax_results.php'; ?>

<div class="animation-fadein">
    <header class="d-flex">
        <div><?php appLibraryDisp::heading('h2', '検索結果', ['css' => 'p-0 m-0']); ?></div>
        <div class="pl-4 pt-1">
            <?php appLibraryDisp::strlenString(
                appHttpTpAdminCrmAjaxIndex::$searchWord,
                '検索ワード「' . appHttpTpAdminCrmAjaxIndex::$searchWord . '」に一致するデータが<span class="pl-1 pr-1">' . appHttpTpAdminCrmAjaxIndex::$count . '</span>件見つかりました',
            ); ?>
        </div>
    </header>
    <div class="bg-white border table-responsive">
        <table class="table table-bordered table-sm m-0 minw-1000px">
            <thead class="bg-contrast-l text-center">
                <tr>
                    <th class="w-50px" scope="col">#</th>
                    <th class="w-10per" scope="col">状況</th>
                    <th scope="w-10per">顧客名</th>
                    <th scope="w-10per">性別</th>
                    <th scope="w-10per">故人名</th>
                    <th class="w-10per" scope="col">電話番号</th>
                    <th class="w-10per" scope="col">プラン</th>
                    <th class="w-10per" scope="col">住民票</th>
                    <th scope="col">対応日</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count(appHttpTpAdminCrmAjaxIndex::$result) > 0): ?>
                    <?php foreach (appHttpTpAdminCrmAjaxIndex::$result as $value): ?>
                        <tr class="<?php appLibraryDisp::compColBg($value['funeral_status'], appDatabaseFuneral::statusCompleted); ?>">
                            <td class=" align-middle"><?php appLibraryDisp::globalModule('btn/hx-edit', ['page' => 'adminCrmDetail', 'getParams' => [$value['funeral_id']]]); ?></td>
                            <td class="align-middle text-center"><?php echo appFuncArray::issetKey(appDatabaseFuneral::status, $value['funeral_status'], appDatabaseFuneral::status[appDatabaseFuneral::statusProgress]); ?></td>
                            <td class="align-middle"><?php appLibraryDisp::globalModule('comp/persons_name', ['fname' => $value['fc_fname'], 'lname' => $value['fc_lname'], 'fname_kana' => $value['fc_fname_kana'], 'lname_kana' => $value['fc_lname_kana']]); ?></td>
                            <td class="align-middle text-center"><?php echo appFuncArray::issetKey(appConfigStatus::gender, $value['fc_gender'], '---'); ?></td>
                            <td class="align-middle"><?php appLibraryDisp::globalModule('comp/persons_name', ['fname' => $value['decd_fname'], 'lname' => $value['decd_lname'], 'fname_kana' => $value['decd_fname_kana'], 'lname_kana' => $value['decd_lname_kana']]); ?></td>
                            <td class="align-middle text-center"><?php echo $value['fc_tel']; ?></td>
                            <td class="align-middle text-center"><?php echo appFuncArray::issetKey(appConfigFuneral::plan, $value['plan'], '---'); ?></td>
                            <td class="align-middle"><?php echo $value['fc_region']; ?></td>
                            <td class="align-middle text-center"><?php echo $value['insert_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="p-3 pb-4 text-center"><?php appLibraryDisp::globalModule('comp/nodata', ['title' => 'データが存在しません']); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="pt-4">
        <?php appFuncPager::disp(
            appRoutesWeb::sitemap['adminFuneral']['contents'],
            appRoutesWeb::sitemap['adminFuneral']['path'],
            appHttpTpAdminCrmAjaxIndex::$count
        ); ?>
    </div>
</div>