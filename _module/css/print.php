<?php
//======================================================================
// 印刷用CSS
//======================================================================
?>
<style>
    @page {
        size: portrait;
    }

    @media print {

        #page-header,
        #bottom,
        .l-edit {
            display: none;
        }

        .l-wrap {
            padding: 0;
        }

        .bg-lgray {
            background: none;
        }

        .print_nodisp {
            display: none;
        }
    }

    @media screen {
        .l-edit {
            position: fixed;
            top: 60px;
            right: 0;
            z-index: 100;
            height: 100vh;
        }

        .l-prev {
            zoom: 0.75;
            padding-top: 30px;
            padding-bottom: 50px;
        }

        .l-prev {
            padding-right: 500px;
        }

    }
</style>