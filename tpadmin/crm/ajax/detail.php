<?php require_once '../../../_app/http/tpadmin/crm/ajax/detail.php'; ?>
<?php require_once '../_module/detail_css.php'; ?>


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
    <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#archive-collapse', 'title' => '過去対応ログ', 'icon' => 'fa-list', 'add' => 'data-hx-get="' . appRoutesWeb::ajax['adminCrmDetailAjaxReportCs']['path'] . appHttpTpAdminCrmAjaxDetail::$funeralId . '" data-hx-target="#archive-body"']); ?>
</article>

<div id="form-wrap" class="l-form-wrap">
    <?php require_once '../_module/form_detail.php'; ?>
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
                confirm: "<?php echo appRoutesWeb::ajax['adminCrmConfirm']['path']; ?>",
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