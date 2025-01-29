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

    .l-archive {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding-top: 0;
        z-index: 200;
    }

    .ql-container {
        height: 200px;
    }
</style>

<div id="form-wrap">
    <article id="archive" class="l-archive border">
        <?php
        //======================================================================
        // 過去対応ログ
        //======================================================================
        ?>
        <div id="archive-collapse" class="collapse">
            <div class="border overflow-y bg-llgray h-50vh">
                <div class="l-main pt-4">
                </div>
            </div>
        </div>
        <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#archive-collapse', 'title' => '過去対応ログ']); ?>
    </article>


    <div class="row no-gutters pb-5 animation-fadein pt-4">
        <div class="col-12 col-lg-3">
            <div class="pb-4">
                <?php
                //======================================================================
                // 葬儀ID
                //======================================================================
                ?>
                <div class="p-3 bg-white">
                    複製機能<br>有効電話、運営事務局、無効電話
                </div>
            </div>
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


        <div class="col-12 col-lg-5 pl-lg-3 pr-lg-3">
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '葬儀情報', ['class' => 'text-center']); ?>
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
                    <div class="pb-3">
                        <?php appLibraryDisp::heading('h2', '本日対応ログ', ['class' => 'text-center']); ?>
                        <?php appLibraryDisp::globalModule(
                            'btn/collapse_xl',
                            [
                                'target' => '#sec-4-collapse-1',
                                'title' => '登録／編集'
                            ]
                        ); ?>
                        <div id="sec-4-collapse-1" class="collapse">
                            <div class="p-3">
                                <?php appLibraryDisp::dbform('hidden', ['report_id'], appDatabaseReport::table, [], ['multiple' => true]); ?>
                                <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, [], ['value' => '対応ログ', 'multiple' => true]); ?>
                                <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryCs, 'multiple' => true]); ?>
                                <?php appLibraryDisp::dbform('select_label', ['cs_category'], appDatabaseReport::tableCs, [], ['add' => 'data-disabled-toggle="#sec-4"', 'multiple' => true, 'selectItem' => appDatabaseReport::csCategory]); ?>
                                <?php appLibraryDisp::dbform('hidden', ['comment'], appDatabaseReport::table, [], ['add' => 'id="sec-4-comment"', 'multiple' => true]); ?>
                                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-primary', 'multiple' => true]); ?>
                                <div data-editor='#sec-4-comment'></div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3">
                        <?php appLibraryDisp::heading('h2', '承認者確認', ['class' => 'text-center']); ?>
                        <?php appLibraryDisp::globalModule(
                            'btn/collapse_xl',
                            [
                                'target' => '#sec-4-collapse-2',
                                'title' => '登録／編集'
                            ]
                        ); ?>
                        <div id="sec-4-collapse-2" class="collapse">
                            <div class="p-3">
                                <?php appLibraryDisp::dbform('hidden', ['approval_status'], appDatabaseReport::tableCs, [], ['multiple' => true]); ?>
                                <?php appLibraryDisp::dbform('hidden', ['comment'], appDatabaseReport::table, [], ['add' => 'id="sec-4-approval_comment"', 'multiple' => true]); ?>
                                <div data-editor='#sec-4-approval_comment'></div>
                            </div>
                        </div>
                    </div>
                    <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmReport); ?>
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
                    <?php appLibraryDisp::globalModule(
                        'btn/collapse_xl',
                        [
                            'target' => '#sec-5-collapse',
                            'title' => '登録／編集'
                        ]
                    ); ?>
                    <div id="sec-5-collapse" class="collapse">
                        <div class="p-3">
                            <div data-editor='#sec-3-comment'>
                                <?php appLibraryDisp::dbform('disp', ['funeral_comment'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                            </div>
                        </div>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    if (typeof formConfig === 'undefined') {
        const formConfig = (function() {
            const elem = {
                main: "<?php echo appConfigPage::pageMain; ?>",
                header: "<?php echo appConfigPage::pageHeader; ?>",
                postConfirm: 'input[name="<?php echo appLibraryCrm::postConfirm; ?>"]',
                form: '#form-wrap',
                formFuneralId: '#form-funeral_id',
                formSections: ["#sec-1", "#sec-2", "#sec-3", "#sec-4", "#sec-5", "#sec-6"],
                archive: '#archive',
                editorSections: ["#sec-4-quil", "#sec-5-quil"],
                dataAdd: '[data-add]',
                dataEditor: '[data-editor]',
                dataDisabled: '[data-disabled]',
                dataDisabledToggle: '[data-disabled-toggle]',
                dataSubmit: '[data-submit]',
                dataPrimary: '[data-primary]',
                hxTarget: 'data-hx-target',
            }

            const ajax = {
                confirm: "<?php echo appConfigSite::ajax['adminCrmConfirm']['path']; ?>",
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
                    const childElemId = '#' + childElem.id;
                    parentElement.appendChild(childElem);
                    new Quill(childElemId, {
                        theme: 'snow'
                    });
                });
            }

            const formSubmitEditor = function() {
                const elements = document.querySelectorAll(elem.dataEditor);
                elements.forEach(function(element) {
                    const data = getAttributeData(elem.dataEditor);
                    const targetId = element.getAttribute(data);
                    console.log(targetId);
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

            const dataDisabledToggle = function(form, bool) {
                form.querySelectorAll('input').forEach(inputElem => {
                    inputElem.disabled = bool;
                });
            }

            const pageLoadDisabled = (function() {
                formElem.querySelectorAll(elem.dataDisabled).forEach(form => {
                    dataDisabledToggle(form, true);
                });
            })();

            const elemArchivePosChange = (function() {
                const headerHeight = document.querySelector(elem.header).offsetHeight;
                const elemArchive = qs(elem.archive).style.top = headerHeight + "px";
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
                    if (event.target.closest(elem.dataDisabledToggle)) {
                        data = getAttributeData(elem.dataDisabledToggle);
                        target = qs(event.target.getAttribute(data));
                        if (event.target.value != 'none') {
                            dataDisabledToggle(target, false);
                        } else {
                            dataDisabledToggle(target, true);
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