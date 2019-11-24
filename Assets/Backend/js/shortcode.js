jQuery.noConflict();
(function ($) {
    "use strict";

    var styleid = '';
    var childid = '';
    function Oxi_Tabs_Admin_Editor(functionname, rawdata, styleid, childid, callback) {
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
    $('#oxi-addons-admin-add-new-item').on("click", function (e) {
        e.preventDefault();
        $('#item-id').val("");
        $('#cau-title').val("");
        $('#ctu-link').val("");
        $('#ctu-details').val("");
        $("#oxilab-add-new-data").modal("show");

    });
    $('#content-tabs-ultimate-drag-id').on("click", function (e) {
        e.preventDefault();
        $("#oxi-addons-drag-and-drop-data").modal("show");
    });
    setTimeout(function () {
        jQuery('#oxi-addons-drag-drop').sortable({
            axis: 'y',
            opacity: 0.7
        });
    }, 500);

    jQuery('.oxilab-vendor-color').each(function () {
        jQuery(this).minicolors({
            control: jQuery(this).attr('data-control') || 'hue',
            defaultValue: jQuery(this).attr('data-defaultValue') || '',
            format: jQuery(this).attr('data-format') || 'hex',
            keywords: jQuery(this).attr('data-keywords') || 'transparent' || 'initial' || 'inherit',
            inline: jQuery(this).attr('data-inline') === 'true',
            letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
            opacity: jQuery(this).attr('data-opacity'),
            position: jQuery(this).attr('data-position') || 'bottom left',
            swatches: jQuery(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
            change: function (value, opacity) {
                if (!value)
                    return;
                if (opacity)
                    value += ', ' + opacity;
                if (typeof console === 'object') {
                    // console.log(value);
                }
            },
            theme: 'bootstrap'
        });
    });

    $(".oxi-addons-tabs-ul li:first").addClass("active");
    $(".oxi-addons-tabs-content-tabs:first").addClass("active");
    $(".oxi-addons-tabs-ul li").click(function () {
        if ($(this).hasClass('active')) {
            $(".oxi-addons-tabs-ul li").removeClass("active");
            var activeTab = $(this).attr("ref");
            $(activeTab).removeClass("active");
        } else {
            $(".oxi-addons-tabs-ul li").removeClass("active");
            $(this).toggleClass("active");
            $(".oxi-addons-tabs-content-tabs").removeClass("active");
            var activeTab = $(this).attr("ref");
            $(activeTab).addClass("active");
        }
    });
    $(".oxi-addons-form-heading").click(function () {
        var self = $(this).parent();
        self.toggleClass("oxi-admin-head-d-none");
    });
    $(".oxi-head").click(function () {
        var self = $(this).parent();
        self.toggleClass("oxi-admin-head-d-none");
    });

    jQuery(function () {
        jQuery("#oxi-addons-drag-submit").submit(function (e) {
            e.preventDefault();
            var rawdata = jQuery('#oxi-addons-drag-drop').sortable('toArray').toString();
            var functionname = "addons_rearrange";
            jQuery("#oxi-addons-ultimate-drag-saving").slideDown();
            jQuery("#oxi-addons-drag-drop").slideUp();
            jQuery("#oxi-addons-drag-and-drop-data-close").slideUp();
            jQuery('#oxi-addons-drag-and-drop-data-submit').val('Saving...');
            Oxi_Tabs_Admin_Editor(functionname, rawdata, styleid, childid, function (callback) {
                console.log(callback);
                setTimeout(function () {
                    location.reload();
                }, 500);
            });
            return false;
        });
    });
    jQuery("#oxilab-preview-data-background").on('change', function (e) {
        e.preventDefault();
        $('#oxi-addons-preview-data').css("background-color", $(this).val());
    });


})(jQuery);