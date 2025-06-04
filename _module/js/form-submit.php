<?php
//======================================================================
// javascript：フォームの送信時の処理
//======================================================================
?>
<script>
    (function() {
        const submitBtn = "[data-submit]";
        const cssPointerEventsNone = "pointer-events-none"
        const formDisabled = function(elem) {
            elem.closest("form").classList.add(cssPointerEventsNone);
        }
        if (!!document.querySelector(submitBtn) === true) {
            document.querySelectorAll(submitBtn).forEach(function(selecter) {
                selecter.addEventListener("click", function() {
                    spinners(true);
                    this.closest("form").dispatchEvent(new Event("submit", {
                        bubbles: true
                    }));
                });
            });
        }
    }());
</script>