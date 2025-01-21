$(function() {
    const form = '#form';
    const errorMsg = 'エラーが発生しました';
    const maxItemLength = 30;

    //関数：AJAXデータを読み込む
    const ajaxDataLoad = function(url, params = "") {
        return $.ajax({
            type: "GET",
            url: url + params,
            dataType: "html",
            cache: false
        });
    }

    //関数：数値をフォーマット
    const intFormat = function(num) {
        if (!isNaN(num)) {
            num = Math.floor(num); //小数点以下切り捨て
            num = num.toLocaleString(); //カンマ区切りを入れる
            return num;
        } else {
            return num;
        }
    }

    const strIntFormat = function(num) {
        let target = '[data-intformat]';
        $(target).each(function() {
            let int = $(this).text();
            int = intFormat(int);
            $(this).empty().append(int);
        });
    }

    //関数：アラートの消去
    const alertDel = function(target) {
        $(target).fadeOut('slow');
    }

    //関数：計算
    const itemPriceKeisan = function() {
        let tax = 0.1; //消費税
        let target = $('[data-disp="price"]');
        let dataPriceDispLength = target.length;
        let totalPrice = 0;
        let totalPriceZei = 0;
        let totalTax = 0;
        //一旦すべての金額をリセット
        target.empty();
        //計算
        for (i = 0; i < dataPriceDispLength; i++) {
            let id = target.eq(i).data('parent');
            let price = $(id).find('[data-price]').val();
            let int = $(id).find('[data-int]').val();
            let sumPrice = price * int;
            totalPrice += sumPrice;
            $(id).find(target).append(intFormat(sumPrice));
        }
        //合算値の描画
        totalTax = totalPrice * tax;
        totalPriceZei = totalPrice + totalTax;
        $('[data-disp="totaltax"]').empty().append(intFormat(totalTax));
        $('[data-disp="totalprice"]').empty().append(intFormat(totalPrice));
        $('[data-disp="totalpricezei"]').empty().append(intFormat(totalPriceZei));
        $('input,button').prop("disabled", false);
    }

    //モーダルボタンクリック時の動作（商品一覧）
    $('body').on('click', '[data-confirm]', function() {
        let id = $(form).find('[name="id"]').val();
        let dataConfirm = $(this).data("confirm");
        let formchangeFlag = $(form).find('[data-formchangeflag]').val();
        let confirmWin = "";
        let confirm_withdrawal = 'このページから移動しますか？（保存していない入力内容は破棄されます）';
        let confirm_new = '見積もりデータを新規作成しますか？（保存していない入力内容は破棄されます）';
        let alert_clatePdf = 'PDF作成前に、画面左側の「保存」ボタンを押してください。';
        let alert_seikyu = '請求書作成前に、画面左側の「保存」ボタンを押してください。';
        let result = "";
        switch (dataConfirm) {
            case 'clatepdf':
                if (id == "" || id == null || formchangeFlag == 'true') {
                    alert(alert_clatePdf);
                    return false;
                } else {
                    return true;
                }
            case 'seikyu':
                if (id == "" || id == null || formchangeFlag == 'true') {
                    alert(alert_seikyu);
                    return false;
                } else {
                    return true;
                }
            case 'withdrawal':
                confirmWin = confirm_withdrawal;
                result = window.confirm(confirmWin);
                break;
            case 'new':
                confirmWin = confirm_new;
                result = window.confirm(confirmWin);
                break;
        } //switch
        if (!result) {
            return false;
        }
    });

    //フォーム追加ボタンクリック時の動作
    $('[data-addform-url]').click(function() {
        let ajaxUrl = $(this).data('addform-url');
        let addTarget = $(this).data('addform-target');
        let val = $(this).val();
        let ajaxParm = '?id=' + val;
        let dataPriceLength = $(addTarget).find('[data-price]').length;
        if (dataPriceLength >= maxItemLength) {
            return alert('追加上限に達しました');
        }
        ajaxDataLoad(ajaxUrl, ajaxParm).done(function(data) {
            setTimeout(function() {
                $(addTarget).append(data);
                return itemPriceKeisan();
            }, 200);
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            return alert(errorMsg);
        });
    });

    //テキストエリア'[data-int][data-price]'操作時の動作
    $(form).on('change click', '[data-int],[data-price]', function() {
        let value = $(this).val();
        value = value.replace(/[^0-9]/g, '');
        $(this).val(value);
        itemPriceKeisan();
    });

    //テキストエリア'[data-submit]'操作時の動作
    $(form).on('click', '[data-submit]', function() {
        let postType = $(this).data('submit');
        let clientId = $(form).find('[name="client_id"]').val();
        let category = $(form).find('[name="category"]').val();
        let submitFlag = 0;
        let confirmWin = "";
        switch (postType) {
            case "copy":
                //複製ボタン押下時の処理
                confirmWin = window.confirm('この見積もりデータを複製します。よろしいですか？');
                if (confirmWin) {
                    $(form).find('[name="posttype"]').val("insert_copy");
                    submitFlag = 1;
                }
                break;
            case "save":
                //保存ボタン押下時の処理
                submitFlag = 1;
                break;
        }
        if (submitFlag == 1) {
            $('[data-alert="submit"]').removeClass("d-none");
            $(this).prop("disabled", true).addClass("bg-disabled");
            $(form).submit();
        }
    });

    //削除ボタン[data-del]クリック時の操作
    $(form).on('click', '[data-del]', function() {
        let parentId = $(this).data('del');
        let result = window.confirm('項目を削除します。よろしいですか？');
        if (result) {
            $(parentId).remove();
            itemPriceKeisan();
        }
    });

    //フォーム追加ボタンクリック時の動作
    $('[data-modalclose]').click(function() {

    });

    //キーボードのキーを入力した際、POSTしないようにする
    $("input").keydown(function(e) {
        if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
            return itemPriceKeisan();
        }
    });

    //ページを開いた後、フォームで変更を感知した場合、formChangeFlagをTrueに
    $(form).on('change click', 'input, [data-del], [data-additem], [data-addform]', function() {
        $(form).find('[data-formchangeflag]').val('true');
    });

    //ページ読み込み開始直後の処理
    setTimeout(alertDel, 2000, '[data-alert="pageload"]'); //一定時間後、アラートを非表示にす
    strIntFormat();
    itemPriceKeisan();
});