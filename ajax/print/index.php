<?php require_once '../../_app/ssl_base.php'; ?>

<?php appFuncStorage::start(); ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php require_once '../../_module/css/print.php'; ?>
<style>
    @media screen {
        .print_wrap {
            width: 240mm;
            height: 332mm;
            padding: 15mm;
        }
    }

    @media print {
        .print_wrap {
            padding: 15mm;
            height: 100vh;
        }
    }

    .l-prev-mark {
        position: absolute;
        top: 10mm;
        left: 10mm;
        width: 28mm;
        height: auto;
    }

    .wrap-postcode {
        width: 10mm;
        height: 12mm;
        overflow: hidden;
    }

    .vertical-upright {
        writing-mode: vertical-rl;
        text-orientation: upright;
    }

    .vertical-mixed {
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }

    .font-size-address {
        font-size: 2.8rem;
    }

    .font-size-name {
        font-size: 4.2rem;
    }

    .font-size-space {
        font-size: 75%;
    }

    .h-name {
        height: 200mm;
    }

    .pb-poscode {
        padding-bottom: 4rem;
    }

    .pt-address_col2 {
        padding-top: 10rem;
    }

    .pt-name {
        padding-top: 5rem;
    }

    .pb-name {
        padding-bottom: 6rem;
    }

    .text-line {
        display: inline-block;
        line-height: 1em;
        transform: scaleY(0.5);
    }

    .border-poscode-red {
        border: 1px solid #e83632;
    }

    .border-poscode-lred {
        border: 1px solid #f19798;
    }

    .color-poscode-red {
        color: #e83632;
    }
</style>

<div class="l-edit">
    <div class="bg-white w-450px h-100 border">
        <form id="form" class="pt-4">
            <div class="container pt-4">
                <?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
                <section class="pb-3">
                    <h2 class="font-size-1 pb-1">郵便番号</h2>
                    <input type="text" data-change-postcode="#postcode" maxlength="10" class="form-control" placeholder="例：1234567" value="">
                </section>
                <section class="pb-3">
                    <h2 class="font-size-1 pb-1">住所1</h2>
                    <input type="text" data-change-text="#address1" class="form-control" placeholder="例：東京都○○区○○町 1-2-3" value="">
                </section>
                <section class="pb-3">
                    <h2 class="font-size-1 pb-1">住所2</h2>
                    <input type="text" data-change-text="#address2" class="form-control" placeholder="例：○○○○マンション○○号室" value="">
                </section>
                <section class="pb-4">
                    <h2 class="font-size-1 pb-1">お客様名</h2>
                    <input type="text" data-change-text="#name" class="form-control" placeholder="例：都民 太郎" value="">
                </section>
            </div>
            <section class="pb-4">
                <h2 class="font-size-1 p-0 m-0">
                    <button class="btn btn-acd border-top border-bottom w-100 p-2 collapsed" type="button" data-toggle="collapse" data-target="#form-option">
                        応用設定
                    </button>
                </h2>
                <div id="form-option" class="collapse bg-llgray">
                    <div class="container">
                        <div class="form-group form-check pt-3 pb-4">
                            <input type="checkbox" class="form-check-input" id="check-sendmaterials" data-toggle-disp="send-materials">
                            <label class="form-check-label" for="check-sendmaterials">料金後納表記を使用</label>
                        </div>
                    </div>
                </div>
            </section>
            <div class="w-75 mx-auto">
                <?php appFuncModule::btn('print'); ?>
            </div>
            <div class="pt-4 font-size-0_9 container">
                【印刷時の設定について】<br>※用紙サイズは封筒角形2号を指定してください<br>※余白は「デフォルト」を設定してください
            </div>
        </form>
    </div>
</div>

