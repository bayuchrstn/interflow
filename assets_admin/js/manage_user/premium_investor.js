$(document).ready(function() {
	load_table();
});




function load_table() {

	$("#table1").DataTable({
		"destroy": true,
		"processing": true,
		"responsive": true,
		"serverSide": true,
		"ajax": {
			"url": base_url + 'admin/Manage_user/get_data_premium_investor',
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
				"targets": [6],
				"orderable": false,
				"className": "text-center"
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

}

	
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
		url : base_url+"admin/Manage_user/ajax_simpan_premium_investor",
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
			$('#first_name').val(data.first_name);
			$('#last_name').val(data.last_name);
			$('#tempat_lahir').val(data.tempat_lahir);
			$('#tgl_lahir').val(date_fmt);
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

function format_date(dateStr) {
	arr = dateStr.split("-");  // ex input "2010-01-18"
	return arr[2]+ "-" +arr[1]+ "-" +arr[0]; //ex out: "18-01-2010"
}

function clear_form() {
	$('#form-data').trigger('reset');
	$("#id").val('');
}


$('#tgl_lahir').datepicker({
	format: "dd-mm-yyyy"
});