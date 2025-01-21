$(function() {

    const form = '#form';
    const enqueteId = '#enquete';
    const clientDataId = '#clientData';
    const alertRequired = '#form-alert-required';
    const alertEnquete = '#form-alert-enquete';
    const submitButton = '[name="btn_submit"]';
    const submitButtonArea = '#disp-submit';
    const submitButtonLoadingArea = '#disp-submit-loading';
    const noDispClass = 'd-none';

    $(form).find(submitButton).on('click', function() {
        return formvalidation(submitButton);
    });

    /*formCalidation*/
    const formvalidation = function() {
        let errorCount = 0;
        let required = checkRequired(clientDataId);
        $(submitButtonArea).addClass(noDispClass);
        $(submitButtonLoadingArea).removeClass(noDispClass);
        if ($(clientDataId).length) {
            dispAlert(required, alertRequired);
            if (required == false) {
                errorCount += 1;
            }
        }
        if ($(enqueteId).length) {
            let enquete = checkRequired(enqueteId);
            dispAlert(enquete, alertEnquete);
            if (enquete == false) {
                errorCount += 1;
            }
        }
        if (errorCount == 0) {
            $(form).submit();
        } else {
            setTimeout(function() {
                $(submitButtonArea).removeClass(noDispClass);
                $(submitButtonLoadingArea).addClass(noDispClass);
            }, 500);
        }
    }

    /*dispAlert*/
    const dispAlert = function(parm, dispTarget) {
        if (parm == false) {
            $(dispTarget).removeClass(noDispClass);
        } else {
            $(dispTarget).addClass(noDispClass);
        }
    }

    /*enqueteRequired*/
    const checkRequired = function(targetId) {
        let errorCount = 0;
        $(targetId).find('input').each(function() {
            if ($(this).attr('required')) {
                let requiredName = $(this).attr('name');
                let requiredType = $(this).attr('type');
                let requiredVal = '';
                switch (requiredType) {
                    case 'radio':
                        requiredVal = $('[name=' + requiredName + ']:checked').val();
                        break;
                    case 'text':
                        requiredVal = $('[name=' + requiredName + ']').val();
                        break;
                }
                console.log(requiredName + '：' + requiredVal);
                if (requiredVal === void 0 || requiredVal == '') {
                    errorCount += 1;
                }
            }
        });
        console.log('---------------');
        if (errorCount == 0) {
            return true;
        } else {
            return false;
        }
    }


});