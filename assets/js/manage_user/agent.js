$(document).ready(function() {
    // load_table();

    $('#cabang option:first').attr('disabled', 'disabled');
    $('#cabang').select2();

    $('#religion option:first').attr('disabled', 'disabled');
    $('#religion').select2();

    $('#agent_ref option:first').attr('disabled', 'disabled');
    $('#agent_ref').select2();



});


$(document).on("click", ".openImageDialog", function () {
    let myImageId = $(this).data('id');
    let myImageName = $(this).data('name');
    
    $(".modal-body #myImage").attr("src", myImageId);
    $(".btn_download").attr("href", myImageId);
    $(".btn_download").attr("download", myImageName);
});



function input_data() {
    $("#modal_agent").attr('transaksi', 'tambah');
    $('#modal_agent').modal('show');
}




// function load_table() {

var table = $("#table1").DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ajax": {
                    "url": base_url + 'admin/Manage_user/get_data_agent',
                    "type": "POST",
                    "data": function(data) {
                        data.search_keyword = $('#table1_filter').val();
                    }
                },
                "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    },
                    {
                        "targets": [4,8],
                        "className": "text-center"
                    },
                    {
                        "targets": [9],
                        "orderable": false,
                        "className": "text-center"
                    },
                    {
                        "targets": [10],
                        "orderable": false,
                        "className": "text-center"
                    },
                    {
                        "targets": [12],
                        "orderable": false,
                        "className": "text-center"/* ,
                        "width": "30%" */
                    }/* ,
                    {
                        "targets": [6],
                        "width": "30%"
                    } */
                ],
                "language": {
                    "loadingRecords": "&nbsp;",
                    "processing": "<i class='icon-spinner9 spinner'></i>"
                },
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
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

// }


function reset_pass(id) {
    bootbox.confirm("Yakin akan Reset Password user ini ?", function(event){
        if (event == true) {
            $.ajax({
                url : base_url+'admin/Manage_user/reset_password/'+id,
                dataType : "json",
                beforeSend : function(){
                    blockUI();
                },
                complete : function(){
                    unBlockUI();
                },
                success : function(data){
                    if(data.status == 1) {
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error : function(){
                    toastr.warning('Terjadi error saat mennyimpan data');
                }
            });
        }
    });
}



function show_form() {
    $('#modal_form').modal('toggle');
    clear_form();
}



function save_data() {
    formData = new FormData($('#form-data')[0]);

    $.ajax({
        url : base_url+"admin/Manage_user/ajax_simpan_agent",
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

                table.ajax.reload(null, false);
                // load_table();
            } else {
                toastr.error(data.message);
            }
        },
        error:function(error) {
            toastr.warning('Terjadi error saat menyimpan data');
        }
    });
}




