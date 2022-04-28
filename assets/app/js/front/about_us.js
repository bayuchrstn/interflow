function LoadMap(propertes) {
    var defaultLat = -7.000787;
    var defaultLng = 110.444846;
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
    var myLatlng = new google.maps.LatLng(-7.000787, 110.444846);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });
    (function (marker) {
        google.maps.event.addListener(marker, "click", function (e) {
            infoWindow.setContent("" +
                "<div class='map-properties contact-map-content'>" +
                "<div class='map-content'>" +
                "<p class='address'>Interflow Property</p>" +
                "<ul class='map-properties-list'> " +
                "<li><i class='flaticon-phone'></i>  0895 602 532 888</li> " +
                "<li><i class='flaticon-mail'></i>  interflow.property@gmail.com</li> " +
                "<li><a href=''><i class='fa fa-globe'></i>  http://www.example.com</li></a> " +
                "</ul>" +
                "</div>" +
                "</div>");
            infoWindow.open(map, marker);
        });
    })(marker);
} LoadMap();

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

$("#slider_testimoni").slick({
    dots: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false
});

$(document).ready(function () {
    $.ajax({
        url: base_url + "Main/ajax_data_partner",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            let html = '';
            for (let i = 0; i < data.length; i++) {
                partner = data[i];
                html += '<div class="slick-slide-item"><img class="img-responsive" src="' + partner.img_url + '" alt="Partner"></div>';
            }

            $("#slider_partner")
                .html(html)
                .slick({
                    dots: false,
                    infinite: false,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings:
                            {
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 3000
                            }
                        }, {
                            breakpoint: 768,
                            settings:
                            {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 3000
                            }
                        }
                    ]
                });
        },
        error: function (err) {
            console.log(err);
        }
    });
});