<?php
//======================================================================
// javascript：フォームの送信
//======================================================================
?>
<script>
    (function() {
        const spinners = document.querySelector("<?php echo appConfigSite::spinners; ?>");
        const submitBtn = "data-submit";
        const submitRedirectBtn = "data-submit-redirect";
        const inputRedirect = "input[name=redirect]";
        const cssClass = {
            dNone: "d-none",
            pointerEventsNone: "pointer-events-none",
        };
        const formDisabled = function(elem) {
            elem.closest("form").classList.add(cssClass.pointerEventsNone);
        }
        const formRedirectSet = function(elem) {
            if (elem.getAttribute(submitRedirectBtn) != null) {
                document.querySelector(inputRedirect).removeAttribute("disabled");
            }
        }
        if (!!document.querySelector("[" + submitBtn + "]") === true) {
            document.querySelectorAll("[" + submitBtn + "]").forEach(function(submitBtn) {
                submitBtn.addEventListener("click", function() {
                    spinners.classList.remove(cssClass.dNone);
                    formDisabled(this);
                    formRedirectSet(submitBtn);
                    this.closest("form").dispatchEvent(new Event("submit", {
                        bubbles: true
                    }));
                });
            });
        }
    }());
</script>