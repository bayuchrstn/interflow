$(document).ready(function () {
    var limit = 8;
    var start = 4;
    var action = 'inactive';

    function lazzy_loader(limit) {
        output = '';

        for (var count = 0; count < 4; count++) {
            output += '<div class="col-lg-3 col-md-6 col-sm-12 filtr-item col-pad">';
            output += '<span class="content-placeholder" style="width:100%; height: 160px;margin-bottom:15px">&nbsp;</span>';
            output += '</div>';
        }

        $('#load_data_message').html(output);
    }

    function load_data(limit, start) {
        $.ajax({
            url: base_url + "Main/ajax_data_gallery",
            method: "POST",
            data: { limit: limit, start: start },
            cache: false,
            success: function (data) {
                if (data == '') {
                    action = 'active';
                    $('#load_data_message').html("");
                    $('.filter-container').filterizr(
                        options = {
                            animationDuration: 0.5,
                            callbacks: {
                                onInit: function() { },
                                onFilteringStart: function () { },
                                onFilteringEnd: function () { },
                                onShufflingStart: function () { },
                                onShufflingEnd: function () { },
                                onSortingStart: function () { },
                                onSortingEnd: function () { }
                            },
                            delay: 0,
                            delayMode: 'progressive',
                            easing: 'ease-out',
                            filter: 'all',
                            filterOutCss: {
                                'opacity': 0,
                                'transform': 'scale(0.5)'
                            },
                            filterInCss: {
                                'opacity': 1,
                                'transform': 'scale(1)'
                            },
                            layout: 'packed',
                            setupControls: true
                        });
                }
                else {
                    $('.filter-container').append(data);
                    $('#load_data_message').html("");

                    action = "inactive";
                    $('.filter-container').filterizr(
                        options = {
                            animationDuration: 0.5,
                            callbacks: {
                                onInit: function() { },
                                onFilteringStart: function () { },
                                onFilteringEnd: function () { },
                                onShufflingStart: function () { },
                                onShufflingEnd: function () { },
                                onSortingStart: function () { },
                                onSortingEnd: function () { }
                            },
                            delay: 0,
                            delayMode: 'progressive',
                            easing: 'ease-out',
                            filter: 'all',
                            filterOutCss: {
                                'opacity': 0,
                                'transform': 'scale(0.5)'
                            },
                            filterInCss: {
                                'opacity': 1,
                                'transform': 'scale(1)'
                            },
                            layout: 'sameSize',
                            setupControls: true
                        });
                    $('.portfolio-item').magnificPopup({
                        delegate: 'a',
                        type: 'image',
                        gallery: { enabled: true }
                    });
                    $('.filters').find('li.active').click();
                }
            }
        });
    }

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $(".filter-container").height() && action == 'inactive') {
            lazzy_loader(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function () {
                load_data(limit, start);
            }, 1000);
        }
    });
});

// Page scroller initialization.
$.scrollUp({
    scrollName: 'page_scroller',
    scrollDistance: 300,
    scrollFrom: 'top',
    scrollSpeed: 500,
    easingType: 'linear',
    animation: 'fade',
    animationSpeed: 200,
    scrollTrigger: false,
    scrollTarget: false,
    scrollText: '<i class="fa fa-chevron-up"></i>',
    scrollTitle: false,
    scrollImg: false,
    activeOverlay: false,
    zIndex: 2147483647
});