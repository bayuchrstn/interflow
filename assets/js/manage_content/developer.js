$(document).ready(function() {

	// table.ajax.reload(null, false);
	// load_table();

});



$(document).on("click", ".openImageDialog", function () {

    let myImageId = $(this).data('id');

    let myImageName = $(this).data('name');

    

    $(".modal-body #myImage").attr("src", myImageId);

    $(".btn_download").attr("href", myImageId);

    $(".btn_download").attr("download", myImageName);

});





// function load_table() {



var table =	$("#table1").DataTable({

		 

				processing: true,

				responsive: true,

				ajax : {

					url: base_url + 'admin/Manage_content/dt_developer',

					type: "GET"

				},

				columnDefs: [

					{

						targets: [6],

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







function save_data() {

	formData = new FormData($('#form-data')[0]);

	let img_upload = $('#file_img').val();

	let img_upload2 = $('#file_image').val();



	$.ajax({

		url : base_url+"admin/Content_trx/ajax_simpan_developer",

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



				if (img_upload != '') {

					// Reload the current page without the browser cache

					location.reload(true);

				}

				if (img_upload2 != '') {

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

	$('#old_image').show();

	$('#old_pdf').show();



	let img_upload = $('#file_img').val();

	let img_upload2 = $('#file_image').val();

	let pdf_upload = $('#file_pdf').val();



	if (img_upload != '') {

		$('#file_img').val('');

	}

	if (img_upload2 != '') {

		$('#file_image').val('');

	}


	if (pdf_upload != '') {

		$('#file_pdf').val('');

	}



	$.ajax({

		url: base_url + "admin/Content_trx/get_developer_by_id/" + id,

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

			$('#old_image').show();

			$('#old_pdf').show();

			$('#name_tag').val(data.name_tag);

			$('#fullname').val(data.name);

			$('#alamat').val(data.address);

			$('#img_name').val(data.img_name); 

			$('#image').val(data.image);

			$('#pdf_name').val(data.pdf_name); 

			$('#old_img').html('<div class="form-group row"> <label class="col-form-label col-md-2"></label></label> <div class="col-md-8">  <div class="input-group"> <a href="' + data.img_url + '"><img src="' + data.img_url + '" style="width:100px;"> </a> </div> </div> </div>'); 

			$('#old_image').html('<div class="form-group row"> <label class="col-form-label col-md-2"></label></label> <div class="col-md-8">  <div class="input-group"> <a href="' + data.image_url + '"><img src="' + data.image_url + '" style="width:100px;"> </a> </div> </div> </div>'); 

			if (data.pdf_url != "" && data.pdf_name != "" && data.pdf_url !== null && data.pdf_name !== null) {
				$('#old_pdf').html('<br> <div class="form-group row"> <label class="col-form-label col-md-2"></label></label> ' + 
									'<div class="col-md-8"> <div class="input-group"> '+
									' <a href="' + data.pdf_url + data.pdf_name + '" target="_blank" class="btn btn-sm btn-danger"> ' + 
									'<span class="icon-file-pdf"> </span> PDF </a> </div> </div> </div>'); 
			} else {
				$('#old_pdf').html('<br> <div class="form-group row"> <label class="col-form-label col-md-2"></label></label> ' + 
									'<span class="badge badge-warning"> Belum Upload PDF </span> </div>');
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

				url : base_url+'admin/Content_trx/hapus_developer/'+id,

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



/* function format_date(dateStr) {

	arr = dateStr.split("-");  // ex input "2010-01-18"

	return arr[2]+ "-" +arr[1]+ "-" +arr[0]; //ex out: "18-01-2010"

}

 */

function clear_form() {

	$('#form-data').trigger('reset');

	$("#id").val('');

	$("#img_name").val('');

	$("#image").val('');

	$("#pdf_name").val('');

	$('#old_img').hide();

	$('#old_image').hide();

	$('#old_pdf').hide();

}





/* $('#tgl_lahir').datepicker({

	format: "dd-mm-yyyy"

}); */