$(document).ready(function() {
    // table.ajax.reload(null, false);
    // load_table();
});


// function load_table() {
    var table =	 $("#table1").DataTable({
                    
                    processing: true,
                    responsive: true,
                    ajax : {
                        url: base_url + 'admin/Master/dt_email_subscriber',
                        type: "GET"
                    },
                    columnDefs: [
                        {
                            targets: [2],
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
		url: base_url+"admin/Master/ajax_simpan_email_subscriber",
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
		url: base_url + "admin/Master/email_subscriber_id/" + id,
		dataType: "json",
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {
			$('#id').val(data.id);
            $('#email').val(data.email);
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
                url : base_url+'admin/Master/hapus_email_subscriber/'+id,
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
