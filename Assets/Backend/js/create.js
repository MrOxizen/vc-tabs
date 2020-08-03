jQuery.noConflict();
(function ($) {
    var styleid = '';
    var childid = '';
    function Oxi_Tabs_Admin_Create(functionname, rawdata, styleid, childid, callback) {
        if (functionname !== "") {
            $.ajax({
                url: oxilabtabsultimate.root + 'oxilabtabsultimate/v1/' + functionname,
                method: 'POST',
                dataType: "json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', oxilabtabsultimate.nonce);
                },
                data: {
                    styleid: styleid,
                    childid: childid,
                    rawdata: rawdata
                }
            }).done(function (response) {
                callback(response);
            });
        }
    }
    jQuery(".oxi-addons-addons-js-create").on("click", function (e) {
        e.preventDefault();
        $('#addons-style-name').val('');
        $('#oxistyledata').val($('#' + $(this).attr('addons-data')).val());
        console.log('new modal form');
        $("#oxi-addons-style-create-modal").modal("show");
    });

    jQuery("#oxi-addons-style-modal-form").submit(function (e) {
        e.preventDefault();
        var rawdata = JSON.stringify($(this).serializeJSON({checkboxUncheckedValue: "0"}));
        var functionname = "create_new";
        $('.modal-footer').prepend('<span class="spinner sa-spinner-open-left"></span>');
        Oxi_Tabs_Admin_Create(functionname, rawdata, styleid, childid, function (callback) {
            console.log(callback);
            setTimeout(function () {
                document.location.href = callback;
            }, 1000);
        });
    });

    jQuery(".shortcode-addons-template-deactive").submit(function (e) {
        e.preventDefault();
        var $This = $(this);
        var rawdata = JSON.stringify($(this).serializeJSON({checkboxUncheckedValue: "0"}));
        var functionname = "shortcode_deactive";
        $(this).append('<span class="spinner sa-spinner-open"></span>');
        Oxi_Tabs_Admin_Create(functionname, rawdata, styleid, childid, function (callback) {
            console.log(callback);
            setTimeout(function () {
                if (callback === "done") {
                    $This.parents('.oxi-addons-col-1').remove();
                }
            }, 1000);
        });
        return false;
    });
    jQuery(".shortcode-addons-template-import").submit(function (e) {
        e.preventDefault();
        var rawdata = JSON.stringify($(this).serializeJSON({checkboxUncheckedValue: "0"}));
        var functionname = "shortcode_active";
        $(this).prepend('<span class="spinner sa-spinner-open-left"></span>');
        Oxi_Tabs_Admin_Create(functionname, rawdata, styleid, childid, function (callback) {
            console.log(callback);
            setTimeout(function () {
                document.location.href = callback;
            }, 1000);
        });
        return false;
    });
    jQuery(".shortcode-addons-template-pro-only").submit(function (e) {
        e.preventDefault();
        return false;
    });

})(jQuery)