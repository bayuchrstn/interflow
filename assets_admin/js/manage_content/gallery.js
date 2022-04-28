Dropzone.autoDiscover = false;
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
            url: base_url + 'admin/Manage_content/dt_gallery',
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
}


$('#modal_form').on('shown.bs.modal', function (e) {
	// Initialize Dropzone

	/* var myDropzone =  */
	new Dropzone("#gallery-upload",{
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
	
					load_table();
			//   };
			});
		
			reader.readAsDataURL(file);
			done();
			
			
		  }
		  
	});

	/* myDropzone.on("complete", function(file) {
		myDropzone.removeFile(file);
	}); */

});

function save_data() {
	formData = new FormData($('#form-data')[0]);

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
				$("#modal_form").modal('toggle');
				load_table();
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
			/* let date_fmt;
			if (data.tgl_lahir !== null) {
				date_fmt = format_date(data.tgl_lahir);
			} else {
				date_fmt = data.tgl_lahir;
			} */

			$('#id').val(data.id);
			$('#first_name').val(data.first_name);
			$('#last_name').val(data.last_name);
			$('#tempat_lahir').val(data.tempat_lahir);
			// $('#tgl_lahir').val(date_fmt);
			$('#alamat').val(data.alamat);
			$('#telp').val(data.phone);
			$('#username').val(data.username);
			$('#email').val(data.email);
			$('#deskripsi').val(data.deskripsi);
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
}


/* $('#tgl_lahir').datepicker({
	format: "dd-mm-yyyy"
}); */