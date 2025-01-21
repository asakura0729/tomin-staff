$(window).on('load', function() {

    const submitForm = '#form';
    const leftimgId = '#leftimg';
    const rightimgId = '#rightimg';
    /*button*/
    const btnEditPhoto = "#editphoto";
    const btnToggleGrid = '[data-toggle-grid]';
    const btnPanzoomReset = '[data-edit_reset]';
    const btnPanzoomZoomin = '[data-edit_zoomin]';
    const btnPanzoomZoomout = '[data-edit_zoomout]';
    const btnSubmit = '#btn-submit';
    /*module*/
    const inputAddBody = '[name="addbody"]';
    const areaGrid = '[data-disp-grid]';
    const loadingModule = '[data-disp-loading]';
    /*panzoom_setting*/
    const panzoomOptionDefault = {
        maxZoom: 3,
        /* 拡大時の上限 */
        minZoom: 0.2,
        /* 縮小時の下限 */
        initialX: 0,
        /* コンテンツ表示の初期横位置 */
        initialY: 0,
        /* コンテンツ表示の初期縦位置 */
        initialZoom: 1,
        /* コンテンツ表示時の初期倍率 */
        bounds: true
    }
    let leftPanzoom = null;
    let rightPanzoom = null;

    const setPanzoom = function(id, transform = true) {
        let removeClass = 'opacity-0';
        let idLength = $(id).length;
        let idSelect = document.querySelector(id);
        if (idLength < 1) {
            return false;
        }
        switch (id) {
            case leftimgId:
                leftPanzoom = panzoom(idSelect, panzoomOptionDefault);
                if (transform == true) {
                    panzoomTransform(id);
                }
                leftPanzoom.pause();
                break;
            case rightimgId:
                rightPanzoom = panzoom(idSelect, panzoomOptionDefault);
                if (transform == true) {
                    panzoomTransform(id);
                }
                rightPanzoom.pause();
                break;
        }
        $(id).removeClass(removeClass);
        return true;
    }

    const panzoomTransform = function(id) {
        let getTransform = $(id).data('transform');
        let x = 0;
        let y = 0;
        let scale = 1;
        if (getTransform.length === 3) {
            x = Number(getTransform[0]);
            y = Number(getTransform[1]);
            scale = Number(getTransform[2]);
        }
        console.log(id);
        switch (id) {
            case leftimgId:
                setTimeout(function() {
                    leftPanzoom.zoomTo(0, 0, scale);
                    setTimeout(function() {
                        leftPanzoom.moveTo(x, y);
                        $('[data-disp-loading="' + id + '"]').remove();
                    }, 500);
                }, 500);
                break;
            case rightimgId:
                setTimeout(function() {
                    rightPanzoom.zoomTo(0, 0, scale);
                    setTimeout(function() {
                        rightPanzoom.moveTo(x, y);
                        $('[data-disp-loading="' + id + '"]').remove();
                    }, 500);
                }, 500);
                break;
        }
        return true;
    }

    const panzoomZoomInOut = function(target, int) {
        switch (target) {
            case leftimgId:
                leftPanzoom.smoothZoom(0, 0, int);
                break;
            case rightimgId:
                rightPanzoom.smoothZoom(0, 0, int);
                break;
        }
        return;
    }

    const getDataName = function(data) {
        let dataName = data;
        dataName = dataName.replace('[', '');
        dataName = dataName.replace('data-', '');
        dataName = dataName.replace(']', '');
        return dataName;
    }

    const appendLoadingHtml = function() {
        let html = "";
        html += '<div class="w-100per minh-100vh bg-black-08 fixed-top z-index-500">';
        html += '<div class="position-middle-center text-center">';
        html += '<div class="spinner-border text-light" role="status">';
        html += '<span class="sr-only">Loading...</span>';
        html += '</div></div></div>';
        $('body').append(html);
    }

    const formSubmit = function() {
        console.log("formSubmit!");
        $(submitForm).submit();
    }

    $(btnToggleGrid).on("click", function() {
        let target = areaGrid;
        let btnToggleGridData = getDataName(btnToggleGrid);
        let toggleClass = $(this).data(btnToggleGridData);
        if ($(target).hasClass(toggleClass)) {
            $(target).removeClass(toggleClass);
        } else {
            $(target).addClass(toggleClass);
        }
    });

    $(btnEditPhoto).on("click", function() {
        let editStatus = $(btnEditPhoto + ':checked').val();
        if (editStatus == 1) {
            $('[data-disp-photomode="true"]').removeClass("d-none");
            $('[data-disp-photomode="false"]').addClass("d-none");
            $('[data-editimg]').each(function(index) {
                let selectid = $(this).attr('id');
                selectid = '#' + selectid;
                switch (selectid) {
                    case leftimgId:
                        leftPanzoom.resume();
                        break;
                    case rightimgId:
                        rightPanzoom.resume();
                        break;
                }
            });
        }
    });

    $(btnPanzoomReset).on("click", function() {
        let dataName = getDataName(btnPanzoomReset);
        let target = $(this).data(dataName);
        switch (target) {
            case leftimgId:
                leftPanzoom.dispose();
                setPanzoom(leftimgId, false);
                leftPanzoom.resume();
                break;
            case rightimgId:
                rightPanzoom.dispose();
                setPanzoom(rightimgId, false);
                rightPanzoom.resume();
                break;
        }
        return;
    });

    $(btnPanzoomZoomin).on("click", function() {
        let dataName = getDataName(btnPanzoomZoomin);
        let target = $(this).data(dataName);
        return panzoomZoomInOut(target, 1.01);
    });

    $(btnPanzoomZoomout).on("click", function() {
        let dataName = getDataName(btnPanzoomZoomout);
        let target = $(this).data(dataName);
        return panzoomZoomInOut(target, 0.99);
    });

    $(btnSubmit).on("click", function() {
        let addParm = "[";
        let totalIndex = $('[data-editimg]').length;
        $('[data-editimg]').each(function(index) {
            let selectid = $(this).attr('id');
            let imgId = $(this).data('editimg');
            let imgTransform = '';
            selectid = '#' + selectid;
            switch (selectid) {
                case leftimgId:
                    imgTransform = leftPanzoom.getTransform();
                    break;
                case rightimgId:
                    imgTransform = rightPanzoom.getTransform();
                    break;
            }
            imgTransform = JSON.stringify(imgTransform);
            addParm += '{"id":"' + imgId + '","transform":' + imgTransform + '}';
            if (index != totalIndex - 1) {
                addParm += ','
            }
        });
        addParm += ']';
        $(inputAddBody).val(addParm);
        appendLoadingHtml();
        setTimeout(function() {
            return formSubmit();
        }, 500);
    });

    setPanzoom(leftimgId);
    setPanzoom(rightimgId);

});