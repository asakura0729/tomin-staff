<?php
//======================================================================
// javascript：webサイト全体
//======================================================================
?>
<script>
    const id = {
        header: "<?php echo appConfigSite::pageHeader; ?>",
        main: "<?php echo appConfigSite::pageMain; ?>",
        spinners: "<?php echo appConfigSite::spinners; ?>"
    }
    const elem = {
        header: document.querySelector(id.header),
        dataHxPushUrl: "[data-hx-push-url]",
        dataHxReplaceUrl: "[data-hx-replace-url]",
        dataAddSpinner: "[data-add-spinner]",
        dataAnimation: "[data-animation]"
    }
    const css = {
        dNone: 'd-none',
        isCurrent: 'is-current'
    }
    const dataAttribute = function(str) {
        return str.replace(/^\[|\]$/g, '');
    }
    const htmxSetting = function(selector) {
        selector.querySelectorAll(elem.dataHxPushUrl).forEach(button => {
            const pushUrl = button.getAttribute(dataAttribute(elem.dataHxPushUrl));
            button.setAttribute(dataAttribute(elem.dataHxReplaceUrl), pushUrl);
            button.addEventListener("click", function() {
                document.querySelector(id.spinners).classList.remove(css.dNone);
                setTimeout(function() {
                    window.scrollTo(0, 0);
                }, 100);
            });
        });
        selector.querySelectorAll(elem.dataAddSpinner).forEach(button => {
            button.addEventListener("click", function() {
                const target = this.getAttribute(dataAttribute(elem.dataAddSpinner));
                const cloneSpinner = document.querySelector(id.spinners).innerHTML;
                document.querySelector(target).innerHTML = cloneSpinner;
            });
        });
    }
    const gNavColorChange = function() {
        const path = location.pathname;
        const gnavLinks = elem.header.querySelectorAll(elem.dataHxPushUrl);
        let currentGnavId = null;
        gnavLinks.forEach(gnavLink => {
            const gnavId = gnavLink.getAttribute("id");
            const gnavLinkUrl = gnavLink.getAttribute(dataAttribute(elem.dataHxPushUrl));
            gnavLink.classList.remove(css.isCurrent);
            if (path === gnavLinkUrl) {
                currentGnavId = gnavId;
            }
        });
        if (currentGnavId != null) {
            document.getElementById(currentGnavId).classList.add(css.isCurrent);
        }
    }
    const setAnimation = function() {
        document.querySelectorAll(elem.dataAnimation).forEach(selecter => {
            const css = selecter.getAttribute(dataAttribute(elem.dataAnimation));
            selecter.classList.add(css);
        });
    }
    htmxSetting(elem.header);
    htmx.onLoad(function(ajaxContents) {
        htmxSetting(ajaxContents);
        $(function() {
            $('[data-toggle="popover"]').popover();
        });
    });
    document.body.addEventListener("htmx:afterSettle", function(event) {
        gNavColorChange();
        setTimeout(function() {
            document.querySelector(id.spinners).classList.add(css.dNone);
            setAnimation();
        }, 250);
    });
</script>