<table class="table table-bordered table-sm bg-white">
    <thead class="bg-contrast-l text-center">
        <tr>
            <th class="w-10per" scope="col">#</th>
            <th class="w-20per" scope="col">日時</th>
            <th class="w-20per" scope="col">状況</th>
            <th class="w-20per" scope="col">カテゴリ</th>
            <th class="w-30per" scope="col">作成日</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultReportCs) > 0): ?>
            <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultReportCs as $value): ?>
                <tr>
                    <td>
                        <button type="button" class="btn" data-toggle="modal" data-target="#modal" data-hx-get="/tpadmin/crm/ajax/report_cs?funeral_id=<?php echo appHttpTpAdminCrmAjaxDetail::$resultFuneral['funeral_id']; ?>&report_id=<?php echo $value['report_id']; ?>" data-hx-target="#modal-body">
                            <i class="fa fa-pencil color-contrast" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td><?php echo $value['insert_date']; ?></td>
                    <td>---</td>
                    <td><?php echo appDatabaseReport::csCategory[$value['cs_category']]; ?></td>
                    <td><?php echo $value['insert_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center p-3">データが存在しません</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>