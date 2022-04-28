Dropzone.autoDiscover = false;
$(document).ready(function() {
	$('#album_name option:first').attr('disabled', 'disabled');
	$('#album_name').select2();
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


	var table =		$("#table1").DataTable({
		 
						processing: true,
						responsive: true,
						ajax : {
							url: base_url + 'admin/Manage_content/dt_gallery',
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
	$("#modal_update").modal('toggle');
	clear_form();
	// $('#modal_form').modal('toggle');
}


// $('#modal_form').on('shown.bs.modal', function (e) {
	// Initialize Dropzone


	var myDropzone = 	new Dropzone("#gallery-upload",{
							paramName: "file_gallery", // The name that will be used to transfer the file
							maxFilesize: 0.25, // MB
							maxFiles: 10,
							acceptedFiles: "image/*",
							dictInvalidFileType: "Format file ini tidak diizinkan",
							addRemoveLinks: true ,

							accept: function(file, done) {

								// FileReader() asynchronously reads the contents of files (or raw data buffers) stored on the user's computer.
								let reader = new FileReader();
								reader.onload = (function(entry) {
								// The Image() constructor creates a new HTMLImageElement instance.
								/* let image = new Image(); 
								image.src = entry.target.result;
								image.onload = function() {
					*/
									/* if (this.width != 1920 && this.height != 1000) {
										done("Dimensi gambar yang diizinkan: 1920 x 1000")
									}  */

										// table.ajax.reload(null, false);
										// load_table();
								//   };
								});

								reader.readAsDataURL(file);
								done();


							}

						});

	myDropzone.on("complete", function(file) {
		table.ajax.reload(null, false);
		// myDropzone.removeFile(file);
	});

// });

function save_data() {
	formData = new FormData($('#form-update')[0]);

	$.ajax({
		url : base_url+"admin/Content_trx/ajax_simpan_gallery",
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
				$("#modal_update").modal('toggle');
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
		url: base_url + "admin/Content_trx/get_gallery_by_id/" + id,
		dataType: "json",
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {
			$('#old_img').show();
			$('#id').val(data.id);
			$('#judul').val(data.title);
			$('#img_name').val(data.file_name); 
			$('#old_img').html('<div class="form-group row"> <label class="col-form-label col-md-2"></label> <div class="col-md-8">  <div class="input-group"> <a href="' + data.file_url + '"><img src="' + data.file_url + '" style="width:100px;"> </a> </div> </div> </div>'); 
			$('#album_name').val(data.id_album).change();
		},
		error: function () {
			toastr.warning('Terjadi error saat memuat data');
		}
	});
	$("#modal_update").modal("toggle");
}



function delete_data(id) {
	bootbox.confirm("Yakin akan menghapus data ?", function(event){
		if (event == true) {
			$.ajax({
				url : base_url+'admin/Content_trx/hapus_gallery/'+id,
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
	$('#form-update').trigger('reset');
	$("#id").val('');
	$("#img_name").val('');
	$('#old_img').hide();
	$('#album_name').val("0").change();
}


/* $('#tgl_lahir').datepicker({
	format: "dd-mm-yyyy"
}); */