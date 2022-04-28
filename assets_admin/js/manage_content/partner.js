$(document).ready(function() {

	load_table();

});





$(document).on("click", ".openImageDialog", function () {

    let myImageId = $(this).data('id');

    let myImageName = $(this).data('name');

    

    $(".modal-body #myImage").attr("src", myImageId);

    $(".btn_download").attr("href", myImageId);

    $(".btn_download").attr("download", myImageName);

});







function load_table() {



	$("#table1").DataTable({

		destroy: true, 

        processing: true,

        responsive: true,

        ajax : {

            url: base_url + 'admin/Manage_content/dt_partner',

            type: "GET"

        },

        columnDefs: [

            {

                targets: [3],

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







function save_data() {

	formData = new FormData($('#form-data')[0]);

	let img_upload = $('#file_img').val();



	$.ajax({

		url : base_url+"admin/Content_trx/ajax_simpan_partner",

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

				load_table();



				if (img_upload != '') {

					// Reload the current page without the browser cache

					location.reload(true);

				}





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

	$('#old_pdf').show();



	let img_upload = $('#file_img').val();

	let pdf_upload = $('#file_pdf').val();



	if (img_upload != '') {

		$('#file_img').val('');

	}



	if (pdf_upload != '') {

		$('#file_pdf').val('');

	}



	$.ajax({

		url: base_url + "admin/Content_trx/get_partner_by_id/" + id,

		dataType: "json",

		beforeSend: function () {

			blockUI();

		},

		complete: function () {

			unBlockUI();

		},

		success: function (data) {

			$('#id').val(data.id);

			$('#old_img').show();

			/* $('#old_pdf').show();

			$('#name_tag').val(data.name_tag); */

			$('#fullname').val(data.name);

			/* $('#alamat').val(data.address); */

			$('#img_name').val(data.img_name); 

			// $('#pdf_name').val(data.pdf_name); 

			$('#old_img').html('<div class="form-group row"> <label class="col-form-label col-md-2"></label></label> <div class="col-md-8">  <div class="input-group"> <a href="' + data.img_url + '"><img src="' + data.img_url + '" style="width:100px;"> </a> </div> </div> </div>'); 

			// $('#old_pdf').html('<br> <div class="form-group row"> <label class="col-form-label col-md-2"></label></label> <div class="col-md-8">  <div class="input-group"> <a href="' + data.pdf_url + '" target="_blank" class="btn btn-sm btn-danger"> <span class="icon-file-pdf"> </span> PDF </a> </div> </div> </div>');

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

				url : base_url+'admin/Content_trx/hapus_partner/'+id,

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



/* function format_date(dateStr) {

	arr = dateStr.split("-");  // ex input "2010-01-18"

	return arr[2]+ "-" +arr[1]+ "-" +arr[0]; //ex out: "18-01-2010"

}

 */

function clear_form() {

	$('#form-data').trigger('reset');

	$("#id").val('');

	$("#img_name").val('');

	$("#pdf_name").val('');

	$('#old_img').hide();

	$('#old_pdf').hide();

}





/* $('#tgl_lahir').datepicker({

	format: "dd-mm-yyyy"

}); */