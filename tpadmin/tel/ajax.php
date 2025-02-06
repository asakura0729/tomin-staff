<?php require_once '../../_app/http/tpadmin/tel/ajax.php'; ?>

<?php appLibraryDisp::heading('h1', '架電リスト'); ?>

<table class="table table-bordered table-sm bg-white">
    <thead class="bg-contrast-l text-center">
        <tr>
            <th class="w-50px" scope="col">#</th>
            <th class="w-15per" scope="col">架電日時</th>
            <th class="w-15per" scope="col">架電状況</th>
            <th class="w-15per" scope="col">対応者</th>
            <th scope="col">コメント</th>
            <th class="w-15per" scope="col">登録日時</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count(appHttpTpAdminCrmAjaxTel::$result) > 0): ?>
            <?php foreach (appHttpTpAdminCrmAjaxTel::$result as $value): ?>
                <tr>
                    <td class="align-middle"><?php appLibraryDisp::globalModule('btn/hx-edit', ['page' => 'adminCrmDetail', 'getParams' => [$value['funeral_id']]]); ?></td>
                    <td class="align-middle text-center"><?php echo $value['tel_date']; ?></td>
                    <td class="align-middle text-center"><?php echo appFuncArray::issetKey(appDatabaseReport::telStatus, $value['tel_status'], appDatabaseReport::telStatus['none']); ?></td>
                    <td class="align-middle text-center"><?php echo $value['tel_by']; ?></td>
                    <td class="align-middle"><?php echo appFuncString::extract($value['comment'], 100); ?></td>
                    <td class="align-middle text-center"><?php echo $value['insert_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center p-3">データが存在しません</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>