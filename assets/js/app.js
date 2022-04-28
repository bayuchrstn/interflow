/********** MOBILE AND IE DETECTION **********/



/*! modernizr 3.3.1 (Custom Build) | MIT *
 * https://modernizr.com/download/?-pointerevents-touchevents-setclasses !*/
!function (e, n, t) { function o(e, n) { return typeof e === n } function s() { var e, n, t, s, i, a, r; for (var f in d) if (d.hasOwnProperty(f)) { if (e = [], n = d[f], n.name && (e.push(n.name.toLowerCase()), n.options && n.options.aliases && n.options.aliases.length)) for (t = 0; t < n.options.aliases.length; t++)e.push(n.options.aliases[t].toLowerCase()); for (s = o(n.fn, "function") ? n.fn() : n.fn, i = 0; i < e.length; i++)a = e[i], r = a.split("."), 1 === r.length ? Modernizr[r[0]] = s : (!Modernizr[r[0]] || Modernizr[r[0]] instanceof Boolean || (Modernizr[r[0]] = new Boolean(Modernizr[r[0]])), Modernizr[r[0]][r[1]] = s), l.push((s ? "" : "no-") + r.join("-")) } } function i(e) { var n = c.className, t = Modernizr._config.classPrefix || ""; if (p && (n = n.baseVal), Modernizr._config.enableJSClass) { var o = new RegExp("(^|\\s)" + t + "no-js(\\s|$)"); n = n.replace(o, "$1" + t + "js$2") } Modernizr._config.enableClasses && (n += " " + t + e.join(" " + t), p ? c.className.baseVal = n : c.className = n) } function a() { return "function" != typeof n.createElement ? n.createElement(arguments[0]) : p ? n.createElementNS.call(n, "http://www.w3.org/2000/svg", arguments[0]) : n.createElement.apply(n, arguments) } function r() { var e = n.body; return e || (e = a(p ? "svg" : "body"), e.fake = !0), e } function f(e, t, o, s) { var i, f, l, d, u = "modernizr", p = a("div"), v = r(); if (parseInt(o, 10)) for (; o--;)l = a("div"), l.id = s ? s[o] : u + (o + 1), p.appendChild(l); return i = a("style"), i.type = "text/css", i.id = "s" + u, (v.fake ? v : p).appendChild(i), v.appendChild(p), i.styleSheet ? i.styleSheet.cssText = e : i.appendChild(n.createTextNode(e)), p.id = u, v.fake && (v.style.background = "", v.style.overflow = "hidden", d = c.style.overflow, c.style.overflow = "hidden", c.appendChild(v)), f = t(p, e), v.fake ? (v.parentNode.removeChild(v), c.style.overflow = d, c.offsetHeight) : p.parentNode.removeChild(p), !!f } var l = [], d = [], u = { _version: "3.3.1", _config: { classPrefix: "", enableClasses: !0, enableJSClass: !0, usePrefixes: !0 }, _q: [], on: function (e, n) { var t = this; setTimeout(function () { n(t[e]) }, 0) }, addTest: function (e, n, t) { d.push({ name: e, fn: n, options: t }) }, addAsyncTest: function (e) { d.push({ name: null, fn: e }) } }, Modernizr = function () { }; Modernizr.prototype = u, Modernizr = new Modernizr; var c = n.documentElement, p = "svg" === c.nodeName.toLowerCase(), v = u._config.usePrefixes ? " -webkit- -moz- -o- -ms- ".split(" ") : ["", ""]; u._prefixes = v; var h = function () { function e(e, n) { var s; return e ? (n && "string" != typeof n || (n = a(n || "div")), e = "on" + e, s = e in n, !s && o && (n.setAttribute || (n = a("div")), n.setAttribute(e, ""), s = "function" == typeof n[e], n[e] !== t && (n[e] = t), n.removeAttribute(e)), s) : !1 } var o = !("onblur" in n.documentElement); return e }(); u.hasEvent = h; var m = "Moz O ms Webkit", g = u._config.usePrefixes ? m.toLowerCase().split(" ") : []; u._domPrefixes = g, Modernizr.addTest("pointerevents", function () { var e = !1, n = g.length; for (e = Modernizr.hasEvent("pointerdown"); n-- && !e;)h(g[n] + "pointerdown") && (e = !0); return e }); var w = u.testStyles = f; Modernizr.addTest("touchevents", function () { var t; if ("ontouchstart" in e || e.DocumentTouch && n instanceof DocumentTouch) t = !0; else { var o = ["@media (", v.join("touch-enabled),("), "heartz", ")", "{#modernizr{top:9px;position:absolute}}"].join(""); w(o, function (e) { t = 9 === e.offsetTop }) } return t }), s(), i(l), delete u.addTest, delete u.addAsyncTest; for (var y = 0; y < Modernizr._q.length; y++)Modernizr._q[y](); e.Modernizr = Modernizr }(window, document);

