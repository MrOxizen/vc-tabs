jQuery(document).ready(function () {
    var ctuultimateid = $("#ctu-ultimate-style-styleid").val();
    jQuery("#heading-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{font-size: " + jQuery("#heading-font-size").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{font-size: " + jQuery("#heading-font-size").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{color: " + jQuery("#heading-font-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{color: " + jQuery("#heading-font-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{background-color: " + jQuery("#heading-background-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{background-color: " + jQuery("#heading-background-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-border-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{border-color: " + jQuery("#heading-border-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li.active{color: " + jQuery("#heading-font-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+".active{color: " + jQuery("#heading-font-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-style").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{font-style: " + jQuery("#heading-font-style").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery('#heading-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-family:" + font[0] + ";} </style>").appendTo(".oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{ font-family:" + font[0] + ";} </style>").appendTo(".oxi-addons-preview-data");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-width").on("change", function () {
        var value = parseInt(jQuery('#heading-width').val(), 10);
        var value1 = parseInt(jQuery('#heading-padding-left-right').val(), 10);
        var value2 = parseInt(jQuery('#heading-padding-box-left').val(), 10);
        var finalvalue = value + value1 + value2;
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{min-width:  " + finalvalue + "px;} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{max-width: " + jQuery("#heading-width").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-"+ctuultimateid+"-content{max-width: calc(100% - " + finalvalue + "px); } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-padding-up-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{padding: " + jQuery("#heading-padding-up-bottom").val() + "px " + jQuery("#heading-padding-left-right").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{padding: " + jQuery("#heading-padding-up-bottom").val() + "px 10px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-padding-left-right").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{padding: " + jQuery("#heading-padding-up-bottom").val() + "px " + jQuery("#heading-padding-left-right").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-padding-box").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{padding: " + jQuery("#heading-padding-box").val() + "px " + jQuery("#heading-padding-box-left").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-padding-box-left").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{padding: " + jQuery("#heading-padding-box").val() + "px " + jQuery("#heading-padding-box-left").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{font-size: " + jQuery("#content-font-size").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{color: " + jQuery("#content-font-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-line-height").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{line-height: " + jQuery("#content-line-height").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery('#content-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{ font-family:" + font[0] + ";} </style>").appendTo(".oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-family:" + font[0] + ";} </style>").appendTo(".oxi-addons-preview-data");
    });
    jQuery("#content-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{font-weight: " + jQuery("#content-font-weight").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-box-shadow-Horizontal").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-"+ctuultimateid+"{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-box-shadow-Vertical").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-"+ctuultimateid+"{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-box-shadow-Blur").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-"+ctuultimateid+"{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-box-shadow-Spread").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-"+ctuultimateid+"{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-box-shadow-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-"+ctuultimateid+"{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-style-heading-"+ctuultimateid+"{box-shadow:  0 0 5px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{box-shadow:  0 0 5px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-font-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs p{text-align: " + jQuery("#content-font-align").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-width").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulimate-style-"+ctuultimateid+"{width: calc(100% - " + jQuery("#content-width").val() + "%) ;} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data   .ctu-ultimate-style-"+ctuultimateid+"-content{width: " + jQuery("#content-width").val() + "%; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{background-color: " + jQuery("#content-background-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-border-left-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ulitate-style-"+ctuultimateid+"-tabs{border-left: 1px solid " + jQuery("#content-border-left-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#span-margin-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-content-span{margin-bottom: " + jQuery("#span-margin-bottom").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
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
    jQuery("#content-border-radius").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data  .ctu-ultimate-wrapper-"+ctuultimateid+"{border-radius: " + jQuery("#content-border-radius").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });

});