///* 
// * Frontend JS Script
// */
//jQuery(document).ready(function($) {
//       var maps = [];
//       var markers = [];
//       var woocommerce_enabled = etab_params.check_woocommerce_enabled;
//
//       $('.etab-group-wrap').each(function() {
//        //$(this).children('.ap_tab').find('.tab-title').prependTo($(this).find('.etab_tab_group'));
//        $(this).children('.etab-label').wrapAll("<div class='etab-header-wrap clearfix'><ul class='etab-title-tabs'></ul></div>");
//       });
//
//        if(woocommerce_enabled == "true"){
//          $('.everest-tab-main-wrapper').each(function(){
//               $(this).addClass('woocommerce');
//          });
//        
//        }
//
//    $( window ).resize(function() {
//       if($(window).width() >= 570){
//          $('.everest-tab-main-wrapper').each(function(){
//            if($(this).hasClass('etab-top-compact-position') || $(this).hasClass('etab-bottom-compact-position')){
//             // var tabwidth = $(this).find('.etab-header-wrap').outerWidth();
//              //var win_width = $(window).width();
//              //var widthPercent = (parseInt(tabwidth) / parseInt(win_width))*100;
//              var num = $(this).find('.etab-header-wrap .etab-title-tabs li').length;
//              var eachwidth = 100 / parseInt(num);
//              $(this).find('.etab-header-wrap .etab-label').css({
//                width: eachwidth + '%'
//              }); 
//            }
//
//          });
//          }
//     }).resize();
//
//
//    
//       $('.etab-label').each(function() {
//        if( $(this).hasClass('etab-active-show')){
//        var unique_id = $(this).parent().attr('data-id');
//         var id= $(this).attr('id');
//        $(this).closest('.etab-sc-main-wrapper').find('.'+unique_id+'.'+id).addClass("etab-active-content");
//        }     
//       });
//
//
//
//
//      
//      /*
//       * On Click Tab 
//       */
//      // $('.etab-trigger-on_click .etab-header-wrap ul.etab-title-tabs').on('click','.etab-label',function() {
//      $(".etab-trigger-on_click").on('click', '.etab-label',function(){
//           if(!$(this).hasClass('etab-active-show')){
//            var tabtype = $(this).find('a').attr('data-tabtype');
//            if(tabtype == "component_type"){
//            var tab_id = $(this).attr('id');
//            var tab_parent_id = $(this).parent().data('id');
//            var animation = $(this).closest('.etab-sc-main-wrapper').find('.'+tab_id).data('animation');
//            
//            if($(this).parent().data('deeplinking')){
//                 var hash = '#' + $(this).data('link');
//                 $(this).find('a').attr('href',hash);
//            }
//
//            $(this).siblings().removeClass('etab-active-show');
//            $(this).addClass("etab-active-show");
//            $(this).closest('.etab-sc-main-wrapper').find('.etab-content-section.'+tab_parent_id).removeClass('etab-active-content');
//            $(this).closest('.etab-sc-main-wrapper').find('.'+tab_id).addClass("etab-active-content").addClass(animation);;
//            if($('.'+tab_id).find('.etab-google-map').length > 0){
//               setTimeout(function () {
//                initMap();
//               }, 1500); 
//            }
//             }
//           }
//        });
//
//       $('.etab-label').each(function(){
//        var hash = '#' + $(this).find('a').attr('href');
//        if(hash == window.location.hash){
//            $(this).click();
//        }
//       });    
//
//       $(window).on('hashchange', function(){
//          //console.log( 'location.hash: ' + location.hash );
//          var hash =  $('.etab-label').find('a[href="'+location.hash+'"]');
//          $(hash).click();
//       });
//
//       /*
//       * On Hover Tab 
//       */
//      $('.etab-trigger-on_hover').on('hover','.etab-label',function() {
//           if(!$(this).hasClass('etab-active-show')){
//            var tabtype = $(this).find('a').attr('data-tabtype');
//            if(tabtype == "component_type"){
//            var tab_id = $(this).attr('id');
//            var tab_parent_id = $(this).parent().data('id');
//            var animation = $(this).closest('.etab-sc-main-wrapper').find('.'+tab_id).data('animation');
//            $(this).siblings().removeClass('etab-active-show');
//            $(this).addClass("etab-active-show");
//            $(this).closest('.etab-sc-main-wrapper').find('.etab-content-section.'+tab_parent_id).removeClass('etab-active-content');
//            $(this).closest('.etab-sc-main-wrapper').find('.'+tab_id).addClass("etab-active-content").addClass(animation);;
//            if($('.'+tab_id).find('.etab-google-map').length > 0){
//               setTimeout(function () {
//                initMap();
//               }, 1500); 
//            }
//            }
//           }
//        });
//
//       
//        function initMap(var_lati,var_long) {
//            var $maps = $('.etab-google-map');
//            $.each($maps, function (i, value) {
//                var zoom_level = parseInt($(value).data('zoomlevel'));
//                var varlocation = { lat: parseFloat($(value).data('latitude')), lng: parseFloat($(value).data('longitude')) };
//
//                var mapDivId = $(value).attr('id');
//
//                maps[mapDivId] = new google.maps.Map(document.getElementById(mapDivId), {
//                    zoom: zoom_level,
//                    center: varlocation
//                });
//
//                markers[mapDivId] = new google.maps.Marker({
//                    position: varlocation,
//                    map: maps[mapDivId]
//                });
//            });
//        }
//        initMap();
//
// });