<div id="prev" class="l-prev" data-animation="animation-fadein">
    <div class="position-relative print_wrap bg-white mx-auto">
        <header class="font-notoserif d-flex justify-content-end align-items-center font-size-2 pb-poscode line-height-1">
            <div data-postcode class="wrap-postcode mr-1 border-poscode-red p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
            <div data-postcode class="wrap-postcode mr-1 border-poscode-red p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
            <div data-postcode class="wrap-postcode border-poscode-red p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
            <div class="text-center p-1"><span class="pb-2 color-poscode-red d-block">-</span></div>
            <div data-postcode class="wrap-postcode mr-1 border-poscode-lred p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
            <div data-postcode class="wrap-postcode mr-1 border-poscode-lred p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
            <div data-postcode class="wrap-postcode mr-1 border-poscode-lred p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
            <div data-postcode class="wrap-postcode border-poscode-lred p-1 text-center"><span class="color-lgray print_nodisp">0</span></div>
        </header>
        <div class="l-prev-mark d-none" data-disp="send-materials"><img src="/assets/img/envelope/pic_mark.svg" alt="料金後納郵便"></div>
        <div class="pos-bottom-left w-100 text-center pb-3">
            <div class="font-weight-bold" style="font-size:1.3rem;">資料発送センター</div>
            <div class="pb-1 font-weight-bold color-pink" style="font-size:1.5rem;"><i class="fa fa-phone pr-1" aria-hidden="true"></i><?php echo appConfigSite::tel; ?></div>
            <div class="font-size-0_8" style="line-height:1.3">〒151-0051<br>東京都渋谷区千駄ヶ谷5-16-11<br> Lʼtia OFFICE YOYOGI 6階</div>
        </div>
        <div class="position-relative font-notoserif">
            <div class="row justify-content-end">
                <div class="col-4 d-flex flex-row-reverse align-items-start">
                    <div class="font-size-address text-right vertical-upright pl-3" id="address1">
                        <span class="color-lgray print_nodisp">東京都○○区○○町 1<span class="vertical-mixed text-line">―</span>2<span class="vertical-mixed text-line">―</span>3</span>
                    </div>
                    <div class="font-size-address text-right vertical-upright pt-address_col2" id="address2">
                        <span class="color-lgray print_nodisp">○○○○マンション○○号室</span>
                    </div>
                </div>
                <div class="pos-top-center pt-name font-size-name vertical-upright h-name"><span id="name" class="pb-name"><span class="color-lgray print_nodisp">都民 太郎</span></span>様</div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const elem = {
            form: "#form",
            prev: "#prev",
            postcode: '[data-postcode]',
            dataDisp: '[data-disp]'
        }

        const input = {
            changeText: '[data-change-text]',
            changePostcode: '[data-change-postcode]',
            dataToggleDisp: '[data-toggle-disp]'
        }

        const getDataName = function(str, dataHeader = true) {
            if (dataHeader == true) {
                str = str.replace('data-', '');
            }
            str = str.replace('[', '');
            str = str.replace(']', '');
            return str;
        }

        const dataParse = function(clickElem, selecter) {
            const dataName = getDataName(selecter);
            const result = $(clickElem).data(dataName);
            return result;
        }

        const hankaku2Zenkaku = function(str) {
            return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
            });
        }

        $(elem.form).on('change', input.changeText, function() {
            let val = $(this).val();
            let target = dataParse(this, input.changeText);
            let text = val;
            text = text.replaceAll('-', '{l}');
            text = text.replaceAll('‐', '{l}');
            //text = text.replaceAll(/\s+/g, '{s}');
            text = text.replaceAll('{l}', '<span class="vertical-mixed text-line">―</span>');
            text = text.replaceAll('{s}', '<span class="font-size-space">　</span>');
            text = hankaku2Zenkaku(text);
            $(target).empty().append(text);
        });

        $(elem.form).on('change', input.changePostcode, function() {
            const val = $(this).val();
            const newval = val.replaceAll(/[^0-9/]/g, '').slice(0, 7);
            const target = dataParse(this, input.changePostcode);
            const postcode = newval.split("");
            $(this).val(newval);
            $(elem.postcode).empty();
            for (let i = 0; i < postcode.length; i++) {
                $(elem.postcode).eq(i).append(postcode[i]);
            }
        });

        $(elem.form).on('change', input.dataToggleDisp, function() {
            let val = $(this).val();
            let targetParam = dataParse(this, input.dataToggleDisp);
            let dataName = getDataName(elem.dataDisp);
            $(elem.prev).find(elem.dataDisp).each(function(index) {
                let param = $(this).data(dataName);
                if (targetParam == param) {
                    if ($(this).hasClass('d-none')) {
                        $(this).removeClass('d-none');
                    } else {
                        $(this).addClass('d-none');
                    }
                }
            });
        });
    });
</script>
<?php appFuncStorage::end(); ?>d