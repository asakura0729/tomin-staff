<?php
//======================================================================
// javascript：フォーム送信(送客シート作成)ボタン押下時の処理
//======================================================================
?>
<script>
    (function() {
        const submitBtn = "[data-submit]";
        const submitRedirectBtn = "[data-submit-redirect]";
        const inputRedirect = "input[name=redirect_flg]";
        const formRedirectSet = function(selecter) {
            document.querySelector(inputRedirect).removeAttribute("disabled");
            selecter.closest("form").querySelector(submitBtn).click();
        }
        if (!!document.querySelector(submitRedirectBtn) === true) {
            document.querySelectorAll(submitRedirectBtn).forEach(function(selecter) {
                selecter.addEventListener("click", function() {
                    return formRedirectSet(this);
                });
            });
        }
    }());
</script>