jQuery.noConflict();
(function ($) {
    $(document).ready(function () {
        /* Check Url if there have any ID*/
        var trigger = '', hash_link = window.location.hash;
        if (hash_link.includes("oxi-tabs-trigger-")) {
            var trigger = hash_link, explode = trigger.split("-"), parent = explode[3], child = explode[4];
            OxiTabsController(parent, child);
        }

        /* Install All Tabs*/
        if (trigger === '') {
            $('[class*=oxi-tabs-wrapper-]').each(function () {
                var This = $(this), id = This.attr('id'), explode = id.split("-"), parent = explode[3];
                OxiTabsController(parent);
            });
        }

        /* Re-Install Tabs While Style Data Saved*/
        $('#style-changing-trigger').change(function () {
            $("#oxi-addons-preview-data").find("*").off();
            $('[class*=oxi-tabs-wrapper-]').each(function () {
                var This = $(this), id = This.attr('id'), explode = id.split("-"), parent = explode[3];
                OxiTabsController(parent);
            });
        });
        /* Check any btn click for confirm event for tabs*/
        $(document).on('click', '[id^="oxi-tabs-trigger-"]', function () {
            var wrapper = $(this).attr('id'), explode = wrapper.split("-"), parent = explode[3], child = explode[4];
            OxiTabsController(parent, child);
        });


        /* Tabs Header Hover  Data Confirmation*/
        
        $(document).on('click', '.oxi-tabs-hover-event .oxi-tabs-header-li', function () {
            var link = $(this).data("link"), variable = '';
            if ((typeof link !== typeof undefined && link !== false) && typeof variable === '#oxi-addons-preview-data') {
                var target = '_self';
                if (link.target === 'yes') {
                    var target = ", '_blank'";
                }
                window.open("" + link.url + "", "" + target + "");
            } else {
                var t = $(this).attr('ref'), explode = t.split("-"), parent = explode[3], child = explode[4];
                OxiTabsController(parent, child);
            }
        });
        
        /* Tabs Header Click Data Confirmation*/
        
        $(document).on('click', '.oxi-tabs-click-event .oxi-tabs-header-li', function () {
            var link = $(this).data("link"), variable = '';
            if ((typeof link !== typeof undefined && link !== false) && typeof variable === '#oxi-addons-preview-data') {
                var target = '_self';
                if (link.target === 'yes') {
                    var target = ", '_blank'";
                }
                window.open("" + link.url + "", "" + target + "");
            } else {
                var t = $(this).attr('ref'), explode = t.split("-"), parent = explode[3], child = explode[4];
                OxiTabsController(parent, child);
            }
        });


        function OxiTabsController(p = '', c = '') {
            var cls = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style";
            var title = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style .oxi-tabs-header-li";
            var mtitle = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style .oxi-tabs-body-header";
            var content = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style .oxi-tabs-body-tabs";

            var j = $(cls).data('oxi-tabs');

            if (c === '') {
                $(title + j.initial).addClass("active");
                $(mtitle + j.initial).addClass("active");
                $(content + j.initial).show();
            } else {
                if (j.trigger === '1') {
                    var hl = '.oxi-tabs-header-li-' + p + '-' + c, bh = '.oxi-tabs-body-header-' + p + '-' + c, cb = '#oxi-tabs-body-' + p + '-' + c;
                    if ($(hl).hasClass('active') || $(bh).hasClass('active')) {
                        $(hl).toggleClass("active");
                        $(bh).toggleClass("active");
                        if (j.animation === 'fade') {
                            $(cb).fadeOut();
                        } else if (j.animation === 'slide') {
                            $(cb).slideUp();
                        } else {
                            $(cb).hide();
                        }
                    } else {
                        $(title).removeClass("active");
                        $(hl).toggleClass("active");
                        $(mtitle).removeClass("active");
                        $(bh).toggleClass("active");
                        if (j.animation === 'fade') {
                            $(content).fadeOut();
                            $(cb).fadeIn();
                        } else if (j.animation === 'slide') {
                            $(content).slideUp();
                            $(cb).slideDown();
                        } else {
                            $(content).hide();
                            $(cb).show();
                        }
                    }
                } else {
                    var hl = '.oxi-tabs-header-li-' + p + '-' + c, bh = '.oxi-tabs-body-header-' + p + '-' + c, cb = '#oxi-tabs-body-' + p + '-' + c;
                    if ($(hl).hasClass('active') || $(bh).hasClass('active')) {
                        return;
                    } else {
                        $(title).removeClass("active");
                        $(hl).toggleClass("active");
                        $(mtitle).removeClass("active");
                        $(bh).toggleClass("active");
                        if (j.animation === 'fade') {
                            $(content).fadeOut();
                            $(cb).fadeIn();
                        } else if (j.animation === 'slide') {
                            $(content).slideUp();
                            $(cb).slideDown();
                        } else {
                            $(content).hide();
                            $(cb).show();
                        }
                    }
                }

        }
        }

    });
})(jQuery);