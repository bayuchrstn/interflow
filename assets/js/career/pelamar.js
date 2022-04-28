$(document).ready(function() {
	// table.ajax.reload(null, false);
	// load_table();
});





// function load_table() {


	var table =		$("#table1").DataTable({
		processing: true,
		responsive: true,
		ajax : {
			url: base_url + 'admin/Career/dt_pelamar',
			type: "GET"
		},
		columnDefs: [
			{
				targets: [10],
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


function delete_data(id) {
	bootbox.confirm("Yakin akan menghapus data ?", function(event){
		if (event == true) {
			$.ajax({
				url : base_url+'admin/Career/hapus_pelamar/'+id,
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