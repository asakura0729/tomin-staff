<?php require_once '../../_app/http/tpadmin/funeral/ajax.php'; ?>

<section class="pb-3 animation-fadein">
    <form class="bg-white p-3" hx-get="confirm.html" hx-target="body">
        <div class="row align-items-center no-gutters">
            <div class="col-2 pb-1">
                <h1 class="font-size-2 text-center m-0 p-0 line-height-0">顧客検索</h1>
            </div>
            <div class="col-4 d-flex">
                <?php appLibraryDisp::form('radio_nav', 'str', '', 'cl_name', ['selectItem' => appLibraryCrm::search]); ?>
            </div>
            <div class="col-6">
                <?php appLibraryDisp::form('search', 'str', '検索', '', ['placeholder' => '検索したい文字列を入力']); ?>
            </div>
        </div>
    </form>
</section>

<section id="" class="pb-5 animation-fadein delay-0_5">
    <?php appLibraryDisp::heading('h2', '検索結果'); ?>
    <div class="bg-white border">
        <table class="table table-bordered table-sm m-0">
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
    <div class="pt-4">
        <?php appFuncPager::disp(
            appRoutesWeb::sitemap['adminCrm']['contents'],
            appRoutesWeb::sitemap['adminCrm']['path'],
            appHttpTpAdminCrmAjaxIndex::$count
        ); ?>
    </div>
</section>