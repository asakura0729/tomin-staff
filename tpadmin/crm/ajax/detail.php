<?php require_once '../../../_app/http/tpadmin/crm/ajax/detail.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .l-submit {
        position: fixed;
        bottom: 0;
        right: 100px;
        width: 400px;
        z-index: 2000;
        border-radius: .25rem;
    }

    .l-submit-inner {
        height: 60px;
        border: 3px solid #fff;
    }

    .ql-container {
        height: 200px;
    }
</style>

<div id="debug"></div>

<div id="form-wrap" class="row no-gutters pb-5 animation-fadein">
    <div class="col-12 col-lg-3">
        <form id="form-funeral_id" class="col-12">
            <?php
            //======================================================================
            // 葬儀ID
            //======================================================================
            ?>
            <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
            <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralId); ?>
        </form>
        <form id="sec-1" class="pb-4">
            <?php
            //======================================================================
            // 故人情報
            //======================================================================
            ?>
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '故人情報', ['class' => 'text-center']); ?>
                <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名']); ?>
                <div class="form-row pb-2">
                    <?php appLibraryDisp::dbform('text_row', ['decd_lname', 'decd_fname'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
                <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名(カナ)']); ?>
                <div class="form-row pb-2">
                    <?php appLibraryDisp::dbform('text_row', ['decd_lname_kana', 'decd_fname_kana'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
                <?php appLibraryDisp::dbform('select_label', ['decd_gender'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigStatus::gender]); ?>
                <?php appLibraryDisp::dbform('text_label', ['decd_region'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-primary']); ?>
                <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralData); ?>
            </div>
        </form>
        <form id="sec-2" class="pb-4 position-relative">
            <?php
            //======================================================================
            // 依頼者情報
            //======================================================================
            ?>
            <div class="pos-top-right p-2">
                <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-add data-hx-get="/tpadmin/crm/ajax/client" data-hx-target="#sec-2-1" hx-swap="afterbegin"']); ?>
            </div>
            <div class="bg-white">
                <?php appLibraryDisp::heading('h2', '依頼者情報', ['class' => 'text-center m-0 p-3']); ?>
                <div id="sec-2-1" class="bg-llgray p-2 pb-4 border-top">
                    <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultClient) > 0): ?>
                        <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultClient as $client): ?>
                            <?php appLibraryDisp::module('../_module/form_client.php', ['result' => $client]); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php appLibraryDisp::globalModule('comp/nodata', ['title' => '依頼者情報未登録']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralClientData); ?>
        </form>
    </div>
    <div class="col-12 col-lg-5 pl-lg-3 pr-lg-3">
        <?php
        //======================================================================
        // 過去対応ログ
        //======================================================================
        ?>
        <div class="p-3 bg-white">
            <?php appLibraryDisp::heading('h2', '過去対応ログ', ['class' => 'text-center']); ?>
            <div class="border h-300px overflow-y bg-llgray">
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
            </div>
            <form id="sec-3" class="row pt-3">
                <?php
                //======================================================================
                // 葬儀情報
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
                    <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-1', 'table' => appDatabaseFuneral::table['crematory']]); ?>
                    <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-2', 'table' => appDatabaseFuneral::table['hall']]); ?>
                    <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-3', 'table' => appDatabaseFuneral::table['option']]); ?>
                </div>
                <?php appLibraryDisp::dbform('hidden',  ['funeral_comment'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'id="sec-3-comment"']); ?>
                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-primary']); ?>
                <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmFuneralData); ?>
            </form>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <form id="sec-4" class="pb-4 position-relative" data-disabled>
            <?php
            //======================================================================
            // レポート（本日対応ログ）
            //======================================================================
            ?>
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '本日対応ログ', ['class' => 'text-center']); ?>
                <?php appLibraryDisp::dbform('hidden', ['report_id'], appDatabaseReport::table, [], ['multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, [], ['value' => '対応ログ', 'multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryCs, 'multiple' => true]); ?>
                <?php appLibraryDisp::dbform('select_label', ['cs_category'], appDatabaseReport::tableCs, [], ['multiple' => true, 'add' => 'data-cs_category="#sec-4"', 'selectItem' => appDatabaseReport::csCategory]); ?>
                <?php appLibraryDisp::dbform('hidden', ['comment'], appDatabaseReport::table, [], ['add' => 'id="sec-4-comment"', 'multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-primary', 'multiple' => true]); ?>
                <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmReport); ?>
                <div data-editor='#sec-4-comment'></div>
            </div>
        </form>
        <form id="sec-5" class="pb-4 position-relative">
            <?php
            //======================================================================
            // レポート（申し送り事項）
            //======================================================================
            ?>
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '申し送り事項', ['class' => 'text-center']); ?>
                <div data-editor='#sec-3-comment'>
                    <?php appLibraryDisp::dbform('disp', ['funeral_comment'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
            </div>
        </form>
        <form id="sec-6" class="pb-4 position-relative">
            <?php
            //======================================================================
            // レポート（架電日時登録）
            //======================================================================
            ?>
            <div class="pos-top-right p-2 pr-3">
                <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-add data-hx-get="/tpadmin/crm/ajax/report_tel" data-hx-target="#sec-6-1" hx-swap="afterbegin"']); ?>
            </div>
            <div class="bg-white">
                <?php appLibraryDisp::heading('h2', '架電日時登録', ['class' => 'text-center m-0 p-3']); ?>
                <div id="sec-6-1" class="bg-llgray p-3 pb-4 border-top">
                    <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultReportTel) > 0): ?>
                        <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultReportTel as $value): ?>
                            <?php appLibraryDisp::module('../_module/form_report_tel.php', ['result' => $value]); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php appLibraryDisp::globalModule('comp/nodata', ['title' => '架電日時未登録']); ?>
                    <?php endif; ?>
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

