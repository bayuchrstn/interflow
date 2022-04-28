not_found = '<div class="col-lg-12 text-center"><h4>--- no data available ---</h4></div>';

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



function loader(limit,id,id_list) {

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

    output = '';

    for(var count=0; count<limit; count++) {

        output += '<div class="col-lg-8 col-md-8 col-sm-8 col-12"><div class="property-box-2">';

        output += '<div class="post_data">';

        output += '<p><span class="content-placeholder" style="width:100%; height: 160px;">&nbsp;</span></p>';

        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';

        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';

        output += '</div></div></div>';

    }

    $('#'+id_list).html(output);

}



function loadRecommended() {

    category = $("#categoryId").val();

    premium  = $("#premium").val();

    sort_order = $("#sort_order").val();

    $.ajax({

        url:base_url+"Main/ajax_data_property_recommended",

        type:"GET",

        data:$("#form_filter").serialize()+"&category="+category+"&premium="+premium+"&sort_order="+sort_order,

        dataType:"JSON",

        beforeSend:function() {

            loader(3,'recommended');

            loader(3,'','recommended_type_list');

        },

        success:function(data) {

            let html = '';

            let html_list = '';

            for (let i = 0; i < data.length; i++) {

                property = data[i];

                enter_name = '';

                str_name_property = property.nama;

                str_address_property = property.nama_jalan; // property.alamat

                if(str_name_property.length < 30) {

                    enter_name = '<br><br>';

                }

                if(str_name_property.length > 50) {

                    enter_name = '';

                    str_name_property = str_name_property.substr(0, 50)+'...';

                }

                if(str_address_property.length > 38) {

                    str_address_property = str_address_property.substr(0, 35)+'...';

                }

                if (property.id_status_property == '1') {
                    status_property = '<div class="tag-buy">' + property.name_status + '</div>';
                } else {
                    status_property = '<div class="tag-buy" style="background: red;">' + property.name_status_trx + '</div>';
                }

                html += '';

                html += '<div class="col-lg-4 col-md-4 col-sm-12"><div class="property-box"><div class="property-thumbnail"><a href="'+base_url+'Main/detail_property?q='+property.id+'" class="property-img">'+status_property+'<div class="price-box"><span>Rp '+property.harga_jual+'</span></div><img class="d-block w-100" src="'+property.image+'" alt="properties"></a></div><div class="detail"><h1 class="title"><a title="'+property.nama+'" href="'+base_url+'Main/detail_property?q='+property.id+'">'+str_name_property+enter_name+'</a></h1><div class="location"><a title="'+str_address_property+'" href="javascript:;"><i class="flaticon-pin"></i></a>'+str_address_property+'</div><hr><ul class="facilities-list clearfix">';



                // list layout //

                html_list += '<div class="col-lg-8 col-md-8 col-sm-8 col-12"><div class="property-box-2"><div class="row"><div class="col-lg-5 col-md-5 col-pad"><div class="property-thumbnail"><a href="'+base_url+'Main/detail_property?q='+property.id+'" class="property-img"><img src="'+property.image+'" alt="properties" class="img-fluid">'+status_property+'<div class="price-box"><span>Rp '+property.harga_jual+'</span></div></a></div></div><div class="col-lg-7 col-md-7 col-pad align-self-center"><div class="detail"><h3 class="title"><a href="'+base_url+'Main/detail_property?q='+property.id+'">'+property.nama+'</a></h3><h5 class="location"><a href="javascript:;"><i class="flaticon-pin"></i>'+str_address_property+'</a></h5><hr><ul class="facilities-list clearfix">';



                    fasilitas = property.fasilitas;

                    for (let j = 0; j < fasilitas.length; j++) {

                        html += '<li><i class="'+fasilitas[j].logo+'"></i>'+fasilitas[j].fasilitas+' '+fasilitas[j].label+' '+fasilitas[j].satuan+'</li>';



                        html_list += '<li><i class="'+fasilitas[j].logo+'"></i>'+fasilitas[j].fasilitas+' '+fasilitas[j].label+' '+fasilitas[j].satuan+'</li>';

                    }



                html += '</ul></div></div></div>';



                html_list += '</ul></div></div></div></div></div>';                

            }

            $("#recommended").html(html);

            $("#recommended_type_list").html(html_list);

            if(data.length == 0) {

                $("#recommended").html(not_found);

                $("#recommended_type_list").html(not_found);

            }

        },

        error:function(err) {

            console.log(err);

        }

    });

} loadRecommended();