function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

var mobile = false;
var ie = false;
var ie9 = false;
if (isIE() && isIE() <= 9) {
    ie9 = true;
    ie = true;
    jQuery('html').addClass('ie9');
} else if (isIE() || navigator.appVersion.indexOf('Trident/') > 0) {
    ie = true;
}
if (($('html').hasClass('pointerevents') || $('html').hasClass('touchevents')) && !ie && w_width < 1025) {
    jQuery('html').addClass('mobile');
    mobile = true;
}




var w_height = jQuery(window).height();
var w_width = jQuery(window).width();
var estateMap = false;
var panorama = false;
var staticDescHeight = 0;


function format_uang(data) {
    var bilangan = data;
    var number_string = bilangan.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    return rupiah;
}

$(function () {

    'use strict';

    // Showing page loader
    $(window).on('load', function () {
        populateColorPlates();
        setTimeout(function () {
            $(".page_loader").fadeOut("fast");
        }, 100);

        if ($('body .filter-container').length > 0) {
            $(function () {
                $('.filter-container').filterizr(
                    {
                        delay: 0
                    }
                );
            });
            $('.filteriz-navigation li').on('click', function () {
                $('.filteriz-navigation .filtr').removeClass('active');
                $(this).addClass('active');
            });
        }
    });


    // Made the left sidebar's min-height to window's height
    var winHeight = $(window).height();
    $('.dashboard-nav').css('min-height', winHeight);


    // Magnify activation
    $('.portfolio-item').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: { enabled: true }
    });


    // Header shrink while page scroll
    adjustHeader();
    doSticky();
    placedDashboard();
    $(window).on('scroll', function () {
        adjustHeader();
        doSticky();
        placedDashboard();
    });

    // Header shrink while page resize
    $(window).on('resize', function () {
        adjustHeader();
        doSticky();
        placedDashboard();
    });

    function adjustHeader() {
        var windowWidth = $(window).width();
        if (windowWidth > 992) {
            if ($(document).scrollTop() >= 100) {
                if ($('.header-shrink').length < 1) {
                    $('.sticky-header').addClass('header-shrink');
                }
                if ($('.do-sticky').length < 1) {
                    $('.logo img').attr('src', 'img/logos/black-logo.png');
                }
            }
            else {
                $('.sticky-header').removeClass('header-shrink');
                if ($('.do-sticky').length < 1 && $('.fixed-header').length == 0 && $('.fixed-header2').length == 0) {
                    $('.logo img').attr('src', 'img/logos/logo.png');
                } else {
                    $('.logo img').attr('src', 'img/logos/black-logo.png');
                }
            }
        } else {
            $('.logo img').attr('src', 'img/logos/black-logo.png');
        }
    }

    function doSticky() {
        if ($(document).scrollTop() > 40) {
            $('.do-sticky').addClass('sticky-header');
            //$('.do-sticky').addClass('header-shrink');
        }
        else {
            $('.do-sticky').removeClass('sticky-header');
            //$('.do-sticky').removeClass('header-shrink');
        }
    }

    function placedDashboard() {
        var headerHeight = parseInt($('.main-header').height(), 10);
        $('.dashboard').css('top', headerHeight);
    }


    // Banner slider
    (function ($) {
        //Function to animate slider captions
        function doAnimations(elems) {
            //Cache the animationend event in a variable
            var animEndEv = 'webkitAnimationEnd animationend';
            elems.each(function () {
                var $this = $(this),
                    $animationType = $this.data('animation');
                $this.addClass($animationType).one(animEndEv, function () {
                    $this.removeClass($animationType);
                });
            });
        }

        //Variables on page load
        var $myCarousel = $('#carousel-example-generic')
        var $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
        //Initialize carousel
        $myCarousel.carousel();

        //Animate captions in first slide on page load
        doAnimations($firstAnimatingElems);
        //Pause carousel
        $myCarousel.carousel('pause');
        //Other slides to be animated on carousel slide event
        $myCarousel.on('slide.bs.carousel', function (e) {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
        });
        $('#carousel-example-generic').carousel({
            interval: 3000,
            pause: "false"
        });
    })(jQuery);

    // Page scroller initialization.
    // $.scrollUp({
    //     scrollName: 'page_scroller',
    //     scrollDistance: 300,
    //     scrollFrom: 'top',
    //     scrollSpeed: 500,
    //     easingType: 'linear',
    //     animation: 'fade',
    //     animationSpeed: 200,
    //     scrollTrigger: false,
    //     scrollTarget: false,
    //     scrollText: '<i class="fa fa-chevron-up"></i>',
    //     scrollTitle: false,
    //     scrollImg: false,
    //     activeOverlay: false,
    //     zIndex: 2147483647
    // });

    // Counter
    function isCounterElementVisible($elementToBeChecked) {
        var TopView = $(window).scrollTop();
        var BotView = TopView + $(window).height();
        var TopElement = $elementToBeChecked.offset().top;
        var BotElement = TopElement + $elementToBeChecked.height();
        return ((BotElement <= BotView) && (TopElement >= TopView));
    }

    $(window).on('scroll', function () {
        $(".counter").each(function () {
            var isOnView = isCounterElementVisible($(this));
            if (isOnView && !$(this).hasClass('Starting')) {
                $(this).addClass('Starting');
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            }
        });
    });


    // Countdown activation
    $(function () {
        // Add background image
        //$.backstretch('../img/nature.jpg');
        var endDate = "December  27, 2019 15:03:25";
        $('.countdown.simple').countdown({ date: endDate });
        $('.countdown.styled').countdown({
            date: endDate,
            render: function (data) {
                $(this.el).html("<div>" + this.leadingZeros(data.days, 3) + " <span>Days</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>Hours</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>Minutes</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>Seconds</span></div>");
            }
        });
        $('.countdown.callback').countdown({
            date: +(new Date) + 10000,
            render: function (data) {
                $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
            },
            onEnd: function () {
                $(this.el).addClass('ended');
            }
        }).on("click", function () {
            $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
        });

    });


