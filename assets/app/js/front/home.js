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
function loader(limit,id) {
    var output = '';
    for(var count=0; count<limit; count++) {
        output += '<div class="col-lg-4 col-md-4 col-sm-12"><div class="property-box">';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 200px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '</div></div></div>';
    }
    $('#'+id).html(output);
}

$("#slider_testimoni").slick({
    dots: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false
});

$(document).ready(function () {
    $.ajax({
        url: base_url + "Main/ajax_data_hot_property_random",
        type: "GET",
        dataType: "JSON",
        beforeSend:function() {
            loader(3,'slider_hot_property');
        },
        success: function (data) {
            not_found = '<div class="col-lg-12 text-center"><h4>--- no data available ---</h4></div>';
            let html = '';
            for (let i = 0; i < data.length; i++) {
                property = data[i];
                enter_name = '';
                str_name_property = property.nama;
                str_address_property = property.nama_jalan; // property.alamat
                property_status = property.status_property;
                status_name = property.name_status;
                harga_jual = property.harga_jual;
                harga_sewa = property.harga_sewa;
                
                if (str_name_property.length < 30) {
                    enter_name = '<br><br>';
                }
                if (str_name_property.length > 50) {
                    enter_name = '';
                    str_name_property = str_name_property.substr(0, 50)+'...';
                }
                if (str_address_property.length > 38) {
                    str_address_property = str_address_property.substr(0, 35)+'...';
                }

                if (property_status == "1" || property_status == "2") { //  Sell / Rent
                    status_property = '<div class="tag-buy">' + status_name + '</div>';
                } else if (property_status == "3" || property_status == "4") { // Sold / Rented
                    status_property = '<div class="tag-buy" style="background: red;">' + status_name + '</div>';
                } else if (property_status == "5") { // Bisa Jual, bisa Sewa: Sell / Rent  
                    status_property = '<div class="tag-buy">' + status_name + '</div>';
                } else {
                    status_property = '<div class="tag-buy">' + status_name + '</div>';
                }

                if (property_status == "1" || property_status == "3") { // Jual: Sell / Sold
                    harga = harga_jual;
                } else if (property_status == "2" || property_status == "4") { // Sewa: Rent / Rented
                    harga = harga_sewa;
                } else if (property_status == "5") { // Bisa Jual, bisa Sewa: Sell / Rent  
                    harga = harga_jual; // + ' ...';
                } else {
                    harga = harga_jual;
                }

                /* if (property.status_transaksi == '0') {
                    status_property = '<div class="tag-buy">' + property.name_status + '</div>';
                } else {
                    status_property = '<div class="tag-buy" style="background: red;">' + property.name_status_trx + '</div>';
                } */
                html += '<div class="slick-slide-item"><div class="property-box"><div class="property-thumbnail"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '" class="property-img">' + status_property + '<div class="price-box"><span>Rp ' + harga + '</span></div><img src="assets/img/starproperti.png" style="height:50px; position:absolute; right:0;margin-top:10px;"><img class="d-block w-100" src="' + property.image + '" alt="properties"></a></div><div class="detail"><h1 class="title"><a title="'+property.nama+'" href="' + base_url + 'Main/detail_property?q=' + property.id + '">' + str_name_property + enter_name + '</a></h1><div class="location"><a title="'+property.alamat+'" href="javascript:;"><i class="flaticon-pin"></i></a>' + str_address_property + '</div><hr><ul class="facilities-list clearfix">';
                fasilitas = property.fasilitas;
                for (let j = 0; j < fasilitas.length; j++) {
                    html += '<li><i class="' + fasilitas[j].logo + '"></i>' + fasilitas[j].fasilitas + ' ' + fasilitas[j].label + ' ' + fasilitas[j].satuan + '</li>';
                }

                html += '</ul></div></div></div>';
            }

            $("#slider_hot_property")
                .html(html)
                .slick({
                    dots: true,
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings:
                            {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        }, {
                            breakpoint: 768,
                            settings:
                            {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            if(data.length == 0) {
                $("#slider_hot_property").html(not_found);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });

    $.ajax({
        url: base_url + "Main/ajax_data_consultant_random",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            let html = '';
            for (let i = 0; i < data.length; i++) {
                consultant = data[i];
                html += '<div class="slick-slide-item"><div class="team-1"><div class="team-photo"><a href="' + base_url + 'Main/detail_consultant?q=' + consultant.id + '"><img src="' + consultant.host + consultant.foto + '" alt="agent" class="img-fluid"></a></div><div class="team-details"><h5><a href="' + base_url + 'Main/detail_consultant?q=' + consultant.id + '">' + consultant.fullname + '</a></h5><h6>' + consultant.phone + '</h6></div></div></div>'; // consultant.first_name + ' ' + consultant.last_name
            }

            $("#slider_consultant")
                .html(html)
                .slick({
                    dots: true,
                    infinite: false,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings:
                            {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        },
						{
						  breakpoint: 800,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						  }
						},
						{
						  breakpoint: 600,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						  }
						},
						{
						  breakpoint: 480,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						  }
						}
                    ]
                });
        },
        error: function (err) {
            console.log(err);
        }
    });

    $.ajax({
        url: base_url + "Main/ajax_data_news_random",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            let html = '';
            for (let i = 0; i < data.length; i++) {
                news = data[i];
                html += '<div class="slick-slide-item"><div class="blog-2"><div class="blog-photo"><img src="' + news.img_url + '" alt="small-blog" class="img-fluid"></div><div class="detail"><span class="date-up">' + news.format_tanggal + '</span><h4><a href="' + base_url + 'Main/detail_news?q=' + news.id + '">' + news.judul + '</a></h4><p style="text-align: justify;">' + news.berita.substring(0, 150) + '...' + '</p></div></div></div>';
            }

            $("#slider_news")
                .html(html)
                .slick({
                    dots: true,
                    infinite: false,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings:
                            {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        }, {
                            breakpoint: 768,
                            settings:
                            {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
        },
        error: function (err) {
            console.log(err);
        }
    });

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



/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be TRUE if the browser is a mobile device
 *
 **/


    (function (a) {
        (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
        // alert(jQuery.browser.mobile);
    })(navigator.userAgent || navigator.vendor || window.opera);


    function isMobile() {
        // alert(jQuery.browser.mobile);

        if (jQuery.browser.mobile == true) {
            return true; 
        } else {
            return false;
        }

    }


    var window = $(window);
    var videoWrap = $('.video-wrap');
    var video = $('.video');
    var videoHeight = video.outerHeight();
    var arebia = $('#arebia');
    $(window).scroll(function () { 
        
    // $(window).on('scroll',  function() {
        var windowScrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var videoBottom = videoHeight + videoWrap.offset().top;
        
    if (windowScrollTop > videoBottom) { //  + $('#bannerCarousole').height() + windowHeight

            if (isMobile() == false) {
                videoWrap.height(windowHeight); // videoHeight
                video.addClass('stuck');
                arebia.addClass('stuck');

            } else {
                videoWrap.height('auto');
                video.removeClass('stuck');
                arebia.removeClass('stuck');

            }

        } else {
            videoWrap.height('auto');
            video.removeClass('stuck');
            arebia.removeClass('stuck');
        }
    });