function get_id(id) {
    $('#old_img').show();
    let img_upload = $('#file_img').val();

    if (img_upload != '') {
        $('#file_img').val('');
    }

    $.ajax({
        url: base_url + "admin/Manage_user/get_agent_id/" + id,
        dataType: "json",
        beforeSend: function () {
            blockUI();
        },
        complete: function () {
            unBlockUI();
        },
        success: function (data) {
            let date_fmt;
            if (data.tgl_lahir !== null) {
                date_fmt = format_date(data.tgl_lahir);
            } else {
                date_fmt = data.tgl_lahir;
            }
            
            $('#id').val(data.id);
            $('#fullname').val(data.fullname);
            $('#nickname').val(data.nickname);
            /* $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name); */
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tgl_lahir').val(date_fmt);
            $('#alamat').val(data.alamat);
            $('#motto').val(data.motto);
            $('#telp').val(data.phone);
            $('#telp_2').val(data.phone2);
            $('#username').val(data.username);
            $('#img_name').val(data.foto); 
            /* $("#cabang").select2("trigger", "select", {
                data: { id: data.cabang }
            }); */
            $('#cabang').val(data.cabang).trigger('change');
            $('#email').val(data.email);
            $('#deskripsi').val(data.deskripsi);
            $('#old_img').html('<div class="form-group row"> <label class="col-form-label col-lg-3"></label> <div class="col-lg-8">  <div class="input-group"> <a href="' + data.host + data.foto + '"><img src="' + data.host + data.foto + '" style="width:100px;"> </a> </div> </div> </div>'); 
            

            let date_fmt_permohonan;
            if (data.tgl_permohonan !== null) {
                date_fmt_permohonan = format_date(data.tgl_permohonan);
            } else {
                date_fmt_permohonan = data.tgl_permohonan;
            }

            $('#tgl_permohonan').val(date_fmt_permohonan);
            $('#id_consultant').val(data.consultant_id);
            $('#nmr_identitas').val(data.nmr_identitas);
            $('#kode_area_telp').val(data.kode_area_telp);
            $('#telp_rumah').val(data.telp_rumah);
            $('#no_rek').val(data.no_rek);
            $('#no_rek_atasnama').val(data.no_rek_atasnama);
            $('#kcp').val(data.kcp);


            if (data.jns_identitas !== null && data.jns_identitas != '') {

                if (data.jns_identitas == 'KTP') {
                    document.getElementById('rd_ktp').setAttribute('checked','');
                    $('#rd_ktp').trigger('click');
                } else if (data.jns_identitas == 'SIM') {
                    document.getElementById('rd_sim').setAttribute('checked','');
                    $('#rd_sim').trigger('click');
                } 

            }


            if (data.gender !== null && data.gender != '') {

                if (data.gender == 'Pria') {
                    document.getElementById('rd_male').setAttribute('checked','');
                    $('#rd_male').trigger('click');
                } else if (data.gender == 'Wanita') {
                    document.getElementById('rd_female').setAttribute('checked','');
                    $('#rd_female').trigger('click');
                } 

            }
            
            
            if (data.mar_stat !== null && data.mar_stat != '') {

                if (data.mar_stat == 'Menikah') {
                    document.getElementById('rd_married').setAttribute('checked','');
                    $('#rd_married').trigger('click');
                } else if (data.mar_stat == 'Belum Menikah') {
                    document.getElementById('rd_single').setAttribute('checked','');
                    $('#rd_single').trigger('click');
                } 

            }

            
            if (data.last_education !== null && data.last_education != '') {


                switch (data.last_education) {
                    case 'SMA':
                        document.getElementById('rd_sma').setAttribute('checked','');
                        $('#rd_sma').trigger('click');
                        break;
                    case 'S1':
                        document.getElementById('rd_s1').setAttribute('checked','');
                        $('#rd_s1').trigger('click');
                        break;
                    case 'S2':
                        document.getElementById('rd_s2').setAttribute('checked','');
                        $('#rd_s2').trigger('click');
                        break;
                    case 'S3':
                        document.getElementById('rd_s3').setAttribute('checked','');
                        $('#rd_s3').trigger('click');
                        break;
                    default:
                        document.getElementById('rd_other_edu').setAttribute('checked','');
                        $('#rd_other_edu').trigger('click');
                        $('#other_edu').val(data.last_education);
                        break;
                }

                /* if (data.last_education == 'SMA') {
                    document.getElementById('rd_sma').setAttribute('checked','');
                    $('#rd_sma').trigger('click');
                } 
                
                if (data.last_education == 'S1') {
                    document.getElementById('rd_s1').setAttribute('checked','');
                    $('#rd_s1').trigger('click');
                } 

                if (data.last_education == 'S2') {
                    document.getElementById('rd_s2').setAttribute('checked','');
                    $('#rd_s2').trigger('click');
                } 
                
                if (data.last_education == 'S3') {
                    document.getElementById('rd_s3').setAttribute('checked','');
                    $('#rd_s3').trigger('click');
                } 
                
                */

            }

            $('#religion').val(data.agama).change();
            $('#agent_ref').val(data.id_ref_agent).change();

            let kelengkapan_agen = data.kelengkapan;

            

            if (kelengkapan_agen !== null && kelengkapan_agen != '') {
                let splitted_kelengkapan = kelengkapan_agen.split(" | ");
                let checkbox = $('input[name^=kelengkapan]');
                
                for (let i = 0; i < splitted_kelengkapan.length; i++) {
                    checkbox.filter('[value="'+ splitted_kelengkapan[i] +'"]').attr('checked','');
                    $('input[value="'+ splitted_kelengkapan[i] +'"]').trigger('click');

                    /* $('input:checkbox:not(:checked)').each(function() { 
                        $('input[value="'+ splitted_kelengkapan[i] +'"]').trigger('click');
                        
                    });  */
                        
                    
                    // toastr.success(splitted_kelengkapan[i]);
                }
                
                // alert(splitted_kelengkapan);
            } else {
                $('input[type=checkbox]:checked').removeAttr('checked');
                $('input[type=checkbox]:checked').trigger('click'); 
            }
            

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
                url : base_url+'admin/Manage_user/hapus_user/'+id,
                dataType : "json",
                beforeSend : function(){
                    blockUI();
                },
                complete : function(){
                    unBlockUI();
                },
                success : function(data){
                    if(data.status == 1) {
                        table.ajax.reload(null, false);
                        // load_table();
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

function format_date(dateStr) {
    arr = dateStr.split("-");  // ex input "2010-01-18"
    return arr[2]+ "-" +arr[1]+ "-" +arr[0]; //ex out: "18-01-2010"
}

function clear_form() {
    $('#form-data').trigger('reset');
    $("#id").val('');
    $("#img_name").val('');
    $('#old_img').hide();
    $('#cabang').val("0").trigger('change');
    $('#religion').val("0").trigger('change');
    $('#agent_ref').val("0").trigger('change');

}


$('#tgl_lahir').datepicker({
    format: "dd-mm-yyyy"
});

$('#tgl_permohonan').datepicker({
    format: "dd-mm-yyyy"
});


    
function resign_agent(id) {
    bootbox.confirm("Apakah Anda yakin bahwa consultant ini sudah <b>resign</b> ?<br> Akun consultant menjadi <b>nonaktif</b> sesudah Anda klik OK.", function(event){
        if (event == true) {
            $.ajax({
                url : base_url+'admin/Manage_user/ajax_resign_agent/'+id,
                dataType : "json",
                beforeSend : function(){
                    blockUI();
                },
                complete : function(){
                    unBlockUI();
                },
                success : function(data){
                    if(data.status == 1) {
                        toastr.success(data.message);
                        table.ajax.reload(null, false);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error : function(){
                    toastr.warning('Terjadi error saat mennyimpan data');
                }
            });
        }
    });
}