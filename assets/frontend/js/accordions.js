jQuery.noConflict();
(function ($) {
    $(document).ready(function () {
        $('.oxi-accordions-preloader').each(function () {
            $(this).css("opacity", "1");
        });
    });

    $(document).ready(function () {
        /* Check Url if there have any ID*/
        var trigger = '', hash_link = window.location.hash;
        if (hash_link.includes("oxi-accordions-trigger-")) {
            var explode = hash_link.split("-"), parent = explode[3], child = explode[4];
            OxiAccordionsController(parent, child);
        } else {
            $('[class*=oxi-accordions-wrapper-]').each(function () {
                var This = $(this), id = This.attr('id'), explode = id.split("-"), parent = explode[3];
                OxiAccordionsController(parent);
            });
        }
        $('[class*=oxi-accordions-wrapper-]').each(function () {
            var This = $(this), id = This.attr('id'), explode = id.split("-"), parent = explode[3];
            var autoplay = This.find(".oxi-accordions-autoplay");
            if (autoplay.length > 0) {
                var autoplay = $("#" + id + " > .oxi-addons-row > .oxi-accordions-ultimate-style .oxi-accordions-autoplay"),
                        autoplayduration = css_time_to_milliseconds($(autoplay).css('transition-duration')),
                        total_accordion = $(autoplay).length,
                        count = 0;
                function AutoPlay() {
                    var ID = autoplay[count++];
                    $(ID).find('.oxi-accordions-header-body').trigger('click');
                    if (count === total_accordion) {
                        count = 0;
                    }
                }
                setInterval(function () {
                    AutoPlay();
                }, autoplayduration);



            }

        });



        function css_time_to_milliseconds(time_string) {
            var num = parseFloat(time_string, 10),
                    unit = time_string.match(/m?s/),
                    milliseconds;

            if (unit) {
                unit = unit[0];
            }

            switch (unit) {
                case "s": // seconds
                    milliseconds = num * 1000;
                    break;
                case "ms": // milliseconds
                    milliseconds = num;
                    break;
                default:
                    milliseconds = 0;
                    break;
            }

            return milliseconds;
        }

        /* Check any btn click for confirm event for tabs*/
        $(document).on('click', '[id^="oxi-accordions-trigger-"]', function (e) {
            e.preventDefault();
            var wrapper = $(this).attr('id'), explode = wrapper.split("-"), parent = explode[3], child = explode[4];
            OxiAccordionsController(parent, child);
        });


        $('a[href*="#oxi-accordions-trigger-"]').click(function (e) {
            e.preventDefault();
            var wrapper = $(this).attr('href'), explode = wrapper.split("-"), parent = explode[3], child = explode[4];
            OxiAccordionsController(parent, child);
        });



        /* Tabs Header Hover  Data Confirmation*/
        $(".oxi-accordions-hover-event .oxi-accordions-header-body").hover(function () {
            var link = $(this).data("link");
            if (typeof link !== typeof undefined && link !== false && $(".shortcode-addons-template-body").length === 0) {
                var target = '_self';
                if (link.target === 'yes') {
                    var target = ", '_blank'";
                }
                window.open("" + link.url + "", "" + target + "");
            } else {
                var t = $(this).data('oxitarget'), explode = t.split("-"), parent = explode[3], child = explode[4];
                OxiAccordionsController(parent, child);

            }
        });

//        /* Tabs Header Click Data Confirmation*/
        $(document).on('click', '.oxi-accordions-click-event .oxi-accordions-header-body', function () {
            var link = $(this).data("link");
            if (typeof link !== typeof undefined && link !== false && $(".shortcode-addons-template-body").length === 0) {
                var target = '_self';
                if (link.target === 'yes') {
                    var target = ", '_blank'";
                }
                window.open("" + link.url + "", "" + target + "");
            } else {
                var t = $(this).data('oxitarget'), explode = t.split("-"), parent = explode[3], child = explode[4];
                OxiAccordionsController(parent, child);
            }
        });
        function OxiAccordionsController(p = '', c = '') {
            var cls = '#oxi-accordions-wrapper-' + p + " > .oxi-addons-row > .oxi-accordions-ultimate-style";
            var accordions = '#oxi-accordions-wrapper-' + p + " > .oxi-addons-row > .oxi-accordions-ultimate-style  .oxi-accordions-single-card-" + p;
            var content = '#oxi-accordions-wrapper-' + p + " > .oxi-addons-row >  .oxi-accordions-ultimate-style #oxi-accordions-content-" + p + '-' + c;
            var j = $(cls).data('oxi-accordions');
            if (c === '') {
                $(accordions).each(function () {
                    var ref = $(this).find(".oxi-accordions-header-body");
                    var attr = $(ref).attr('default-opening');
                    if (typeof attr !== 'undefined' && attr === 'yes') {
                        $(this).addClass("oxi-accordions-expand");
                        $(this).children('.oxi-accordions-content-card').oxicollapse("show");
                    }
                });
            } else {
                var contentbody = '#oxi-accordions-content-' + p + '-' + c + ' > .oxi-accordions-content-body',
                        contentrows = '.oxi-accordions-content-card-' + p,
                        Headerbody = '.oxi-accordions-single-card-' + p + '-' + c;
                if ($(Headerbody).hasClass('oxi-accordions-expand')) {
                    if (j.type === 'oxi-accordions-toggle' && !$(accordions).hasClass('oxi-accordions-hover-event')) {
                        $(Headerbody).removeClass("oxi-accordions-expand");
                        $(contentbody).removeClass(j.animation);
                        $(content).oxicollapse("hide");
                    }
                    return false;
                } else {
                    if (j.type === 'oxi-accordions-toggle') {
                        console.log('toggle');
                        $(content).oxicollapse("show");
                        $(contentbody).addClass(j.animation);
                        $(Headerbody).addClass("oxi-accordions-expand");
                    } else {
                        $(contentrows).oxicollapse("hide");
                        $(accordions).removeClass("oxi-accordions-expand");
                        $(contentbody).removeClass(j.animation);
                        $(content).oxicollapse("show");
                        $(Headerbody).addClass("oxi-accordions-expand");
                        $(contentbody).addClass(j.animation);
                    }
                }
        }
        }

        if ($("#oxi-addons-iframe-background-color").length) {
            var value = $('#oxi-addons-iframe-background-color').val();
            $('.shortcode-addons-template-body').css('background', value);
        }
    });
})(jQuery);