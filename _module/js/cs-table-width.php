<?php
//======================================================================
// javascript：テーブルの横幅調整
//======================================================================
?>
<script>
    document.body.addEventListener("htmx:afterSettle", function() {
        const mainContents = document.querySelector("<?php echo appConfigSite::pageMain; ?>");
        const targetTable = "<?php echo appConfigSite::secCsIndex; ?>";
        const dataElem = "data-width";
        const dataCol = "[data-col]";
        const dataRow = "[data-row]";
        const setTableLayout = function() {
            if (!!mainContents.querySelector(targetTable) != true) {
                return;
            }
            const table = mainContents.querySelector(targetTable);
            let tableWidth = 300;
            table.querySelectorAll("[" + dataElem + "]").forEach(function(theadTh, count) {
                const tableColWidth = theadTh.getAttribute(dataElem);
                const nth = count + 1;
                const cells = table.querySelectorAll(dataCol + " " + dataRow + ":nth-child(" + nth + ")");
                theadTh.style.width = tableColWidth + "px";
                tableWidth += Number(tableColWidth);
                cells.forEach(cell => {
                    cell.style.width = tableColWidth + "px";
                });
            });
            table.style.width = tableWidth + "px";
            const windowWidth = window.innerWidth - 25;
            mainContents.querySelectorAll("form").forEach(function(form) {
                form.style.width = tableWidth + "px";
            });
            mainContents.querySelectorAll("form>.pos-sticky").forEach(function(formInner) {
                formInner.style.width = windowWidth + "px";
            });
        }
        setTableLayout();
        window.addEventListener('resize', () => {
            setTableLayout();
        });
    });
</script>