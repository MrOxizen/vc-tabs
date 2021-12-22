jQuery(document).ready(function () {
    var ctuultimateid = $("#ctu-ultimate-style-styleid").val();
    jQuery("#heading-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-size:" + jQuery('#heading-font-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery('#heading-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-font-style").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-style: " + jQuery('#heading-font-style').val() + ";}</style>").appendTo(" .ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-weight:" + jQuery('#heading-font-weight').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-text-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{ justify-content:" + jQuery('#heading-text-align').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-width").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ max-width: " + jQuery('#heading-width').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-padding").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ padding: " + jQuery('#heading-padding').val() + "px 10px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-margin-right").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ margin-right: " + jQuery('#heading-margin-right').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-border-radius").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ border-radius: " + jQuery('#heading-border-radius').val() + "px " + jQuery('#heading-border-radius').val() + "px 0 0;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-size:" + jQuery('#content-font-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-padding-top").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-right").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-left").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-line-height").on("change", function () {
        var idvalue = jQuery('#content-line-height').val();
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ line-height:" + idvalue + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery('#content-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-weight:" + jQuery('#content-font-weight').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-font-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ text-align:" + jQuery('#content-font-align').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
});