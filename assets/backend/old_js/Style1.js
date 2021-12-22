jQuery(document).ready(function () {

    var ctuultimateid = $("#ctu-ultimate-style-styleid").val();
  
    jQuery("#heading-font-size").on("change", function () {
        jQuery("<style type='text/css'> #oxi-addons-preview-data  .vc-tabs-li{font-size: " + jQuery("#heading-font-size").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+"{font-size: " + jQuery("#heading-font-size").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+"{color: " + jQuery("#heading-font-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{color: " + jQuery("#heading-font-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{background-color: " + jQuery("#heading-background-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+"{background-color: " + jQuery("#heading-background-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li.active{color: " + jQuery("#heading-font-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+".active{color: " + jQuery("#heading-font-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-background-active-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{ border-top: " + jQuery("#heading-border-top").val() + "px solid " + jQuery("#heading-background-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{border-right: " + jQuery("#heading-background-active-color").val() + "1px solid; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li.active{background-color: " + jQuery("#heading-background-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+".active{background-color: " + jQuery("#heading-background-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery('#heading-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{ font-family:" + font[0] + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+"{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-text-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{justify-content: " + jQuery("#heading-text-align").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-width").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{width: " + jQuery("#heading-width").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-padding").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+" .vc-tabs-li{padding: " + jQuery("#heading-padding").val() + "px 10px; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+"{padding: " + jQuery("#heading-padding").val() + "px 10px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-Border-radius").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{border-radius: " + jQuery("#heading-Border-radius").val() + "px " + jQuery("#heading-Border-radius").val() + "px 0 0; } </style>").appendTo("#oxi-addons-preview-data");
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ultimate-style-heading-"+ctuultimateid+"{border-radius: " + jQuery("#heading-Border-radius").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-border-top").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{ border-top: " + jQuery("#heading-border-top").val() + "px solid " + jQuery("#heading-background-active-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-margin-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{margin-bottom: " + jQuery("#heading-margin-bottom").val() + "px; } </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#heading-box-shadow-Horizontal").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#heading-box-shadow-Vertical").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#heading-box-shadow-Blur").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#heading-box-shadow-Spread").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#heading-box-shadow-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulimate-style-"+ctuultimateid+"{box-shadow:" + jQuery('#heading-box-shadow-Horizontal').val() + "px " + jQuery('#heading-box-shadow-Vertical').val() + "px " + jQuery('#heading-box-shadow-Blur').val() + "px " + jQuery('#heading-box-shadow-Spread').val() + "px " + jQuery('#heading-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#content-font-size").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{font-size: " + jQuery("#content-font-size").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-font-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{color: " + jQuery("#content-font-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-line-height").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{line-height: " + jQuery("#content-line-height").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery('#content-font-familly').change(function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{ font-family:" + font[0] + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#content-font-weight").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{font-weight: " + jQuery("#content-font-weight").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-font-align").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs p{text-align: " + jQuery("#content-font-align").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-background-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{background-color: " + jQuery("#content-background-color").val() + ";} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-top").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-top").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-bottom").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-bottom").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-left").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-padding-right").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{padding: " + jQuery("#content-padding-right").val() + "px;} </style>").appendTo("#oxi-addons-preview-data");
    });
    jQuery("#content-box-shadow-Horizontal").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{box-shadow:" + jQuery('#content-box-shadow-Horizontal').val() + "px " + jQuery('#content-box-shadow-Vertical').val() + "px " + jQuery('#content-box-shadow-Blur').val() + "px " + jQuery('#content-box-shadow-Spread').val() + "px " + jQuery('#content-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#content-box-shadow-Vertical").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{box-shadow:" + jQuery('#content-box-shadow-Horizontal').val() + "px " + jQuery('#content-box-shadow-Vertical').val() + "px " + jQuery('#content-box-shadow-Blur').val() + "px " + jQuery('#content-box-shadow-Spread').val() + "px " + jQuery('#content-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#content-box-shadow-Blur").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{box-shadow:" + jQuery('#content-box-shadow-Horizontal').val() + "px " + jQuery('#content-box-shadow-Vertical').val() + "px " + jQuery('#content-box-shadow-Blur').val() + "px " + jQuery('#content-box-shadow-Spread').val() + "px " + jQuery('#content-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#content-box-shadow-Spread").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{box-shadow:" + jQuery('#content-box-shadow-Horizontal').val() + "px " + jQuery('#content-box-shadow-Vertical').val() + "px " + jQuery('#content-box-shadow-Blur').val() + "px " + jQuery('#content-box-shadow-Spread').val() + "px " + jQuery('#content-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
    jQuery("#content-box-shadow-color").on("change", function () {
        jQuery("<style type='text/css'>#oxi-addons-preview-data .ctu-ulitate-style-"+ctuultimateid+"-tabs{box-shadow:" + jQuery('#content-box-shadow-Horizontal').val() + "px " + jQuery('#content-box-shadow-Vertical').val() + "px " + jQuery('#content-box-shadow-Blur').val() + "px " + jQuery('#content-box-shadow-Spread').val() + "px " + jQuery('#content-box-shadow-color').val() + ";} </style>").appendTo(".ctu-ultimate-wrapper");
    });
});