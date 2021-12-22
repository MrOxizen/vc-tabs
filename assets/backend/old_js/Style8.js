jQuery(document).ready(function () {
    var ctuultimateid = $("#ctu-ultimate-style-styleid").val();
    jQuery("#heading-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-size:" + jQuery('#heading-font-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ color:" + jQuery('#heading-font-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ background-color:" + jQuery('#heading-background-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-font-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li.active{ color:" + jQuery('#heading-font-active-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-background-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li.active{ background-color:" + jQuery('#heading-background-active-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li.active{ border-bottom: 1px solid " + jQuery('#heading-background-active-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery('#heading-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-weight:" + jQuery('#heading-font-weight').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-width").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ width: " + jQuery('#heading-width').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-text-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{ justify-content: " + jQuery(this).val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#heading-padding").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ padding: " + jQuery('#heading-padding').val() + "px 10px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-size:" + jQuery('#content-font-size').val() + "px;} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ color:" + jQuery('#content-font-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{ background-color:" + jQuery('#content-background-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-line-height").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ line-height:" + jQuery('#content-line-height').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery('#content-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-weight:" + jQuery('#content-font-weight').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
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
    jQuery("#content-font-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ text-align:" + jQuery('#content-font-align').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
    jQuery("#content-border-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ border-color:" + jQuery('#content-border-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li:first-child{ border-left-color:" + jQuery('#content-border-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+".active{ border-color:" + jQuery('#content-border-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{ border-color:" + jQuery('#content-border-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  @media only screen and (max-width: 900px){.ctu-ultimate-style-"+ctuultimateid+"-content{ border-color:" + jQuery('#content-border-color').val() + ";}} </style>").appendTo(".ctu-ultimate-wrapper-"+ctuultimateid+"");
    });
});