<?php
//======================================================================
// javascript：対応ログ用フォームの制御
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    (function() {
        const targetId = "<?php echo $option['target']; ?>";
        const targetForm = document.querySelector(targetId);
        const dataElem = {
            dataModal: '[data-modal]',
            dataToggleRow: '[data-toggle-row]',
            dataToggleAccordion: '[data-toggle-accordion]',
            dataInputCheck: '[data-input-check]',
            dataInputNumber: '[data-input-number]',
            dataInputDate: '[data-input-date]',
            dataAddSelect: '[data-add-select]',
            dataAddClone: '[data-add-clone]'
        }
        const css = {
            dNone: 'is-invalid',
            bgSelect: 'bg-lgreen'
        }
        const labelBgColorChange = function(event) {
            const modalId = event.closest('.modal').id;
            targetForm.querySelectorAll('#' + modalId + ' label').forEach(function(label) {
                label.classList.remove(css.bgSelect);
            });
            event.closest('label').classList.add(css.bgSelect);
        }
        const setModalBtn = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(btn) {
                btn.addEventListener("click", function() {
                    $(targetId).find('.modal').modal('show');
                });
            });
        }
        const setToggleRowBtn = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(radioBtn) {
                radioBtn.addEventListener("click", function() {
                    if (this.checked) {
                        const radioBtnText = this.closest('label').textContent.trim();
                        const dataToggleRow = selecter.replace(/^\[|\]$/g, '');
                        const toggleRowJSON = this.getAttribute(dataToggleRow);
                        const toggleRow = JSON.parse(toggleRowJSON);
                        const toggleTarget = toggleRow.target;
                        const toggleDisp = toggleRow.disp;
                        labelBgColorChange(this);
                        setTimeout(() => {
                            $(targetId).find('.modal').modal('hide');
                        }, "250");
                        setTimeout(() => {
                            targetForm.querySelector(dataElem.dataModal).textContent = radioBtnText;
                            targetForm.querySelectorAll(toggleTarget).forEach(function(col) {
                                if (toggleDisp === true) {
                                    col.classList.remove(css.dNone);
                                } else {
                                    col.classList.add(css.dNone);
                                    if (col.querySelector('input')) {
                                        col.querySelector('input').value = '';
                                    } else if (col.querySelector('textarea')) {
                                        col.querySelector('textarea').value = '';
                                    } else if (col.querySelector('select')) {
                                        col.querySelector('select').selectedIndex = 0;
                                    }
                                }
                            });
                        }, "500");
                    }
                });
            });
            if (!!targetForm.querySelector(selecter + ':checked') === true) {
                targetForm.querySelector(selecter + ':checked').click();
            }
        }
        const setToggleAccordionBtn = function(selecter) {
            const closeStatusText = '＋';
            const openStatusText = '－';
            if (!!targetForm.querySelectorAll(selecter) === false) {
                return;
            }
            targetForm.querySelectorAll(selecter).forEach(button => {
                const btnStatus = button.getAttribute(dataAttribute(selecter));
                button.addEventListener('click', () => {
                    const target = button.nextElementSibling;
                    if (target.classList.contains(css.dNone)) {
                        target.classList.remove(css.dNone);
                        button.textContent = openStatusText;
                    } else {
                        target.classList.add(css.dNone);
                        button.textContent = closeStatusText;
                    }
                });
                if (btnStatus === 'true') {
                    button.click();
                } else {
                    button.textContent = openStatusText;
                }
            });
        }
        const setInputCheck = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(checkBox) {
                checkBox.addEventListener("click", function() {
                    const inputCheckJSON = this.getAttribute(dataAttribute(dataElem.dataInputCheck));
                    const inputCheck = JSON.parse(inputCheckJSON);
                    const target = inputCheck.target;
                    const checkValue = inputCheck.checkValue;
                    const noCheckValue = inputCheck.noCheckValue;
                    let setValue = noCheckValue;
                    if (this.checked) {
                        setValue = checkValue;
                    }
                    targetForm.querySelector(target).value = setValue;
                });
            });
        }
        const setInputNumberFormat = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(input) {
                inputNumberFormat(input);
                changeInputNumberFormat(input);
            });
        }
        const setAddValSelectmenu = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(selectMenu) {
                selectMenu.addEventListener("change", function() {
                    const selectValue = this.value.replace(/&#10;/g, '\n');;
                    const targetInput = this.getAttribute(dataAttribute(selecter));
                    const targetInputVal = targetForm.querySelector(targetInput).value;
                    setTimeout(() => {
                        targetForm.querySelector(targetInput).value = selectValue + '\n' + targetInputVal;
                        this.selectedIndex = 0;
                    }, "250");
                });
            });
        }
        const setAddCloneValBtn = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(btn) {
                btn.addEventListener("click", function() {
                    const data = JSON.parse(this.getAttribute(dataAttribute(selecter)));
                    const dataTarget = data.target;
                    const dataClone = data.clone;
                    targetForm.querySelector(dataTarget).value = '';
                    setTimeout(() => {
                        targetForm.querySelector(dataTarget).value = targetForm.querySelector(dataClone).value;
                    }, "250");
                });
            });
        }
        const setTextAreaResize = function() {
            const debounceTimers = new Map();
            const observer = new ResizeObserver(entries => {
                for (const entry of entries) {
                    const textarea = entry.target;
                    if (debounceTimers.has(textarea)) {
                        clearTimeout(debounceTimers.get(textarea));
                    }
                    const timer = setTimeout(() => {
                        for (const entry of entries) {
                            const height = entry.target.offsetHeight;
                            changeInputHeight(height);
                        }
                        debounceTimers.delete(textarea);
                    }, 200);
                    debounceTimers.set(textarea, timer);
                }
            });
            targetForm.querySelectorAll('textarea').forEach(textarea => {
                observer.observe(textarea);
            });
        }
        const changeInputHeight = function(height) {
            targetForm.querySelectorAll('textarea').forEach(function(input) {
                input.style.height = height + 'px';
            });
        }
        const changeInputNumberFormat = function(selecter) {
            selecter.addEventListener("change", function() {
                inputNumberFormat(this);
            });
        }
        const changeInputDateAction = function(selecter) {
            targetForm.querySelectorAll(selecter).forEach(function(input) {
                input.addEventListener("change", function() {
                    const dataName = dataAttribute(selecter);
                    const targetInputs = '[' + dataName + '=' + this.getAttribute(dataName) + ']';
                    let date = {
                        'min': '',
                        'max': ''
                    };
                    targetForm.querySelectorAll(targetInputs).forEach(function(targetInput, i) {
                        if (i === 0) {
                            date.min = targetInput.value;
                        } else {
                            date.max = targetInput.value;
                            if (date.max != '' && date.min > date.max) {
                                alert('検索開始日時よりも大きい値をいれて下さい');
                                targetInput.value = '';
                            } else if (date.min != '') {
                                targetInput.readOnly = false;
                            } else if (date.min === '') {
                                targetInput.readOnly = true;
                            }
                        }
                    });
                });
            });
        }
        const inputNumberFormat = function(selecter) {
            let num = selecter.value;
            if (num != '') {
                num = num.replace(/[^\d-]/g, '');
                num = Number(num).toLocaleString()
            }
            selecter.value = num;
        }
        setModalBtn(dataElem.dataModal);
        setToggleRowBtn(dataElem.dataToggleRow);
        setToggleAccordionBtn(dataElem.dataToggleAccordion);
        setInputCheck(dataElem.dataInputCheck);
        setInputNumberFormat(dataElem.dataInputNumber);
        setAddCloneValBtn(dataElem.dataAddClone);
        setAddValSelectmenu(dataElem.dataAddSelect);
        setTextAreaResize();
        changeInputDateAction(dataElem.dataInputDate);
    }());
</script>