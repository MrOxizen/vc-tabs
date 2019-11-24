jQuery.noConflict();
(function ($) {
    var styleid = '';
    var childid = '';
    function Oxi_Tabs_Admin_Create(functionname, rawdata, styleid, childid, callback) {
        if (functionname !== "") {
            $.ajax({
                url: oxi_tabs_editor.ajaxurl,
                type: "post",
                data: {
                    action: "oxi_tabs_data",
                    _wpnonce: oxi_tabs_editor.nonce,
                    functionname: functionname,
                    styleid: styleid,
                    childid: childid,
                    rawdata: rawdata
                },
                success: function (response) {
                    callback(response);
                }
            });
        }
    }
    jQuery(".oxi-addons-addons-template-create").on("click", function (e) {
        e.preventDefault();
        $('#addons-style-name').val('');
        $('#oxistyledata').val($('#' + $(this).attr('addons-data')).val())
        jQuery("#oxi-addons-style-create-modal").modal("show");
    });

    jQuery("#oxi-addons-style-modal-form").submit(function (e) {
        e.preventDefault();
        var rawdata = $(this).serialize();
        var functionname = "create_tabs";
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
        var rawdata = $This.serialize();
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
    jQuery(".OxiAddImportDatacontent").on("click", function () {
        jQuery("#OxiAddImportDatacontent").select();
        document.execCommand("copy");
        alert("Your Style Data Copied");
    });


})(jQuery)