function dcodenumeral() {
    $("#minval").val('Rp ' +
        numeral().unformat($("#minval").val())
    );
    $("#maxval").val('Rp ' +
        numeral().unformat($("#maxval").val())
    );
    $("#current_min").val('Rp ' +
        numeral().unformat($("#current_min").val())
    );
    $("#current_max").val('Rp ' +
        numeral().unformat($("#current_max").val())
    );
    $("#min_price").val(
    numeral().unformat($("#min_price").val())
);
$("#max_price").val(
    numeral().unformat($("#max_price").val())
);
}
    function encdnumeral() {
        $("#minval").val('Rp ' + numeral($("#minval").val()).format('0,0')
        );
        $("#maxval").val('Rp ' +
            numeral($("#maxval").val()).format('0,0')
        );
        $("#current_min").val('Rp ' + numeral($("#current_min").val()).format('0,0')
        );
        $("#current_max").val('Rp ' + numeral($("#current_max").val()).format('0,0')
        );
        $("#min_price").val(numeral($("#min_price").val()).format('0,0')
        );
        $("#max_price").val(numeral($("#max_price").val()).format('0,0')
        );
    }
    $(document).ready(function () {
        dcodenumeral();
        encdnumeral();
    $("#minval").on('keyup', function () {
        dcodenumeral();
        encdnumeral();
    });
    $("#maxval").on('keyup', function () {
        dcodenumeral();
        encdnumeral();
    });
    $("#current_max").on('keyup', function () {
        dcodenumeral();
        encdnumeral();
    });
    $("#current_min").on('keyup', function () {
        dcodenumeral();
        encdnumeral();
    });
    $("#min_price").on('keyup', function () {
        dcodenumeral();
        encdnumeral();
    });
    $("#max_price").on('keyup', function () {
        dcodenumeral();
        encdnumeral();
    });
    });
    // $(".range-slider-ui").each(function () {
    //     var minRangeValue = $(this).attr('data-min');
    //     var maxRangeValue = $(this).attr('data-max');
    //     var current_min = $("#current_min").val();
    //     var current_max = $("#current_max").val();
    //     var minName = $(this).attr('data-min-name');
    //     var maxName = $(this).attr('data-max-name');
    //     var unit = $(this).attr('data-unit');
    //     var currmax = parseInt(maxRangeValue, 10);

    //     $(this).append("" +
    //         "<input type='text' class='min-value' name='min-value'> " +
    //         "<input type='text' class='max-value' name='max-value'>" +
    //         "<input class='current-min' type='text' name='min_price" + format_uang(minName) + "'>" +
    //         "<input class='current-max' type='text' name='max_price" + format_uang(maxName) + "'>"
    //     );
    //     $(this).slider({
    //         range: true,
    //         min: minRangeValue,
    //         max: maxRangeValue,
    //         step: 5000000,
    //         values: [minRangeValue, maxRangeValue],
    //         slide: function (event, ui) {
    //             event = event;
    //             var currentMin = parseInt(ui.values[0], 10);
    //             var currentMax = parseInt(ui.values[1], 10);
    //             $(this).children(".min-value").val(unit + " " + format_uang(currentMin));
    //             $(this).children(".max-value").val(unit + " " + format_uang(currentMax));
    //             $(this).children(".current-min").val(format_uang(currentMin));
    //             $(this).children(".current-max").val(format_uang(currentMax));
    //         }
    //     });
    //     var currentMin = parseInt($(this).slider("values", 0), 10);
    //     var currentMax = parseInt($(this).slider("values", 1), 10);
    //     if (!!current_max) {
    //         $(this).children(".min-value").text(unit + " " + format_uang(current_min));
    //         $(this).children(".max-value").text(unit + " " + format_uang(current_max));
    //     }
    //     else {
    //         $(this).children(".min-value").text(unit + " " + format_uang(currentMin));
    //         $(this).children(".max-value").text(unit + " " + format_uang(currentMax));
    //     }
    //     $(this).children(".current-min").val(format_uang(currentMin));
    //     $(this).children(".current-max").val(format_uang(currentMax));
    //     current_min = parseInt(current_min, 10);
    //     current_max = parseInt(current_max, 10);
    //     var curr_left = (current_min / currmax) * 100;
    //     var curr_width = ((current_max / currmax) * 100) - curr_left;
    //     var curr_width2 = (current_max / currmax) * 100;
    //     $(this).find('.ui-widget-header').css({ left: curr_left + "%", width: curr_width + "%" });
    //     $(this).find('.ui-state-default.0').css({ left: curr_left + "%" });
    //     $(this).find('.ui-state-default.1').css({ left: curr_width2 + "%" });
    // });

    // Select picket
    $('.selectpicker').selectpicker({
        dropupAuto: false
    });

    // Search option's icon toggle
    $('.search-options-btn').on('click', function () {
        $('.search-section').toggleClass('show-search-area');
        $('.search-options-btn .fa').toggleClass('fa-chevron-down');
    });

    // Carousel with partner initialization
    (function () {
        $('#ourPartners').carousel({ interval: 3600 });
    }());

    (function () {
        $('.our-partners .item').each(function () {
            var itemToClone = $(this);
            for (var i = 1; i < 4; i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
    }());

    // Background video playing script
    $(document).ready(function () {
        $(".player").mb_YTPlayer(
            {
                mobileFallbackImage: 'img/banner/banner-1.jpg'
            }
        );
    });

    // Multilevel menuus
    $('[data-submenu]').submenupicker();

    // Expending/Collapsing advance search content
    $('.show-more-options').on('click', function () {
        if ($(this).find('.fa').hasClass('fa-minus-circle')) {
            $(this).find('.fa').removeClass('fa-minus-circle');
            $(this).find('.fa').addClass('fa-plus-circle');
        } else {
            $(this).find('.fa').removeClass('fa-plus-circle');
            $(this).find('.fa').addClass('fa-minus-circle');
        }
    });

    var videoWidth = $('.sidebar-widget').width();
    var videoHeight = videoWidth * .61;
    $('.sidebar-widget iframe').css('height', videoHeight);


    // Megamenu activation
    $(".megamenu").on("click", function (e) {
        e.stopPropagation();
    });

    // Dropdown activation
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });


    // Full  Page Search Activation
    $(function () {
        $('a[href="#full-page-search"]').on('click', function (event) {
            event.preventDefault();
            $('#full-page-search').addClass('open');
            $('#full-page-search > form > input[type="search"]').focus();
        });

        $('#full-page-search, #full-page-search button.close').on('click keyup', function (event) {
            if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                $(this).removeClass('open');
            }
        });
    });


    // Slick Sliders
    // $('.slick-carousel').each(function () {
    //     var slider = $(this);
    //     $(this).slick({
    //         infinite: true,
    //         dots: false,
    //         arrows: false,
    //         centerMode: true,
    //         centerPadding: '0'
    //     });

    //     $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function () {
    //         slider.slick('slickPrev');
    //     });
    //     $(this).closest('.slick-slider-area').find('.slick-next').on("click", function () {
    //         slider.slick('slickNext');
    //     });
    // });


    $(".dropdown.btns .dropdown-toggle").on('click', function () {
        $(this).dropdown("toggle");
        return false;
    });



    // Dropzone initialization
    Dropzone.autoDiscover = false;
    $(function () {
        $("div#myDropZone").dropzone({
            url: "/file-upload"
        });
    });

    // Filterizr initialization
    $(function () {
        //$('.filtr-container').filterizr();
    });

    function toggleChevron(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".fa")
            .toggleClass('fa-minus fa-plus');
    }

    $('.panel-group').on('shown.bs.collapse', toggleChevron);
    $('.panel-group').on('hidden.bs.collapse', toggleChevron);

    // Switching Color schema
    function populateColorPlates() {
        var plateStings = '<div class="option-panel option-panel-collased">\n' +
            '    <h2>Change Color</h2>\n' +
            '    <div class="color-plate default-plate" data-color="default"></div>\n' +
            '    <div class="color-plate midnight-blue-plate" data-color="midnight-blue"></div>\n' +
            '    <div class="color-plate yellow-plate" data-color="yellow"></div>\n' +
            '    <div class="color-plate blue-plate" data-color="blue"></div>\n' +
            '    <div class="color-plate green-light-plate" data-color="green-light"></div>\n' +
            '    <div class="color-plate yellow-light-plate" data-color="yellow-light"></div>\n' +
            '    <div class="color-plate green-plate" data-color="green"></div>\n' +
            '    <div class="color-plate green-light-2-plate" data-color="green-light-2"></div>\n' +
            '    <div class="color-plate red-plate" data-color="red"></div>\n' +
            '    <div class="color-plate purple-plate" data-color="purple"></div>\n' +
            '    <div class="color-plate brown-plate" data-color="brown"></div>\n' +
            '    <div class="color-plate olive-plate" data-color="olive"></div>\n' +
            '    <div class="setting-button">\n' +
            '        <i class="fa fa-gear"></i>\n' +
            '    </div>\n' +
            '</div>';
        // $('body').append(plateStings);
    }
    $(document).on('click', '.color-plate', function () {
        var name = $(this).attr('data-color');
        $('link[id="style_sheet"]').attr('href', 'css/skins/' + name + '.css');
    });

    $(document).on('click', '.setting-button', function () {
        $('.option-panel').toggleClass('option-panel-collased');
    });
});

