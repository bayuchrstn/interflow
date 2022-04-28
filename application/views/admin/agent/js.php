<script type="text/javascript">
    $(document).ready(function() {
        // load_table();

       /*  $('#cabang').select2({
            placeholder : "Pilih Cabang",
            // ajax call data
            ajax : {
                url : base_url+'admin/Manage_user/select2_cabang',
                dataType : 'json',
                type : 'post',
                delay : 250,
                data : function(params) {
                    return {
                        q : params.term
                    }
                },
                processResults : function(data) {
                    var results = [];
                    if (data) {
                        $.each(data, function(index, item){
                            results.push({
                                id : item.id,
                                text : item.text
                            });
                        });
                    }

                    return {
                        results : results
                    }
                }
            } 
        }); */

        $('#cabang option:first').attr('disabled', 'disabled');
        $('#cabang').select2();


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
                "destroy": true,
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
                        "targets": [3],
                        "orderable": false,
                        "className": "text-center"
                    },
                    {
                        "targets": [8],
                        "orderable": false,
                        "className": "text-center",
                        "width": "30%"
                    },
                    {
                        "targets": [6],
                        "width": "30%"
                    }
                ],
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
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
            url: base_url + "admin/Manage_user/get_user_id/" + id,
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
                $('#telp').val(data.phone);
                $('#username').val(data.username);
                $('#img_name').val(data.foto); 
                /* $("#cabang").select2("trigger", "select", {
                    data: { id: data.cabang }
                }); */
                $('#cabang').val(data.cabang).trigger('change');
                $('#email').val(data.email);
                $('#deskripsi').val(data.deskripsi);
                $('#old_img').html('<div class="form-group row"> <label class="col-form-label col-lg-3"></label> <div class="col-lg-8">  <div class="input-group"> <a href="' + data.host + data.foto + '"><img src="' + data.host + data.foto + '" style="width:100px;"> </a> </div> </div> </div>'); 
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
    }


    $('#tgl_lahir').datepicker({
        format: "dd-mm-yyyy"
    });
    
</script>