<?php
//======================================================================
// javascript：フォームの送信時、リダイレクト処理を行う
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