$(document).ready(function(){ 

    $('#pagination_prop').on('click','a',function(e){

      e.preventDefault(); 

      var page_no = $(this).attr('data-ci-pagination-page');

      loadProperty(page_no);

    });

});



loadProperty(0);

function loaddetail(obj){
    window.location = $(obj).find("a").attr("href");
    return false;
}

function loadProperty(page_no) {
    topY = window.scrollY;
    if(topY > 0) {
        window.scroll({top: 980, left: 0, behavior: 'smooth'});
    }

    category = $("#categoryId").val();

    premium  = $("#premium").val();

    sort_order = $("#sort_order").val();

    $.ajax({

        url:base_url+"Main/ajax_data_premium/"+page_no,

        type:"GET",

        data:$("#form_filter").serialize()+"&category="+category+"&premium="+premium+"&sort_order="+sort_order,

        dataType:"JSON",

        beforeSend:function() {

            loader(6,'property_list');

            loader(6,'','property_type_list');

        },

        success:function(data) {

            data_property = data.data;

            pagination    = data.pagination;

            let html = '';

            let html_list = '';

            for (let i = 0; i < data_property.length; i++) {

                property = data_property[i];

                enter_name = '';

                str_name_property = property.nama;

                str_address_property = property.nama_jalan; // property.alamat

                if(str_name_property.length < 30) {

                    enter_name = '<br><br>';

                }

                if(str_name_property.length > 50) {

                    enter_name = '';

                    str_name_property = str_name_property.substr(0, 50)+'...';

                }

                if(str_address_property.length > 38) {

                    str_address_property = str_address_property.substr(0, 35)+'...';

                }

                // if (property.status_transaksi == '0') {
                //     status_property = '<div class="tag-buy">' + property.name_status + '</div>';
                // }
                //  else {
                //     status_property = '<div class="tag-buy" style="background: red;">' + property.name_status_trx + '</div>';
                // }

                if (property.id_status_property == '1'){
                    status_property = '<div class="tag-buy">' + property.name_status + '</div>';
                }else{
                    status_property = '<div class="tag-buy">' + property.name_status + '</div>';
                }

                html += '';

                html += '<div class="col-lg-4 col-md-4 col-sm-12"><div class="property-box" onclick="loaddetail(this);"><div class="property-thumbnail"><a href="'+base_url+'Main/detail_property?q='+property.id+'" class="property-img">'+status_property+'<div class="price-box"><span>Rp '+property.harga_jual+'</span></div><img src="../assets/img/premium.png" style="height:100px; position:absolute; right:0;"><img class="d-block w-100" src="'+property.image+'" alt="properties"></a></div><div class="detail"><h1 class="title"><a title="'+property.nama+'" href="'+base_url+'Main/detail_property?q='+property.id+'">'+str_name_property+enter_name+'</a></h1><div class="location"><a title="'+str_address_property+'" href="javascript:;"><i class="flaticon-pin"></i></a>'+str_address_property+'</div><hr><ul class="facilities-list clearfix">';



                // list layout //

                html_list += '<div class="col-lg-8 col-md-8 col-sm-8 col-12"><div class="property-box-2" onclick="loaddetail(this);"><div class="row"><div class="col-lg-5 col-md-5 col-pad"><div class="property-thumbnail"><a href="'+base_url+'Main/detail_property?q='+property.id+'" class="property-img"><img src="'+property.image+'" alt="properties" class="img-fluid">'+status_property+'<div class="price-box"><span>Rp '+property.harga_jual+'</span></div><img src="../assets/img/premium.png" style="width:100px;height:100px; position:absolute; right:0;"></a></div></div><div class="col-lg-7 col-md-7 col-pad align-self-center"><div class="detail"><h3 class="title"><a href="'+base_url+'Main/detail_property?q='+property.id+'">'+property.nama+'</a></h3><h5 class="location"><a href="javascript:;"><i class="flaticon-pin"></i>'+str_address_property+'</a></h5><hr><ul class="facilities-list clearfix">';



                    fasilitas = property.fasilitas;

                    for (let j = 0; j < fasilitas.length; j++) {

                         html += '<li><i class="'+fasilitas[j].logo+'"></i>'+fasilitas[j].fasilitas+' '+fasilitas[j].label+' '+fasilitas[j].satuan+'</li>';



                        html_list += '<li><i class="'+fasilitas[j].logo+'"></i>'+fasilitas[j].fasilitas+' '+fasilitas[j].label+' '+fasilitas[j].satuan+'</li>';

                    }



                html += '</ul></div></div></div>';



                html_list += '</ul></div></div></div></div></div>'; 

            }

            $("#property_list").html(html);

            $("#property_type_list").html(html_list);

            $("#pagination_prop").html(pagination);

            $('.page-link').attr("href","javascript:;");

            if(data_property.length == 0) {

                $("#property_list").html(not_found);

                $("#property_type_list").html(not_found);

            }

        },

        error:function(err) {

            console.log(err);

        }

    });

}



