<?php require_once '../../../_app/http/tpadmin/crm/ajax/report_cs.php'; ?>


<table class="table table-bordered table-sm bg-white">
    <thead class="bg-contrast-l text-center">
        <tr>
            <th class="w-50px" scope="col">#</th>
            <th class="w-200px" scope="col">日時</th>
            <th class="w-100px" scope="col">状況</th>
            <th class="w-200px" scope="col">カテゴリ</th>
            <th scope="col">コメント</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count(appHttpTpAdminCrmAjaxReportcs::$result) > 0): ?>
            <?php foreach (appHttpTpAdminCrmAjaxReportcs::$result as $value): ?>
                <tr>
                    <td class="align-middle"><?php appLibraryDisp::globalModule('btn/hx-edit', ['page' => 'adminCrmLog', 'getParams' => [$value['report_id']]]); ?></td>
                    <td class="align-middle"><?php echo $value['insert_date']; ?></td>
                    <td class="align-middle text-center"><?php echo appDatabaseContainerCs::status[$value['approval_status']]; ?></td>
                    <td class="align-middle text-center"><?php echo appDatabaseReport::csCategory[$value['cs_category']]; ?></td>
                    <td class="align-middle"><?php echo appFuncString::extract($value['comment'], 100); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center p-3">データが存在しません</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>