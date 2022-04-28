$('#form-data').submit(function (event) { 
    event.preventDefault();
    formData = new FormData($(this)[0]);

    $.ajax({
		url: base_url+"admin/Setting/ajax_change_password",
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
                // clear_form();
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


function clear_form() {
	$('#form-data').trigger('reset');
}


function toggle_oldpass() {
	let x = document.getElementById('old_password');
	if (x.type === "password") {
	  x.type = "text";
	} else {
	  x.type = "password";
	}
}

function toggle_newpass() {
	let x = document.getElementById('new_password');
	if (x.type === "password") {
	  x.type = "text";
	} else {
	  x.type = "password";
	}
}

function toggle_confirmpass() {
	let x = document.getElementById('confirm_password');
	if (x.type === "password") {
	  x.type = "text";
	} else {
	  x.type = "password";
	}
}
  