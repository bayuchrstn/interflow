not_found = '<div class="col-lg-12 text-center"><h4>--- no data available ---</h4></div>';



$("#btn-send").click(function () {

    $.ajax({

        url: base_url + "Main/ajax_send_contact_agent",

        type: "POST",

        data: $("#form-contact").serialize(),

        dataType: "JSON",

        beforeSend: function () {

            $("#btn-send").html('Sending...').attr('disabled', true);

        },

        complete: function () {

            $("#btn-send").html('Send Message').attr('disabled', false);

        },

        success: function (r) {

            if (r.status == true) {

                $("#alert_notif").html(r.message);

                $('#form-contact').trigger("reset");

            } else {

                $("#alert_notif").html(r.message);

            }

        },

        error: function (err) {

            console.log(err);

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



function loader(limit, id, id_list) {

    var output = '';

    for (var count = 0; count < limit; count++) {

        output += '<div class="col-lg-6 col-md-6 col-sm-12"><div class="property-box">';

        output += '<div class="post_data">';

        output += '<p><span class="content-placeholder" style="width:100%; height: 260px;">&nbsp;</span></p>';

        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';

        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';

        output += '</div></div></div>';

    }

    $('#' + id).html(output);

    output = '';

    for (var count = 0; count < limit; count++) {

        output += '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="property-box-2">';

        output += '<div class="post_data">';

        output += '<p><span class="content-placeholder" style="width:100%; height: 140px;">&nbsp;</span></p>';

        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';

        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';

        output += '</div></div></div>';

    }

    $('#' + id_list).html(output);

}



$(document).ready(function () {

    $('#pagination_prop').on('click', 'a', function (e) {

        e.preventDefault();

        var page_no = $(this).attr('data-ci-pagination-page');

        loadProperty(page_no);

    });

});



loadProperty(0);



function loadProperty(page_no) {

    id_agent = $("#id_agent").val();

    sorting = $("#sorting").val();

    $.ajax({

        url: base_url + "Main/ajax_data_property_list_agent/" + page_no,

        type: "GET",

        data: $("#form-search").serialize() + "&id_agent=" + id_agent + "&sort_order=" + sorting,

        dataType: "JSON",

        beforeSend: function () {

            loader(2, 'property_list');

            loader(2, '', 'property_type_list');

        },

        success: function (data) {

            data_property = data.data;

            pagination = data.pagination;

            let html = '';

            let html_list = '';

            for (let i = 0; i < data_property.length; i++) {

                property = data_property[i];
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

                    str_name_property = str_name_property.substr(0, 50) + '...';

                }

                if (str_address_property.length > 38) {

                    str_address_property = str_address_property.substr(0, 35) + '...';

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

                html += '';
                if (property.premium == '0') {
                    html += '<div class="col-lg-6 col-md-6 col-sm-12"><div class="property-box"><div class="property-thumbnail"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '" class="property-img">' + status_property + '<div class="price-box"><span>Rp ' + harga + '</span></div><img class="d-block w-100" src="' + property.image + '" alt="properties"></a></div><div class="detail"><h1 class="title"><a title="' + property.nama + '" href="' + base_url + 'Main/detail_property?q=' + property.id + '">' + str_name_property + enter_name + '</a></h1><div class="location"><a title="' + str_address_property + '" href="javascript:;"><i class="flaticon-pin"></i></a>' + str_address_property + '</div><hr><ul class="facilities-list clearfix">';



                    // list layout //

                    html_list += '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="property-box-2"><div class="row"><div class="col-lg-5 col-md-5 col-pad"><div class="property-thumbnail"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '" class="property-img"><img src="' + property.image + '" alt="properties" class="img-fluid">' + status_property + '<div class="price-box"><span>Rp ' + harga + '</span></div></a></div></div><div class="col-lg-7 col-md-7 col-pad align-self-center"><div class="detail"><h3 class="title"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '">' + property.nama + '</a></h3><h5 class="location"><a href="javascript:;"><i class="flaticon-pin"></i>' + str_address_property + '</a></h5><hr><ul class="facilities-list clearfix">';
                }
                else {
                    html += '<div class="col-lg-6 col-md-6 col-sm-12"><div class="property-box"><div class="property-thumbnail"><img src="../assets/img/premium.png" style="height:100px; position:absolute; right:0;"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '" class="property-img">' + status_property + '<div class="price-box"><span>Rp ' + harga + '</span></div><img class="d-block w-100" src="' + property.image + '" alt="properties"></a></div><div class="detail"><h1 class="title"><a title="' + property.nama + '" href="' + base_url + 'Main/detail_property?q=' + property.id + '">' + str_name_property + enter_name + '</a></h1><div class="location"><a title="' + str_address_property + '" href="javascript:;"><i class="flaticon-pin"></i></a>' + str_address_property + '</div><hr><ul class="facilities-list clearfix">';



                    // list layout //

                    html_list += '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="property-box-2"><div class="row"><div class="col-lg-5 col-md-5 col-pad"><div class="property-thumbnail"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '" class="property-img"><img src="../assets/img/premium.png" style="height:100px;width:100px;position:absolute; right:0;"><img src="' + property.image + '" alt="properties" class="img-fluid">' + status_property + '<div class="price-box"><span>Rp ' + harga + '</span></div></a></div></div><div class="col-lg-7 col-md-7 col-pad align-self-center"><div class="detail"><h3 class="title"><a href="' + base_url + 'Main/detail_property?q=' + property.id + '">' + property.nama + '</a></h3><h5 class="location"><a href="javascript:;"><i class="flaticon-pin"></i>' + str_address_property + '</a></h5><hr><ul class="facilities-list clearfix">';
                }


                fasilitas = property.fasilitas;

                for (let j = 0; j < fasilitas.length; j++) {
                    html += '<li><i class="' + fasilitas[j].logo + '"></i>' + fasilitas[j].fasilitas + ' ' + fasilitas[j].label + ' ' + fasilitas[j].satuan + '</li>';
                    html_list += '<li><i class="' + fasilitas[j].logo + '"></i>' + fasilitas[j].fasilitas + ' ' + fasilitas[j].label + ' ' + fasilitas[j].satuan + '</li>';
                }



                html += '</ul></div></div></div>';



                html_list += '</ul></div></div></div></div></div>';

            }

            $("#property_list").html(html);

            $("#property_type_list").html(html_list);

            $("#pagination_prop").html(pagination);

            $('.page-link').attr("href", "javascript:;");

            if (data_property.length == 0) {

                $("#property_list").html(not_found);

                $("#property_type_list").html(not_found);

            }

        },

        error: function (err) {

            console.log(err);

        }

    });

}



$("#search-btn").click(function () {

    loadProperty(0);

});



$("#list-type").click(function () {

    $("#" + this.id).addClass('active-view-btn');

    $("." + this.id).show();

    $("#grid-type").removeClass('active-view-btn');

    $(".grid-type").hide();

});



$("#grid-type").click(function () {

    $("#" + this.id).addClass('active-view-btn');

    $("." + this.id).show();

    $("#list-type").removeClass('active-view-btn');

    $(".list-type").hide();

});



$("#sorting").change(function () {

    loadProperty(0);

});