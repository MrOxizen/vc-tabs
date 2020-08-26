jQuery.noConflict();
(function ($) {
    $(document).ready(function () {
        /* Check Url if there have any ID*/
        var trigger = '', hash_link = window.location.hash;
        if (hash_link.includes("oxi-tabs-trigger-")) {
            var explode = hash_link.split("-"), parent = explode[3], child = explode[4];
            OxiTabsController(parent, child);
        } else {

            $('[class*=oxi-tabs-wrapper-]').each(function () {
                var This = $(this), id = This.attr('id'), explode = id.split("-"), parent = explode[3];
                OxiTabsController(parent);
            });
        }
        /* Check any btn click for confirm event for tabs*/
        $(document).on('click', '[id^="oxi-tabs-trigger-"]', function () {
            var wrapper = $(this).attr('id'), explode = wrapper.split("-"), parent = explode[3], child = explode[4];
            OxiTabsController(parent, child);
        });
        /* Tabs Header Hover  Data Confirmation*/
        $(".oxi-tabs-hover-event .oxi-tabs-header-li").hover(function () {
            var link = $(this).data("link"), variable = '';
            if ((typeof link !== typeof undefined && link !== false) && typeof variable === '.shortcode-addons-template-body') {
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
            if ((typeof link !== typeof undefined && link !== false) && typeof variable === '.shortcode-addons-template-body') {
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
                $(content + j.initial).addClass("active");
            } else {
                var header = '.oxi-tabs-header-li-' + p + '-' + c,
                        contentbody = '#oxi-tabs-body-' + p + '-' + c;
                if ($(header).hasClass('active')) {
                    console.log('ache00');
                    if (j.trigger === '1' && j.type !== 'oxi-tabs-hover-event') {
                        $(header).removeClass("active");
                        $(contentbody).removeClass(j.animation).toggleClass("active");
                    }
                    return false;
                } else {
                    $(title).removeClass("active");
                    $(header).addClass("active");
                    $(content).removeClass(j.animation).removeClass("active");
                    $(contentbody).addClass(j.animation).addClass("active");
                }
        }
        }
        $('.oxi-tabs-body-content-equal-height').each(function () {
            var highestBox = 0;
            $('.oxi-tabs-body-tabs', this).each(function () {
                if ($(this).height() > highestBox) {
                    highestBox = $(this).height();
                }
            });
            $('.oxi-tabs-body-tabs', this).height(highestBox);
        });
    });
})(jQuery);