$("#btn-search").click(function() {

    loadRecommended();

    loadProperty(0);

});



$("#search").keydown(function(e) {

    if(e.keyCode == 13) {

        e.preventDefault();

        loadRecommended();

        loadProperty(0);

    }

});



function CategorySearch(val) {

    $("#categoryId").val(val);

    loadRecommended();

    loadProperty(0);

    // get value id for release orange image //

    id_cat = $(".cat-active").attr('id');

    // get value from attribute for delete //

    data_id_cat = $(".cat-active").attr('data-id');

    

    if(data_id_cat == '0') {

        $("#"+id_cat).removeClass('cat-active').attr('src',base_url+'assets/img/icon/interflowgrey.png')

                .removeAttr('data-id');

    }



    if(val == '') {

        $("#img-cat").addClass('cat-active')

                .attr('src',base_url+'assets/img/icon/interfloworange.png')

                .attr('data-id','0');

    }



    if(data_id_cat == '1') {

        $("#img-cat"+data_id_cat).removeClass('cat-active').attr('src',base_url+'assets/img/icon/homegrey.png')

                .removeAttr('data-id');

    }



    if(val == '1') {

        $("#img-cat"+val).addClass('cat-active')

                .attr('src',base_url+'assets/img/icon/homeorange.png')

                .attr('data-id', val);

    }



    if(data_id_cat == '2') {

        $("#img-cat"+data_id_cat).removeClass('cat-active').attr('src',base_url+'assets/img/icon/officegrey.png')

                .removeAttr('data-id');

    }



    if(val == '2') {

        $("#img-cat"+val).addClass('cat-active')

                .attr('src',base_url+'assets/img/icon/officeorange.png')

                .attr('data-id',val);

    }



    if(data_id_cat == '3') {

        $("#img-cat"+data_id_cat).removeClass('cat-active').attr('src',base_url+'assets/img/icon/landgrey.png')

                .removeAttr('data-id');

    }



    if(val == '3') {

        $("#img-cat"+val).addClass('cat-active')

                .attr('src',base_url+'assets/img/icon/landorange.png')

                .attr('data-id',val);

    }



    if(data_id_cat == '4') {

        $("#img-cat"+data_id_cat).removeClass('cat-active').attr('src',base_url+'assets/img/icon/garagegrey.png')

                .removeAttr('data-id');

    }



    if(val == '4') {

        $("#img-cat"+val).addClass('cat-active')

                .attr('src',base_url+'assets/img/icon/garageorange.png')

                .attr('data-id',val);

    }



    if(data_id_cat == '5') {

        $("#img-cat"+data_id_cat).removeClass('cat-active').attr('src',base_url+'assets/img/icon/apartementgrey.png')

                .removeAttr('data-id');

    }



    if(val == '5') {

        $("#img-cat"+val).addClass('cat-active')

                .attr('src',base_url+'assets/img/icon/apartementorange.png')

                .attr('data-id',val);

    }

}



$("#list-type").click(function() {

    $("#"+this.id).addClass('active-view-btn');

    $("."+this.id).show();

    $("#grid-type").removeClass('active-view-btn');

    $(".grid-type").hide();

});



$("#grid-type").click(function() {

    $("#"+this.id).addClass('active-view-btn');

    $("."+this.id).show();

    $("#list-type").removeClass('active-view-btn');

    $(".list-type").hide();

});



$("#sort_order").change(function() {

    loadRecommended();

    loadProperty(0);

});