<form id="form-funeral_id">
    <?php
    //======================================================================
    // 葬儀ID
    //======================================================================
    ?>
    <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-funeral_id']); ?>
    <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralId); ?>
</form>

<div class="row no-gutters pb-5 animation-fadein">
    <div class="col-12 pb-3">
        <div id="sec-7" class="bg-white border" data-submit-add="#sec-1">
            <?php if (appHttpTpAdminCrmAjaxDetail::$resultFuneral['funeral_status'] === appDatabaseFuneral::statusCompleted): ?>
                <div class="bg-lgreen text-center p-2"><i class="fa fa-check-circle pr-2 text-success" aria-hidden="true"></i>対応完了しました</div>
            <?php endif; ?>
            <div class="d-flex align-items-center justify-content-between">
                <?php
                //======================================================================
                // sec-7：ナビゲーション
                //======================================================================
                ?>
                <div class="d-flex align-items-center pl-3 pr-2 w-500px">
                    <?php appLibraryDisp::dbform(
                        'radio_nav',
                        ['funeral_category'],
                        appDatabaseFuneral::table,
                        appHttpTpAdminCrmAjaxDetail::$resultFuneral,
                        ['selectItem' => appDatabaseFuneral::category]
                    ); ?>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex justify-content-end align-items-center pr-3">
                        <?php appLibraryDisp::dbform(
                            'radio_nav',
                            ['funeral_status'],
                            appDatabaseFuneral::table,
                            appHttpTpAdminCrmAjaxDetail::$resultFuneral,
                            ['selectItem' => appDatabaseFuneral::status]
                        ); ?>
                    </div>
                    <button class="btn border-left rounded-0" type="button"><i class="fa fa-print pr-2 color-contrast" aria-hidden="true"></i></i>完了報告書を印刷</button>
                    <button class="btn border-left rounded-0" type="button" data-submit-copy><i class="fa fa-clone pr-2 color-contrast" aria-hidden="true"></i>複製して新規作成</button>
                </div>
            </div>
        </div>
    </div>



    <div class="col-12 col-lg-3">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#sec-2" data-toggle="tab">依頼者情報</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#sec-1" data-toggle="tab">故人情報</a>
            </li>
        </ul>
        <div class="tab-content pt-3 bg-white border-left border-right border-bottom">
            <form id="sec-1" class="tab-pane fade" role="tabpanel">
                <?php
                //======================================================================
                // sec-1：故人情報
                //======================================================================
                ?>
                <div class="p-3 pb-5 bg-white">
                    <?php appLibraryDisp::heading('h2', '故人情報', ['class' => 'text-center', 'icon' => 'fa-user-circle']); ?>
                    <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名']); ?>
                    <?php appLibraryDisp::dbform('text_row', ['decd_lname', 'decd_fname'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名(カナ)']); ?>
                    <?php appLibraryDisp::dbform('text_row', ['decd_lname_kana', 'decd_fname_kana'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    <?php appLibraryDisp::dbform('select_label', ['decd_gender'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigStatus::gender]); ?>
                    <?php appLibraryDisp::dbform('text_label', ['decd_region'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-funeral_id']); ?>
                    <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralData); ?>
                </div>
            </form>
            <form id="sec-2" class="tab-pane fade show active position-relative" role="tabpanel">
                <?php
                //======================================================================
                // sec-2：依頼者情報
                //======================================================================
                ?>
                <div class="pos-top-right p-2">
                    <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-additem data-hx-get="' . appRoutesWeb::ajax['editAddClient'] . '" data-hx-target="#sec-2-1" hx-swap="afterbegin"']); ?>
                </div>
                <div class="bg-white">
                    <?php appLibraryDisp::heading('h2', '依頼者情報', ['class' => 'text-center m-0 p-3', 'icon' => 'fa-user-circle']); ?>
                    <div id="sec-2-1" class="bg-llgray p-2 pb-5 border-top">
                        <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultClient) > 0): ?>
                            <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultClient as $index => $client): ?>
                                <?php appLibraryDisp::module('../_module/form_client.php', ['result' => $client, 'index' => $index]); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php appLibraryDisp::globalModule('comp/nodata', ['title' => '依頼者情報未登録']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralClientData); ?>
            </form>
        </div>
    </div>



    <div id="sec-3" class="col-12 col-lg-5 pl-lg-3 pr-lg-3">
        <div class="p-3 bg-white">
            <?php appLibraryDisp::heading('h2', '葬儀情報', ['class' => 'text-center', 'icon' => 'fa-car']); ?>
            <div class="row pt-3" data-submit-add="#sec-1">
                <?php
                //======================================================================
                // sec-3：葬儀情報
                //======================================================================
                ?>
                <div class="col-12 col-lg-6">
                    <?php appLibraryDisp::dbform('select_label', ['plan'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigFuneral::plan]); ?>
                    <?php appLibraryDisp::dbform('select_label', ['ensconce'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigFuneral::enshrined]); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <?php appLibraryDisp::dbform('date', ['funeral_date'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
                <div class="col-12 pb-2">
                    <?php appLibraryDisp::dbform('text_label', ['ensconce_address'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    <?php appLibraryDisp::dbform('text_label', ['dest_name'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    <?php appLibraryDisp::dbform('text_label', ['dest_address'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    <div class="w-150px d-flex"><?php appLibraryDisp::dbform('text_label', ['totalpeople'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?></div>
                </div>
                <div class="col-12">
                    <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-1', 'table' => appDatabaseFuneral::table['crematory'], 'result' => appHttpTpAdminCrmAjaxDetail::$resultFuneral]); ?>
                    <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-2', 'table' => appDatabaseFuneral::table['hall'], 'result' => appHttpTpAdminCrmAjaxDetail::$resultFuneral]); ?>
                    <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-3', 'table' => appDatabaseFuneral::table['option'], 'result' => appHttpTpAdminCrmAjaxDetail::$resultFuneral]); ?>
                </div>
                <?php appLibraryDisp::dbform('hidden', ['funeral_comment'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'id="sec-3-comment"']); ?>
                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-funeral_id']); ?>
            </div>
        </div>
    </div>


    <div class="col-12 col-lg-4">
        <div class="bg-white">
            <form id="sec-4">
                <?php
                //======================================================================
                // sec-4：レポート（本日対応ログ）
                //======================================================================
                ?>
                <?php appLibraryDisp::heading('h2', '本日対応ログ', ['class' => 'text-center pt-3', 'icon' => 'fa-comments']); ?>
                <?php appLibraryDisp::module('../_module/form_report_cs.php'); ?>
            </form>
        </div>



        <form id="sec-5" class="pt-4 pb-4 position-relative">
            <?php
            //======================================================================
            // sec-5：葬儀情報（申し送り事項）
            //======================================================================
            ?>
            <div class="bg-white">
                <?php appLibraryDisp::heading('h2', '申し送り事項', ['class' => 'text-center pt-3', 'icon' => 'fa-file-text']); ?>
                <div class="border-top border-bottom">
                    <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#sec-5-collapse']); ?>
                    <div id="sec-5-collapse" class="<?php appLibraryDisp::strlenString(appHttpTpAdminCrmAjaxDetail::$resultFuneral['funeral_comment'], '', 'collapse'); ?>">
                        <div class="p-3">
                            <?php appLibraryDisp::dbform('editor', ['funeral_comment'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['targetForm' => '#sec-3-comment']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <form id="sec-6" class="pb-4 position-relative">
            <?php
            //======================================================================
            // sec-6：レポート（架電日時登録）
            //======================================================================
            ?>
            <div class="bg-white">
                <?php appLibraryDisp::heading('h2', '架電日時登録', ['class' => 'text-center m-0 p-3', 'icon' => 'fa-bell']); ?>
                <div class="border-top border-bottom">
                    <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#sec-6-collapse']); ?>
                    <div id="sec-6-collapse" class="<?php appLibraryDisp::arrayCountString(appHttpTpAdminCrmAjaxDetail::$resultReportTel, '', 'collapse'); ?>">
                        <div class="d-flex flex-row-reverse p-1">
                            <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-additem data-hx-get="/tpadmin/crm/ajax/report_tel" data-hx-target="#sec-6-add" hx-swap="afterbegin"']); ?>
                        </div>
                        <div id="sec-6-add" class="bg-llgray p-3 pb-4 border-top">
                            <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultReportTel) > 0): ?>
                                <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultReportTel as $value): ?>
                                    <?php appLibraryDisp::module('../_module/form_report_tel.php', ['result' => $value]); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php appLibraryDisp::globalModule('comp/nodata', ['title' => '架電日時未登録']); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmReport); ?>
        </form>
    </div>
    <div class="l-submit p-5">
        <div class="l-submit-inner">
            <?php appLibraryDisp::globalModule('form/btn_submit', ['add' => 'data-submit', 'title' => '登録する']); ?>
        </div>
    </div>
</div>