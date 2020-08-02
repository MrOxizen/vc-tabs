/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery.noConflict();
(function ($) {
    $(document).ready(function () {

        var trigger = '', hash_link = window.location.hash;
        if (hash_link.includes("oxi-tabs-trigger-")) {
            var trigger = hash_link, a = trigger.split("-"), p = a[3], c = a[4];
            OxiTabsController(p, c);
        }
        if (trigger === '') {
            $('[class*=oxi-tabs-wrapper-]').each(function () {
                var This = $(this), id = This.attr('id'), a = id.split("-"), p = a[3];
                OxiTabsController(p);
            });
        }
        $('#style-changing-trigger').change(function () {
            $("#oxi-addons-preview-data").find("*").off();
            $('[class*=oxi-tabs-wrapper-]').each(function () {
                var This = $(this), id = This.attr('id'), a = id.split("-"), p = a[3];
                OxiTabsController(p);
            });
        });

        $(document).on('click', '[id^="oxi-tabs-trigger-"]', function () {
            var t = $(this).attr('id'), a = t.split("-"), p = a[3], c = a[4];
            OxiTabsController(p, c);
        });
        $(document).on('click', '.oxi-tabs-header-li', function () {
            var link = $(this).data("link"), variable = '';
            if ((typeof link !== typeof undefined && link !== false) && typeof variable === '#oxi-addons-preview-data') {
                var target = '_self';
                if (link.target === 'yes') {
                    var target = ", '_blank'";
                }
                window.open("" + link.url + "", "" + target + "");
            } else {
                var t = $(this).attr('ref'), a = t.split("-"), p = a[3], c = a[4];
                OxiTabsController(p, c);
            }

        });
        function OxiTabsController(p = '', c = '') {
            var cls = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style";
            var title = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style .oxi-tabs-header-li";
            var mtitle = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style .oxi-tabs-body-header";
            var content = '#oxi-tabs-wrapper-' + p + " .oxi-tabs-ultimate-style .oxi-tabs-body-tabs";

            var j = $(cls).data('oxi-tabs');

            if (c === '') {
                console.log(c);
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