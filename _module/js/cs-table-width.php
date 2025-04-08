<?php
//======================================================================
// javascript：テーブルの横幅調整
//======================================================================
?>
<script>
    document.body.addEventListener("htmx:afterSettle", function() {
        const targetTable = "#<?php echo appConfigPage::secCsIndex; ?>";
        const dataElem = "data-width";
        const tableWidth = function() {
            if (!!document.querySelector(targetTable) != true) {
                return;
            }
            const table = document.querySelector(targetTable);
            let tableWidth = 300;
            table.querySelectorAll("[" + dataElem + "]").forEach(function(theadTh, count) {
                const tableColWidth = theadTh.getAttribute(dataElem);
                const nth = count + 1;
                table.querySelectorAll(".d-table-row .d-table-cell:nth-child(" + nth + ")").forEach(function(tBodyTd) {
                    tBodyTd.style.width = tableColWidth + "px";
                });
                tableWidth += Number(tableColWidth);
            });
            table.style.width = tableWidth + "px";
        }
        tableWidth();
    });
</script>