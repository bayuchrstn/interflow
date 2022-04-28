$(document).ready(function() {
	// table.ajax.reload(null, false);
	// load_table();
});





// function load_table() {


	var table =		$("#table1").DataTable({
		processing: true,
		responsive: true,
		ajax : {
			url: base_url + 'admin/Career/dt_lowongan_kerja',
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

// }



function show_form() {
	$('#modal_form').modal('toggle');
	clear_form();
}



function save_data() {
	formData = new FormData($('#form-data')[0]);

	$.ajax({
		url : base_url+"admin/Career/ajax_simpan_lowongan",
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
	$.ajax({
		url: base_url + "admin/Career/get_lowongan_by_id/" + id,
		dataType: "json",
		beforeSend: function () {
			blockUI();
		},
		complete: function () {
			unBlockUI();
		},
		success: function (data) {

			$('#id').val(data.id);
            $('#posisi_kerja').val(data.posisi_pekerjaan);
			$('#keterangan').val(data.keterangan);
			$(".summernote").summernote("code", data.persyaratan);
			// $('#persyaratan').val(data.persyaratan);
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
				url : base_url+'admin/Career/hapus_lowongan/'+id,
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
