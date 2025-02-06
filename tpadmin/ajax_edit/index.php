<?php require_once '../../_app/http/tpadmin/ajax_edit/index.php'; ?>
<?php require_once './_module/detail_css.php'; ?>

<article id="archive" class="l-archive border">
    <?php
    //======================================================================
    // 過去対応ログ
    //======================================================================
    ?>
    <div id="archive-collapse" class="collapse">
        <div class="border overflow-y bg-white h-50vh">
            <div id="archive-body"></div>
        </div>
    </div>
    <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#archive-collapse', 'title' => '過去対応ログ', 'icon' => 'fa-list', 'add' => 'data-hx-get="' . appRoutesWeb::ajax['editLogs']['path'] . appHttpTpAdminCrmAjaxDetail::$funeralId . '" data-hx-target="#archive-body"']); ?>
</article>

<div id="form-wrap" class="l-form-wrap">
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
                        <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-additem data-hx-get="' . appRoutesWeb::ajax['editAddClient']['path'] . '" data-hx-target="#sec-2-1" hx-swap="afterbegin"']); ?>
                    </div>
                    <div class="bg-white">
                        <?php appLibraryDisp::heading('h2', '依頼者情報', ['class' => 'text-center m-0 p-3', 'icon' => 'fa-user-circle']); ?>
                        <div id="sec-2-1" class="bg-llgray p-2 pb-5 border-top">
                            <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultClient) > 0): ?>
                                <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultClient as $index => $client): ?>
                                    <?php appLibraryDisp::module('./_module/form_client.php', ['result' => $client, 'index' => $index]); ?>
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
                        <?php appLibraryDisp::module('./_module/form_add.php', ['id' => 'sec-3-1', 'table' => appDatabaseFuneral::table['crematory'], 'result' => appHttpTpAdminCrmAjaxDetail::$resultFuneral]); ?>
                        <?php appLibraryDisp::module('./_module/form_add.php', ['id' => 'sec-3-2', 'table' => appDatabaseFuneral::table['hall'], 'result' => appHttpTpAdminCrmAjaxDetail::$resultFuneral]); ?>
                        <?php appLibraryDisp::module('./_module/form_add.php', ['id' => 'sec-3-3', 'table' => appDatabaseFuneral::table['option'], 'result' => appHttpTpAdminCrmAjaxDetail::$resultFuneral]); ?>
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
                    <?php appLibraryDisp::module('./_module/form_report_cs.php'); ?>
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
                                <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-additem data-hx-get="' . appRoutesWeb::ajax['editAddTel']['path'] . '" data-hx-target="#sec-6-add" hx-swap="afterbegin"']); ?>
                            </div>
                            <div id="sec-6-add" class="bg-llgray p-3 pb-4 border-top">
                                <?php if (count(appHttpTpAdminCrmAjaxDetail::$resultReportTel) > 0): ?>
                                    <?php foreach (appHttpTpAdminCrmAjaxDetail::$resultReportTel as $value): ?>
                                        <?php appLibraryDisp::module('./_module/form_report_tel.php', ['result' => $value]); ?>
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
</div>
<div id="sec-confirm"></div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    if (typeof formConfig === 'undefined') {
        const formConfig = function() {
            const elem = {
                main: "<?php echo appConfigPage::pageMain; ?>",
                header: "<?php echo appConfigPage::pageHeader; ?>",
                postConfirm: 'input[name="<?php echo appLibraryCrm::postConfirm; ?>"]',
                form: '#form-wrap',
                formFuneralId: '#form-funeral_id',
                archiveArea: '#archive',
                dbSubmitForms: ["#sec-1", "#sec-2", "#sec-4", "#sec-6"],
                dataAddItem: '[data-additem]',
                dataItem: '[data-item]',
                dataItemPush: '[data-item-push]',
                dataItemDel: '[data-item-del]',
                dataEditor: '[data-editor]',
                dataDisabled: '[data-disabled]',
                dataDisabledToggle: '[data-disabled-toggle]',
                dataSubmit: '[data-submit]',
                dataSubmitCopy: '[data-submit-copy]',
                dataSubmitAdd: '[data-submit-add]',
                dataFuneralId: '[data-funeral_id]',
                dataReportLog: '[data-report-log]',
                hxTarget: 'data-hx-target',
            }

            const ajax = {
                confirm: "<?php echo appRoutesWeb::ajax['editConfirm']['path']; ?>",
                detailAjax: "<?php appLibraryDisp::link('adminCrmDetail', ['path' => 'contents']); ?>",
                detailUrl: "<?php appLibraryDisp::link('adminCrmDetail', ['path' => 'path']); ?>"
            }

            const cssClass = {
                qlEditor: '.ql-editor',
                dNone: 'd-none',
                isDisabled: 'is-disabled'
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

            const setQuillEditor = function() {
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
                    const quill = new Quill(childElemId, {
                        theme: 'snow'
                    });
                });
            }

            const dataDisabledToggle = function(targetForm, bool) {
                targetForm.querySelectorAll('input,select').forEach(inputElem => {
                    inputElem.disabled = bool;
                });
                if (bool === true) {
                    targetForm.classList.add(cssClass.isDisabled);
                } else {
                    targetForm.classList.remove(cssClass.isDisabled);
                }
            }

            const pageRefresh = function() {
                const funeralId = qs(elem.formFuneralId).querySelector('[name="funeral_id"]').value;
                const loadContents = ajax.detailAjax + funeralId;
                const pushUrl = ajax.detailUrl + funeralId;
                <?php if (appLibraryCrm::debug === false): ?>
                    htmx.ajax('GET', loadContents, {
                        target: elem.main,
                    });
                    history.pushState({}, "", pushUrl);
                <?php endif; ?>
            }

            const removeItemBtn = function() {
                formElem.querySelectorAll(elem.dataItemDel).forEach(function(delBtn) {
                    console.log(delBtn);
                    delBtn.addEventListener('click', function(event) {
                        const delItem = event.target.closest(elem.dataItem);
                        if (delItem) {
                            delItem.remove();
                        }
                    });
                });
            }

            const formSubmit_csReportlogValue = function() {
                const innerHTMLContent = formElem.innerHTML;
                formElem.querySelector(elem.dataReportLog).value = innerHTMLContent;
            }

            const formSubmit_addItemValueSet = function() {
                formElem.querySelectorAll(elem.dataItemPush).forEach(function(parent) {
                    const arr = [];
                    const targetInput = parent.getAttribute(getAttributeData(elem.dataItemPush));
                    parent.querySelectorAll('input').forEach(function(input) {
                        arr.push(input.value);
                    });
                    const json_text = JSON.stringify(arr);
                    qs(targetInput).value = json_text;
                });
            }

            const formSubmit_formElemMove = function() {
                const elements = document.querySelectorAll(elem.dataSubmitAdd);
                elements.forEach(function(element) {
                    const data = getAttributeData(elem.dataSubmitAdd);
                    const targetId = element.getAttribute(data);
                    qs(targetId).appendChild(element);
                });
            }

            const formSubmit_editorValueSet = function() {
                const elements = document.querySelectorAll(elem.dataEditor);
                elements.forEach(function(element) {
                    const data = getAttributeData(elem.dataEditor);
                    const targetId = element.getAttribute(data);
                    console.log(targetId);
                    const innerHTMLContent = element.querySelector(cssClass.qlEditor).innerHTML;
                    console.log(innerHTMLContent);
                    formElem.querySelector(targetId).value = innerHTMLContent;
                });
            }

            const formSubmit_postConfirm = function() {
                /*要改善*/
                const funeralId = qs(elem.formFuneralId).querySelector('input').value;
                const elements = formElem.querySelectorAll(elem.dataFuneralId);
                elements.forEach(function(element) {
                    element.value = funeralId;
                });
                elem.dbSubmitForms.forEach(id => {
                    const targetElement = qs(id);
                    htmx.ajax('POST', ajax.confirm, {
                        source: id,
                        target: id,
                    });
                    console.log(ajax.confirm);
                });
            }

            const formSubmit_postDB = function() {
                htmx.ajax('POST', ajax.confirm, {
                    source: elem.formFuneralId,
                    target: elem.formFuneralId,
                    swap: 'innerHTML'
                }).then(() => {
                    formSubmit_csReportlogValue();
                    formSubmit_addItemValueSet();
                    formSubmit_editorValueSet();
                    formSubmit_formElemMove();
                    formSubmit_postConfirm();
                    pageRefresh();
                });
            }

            const formChangeEvents = (function() {
                const inputElements = document.querySelectorAll('input,textarea').forEach(function(element) {
                    element.addEventListener('change', function() {
                        const inputValue = this.value;
                        this.setAttribute('value', inputValue);
                    });
                });
                const selectElements = document.querySelectorAll('select').forEach(function(element) {
                    element.addEventListener('change', function() {
                        const selectValue = this.selectedIndex;
                        const selectOptions = Array.from(this.children);
                        selectOptions.forEach(_option => {
                            if (_option.hasAttribute('selected')) {
                                _option.removeAttribute('selected');
                            }
                            selectOptions[selectValue].setAttribute('selected', '');
                        });
                    });
                });
            })();

            const removeItemBtnSet = (function() {
                removeItemBtn();
            })();

            const formDisabledSet = (function() {
                formElem.querySelectorAll(elem.dataDisabled).forEach(form => {
                    dataDisabledToggle(form, true);
                });
            })();

            const elemArchivePositionSet = (function() {
                const archiveElem = document.querySelector(elem.archiveArea)
                const headerHeight = document.querySelector(elem.header).offsetHeight;
                const elemArchive = archiveElem.style.top = headerHeight + "px";
            })();

            const event_dataAddItemClick = (function() {
                formElem.querySelectorAll(elem.dataAddItem).forEach(button => {
                    button.addEventListener('click', function() {
                        const hxTarget = this.getAttribute(elem.hxTarget);
                        const target = qs(hxTarget);
                        if (target.querySelectorAll('input').length <= 0) {
                            target.innerHTML = '';
                        }
                        setTimeout(() => {
                            return removeItemBtn();
                        }, "500");
                    });
                });
            })();

            const event_disabledToggle = (function() {
                formElem.addEventListener('change', function(event) {
                    if (event.target.matches(elem.dataDisabledToggle)) {
                        const data = getAttributeData(elem.dataDisabledToggle);
                        const target = qs(event.target.getAttribute(data));
                        if (event.target.checked != true) {
                            dataDisabledToggle(target, true);
                        } else {
                            dataDisabledToggle(target, false);
                        }
                    }
                });
            })();

            const event_formSubmit = (function() {
                formElem.addEventListener('click', function(event) {
                    if (event.target.matches(elem.dataSubmit)) {
                        /*submit*/
                        return formSubmit_postDB();
                    }
                    if (event.target.matches(elem.dataSubmitCopy)) {
                        /*copy*/
                        qs(elem.formFuneralId).querySelector(elem.dataFuneralId).value = "";
                        return formSubmit_postDB();
                    }
                });
            })();

            setTimeout(() => {
                setQuillEditor();
            }, "500");
        }

        setTimeout(() => {
            formConfig();
        }, "250");
    }
</script>