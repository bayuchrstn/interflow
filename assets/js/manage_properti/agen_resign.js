Dropzone.autoDiscover = false;


$(document).ready(function() {
    $('#telp option:first').attr('disabled', 'disabled');
     $('#telp').select2();

    // load_table();
    // $("#table1").DataTable();
});

var id = $('#id').val();

// function load_table() {

var table_header =    $("#table1").DataTable({
                            processing: true,
                            responsive: true,
                            ajax : {
                                url: base_url + 'admin/Manage_properti/get_properti_agen_resign',
                                type: "GET"
                            },
                            columnDefs: [{
                                    targets: [3],
                                    orderable: false,
                                    className: "text-center"
                            }],
                            lengthMenu: [
                                [10, 25, 50, 100, -1],
                                [10, 25, 50, 100, "All"]
                            ],
                            language: {
                                loadingRecords: "&nbsp;",
                                processing: "<i class='icon-spinner9 spinner'></i>"
                            },
                            buttons: {
                                dom: {
                                    button: {
                                        className: 'btn btn-light'
                                    }
                                },
                                buttons: [{
                                        extend: 'copy'
                                    },
                                    {
                                        extend: 'csv'
                                    },
                                    {
                                        extend: 'excel'
                                    },
                                    {
                                        extend: 'pdf'
                                    },
                                    {
                                        extend: 'print'
                                    }]
                            }
                        });
    
    
// } 


var table_detail =    $("#table2").DataTable({
                            processing: true,
                            responsive: true,
                            ajax : {
                                url: base_url + 'admin/Manage_properti/get_detail_properti_agen_resign/'+id,
                                type: "GET"
                            },
                            columnDefs: [
                                {
                                    targets: [5],
                                    orderable: false,
                                    className: "text-center"
                                }
                            ],
                            lengthMenu: [
                                [10, 25, 50, 100, -1],
                                [10, 25, 50, 100, "All"]
                            ],
                            language: {
                                loadingRecords: "&nbsp;",
                                processing: "<i class='icon-spinner9 spinner'></i>"
                            },
                            buttons: {
                                dom: {
                                    button: {
                                        className: 'btn btn-light'
                                    }
                                },
                                buttons: [{
                                        extend: 'copy'
                                    },
                                    {
                                        extend: 'csv'
                                    },
                                    {
                                        extend: 'excel'
                                    },
                                    {
                                        extend: 'pdf'
                                    },
                                    {
                                        extend: 'print'
                                    }
                                ]
                            }
                        });



function show_form() {
    $('#modal_form').modal('toggle');
    clear_form();
}



function save_data() {
	formData = new FormData($('#form-update')[0]);

	$.ajax({
		url : base_url+"admin/Manage_properti/ajax_change_agent",
		type : "POST",
		data : formData,
		dataType : "JSON",
		contentType: false,
		processData: false,
		beforeSend:function() {
			blockUI();
			$("#btn_simpan").attr("disabled", true).html('Menyimpan ...');
		},
		complete:function() {
			unBlockUI();
			$("#btn_simpan").attr("disabled", false).html('Simpan');
		},
		success:function(data) {
			if(data.status == true) {
				toastr.success(data.message);
				clear_form();
				$("#modal_form").modal('toggle');
				table_detail.ajax.reload(null, false);



			} else {
				toastr.error(data.message);
			}
		},
		error:function(error) {
			toastr.warning('Terjadi error saat menyimpan data');
		}
	});
}



/* $('#form-data').submit(function (event) { 
    event.preventDefault();
    formData = new FormData($(this)[0]);

    $.ajax({
		url: base_url+"admin/Master/ajax_simpan_satuan",
		type: "post",
		data: formData,
		async: false,
		cache: false,
		dataType: "json",
		contentType: false,
		processData: false,
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {
			if (data.status == true) {
                toastr.success(data.message);
                clear_form();
                $("#modal_form").modal('toggle');
                load_table();
			} else {
				toastr.error(data.message);
			}
		},
		error: function () {
			toastr.warning('Terjadi error saat menyimpan data');
		}
	});
    return false;
    

}); */




function get_id(id) {
	$.ajax({
		url: base_url + "admin/Manage_properti/ajax_property_id_agen_resign/" + id,
		dataType: "json",
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {
			$('#id_property').val(data.id_property);
			$('#nama').val(data.nama_properti);
            $('#alamat').val(data.alamat);
			$('#jenis').val(data.category);
            $('#status').val(data.status_name);
		},
		error: function () {
			toastr.warning('Terjadi error saat memuat data');
		}
	});
	$("#modal_form").modal("toggle");
}



