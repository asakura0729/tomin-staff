<?php require_once __DIR__ . '../../../_app/ssl_base.php'; ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php appConfigPage::$title = appConfigSite::siteName; ?>
<?php require_once __DIR__ . '../../../_tmpl/header.php'; ?>
<?php require_once __DIR__ . '../../../_tmpl/l-header.php'; ?>

<main id="page-top" class="l-wrap" hx-history-elt>
    <?php if (appConfigSite::maintenance == true) : ?>
        <div class="container print-none">
            <div class="alert alert-danger p-2 text-center" role="alert">
                ただいまメンテナンス作業を行っています。データ登録・変更の操作は控えてください。
            </div>
        </div>
    <?php endif; ?>
    <div id="page-indicator" class="htmx-spinner">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div id="page-main" class="l-main" <?php appFuncDisp::hxGet(); ?>></div>
</main>

<?php require_once __DIR__ . '../../../_tmpl/l-footer.php'; ?>
<?php appFuncMinify::minifySourceEnd(); ?>

<script>
    const elem = {
        header: document.querySelector("#page-header"),
        main: document.querySelector("#page-main")
    }
    const htmxSetting = function(selector) {
        selector.querySelectorAll("[data-hx-push-url]").forEach(button => {
            const pushUrl = button.getAttribute("data-hx-push-url");
            button.setAttribute("data-hx-replace-url", pushUrl);
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
            if (gnavLinkUrl === path || path.indexOf(gnavLinkUrl) >= 0) {
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

<?php require_once __DIR__ . '../../../_tmpl/footer.php'; ?>