<div id="modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div id="modal-body" class="modal-content">

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    if (typeof formConfig === 'undefined') {
        const formConfig = (function() {
            const elem = {
                main: "<?php echo appConfigPage::pageMain; ?>",
                form: '#form-wrap',
                formFuneralId: '#form-funeral_id',
                formSections: ["#sec-1", "#sec-2", "#sec-3", "#sec-4", "#sec-5", "#sec-6"],
                editorSections: ["#sec-4-quil", "#sec-5-quil"],
                dataAdd: '[data-add]',
                dataEditor: '[data-editor]',
                dataDisabled: '[data-disabled]',
                dataSubmit: '[data-submit]',
                dataCsCategory: '[data-cs_category]',
                dataPrimary: '[data-primary]',
                hxTarget: 'data-hx-target',
            }

            const ajax = {
                confirm: "<?php echo appConfigSite::sitemap['adminCrmConfirm']['path']; ?>",
                detail: "<?php appLibraryDisp::link('adminCrmDetail', ['path' => 'contents']); ?>"
            }

            const cssClass = {
                qlEditor: '.ql-editor',
                dNone: 'd-none'
            }

            const formElem = document.querySelector(elem.form);

            const qs = function(elem) {
                return formElem.querySelector(elem);
            }

            const getAttributeData = function(str) {
                str = str.replace("[", '');
                str = str.replace("]", '');
                return str;
            }

            const setEditor = function() {
                const elements = document.querySelectorAll(elem.dataEditor);
                elements.forEach(function(element) {
                    const data = getAttributeData(elem.dataEditor);
                    const parentElementId = element.getAttribute(data).replace("#", 'editor-');
                    element.id = parentElementId;
                    const parentElement = document.getElementById(parentElementId);
                    const childElem = document.createElement("div");
                    childElem.id = parentElementId + '-child';
                    while (parentElement.firstChild) {
                        childElem.appendChild(parentElement.firstChild);
                    }
                    parentElement.appendChild(childElem);
                    new Quill('#' + childElem.id, {
                        theme: 'snow'
                    });
                });
            }

            const formSubmitEditor = function() {
                const elements = document.querySelectorAll(elem.dataEditor);
                elements.forEach(function(element) {
                    const data = getAttributeData(elem.dataEditor);
                    const targetId = element.getAttribute(data);
                    const innerHTMLContent = element.querySelector(cssClass.qlEditor).innerHTML;
                    formElem.querySelector(targetId).value = innerHTMLContent;
                });
            }

            const formSubmitPostConfirm = function(elemFormFuneralId) {
                const funeralId = elemFormFuneralId.querySelector('input').value;
                const elements = document.querySelectorAll(elem.dataPrimary);
                elements.forEach(function(element) {
                    element.value = funeralId;
                });
                elem.formSections.forEach(id => {
                    const targetElement = qs(id);
                    htmx.ajax('POST', ajax.confirm, {
                        source: id,
                        target: id
                    });
                });
            }

            const dataDisabled = function(form, bool) {
                form.querySelectorAll('input').forEach(inputElem => {
                    inputElem.disabled = bool;
                });
                form.querySelectorAll(elem.dataEditor).forEach(inputElem => {
                    if (bool === true) {
                        inputElem.classList.add(cssClass.dNone);
                    } else {
                        inputElem.classList.remove(cssClass.dNone);
                    }
                });
            }

            const pageLoadDisabled = (function() {
                formElem.querySelectorAll(elem.dataDisabled).forEach(form => {
                    dataDisabled(form, true);
                });
            })();

            const removeNodataText = (function() {
                formElem.querySelectorAll(elem.dataAdd).forEach(button => {
                    button.addEventListener('click', function() {
                        const hxTarget = this.getAttribute(elem.hxTarget);
                        const target = qs(hxTarget);
                        if (target.querySelectorAll('input').length <= 0) {
                            target.innerHTML = '';
                        }
                    });
                });
            })();

            const formSubmit = (function() {
                formElem.addEventListener('click', function(event) {
                    if (event.target.closest(elem.dataSubmit)) {
                        const elemFormFuneralId = qs(elem.formFuneralId);
                        htmx.ajax('POST', ajax.confirm, {
                            source: elemFormFuneralId,
                            target: elemFormFuneralId,
                            swap: 'innerHTML'
                        }).then(() => {
                            formSubmitEditor();
                            formSubmitPostConfirm(elemFormFuneralId);
                            const funeralId = elemFormFuneralId.querySelector('[name="funeral_id"]').value;
                            const loadContents = ajax.detail + funeralId;
                            htmx.ajax('GET', loadContents, {
                                target: elem.main
                            });
                        });
                    }
                });
                formElem.addEventListener('change', function(event) {
                    if (event.target.closest(elem.dataCsCategory)) {
                        data = getAttributeData(elem.dataCsCategory);
                        target = qs(event.target.getAttribute(data));
                        if (event.target.value != 'none') {
                            dataDisabled(target, false);
                        } else {
                            dataDisabled(target, true);
                        }
                    }
                });
            })();

            setTimeout(() => {
                setEditor();
            }, "500");
        }());

    }
</script>