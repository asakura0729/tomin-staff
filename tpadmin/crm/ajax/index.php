<?php require_once '../../../_app/http/tpadmin/crm/ajax/index.php'; ?>

<article class="pb-3 animation-fadein">
    <div class="bg-white p-3 border">
        <?php appLibraryDisp::heading('h2', '検索'); ?>
    </div>
</article>

<section class="pb-3 animation-fadein delay-0_5">
    <div class="bg-white p-3 border">
        <?php appLibraryDisp::heading('h2', '検索結果'); ?>
        <table class="table table-bordered table-sm">
            <thead class="bg-contrast-l text-center">
                <tr>
                    <th class="w-50px" scope="col">#</th>
                    <th scope="col">故人名</th>
                    <th class="w-10per" scope="col">性別</th>
                    <th class="w-10per" scope="col">プラン</th>
                    <th class="w-15per" scope="col">住民票</th>
                    <th class="w-15per" scope="col">作成日</th>
                    <th class="w-15per" scope="col">変更日</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (appHttpTpAdminCrmAjaxIndex::$result as $value): ?>
                    <tr>
                        <td class="align-middle"><?php appLibraryDisp::globalModule('btn/hx-edit', ['page' => 'adminCrmDetail', 'getParams' => [$value['funeral_id']]]); ?></td>
                        <td class="align-middle"><?php echo $value['decd_lname']; ?>&nbsp;<?php echo $value['decd_fname']; ?>（<?php echo $value['decd_lname_kana']; ?><?php echo $value['decd_fname_kana']; ?>）</td>
                        <td class="align-middle text-center"><?php echo appFuncArray::issetKey(appConfigStatus::gender, $value['decd_gender'], '---'); ?></td>
                        <td class="align-middle text-center"><?php echo appFuncArray::issetKey(appConfigFuneral::plan, $value['plan'], '---'); ?></td>
                        <td class="align-middle"><?php echo $value['decd_region']; ?></td>
                        <td class="text-center align-middle"><?php echo $value['insert_date']; ?></td>
                        <td class="text-center align-middle"><?php echo $value['update_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>