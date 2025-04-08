<?php
//======================================================================
// javascript：対応ログ用フォームの制御
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    (function() {
        const target = "<?php echo $option['target']; ?>";
        const targetForm = document.querySelector("<?php echo $option['target']; ?>");
        const input = {
            clientCategory: "input[name=<?php echo appDatabaseCs::table['client_category']['name']; ?>]"
        }
        const css = {
            dNone: 'd-none',
            bgSelect: 'bg-lgreen'
        }
        targetForm.querySelectorAll(input.clientCategory).forEach(function(radioBtn) {
            radioBtn.addEventListener("click", function() {
                if (this.checked) {
                    const modalId = this.closest('.modal').id;
                    const dataToggleRow = this.getAttribute('data-toggle-row');
                    const radioBtnText = this.closest('label').textContent.trim();
                    const toggleRow = JSON.parse(dataToggleRow);
                    targetForm.querySelectorAll('#' + modalId + ' label').forEach(function(elem) {
                        elem.classList.remove(css.bgSelect);
                    });
                    this.closest('label').classList.add(css.bgSelect);
                    setTimeout(() => {
                        $(target).find('.modal').modal('hide');
                    }, "250");
                    setTimeout(() => {
                        targetForm.querySelector('button[data-target="#' + modalId + '"]').textContent = radioBtnText;
                        targetForm.querySelectorAll(toggleRow.target).forEach(function(col) {
                            if (toggleRow.disp === true) {
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
        });
    }());
</script>