// mCustomScrollbar initialization
(function ($) {
    $(window).resize(function () {
        $('#map').css('height', $(this).height() - 110);
        if ($(this).width() > 768) {
            $(".map-content-sidebar").mCustomScrollbar(
                { theme: "minimal-dark" }
            );
            $('.map-content-sidebar').css('height', $(this).height() - 110);
        } else {
            $('.map-content-sidebar').mCustomScrollbar("destroy"); //destroy scrollbar
            $('.map-content-sidebar').css('height', '100%');
        }
    }).trigger("resize");
})(jQuery);

//login
$(document).ready(function () {
    $('#login-form').validate();
    $('#login-form2').validate();
    $('#login-form').on('keyup', function (e) {
        if (e.which == 13 || e.keyCode == 13) {
            login();
        }
    });
    $('#login-form2').on('keyup', function (e) {
        if (e.which == 13 || e.keyCode == 13) {
            login2();
        }
    });
    function login() {
        var url = base_url + 'Main/user_login';
        if ($('#login-form').valid()) {
            $.ajax({
                type: "POST",
                url: url,
                data: $("#login-form").serialize(), // serializes the form's elements.
                beforeSend: function () {
                    $('#logerror').fadeIn().html('<img src="' + base_url + 'assets_admin/global_assets/images/AjaxLoader.gif" align="middle"> Please wait...').bind();
                }
            }).done(function (data) {
                if (data == 1)

                    window.location.href = base_url + "Main/login_auth";
                else $('#logerror').html('Login Failed.').delay(2000).fadeOut();
                $('#logerror').addClass("error");
            });

        }
        return false;
    };

    function login2() {
        var url = base_url + 'Main/user_login';
        if ($('#login-form2').valid()) {
            $.ajax({
                type: "POST",
                url: url,
                data: $("#login-form2").serialize(), // serializes the form's elements.
                beforeSend: function () {
                    $('#logerror2').fadeIn().html('<img src="' + base_url + 'assets_admin/global_assets/images/AjaxLoader.gif" align = "middle" > Please wait...').bind();
                }
            }).done(function (data) {
                if (data == 1)

                    window.location.href = base_url + "Main/login_auth";
                else $('#logerror2').html('Login Failed.').delay(2000).fadeOut();
                $('#logerror2').addClass("error");
            });

        }
        return false;
    };

    $(document).on('click', '#btn-login', function () {
        var url = base_url + 'Main/user_login';
        if ($('#login-form').valid()) {
            $.ajax({
                type: "POST",
                url: url,
                data: $("#login-form").serialize(), // serializes the form's elements.
                beforeSend: function () {
                    $('#logerror').fadeIn().html('<img src="' + base_url + 'assets_admin/global_assets/images/AjaxLoader.gif" align="middle"> Please wait...').bind();
                }
            }).done(function (data) {
                if (data == 1)

                    window.location.href = base_url + "Main/login_auth";
                else $('#logerror').html('Login Failed.').delay(2000).fadeOut();
                $('#logerror').addClass("error");
            });

        }
        return false;
    });

    $(document).on('click', '#btn-login2', function () {
        var url = base_url + 'Main/user_login';
        if ($('#login-form2').valid()) {
            $.ajax({
                type: "POST",
                url: url,
                data: $("#login-form2").serialize(), // serializes the form's elements.
                beforeSend: function () {
                    $('#logerror2').fadeIn().html('<img src="' + base_url + 'assets_admin/global_assets/images/AjaxLoader.gif" align = "middle" > Please wait...').bind();
                }
            }).done(function (data) {
                if (data == 1)

                    window.location.href = base_url + "Main/login_auth";
                else $('#logerror2').html('Login Failed.').delay(2000).fadeOut();
                $('#logerror2').addClass("error");
            });

        }
        return false;
    });
});

