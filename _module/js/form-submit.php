<?php
//======================================================================
// javascript：フォームの送信
//======================================================================
?>
<div id="submit-spinners" class="cover-white opacity-090 d-none">
    <?php appFuncModule::component('spinners'); ?>
</div>
<script>
    (function() {
        const submitBtn = "data-submit";
        const submitRedirectBtn = "data-submit-redirect";
        const inputRedirect = "input[name=redirect]";
        const cssClass = {
            dNone: "d-none",
            fadein: "animation-fadein",
            pointerEventsNone: "pointer-events-none",
            opacity50: "opacity-050"
        };
        const spinners = function() {
            document.querySelector('#submit-spinners').classList.remove(cssClass.dNone);
            document.querySelector('#submit-spinners').classList.add(cssClass.fadein);
        }
        const formDisabled = function(elem) {
            elem.closest("form").classList.add(cssClass.pointerEventsNone);
            elem.closest("form").classList.add(cssClass.opacity50);
        }
        const formRedirectSet = function(elem) {
            if (elem.getAttribute(submitRedirectBtn) != null) {
                document.querySelector(inputRedirect).removeAttribute("disabled");
            }
        }
        if (!!document.querySelector("[" + submitBtn + "]") === true) {
            document.querySelectorAll("[" + submitBtn + "]").forEach(function(submitBtn) {
                submitBtn.addEventListener("click", function() {
                    spinners();
                    formDisabled(this);
                    formRedirectSet(submitBtn);
                    setTimeout(() => {
                        this.closest("form").dispatchEvent(new Event("submit", {
                            bubbles: true
                        }));
                    }, "250");
                });
            });
        }
    }());
</script>