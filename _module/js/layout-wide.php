<?php
//======================================================================
// javascript：レイアウト変更
//======================================================================
?>
<script>
    (function() {
        const targetid = "<?php echo appConfigSite::pageMain; ?>";
        const targetTable = "<?php echo appConfigSite::secCsIndex; ?>";
        const dataWidth = "[data-width]";
        const dataCol = "[data-col]";
        const dataRow = "[data-row]";
        const dataLayoutWide = "[data-layout-wide]";
        const mainContents = document.querySelector(targetid);
        const dataAttribute = function(str) {
            return str.replace(/^\[|\]$/g, '');
        }
        const setTableLayout = function() {
            if (!!mainContents.querySelector(targetTable) != true) {
                return;
            }
            const table = mainContents.querySelector(targetTable);
            let tableWidth = 300;
            let thCount = 0;
            table.querySelectorAll(dataWidth).forEach(function(theadTh, count) {
                const tableColWidth = theadTh.getAttribute(dataAttribute(dataWidth));
                const nth = count + 1;
                const cells = table.querySelectorAll(dataCol + " " + dataRow + ":nth-child(" + nth + ")");
                theadTh.style.width = tableColWidth + "px";
                tableWidth += Number(tableColWidth);
                thCount++;
                cells.forEach(cell => {
                    cell.style.width = tableColWidth + "px";
                });
            });
            if (thCount > 0) {
                tableWidth = tableWidth + "px";
            }
            table.style.width = tableWidth;
            mainContents.querySelectorAll(dataLayoutWide).forEach(function(selecter) {
                selecter.style.width = tableWidth;
            });
            let windowWidth = window.innerWidth - 40;
            mainContents.querySelectorAll(dataLayoutWide + ">.pos-sticky").forEach(function(selecter) {
                selecter.style.width = windowWidth + "px";
            });
        }
        mainContents.querySelector(targetTable).addEventListener('htmx:afterSwap', function(event) {
            setTableLayout();
            window.addEventListener('resize', () => {
                setTableLayout();
            });
        });
    }());
</script>