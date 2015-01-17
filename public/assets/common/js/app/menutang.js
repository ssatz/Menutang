/**
 * Created by Admin on 1/15/2015.
 */
function isFormValid(formId) {
    var $flag = true;
    var $radioflag = true;
    var name = new Array();
    debugger;
    $(formId).find("input[type=radio]").each(function () {
        name.push(this.name);
    })
    var uniqueNames = [];
    $.each(name, function (i, el) {
        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
    });
    $.each(uniqueNames, function (i, el) {
        $radioflag = false;
        $("input[name='" + el + "']").each(function () {
            if ($(this).is(":checked")) {
                $radioflag = true;
                if ($(this).val() == 1) {
                    $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').data('required', true);
                    $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').data('type', 'number');
                }
                else {
                    $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').removeData('required');
                    $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').removeData('type');
                }
            }
        });
        if (!$radioflag) {
            $("input[name='" + el + "']").parents('.form-group').addClass('has-error');
        }
        else {
            $radioflag = true;
            $("input[name='" + el + "']").parents('.form-group').removeClass('has-error');
        }

    });
    $(formId).find('input[type=text],#deliveryArea').each(function (e) {
        $(this).parents('.form-group').removeClass('has-error');
        $(this).nextAll('.required').remove();
        if ($(this).val() != undefined) {
            if ($(this).data('required') && ($(this).val().length == 0 || $(this).val() == '')) {
                $flag = false;
                $(this).parents('.form-group').addClass('has-error');
                $(this).after('<span class="required label-danger">This is a Required field</span>');
            }
        }
        if ($(this).data('type') != undefined && $(this).val().length > 0) {
            if (!validateType($(this).val(), $(this).data('type'))) {
                $flag = false;
                $(this).parents('.form-group').addClass('has-error');
                $(this).after('<span class="required label-danger">This field should contain only ' + $(this).data('type') + ' </span>');
            }

        }

    });

    $(formId).find('select').each(function () {
        $(this).parents('.form-group').removeClass('has-error');
        $(this).nextAll('.required').remove();
        if ($(this).val() === null) {
            $flag = false;
            $(this).parents('.form-group').addClass('has-error');
            $(this).after('<span class="required label-danger">This is a Required field</span>');

        }
    });

    return ($flag && $radioflag) ? true : false;
}


function validateType(e, t) {
    var n;
    switch (t) {
        case"number":
            n = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/;
            break;
        case"digits":
            n = /^\d+$/;
            break;
        case"alphanum":
            n = /^\w+$/;
            break;
        case"email":
            n = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))){2,6}$/i;
            break;
        case"url":
            e = (new RegExp("(https?|s?ftp|git)", "i")).test(e) ? e : "http://" + e;
        case"urlstrict":
            n = /^(https?|s?ftp|git):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
            break;
        case"dateIso":
            n = /^(\d{4})\D?(0[1-9]|1[0-2])\D?([12]\d|0[1-9]|3[01])$/;
            break;
        case"phone":
            n = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
            break;
        default:
            return false
    }
    return "" !== e ? n.test(e) : false;
}
