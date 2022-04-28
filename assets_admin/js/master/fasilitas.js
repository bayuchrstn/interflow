$(document).ready(function() {
    load_table();
});


function load_table() {
    $("#table1").DataTable({
        destroy: true, 
        processing: true,
        responsive: true,
        ajax : {
            url: base_url + 'admin/Master/dt_fasilitas',
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
    
    
} 


function show_form() {
    $('#modal_form').modal('toggle');
    clear_form();
}


$('#form-data').submit(function (event) { 
    event.preventDefault();
    formData = new FormData($(this)[0]);

    $.ajax({
		url: base_url+"admin/Master/ajax_simpan_fasilitas",
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
    

});




function get_id(id) {
	$.ajax({
		url: base_url + "admin/Master/fasilitas_id/" + id,
		dataType: "json",
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {
			$('#id').val(data.id);
			$('#nama').val(data.nama);
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
                url : base_url+'admin/Master/hapus_fasilitas/'+id,
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
	$("#id").val('');
}
