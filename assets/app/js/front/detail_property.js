function LoadMap() {
    var defaultLat = $("#lat").val();
    var defaultLng = $("#lang").val();
    var nama = $(".judul").text();
    var alamat = $(".judul-address").text();
    var flag = $("#flag").val();
    var mapOptions = {
        center: new google.maps.LatLng(defaultLat, defaultLng),
        zoom: 15,
        scrollwheel: false,
        styles: [
            {
                featureType: "administrative",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            },
            {
                featureType: "water",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            },
            {
                featureType: 'poi.business',
                stylers: [{ visibility: 'off' }]
            },
            {
                featureType: 'transit',
                elementType: 'labels.icon',
                stylers: [{ visibility: 'off' }]
            },
        ]
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var infoWindow = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(defaultLat, defaultLng);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });
    // (function (marker) {
    //     google.maps.event.addListener(marker, "click", function (e) {
    //         infoWindow.setContent("" +
    //             "<div class='map-properties contact-map-content'>" +
    //             "<div class='map-content'>" +
    //             "<p>" + nama + "<br>" + alamat + "</p>" +
    //             "<ul class='map-properties-list'> " +
    //             "<li><i class='flaticon-phone'></i>  0895 602 532 888</li> " +
    //             "<li><i class='flaticon-mail'></i>  interflow.property@gmail.com</li> " +
    //             "</ul>" +
    //             "</div>" +
    //             "</div>");
    //         infoWindow.open(map, marker);
    //     });
    // })(marker);
    (function (marker) {
        if (flag == 2){
            alamat = '';
        }
        google.maps.event.addListener(marker, "click", function (e) {
            infoWindow.setContent("" +
                "<div class='map-properties contact-map-content'>" +
                "<div class='map-content'>" +
                "<p>" + nama + "<br>" + alamat + "</p>" +
                "<ul class='map-properties-list'> " +
                "<li><i class='flaticon-phone'></i>  0895 602 532 888</li> " +
                "<li><i class='flaticon-mail'></i>  interflow.property@gmail.com</li> " +
                "</ul>" +
                "</div>" +
                "</div>");
            infoWindow.open(map, marker);
        });
    })(marker);
}

$(".ts-quick-info__item").click(function () {
    $('.ts-quick-info__item').removeClass('active');
    var id = this.id + '_det';
    $(this).addClass('active');
    if (id == 'surface_area_det') {
        $("#surface_area_det").addClass('active');
        $("#building_area_det").removeClass('active');
        $("#proprietary_det").removeClass('active');
        $("#facilities_det").removeClass('active');
    } if (id == 'building_area_det') {
        $("#surface_area_det").removeClass('active');
        $("#building_area_det").addClass('active');
        $("#proprietary_det").removeClass('active');
        $("#facilities_det").removeClass('active');
    } if (id == 'proprietary_det') {
        $("#surface_area_det").removeClass('active');
        $("#building_area_det").removeClass('active');
        $("#proprietary_det").addClass('active');
        $("#facilities_det").removeClass('active');
    } if (id == 'facilities_det') {
        $("#surface_area_det").removeClass('active');
        $("#building_area_det").removeClass('active');
        $("#proprietary_det").removeClass('active');
        $("#facilities_det").addClass('active');
    }
});
$(document).ready(function () {
    LoadMap();
    var $carousel = $('.slider-single');
    $carousel.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        adaptiveHeight: true,
        infinite: true,
        useTransform: true,
        speed: 400,
        asNavFor: '.slider-nav',
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
    }).magnificPopup({
        type: 'image',
        delegate: 'a:not(.slick-cloned)',
        image: {
            cursor: null,
            verticalFit: true,
        },
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            tCounter: '<span class="mfp-counter" style="display:none"></span>', // markup of counte
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
    });

    $('.slider-nav')
        .on('init', function (event, slick) {
            $('.slider-nav .slick-slide.slick-current').addClass('is-active');
        })
        .slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            dots: false,
            arrows: false,
            focusOnSelect: true,
            infinite: true,
            asNavFor: '.slider-single',
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 640,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 420,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }]
        });

    $('.slider-single').on('afterChange', function (event, slick, currentSlide) {
        $('.slider-nav').slick('slickGoTo', currentSlide);
        var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
        $('.slider-nav .slick-slide.is-active').removeClass('is-active');
        $(currrentNavSlideElem).addClass('is-active');
    });

    $('.slider-nav').on('click', '.slick-slide', function (event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data('slick-index');

        $('.slider-single').slick('slickGoTo', goToSingleSlide);
    });


});

$("#form-contact-submit").click(function () {
    $.ajax({
        url: base_url + "Main/ajax_send_contact_agent",
        type: "POST",
        data: $("#form-agent").serialize(),
        dataType: "JSON",
        beforeSend: function () {
            $("#form-contact-submit").html('Sending...').attr('disabled', true);
        },
        complete: function () {
            $("#form-contact-submit").html('Send Message').attr('disabled', false);
        },
        success: function (r) {
            if (r.status == true) {
                $("#alert_notif").html(r.message);
                $('#form-agent').trigger("reset");
            } else {
                $("#alert_notif").html(r.message);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
});
