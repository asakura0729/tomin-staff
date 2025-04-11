<?php
//======================================================================
// webサイト全体
//======================================================================
?>

<script>
    const elem = {
        header: document.querySelector("<?php echo appConfigSite::pageHeader; ?>"),
        main: document.querySelector("<?php echo appConfigSite::pageMain; ?>")
    }
    const htmxSetting = function(selector) {
        selector.querySelectorAll("[data-hx-push-url]").forEach(button => {
            const pushUrl = button.getAttribute("data-hx-push-url");
            button.setAttribute("data-hx-replace-url", pushUrl);
            button.addEventListener("click", function() {
                window.scroll({
                    top: 0,
                    behavior: "smooth",
                });
            });
        });
    }
    const gNavColorChange = function() {
        const path = location.pathname;
        const cssCurrent = 'is-current';
        const gnavLinks = elem.header.querySelectorAll("[data-hx-push-url]");
        let currentGnavId = null;
        gnavLinks.forEach(gnavLink => {
            const gnavId = gnavLink.getAttribute("id");
            const gnavLinkUrl = gnavLink.getAttribute("data-hx-push-url");
            gnavLink.classList.remove(cssCurrent);
            if (path === gnavLinkUrl) {
                currentGnavId = gnavId;
            }
        });
        if (currentGnavId != null) {
            document.getElementById(currentGnavId).classList.add(cssCurrent);
        }
    }
    htmxSetting(elem.header);
    htmx.onLoad(function(ajaxContents) {
        htmxSetting(ajaxContents);
        $(function() {
            $('[data-toggle="popover"]').popover();
        });
    });
    document.body.addEventListener("htmx:afterSettle", function() {
        gNavColorChange();
    });
</script>
