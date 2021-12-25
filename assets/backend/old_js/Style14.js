jQuery(document).ready(function () {
    var ctuultimateid = $("#ctu-ultimate-style-styleid").val();
    jQuery("#heading-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ font-size:" + jQuery('#heading-font-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-font-color").on("change", function () {
        var idvalue = jQuery('#heading-font-color').val();
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ color:" + idvalue + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-font-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active{ color:" + jQuery('#heading-font-active-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-background-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active{ background-color:" + jQuery('#heading-background-active-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active .ctu-absolute{ border-top-color:" + jQuery('#heading-background-active-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery('#heading-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-font-style").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ font-style: " + jQuery('#heading-font-style').val() + ";}</style>").appendTo(" .ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ font-weight:" + jQuery('#heading-font-weight').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-text-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + "{ justify-content: " + jQuery('#heading-text-align').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-width").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ max-width: " + jQuery('#heading-width').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-padding").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li{ padding: " + jQuery('#heading-padding').val() + "px 10px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-icon-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li .oxi-icons{ font-size: " + jQuery('#heading-icon-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-margin-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " { margin-bottom: " + jQuery('#heading-margin-bottom').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-border-radius").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-" + ctuultimateid + " .vc-tabs-li.active{ border-radius: " + jQuery('#heading-border-radius').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-box-shadow-Horizontal").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active {box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-box-shadow-Vertical").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active {box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-box-shadow-Blur").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active {box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-box-shadow-Spread").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active {box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#heading-box-shadow-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-" + ctuultimateid + " .vc-tabs-li.active {box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs p{ font-size:" + jQuery('#content-font-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs p{ color:" + jQuery('#content-font-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs{ background-color:" + jQuery('#content-background-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-padding-top").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-right").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-left").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-line-height").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs p{ line-height:" + jQuery('#content-line-height').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery('#content-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs p{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs p{ font-weight:" + jQuery('#content-font-weight').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-font-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs p{ text-align:" + jQuery('#content-font-align').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-border-radius").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-" + ctuultimateid + "-tabs{ border-radius:" + jQuery('#content-border-radius').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-box-shadow-Blur").on("change", function () {
        var idvalue = jQuery('#content-box-shadow-Horizontal').val() + 'px ' + jQuery('#content-box-shadow-Vertical').val() + 'px ' + jQuery('#content-box-shadow-Blur').val() + 'px ' + jQuery('#content-box-shadow-Spread').val() + 'px ' + jQuery('#content-box-shadow-color').val();
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ulitate-style-" + ctuultimateid + "-tabs {box-shadow :" + idvalue + ";} </style>").appendTo(" .ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-box-shadow-Horizontal").on("change", function () {
        var idvalue = jQuery('#content-box-shadow-Horizontal').val() + 'px ' + jQuery('#content-box-shadow-Vertical').val() + 'px ' + jQuery('#content-box-shadow-Blur').val() + 'px ' + jQuery('#content-box-shadow-Spread').val() + 'px ' + jQuery('#content-box-shadow-color').val();
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ulitate-style-" + ctuultimateid + "-tabs {box-shadow :" + idvalue + ";} </style>").appendTo(" .ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-box-shadow-Vertical").on("change", function () {
        var idvalue = jQuery('#content-box-shadow-Horizontal').val() + 'px ' + jQuery('#content-box-shadow-Vertical').val() + 'px ' + jQuery('#content-box-shadow-Blur').val() + 'px ' + jQuery('#content-box-shadow-Spread').val() + 'px ' + jQuery('#content-box-shadow-color').val();
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ulitate-style-" + ctuultimateid + "-tabs {box-shadow :" + idvalue + ";} </style>").appendTo(" .ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-box-shadow-Spread").on("change", function () {
        var idvalue = jQuery('#content-box-shadow-Horizontal').val() + 'px ' + jQuery('#content-box-shadow-Vertical').val() + 'px ' + jQuery('#content-box-shadow-Blur').val() + 'px ' + jQuery('#content-box-shadow-Spread').val() + 'px ' + jQuery('#content-box-shadow-color').val();
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ulitate-style-" + ctuultimateid + "-tabs{box-shadow :" + idvalue + ";} </style>").appendTo(" .ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
    jQuery("#content-box-shadow-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ulitate-style-" + ctuultimateid + "-tabs{box-shadow:" + jQuery('#content-box-shadow-Horizontal').val() + "px " + jQuery('#content-box-shadow-Vertical').val() + "px " + jQuery('#content-box-shadow-Blur').val() + "px " + jQuery('#content-box-shadow-Spread').val() + "px " + jQuery('#content-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-" + ctuultimateid + "");
    });
});