<?php
//======================================================================
// javascript：フォームの送信
//======================================================================
?>
<script>
    (function() {
        const spinners = document.querySelector("<?php echo appConfigSite::spinners; ?>");
        const submitBtn = "[data-submit]";
        const cssClass = {
            dNone: "d-none",
            pointerEventsNone: "pointer-events-none",
        };
        const formDisabled = function(elem) {
            elem.closest("form").classList.add(cssClass.pointerEventsNone);
        }
        if (!!document.querySelector(submitBtn) === true) {
            document.querySelectorAll(submitBtn).forEach(function(selecter) {
                selecter.addEventListener("click", function() {
                    spinners.classList.remove(cssClass.dNone);
                    formDisabled(this);
                    this.closest("form").dispatchEvent(new Event("submit", {
                        bubbles: true
                    }));
                });
            });
        }
    }());
</script>