function delete_data(id) {
    bootbox.confirm("Yakin akan menghapus data ?", function(event){
        if (event == true) {
            $.ajax({
                url : base_url+'admin/Master/hapus_satuan/'+id,
                dataType : "json",
                beforeSend : function(){
                    blockUI();
                },
                complete : function(){
                    unBlockUI();
                },
                success : function(data){
                    if(data.status == 1) {
                        load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error : function(){
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}



function clear_form() {
	$('#form-data').trigger('reset');
	$("#id_property").val('');
}


var optiondropzone = {url: base_url, clickable: false};


function view_detail(id) {
    // $('.img_form').hide();


    $.ajax({
        url: base_url + "admin/Manage_properti/get_properti_id/" + id,
        dataType: "json",
        beforeSend: function () {
            blockUI();
        },
        complete: function () {
            unBlockUI();
        },
        success: function (respon) {
            data = respon.header;
            data_feature = respon.feature;
            // $('.form-control').val('');
            $('#judul').val(data.nama);
            $('#alamat_lengkap').val(data.alamat);
            $('#nama_jalan').val(data.nama_jalan);
            $('#nmr_jalan').val(data.nmr_jalan);
            $('#rt').val(data.rt);
            $('#rw').val(data.rw);
            $('#luas_bangunan').val(data.luas_bangunan);
            $('#luas_tanah').val(data.luas_tanah);
            $('#jml_lantai').val(data.jml_lantai);
            $('#legal').val(data.legalitas);
            $('#start_date_rent').val(data.start_date_rent);
            $('#due_date_rent').val(data.due_date_rent);
            $('#deskripsi').val(data.deskripsi);
            $('.flok').prop('checked', false);

            $("input[name=flag]").removeAttr('disabled');
            $("input[name=flag][value=" + data.flag + "]").attr('checked', 'checked');
            $("input[name=flag][value=" + data.flag + "]").trigger('click');
            $("input[name=flag]").attr('disabled', '');

            for (let i = 0; i < data_feature.length; i++) {
                let get_f = data_feature[i];
                $("#features" + get_f.id_feature).prop('checked', true);
            }

            
            $("input[name='features[]']").attr('disabled', '');

            $.ajax({
                url: base_url + "admin/Manage_properti/get_fasilitas_by_property_disabled/" + id,
                type: "GET",
                success: function (dt_fasilitas) {
                    $('#fasilitas_properti').html(dt_fasilitas);
                    // $(".select2_facility").select2();

                }
            });

            /* let selected_jns = $('#jns_property option:selected').val();

            if (selected_jns != '3') { // besides Lands / Tanah

                $(".form_harga_jual").show();
                $('.form_tipe_jual_tanah').hide();
                // $('input:radio[name"options_type"]').removeAttr("checked");
                // $('input:radio[name="options_type"]').attr("checked", false);
                // $(".form_harga_tanah").hide();

            } else {
                $(".form_harga_jual").show();
                $('.form_tipe_jual_tanah').show();
            } */


            $.getJSON(base_url + "admin/Manage_properti/get_features_name_by_property/" + id,
                function (dt_features) {
                    $('#features').html(dt_features);
                }
            );

            let start_date_fmt;
            let due_date_fmt;

            // let start_date_fmt2;
            // let due_date_fmt2;

            if (data.start_date !== null) {
                start_date_fmt = format_date(data.start_date);
            } else {
                start_date_fmt = data.start_date;
            }

            // if (data.start_date_rent !== null) {
            // 	start_date_fmt2 = format_date(data.start_date_rent);
            // } else {
            // 	start_date_fmt2 = data.start_date_rent;
            // }

            if (data.due_date !== null) {
                due_date_fmt = format_date(data.due_date);
            } else {
                due_date_fmt = data.due_date;
            }

            // if (data.due_date_rent !== null) {
            // 	due_date_fmt2 = format_date(data.due_date_rent);
            // } else {
            // 	due_date_fmt2 = data.due_date_rent;
            // }

            $('#start_date').val(start_date_fmt);
            $('#due_date').val(due_date_fmt);


            // $('#start_date_rent').val(start_date_fmt2);
            // $('#due_date_rent').val(due_date_fmt2);

            /* let option = new Option(data.id_agent);
            option.selected = true;

            $("#telp").append(option);
            $("#telp").trigger("change"); */

            /* let select = $('#telp');
            let option = $('<option></option>').attr('selected', true).
                text(data.phone + ' | ' + data.first_name + ' ' + data.last_name).val(data.id_agent); */

            /* insert the option (which is already 'selected'!) into the select */
            // option.appendTo(select);

            /* Let select2 do whatever it likes with this */
            // select.trigger('change');

            /* $("#telp").select2("trigger", "select", {
                data: { id: data.id_agent }
            }); */

            /* $('#periode_sewa').append($('<option>', {
                value: 0,
                text: 'Periode Sewa'
            })); */

            // $('#telp').trigger('change');
            $('#telp_kontak').val(data.id_agent).change();
            $('#jns_property').val(data.id_category).change();
            $('#status_property').val(data.id_status_property).change();
            $('#periode_sewa').val(data.id_periode_sewa).change();
            $('#harga_user').val(data.harga_user);
            $('#harga_jual').val(data.harga_jual);
            $('#harga_sewa').val(data.harga_sewa);

            if (data.id_category != '3') {
                $('.form_tipe_jual_tanah').hide();
            } else {
                $('.form_tipe_jual_tanah').show();
            }

            if (data.id_tipe_jual_tanah !== null) {
                

                if (data.id_tipe_jual_tanah == 1) {
                    document.getElementById('rd_tanah_area').setAttribute('checked', '');
                    $('#rd_tanah_area').trigger('click');
                    $('#radio_tanah_area').show();
                    $('#radio_tanah_per_meter').hide();

                } else if (data.id_tipe_jual_tanah == 2) {
                    document.getElementById('rd_tanah_per_meter').setAttribute('checked', '');
                    $('#rd_tanah_per_meter').trigger('click');
                    $('#radio_tanah_per_meter').show();
                    $('#radio_tanah_area').hide();
                    
                }

            } else {

                /* document.getElementById('rd_tanah_area').removeAttribute('checked');
                document.getElementById('rd_tanah_per_meter').removeAttribute('checked'); */
            }
            // let features_properti = data.features;



            // if (features_properti !== null && features_properti != '') {
            //     let splitted_features = features_properti.split('');
            //     let checkbox = $('input[name^=features]');

            //     for (let i = 0; i < splitted_features.length; i++) {
            //         checkbox.filter('[value="'+ splitted_features[i] +'"]').attr('checked','');
            //         $('input[value="'+ splitted_features[i] +'"]').trigger('click');

            //         /* $('input:checkbox:not(:checked)').each(function() { 
            //             $('input[value="'+ splitted_kelengkapan[i] +'"]').trigger('click');

            //         });  */


            //         // toastr.success(splitted_kelengkapan[i]);
            //     }

            //     // alert(splitted_kelengkapan);
            // } else {
            // $('input[type=checkbox]:checked').removeAttr('checked');
            // $('input[type=checkbox]:checked').trigger('click'); 
            // }

            $('#deskripsi_area_lahan').val(data.desc_area_lahan);
            $('#deskripsi_area_bangunan').val(data.desc_area_bangunan);
            $('#deskripsi_legalitas').val(data.desc_legalitas);
            $('#deskripsi_fasilitas').val(data.desc_fasilitas);
            $('#koordinat').val(data.lat + ',' + data.lang);
            $('#url_video').val(data.video_url);
            $('#full_furnish').val(data.full_furnish);
            /* $('#').val(data.);
            $('#').val(data.);
            $('#').val(data.);*/
            $(".droparea").html('');
            $(".droparea").append(`<div class="dropzone" id="myDropzone" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 1 </u> </b> 
            </div>
            <input type="hidden" name="Dropzone1" id="Dropzone1">
        </div>
        <div class="dropzone" id="myDropzone2" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 2 </u> </b>
            </div>
            <input type="hidden" name="Dropzone2" id="Dropzone2">
        </div>
        <div class="dropzone" id="myDropzone3" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 3 </u> </b>
            </div>
            <input type="hidden" name="Dropzone3" id="Dropzone3">
        </div>
        <div class="dropzone" id="myDropzone4" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 4 </u> </b>
            </div>
            <input type="hidden" name="Dropzone4" id="Dropzone4">
        </div>
        <div class="dropzone" id="myDropzone5" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 5 </u> </b>
            </div>
            <input type="hidden" name="Dropzone5" id="Dropzone5">
        </div>`);


            //1-5 dropzone

            /* var dropzone1 = new Dropzone("#myDropzone", optiondropzone1);
            var mockFile = { name: data.nama_foto, size: 1024000 };
            dropzone1.options.addedfile.call(dropzone1, mockFile);
            dropzone1.options.thumbnail.call(dropzone1, mockFile, data.foto);
            $("#Dropzone1").val(data.nama_foto); */

            // $(".dz-hidden-input").prop("disabled", true);


            $.getJSON(base_url + "admin/Manage_properti/ajax_img_1/" + id,
                function (dt_image) {
                    let dropzone1 = new Dropzone("#myDropzone", optiondropzone);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone1.options.addedfile.call(dropzone1, mockFile);
                        dropzone1.options.thumbnail.call(dropzone1, mockFile, dt_image.img_url);
                        $("#Dropzone1").val(dt_image.img_name);
                        // console.log(dt_image);
                    }

                    dropzone1.disable();
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_2/" + id,
                function (dt_image) {

                    let dropzone2 = new Dropzone("#myDropzone2", optiondropzone);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone2.options.addedfile.call(dropzone2, mockFile);
                        dropzone2.options.thumbnail.call(dropzone2, mockFile, dt_image.img_url);
                        $("#Dropzone2").val(dt_image.img_name);
                        // console.log(dt_image);
                    }

                    dropzone2.disable();
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_3/" + id,
                function (dt_image) {
                    let dropzone3 = new Dropzone("#myDropzone3", optiondropzone);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone3.options.addedfile.call(dropzone3, mockFile);
                        dropzone3.options.thumbnail.call(dropzone3, mockFile, dt_image.img_url);
                        $("#Dropzone3").val(dt_image.img_name);
                        // console.log(dt_image);
                    }

                    dropzone3.disable();
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_4/" + id,
                function (dt_image) {
                    let dropzone4 = new Dropzone("#myDropzone4", optiondropzone);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone4.options.addedfile.call(dropzone4, mockFile);
                        dropzone4.options.thumbnail.call(dropzone4, mockFile, dt_image.img_url);
                        $("#Dropzone4").val(dt_image.img_name);
                        // console.log(dt_image);
                    }

                    dropzone4.disable();
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_5/" + id,
                function (dt_image) {
                    let dropzone5 = new Dropzone("#myDropzone5", optiondropzone);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone5.options.addedfile.call(dropzone5, mockFile);
                        dropzone5.options.thumbnail.call(dropzone5, mockFile, dt_image.img_url);
                        $("#Dropzone5").val(dt_image.img_name);
                        // console.log(dt_image);
                    }

                    dropzone5.disable();
                }
            );

            // Convert ajax data (latitude,longitude) from String to Float, so it could be read by Google Maps API. 
            let lat_number = parseFloat(data.lat);
            let lng_number = parseFloat(data.lang);
            var location = { lat: lat_number, lng: lng_number };

            var mapCanvas = document.getElementById('pro-maps_content');

            var myCenter = new google.maps.LatLng(lat_number, lng_number);
            var mapOptions = {
                center: myCenter,
                zoom: 13,
                mapTypeId: 'hybrid'
            };

            var map = new google.maps.Map(mapCanvas, mapOptions);

            // Create a marker from existing coordinate of ajax data.
            marker = new google.maps.Marker({
                position: location,
                map: map
            });

            /* google.maps.event.addListener(map, 'click', function (event) {
                var value = placeMarker(map, event.latLng);
            }); */

            // Create the search box and link it to the UI element.
            /* var pacinput = '<input type="text" name="pac-input" class="pac-input" id="pac-input" placeholder="Pencarian peta" value="" style="z-index: 9998 !important;">';
            $('#pro-maps_content').append(pacinput);
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input); */

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            /* searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();
                // console.log(places);

                if (places.length == 0) {
                    return;
                } */

                // Clear out the old markers.
                /* markers.forEach(function (marker) {
                    marker.setMap(null);
                }); */

                /* markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();

                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    } */

                    /* var icon = {
                      url: place.icon,
                      size: new google.maps.Size(71, 71),
                      origin: new google.maps.Point(0, 0),
                      anchor: new google.maps.Point(17, 34),
                      scaledSize: new google.maps.Size(25, 25)
                    }; */

                    // Create a marker for each place.
                   /*  marker = new google.maps.Marker({
                        map: map,
                        // icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }); */

                    /* if (marker && marker.setMap()) {
                        marker.setMap(null);
                    } */

                    /* placeMarker(map, place.geometry.location);

                    if (place.geometry.viewport) { */
                        // Only geocodes have viewport.
                        /* bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });

                map.fitBounds(bounds);
            }); */

            google.maps.event.addDomListener(window, "load", myMap);


            // var fakeAjaxCall = function(success, error) {
            // var location = {lat: lat_number, lng: lng_number};
            // window.setTimeout(success.bind(null, response), 1000);
            // }

            // var myCenter = new google.maps.LatLng(-7.021491, 110.4271556);
            //Our map object is already initialized, no marker is there yet.
            /* var map = new google.maps.Map(document.getElementById('pro-maps_content'), {
                center: myCenter,
                zoom: 13
            }); */

            //Here we make the ajax call. We expect a lat-lng response like the one from fake ajax call
            // fakeAjaxCall(function success(responseMarker){
            /* var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Hello World!'
            }); */
            // })

            // placeMarker(data.lat + ',' + data.lang);

            // $('#cabang').val(data.cabang).trigger('change');
        },
        error: function () {
            toastr.warning('Terjadi error saat memuat data');
        }
    });

    $("#modal_properti").modal("toggle");
}

function format_date(dateStr) {
    arr = dateStr.split("-");  // ex input "2010-01-18"
    return arr[2] + "-" + arr[1] + "-" + arr[0]; //ex out: "18-01-2010"
}
