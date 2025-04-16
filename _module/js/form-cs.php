<?php
//======================================================================
// javascript：対応ログ用フォームの制御
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    (function() {
        const targetId = "<?php echo $option['target']; ?>";
        const targetForm = document.querySelector(targetId);;
        const elem = {
            dataModal: '[data-modal]',
            dataToggleRow: '[data-toggle-row]',
            dataInputCheck: '[data-input-check]',
            dataInputNumber: '[data-input-number]',
            inputClientCategory: "input[name=<?php echo appDatabaseCs::table['client_category']['name']; ?>]"
        }
        const css = {
            dNone: 'd-none',
            bgSelect: 'bg-lgreen'
        }
        const setModalBtn = function(btn) {
            btn.addEventListener("click", function() {
                $(targetId).find('.modal').modal('show');
            });
        }
        const labelBgColorChange = function(event) {
            const modalId = event.closest('.modal').id;
            targetForm.querySelectorAll('#' + modalId + ' label').forEach(function(label) {
                label.classList.remove(css.bgSelect);
            });
            event.closest('label').classList.add(css.bgSelect);
        }
        const setToggleRowBtn = function(radioBtn) {
            radioBtn.addEventListener("click", function() {
                if (this.checked) {
                    const radioBtnText = this.closest('label').textContent.trim();
                    const dataToggleRow = elem.dataToggleRow.replace(/^\[|\]$/g, '');
                    const toggleRowJSON = this.getAttribute(dataToggleRow);
                    const toggleRow = JSON.parse(toggleRowJSON);
                    const toggleTarget = toggleRow.target;
                    const toggleDisp = toggleRow.disp;
                    labelBgColorChange(this);
                    setTimeout(() => {
                        $(targetId).find('.modal').modal('hide');
                    }, "250");
                    setTimeout(() => {
                        targetForm.querySelector(elem.dataModal).textContent = radioBtnText;
                        targetForm.querySelectorAll(toggleTarget).forEach(function(col) {
                            if (toggleDisp === true) {
                                col.classList.remove(css.dNone);
                            } else {
                                col.classList.add(css.dNone);
                                if (col.querySelector('input')) {
                                    col.querySelector('input').value = '';
                                } else if (col.querySelector('textarea')) {
                                    col.querySelector('textarea').value = '';
                                }
                            }
                        });
                    }, "500");
                }
            });
        }
        const inputCheck = function(checkBox) {
            checkBox.addEventListener("click", function() {
                const dataInputCheck = elem.dataInputCheck.replace(/^\[|\]$/g, '');
                const inputCheckJSON = this.getAttribute(dataInputCheck);
                const inputCheck = JSON.parse(inputCheckJSON);
                const target = inputCheck.target;
                const checkValue = inputCheck.checkValue;
                const noCheckValue = inputCheck.noCheckValue;
                let setValue = noCheckValue;
                if (this.checked) {
                    setValue = checkValue;
                }
                targetForm.querySelectorAll(target).forEach(function(input) {
                    input.value = setValue;
                });
            });
        }
        const inputNumber = function(input) {
            input.addEventListener("change", function() {
                return inputNumberFormat(input);
            });
        }
        const inputNumberFormat = function(input) {
            let num = input.value;
            if (num != '') {
                num = num.replace(/[^\d-]/g, '');
                num = Number(num).toLocaleString()
            }
            input.value = num;
        }
        targetForm.querySelectorAll(elem.dataModal).forEach(function(btn) {
            setModalBtn(btn);
        });
        targetForm.querySelectorAll(elem.inputClientCategory).forEach(function(radioBtn) {
            setToggleRowBtn(radioBtn);
        });
        targetForm.querySelectorAll(elem.dataInputCheck).forEach(function(checkBox) {
            inputCheck(checkBox);
        });
        targetForm.querySelectorAll(elem.dataInputNumber).forEach(function(input) {
            inputNumber(input);
            inputNumberFormat(input);
        });
        if (!!targetForm.querySelector(elem.inputClientCategory + ':checked') === true) {
            targetForm.querySelector(elem.inputClientCategory + ':checked').click();
        }
    }());
</script>