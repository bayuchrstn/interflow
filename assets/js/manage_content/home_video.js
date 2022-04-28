$(document).ready(function() {
    // table.ajax.reload(null, false);
    // load_table();
});


// function load_table() {
    var table =	 $("#table1").DataTable({
                    processing: true,
                    responsive: true,
                    ajax : {
                        url: base_url + 'admin/Manage_content/dt_home_video',
                        type: "GET"
                    },
                    columnDefs: [
                        {
                            targets: [4],
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
                        processing: "<i class='icon-spinner spinner'></i>"
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
    
    
// } 


function show_form() {
    $('#modal_form').modal('toggle');
    clear_form();
}


$('#form-data').submit(function (event) { 
    event.preventDefault();
    formData = new FormData($(this)[0]);

    $.ajax({
		url: base_url+"admin/Content_trx/ajax_simpan_home_video",
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
                table.ajax.reload(null, false);
                // load_table();
			} else {
				toastr.error(data.message);
			}
		},
		error: function () {
			toastr.warning('Terjadi error saat menyimpan data');
		}
	});
    return false;
    

});




function get_id(id) {

	$.ajax({
		url: base_url + "admin/Content_trx/get_home_video_by_id/" + id,
		dataType: "json",
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {
			$('#id').val(data.id);
            $('#video_url').val(data.file_url);
            $('#description').val(data.description);
		},
		error: function () {
			toastr.warning('Terjadi error saat memuat data');
		}
	});
	$("#modal_form").modal("toggle");
}



function delete_data(id) {
    bootbox.confirm("Yakin akan me-nonaktifkan video ini ?", function(event){
        if (event == true) {
            $.ajax({
                url : base_url+'admin/Content_trx/hapus_home_video/'+id,
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

function set_active(id) {
    bootbox.confirm("Yakin akan mengaktifkan video ini ?", function(event){
        if (event == true) {
            $.ajax({
                url : base_url+'admin/Content_trx/set_active_video/'+id,
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



function clear_form() {
	$('#form-data').trigger('reset');
    $("#id").val('');
}
