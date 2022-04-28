Dropzone.autoDiscover = false;

var stat = $('#opt_filter_status option:selected').val();
var key = $('#table_properti_filter').val();

$(document).ready(function () {

    // document.body.style.zoom = "90%";

    // $('.card').css('zoom', '90%');

    //  table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
    // table.ajax.reload(null, false); 
    // load_table();

    // $('#telp option:first').attr('disabled', 'disabled');
    // $('#telp').select2();

    $('#jns_property option:first').attr('disabled', 'disabled');
    $('#jns_property').select2();

    $('#status_property option:first').attr('disabled', 'disabled');
    // $('#status_property').select2();

    $('.select2_facility option:first').attr('disabled', 'disabled');
    $('.select2_facility').select2();

    $('#features option:first').attr('disabled', 'disabled');

    $('#features').select2({
        placeholder: "Pilih Feature",
        allowClear: false,
        closeOnSelect: false
    }).on('select2:open', function () {

        let a = $(this).data('select2');
        // toastr.success($('#close_multiselect').length); 


        if (!$('.select2-link').length) {

            if ($('#close_multiselect').length <= 0) {
                a.$results.parents('.select2-results').append('<a href="javascript:;" class="btn btn-outline-danger btn-sm" '
                    + 'id="close_multiselect" style="text-transform: none;"><i class="icon-close2"></i> '
                    + ' Close Dropdown </a>');
            }

        }


        $('#close_multiselect').on("click", function () {
            $('#features').select2("close");
        });

    }).on('select2:select', function () {

        $('.select2-search__field').val("");
        $('.select2-search__field').focus();

    }).on('select2:unselect', function () {

        $('.select2-search__field').val("");
        $('.select2-search__field').focus();

    });

    $('#periode_sewa option:first').attr('disabled', 'disabled');
    // $('#periode_sewa').select2();

    $('#filter_properti option:first').attr('disabled', 'disabled');


});


/* $('#modal_properti').on('shown.bs.modal', function(e){
    $(this).modal('handleUpdate'); //Update backdrop on modal show
    $(this).scrollTop(0); //reset modal to top position
});
 */
// $('#modal_properti').data("bs.modal").handleUpdate();

$(document).on("click", ".openImageDialog", function () {
    let myImageId = $(this).data('id');
    let myImageName = $(this).data('name');

    $(".modal-body #myImage").attr("src", myImageId);
    $(".btn_download").attr("href", myImageId);
    $(".btn_download").attr("download", myImageName);
});






function show_form() {
    $('#modal_properti').modal('toggle');
    clear_form_properti();
    $('.img_form').show();
    $('#periode_sewa').hide();
    $('.form_harga_tanah').hide();
    $(".droparea").html('');
    $(".droparea").append(`<div class="dropzone" id="myDropzone" style="width:225px;margin-right:20px;">
            <div class="dz-message needsclick">
                <b> <u> Foto 1 </u> </b> <br> <b> Wajib Upload </b> untuk <b> COVER </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone1" id="Dropzone1">
        </div>
        <div class="dropzone" id="myDropzone2" style="width:225px;margin-right:20px;">
            <div class="dz-message needsclick">
                <b> <u> Foto 2 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone2" id="Dropzone2">
        </div>
        <div class="dropzone" id="myDropzone3" style="width:225px;margin-right:20px;">
            <div class="dz-message needsclick">
                <b> <u> Foto 3 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone3" id="Dropzone3">
        </div>
        <div class="dropzone" id="myDropzone4" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 4 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone4" id="Dropzone4">
        </div>
        <div class="dropzone" id="myDropzone5" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 5 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone5" id="Dropzone5">
        </div>`);
    set_up_dropzone1();
    set_up_dropzone2();
    set_up_dropzone3();
    set_up_dropzone4();
    set_up_dropzone5();
}


// function load_table() {

var table = $("#table_properti").DataTable({
    "processing": true,
    "responsive": true,
    "serverSide": true,
    "ajax": {
        "url": base_url + 'admin/Manage_properti/get_data_bangunan',
        "type": "POST",
        "data": function (data) {
            data.status = $('#opt_filter_status option:selected').val();
            data.search_keyword = $('#table_properti_filter').val();
        }
    },
    "columnDefs": [{
        "targets": [0, 1, 11, 12],
        "orderable": false,
    }/* ,
                                        {
                                            "targets": [8, 6],
                                            "orderable": false,
                                            "className": "text-center"
                                        } */
    ],
    "language": {
        "loadingRecords": "&nbsp;",
        "processing": "<i class='icon-spinner9 spinner'></i>"
    },
    "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
    ],
    "autoWidth": false,
    "buttons": {
        "dom": {
            "button": {
                className: 'btn btn-light'
            }
        },
        "buttons": [{
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

/* .columns.adjust()
.responsive.recalc() */
// }

// $('#table_properti').css('width', '100%');
// $('#table_properti').css( 'display', 'table' );

// table.responsive.recalc();

$('#filter_properti').submit(function (event) {
    event.preventDefault();
    table.ajax.reload(null, false);
});

function set_up_dropzone1() {
    $("#myDropzone").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 4, // MB
        maxFiles: 2,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function (file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.className = 'cropperedit';
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';

            // Create the confirm button
            var confirm = document.createElement('button');
            confirm.style.position = 'absolute';
            confirm.style.left = '10px';
            confirm.style.top = '10px';
            confirm.style.zIndex = 9999;
            confirm.textContent = 'Confirm';

            var cancel = document.createElement('button');
            cancel.style.position = 'absolute';
            cancel.style.right = '10px';
            cancel.style.top = '10px';
            cancel.style.zIndex = 9999;
            cancel.textContent = 'Cancel';

            cancel.addEventListener('click', function () {
                $('.cropperedit').remove();
                $('#myDropzone').removeClass('dz-started');
                $('#myDropzone .dz-preview').remove();
                $("#myDropzone").css({ "pointer-events": "all", "cursor": "pointer" });
                myDropZone.removeFile(file);
            });
            confirm.addEventListener('click', function () {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 730,
                    height: 560
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function (blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function (dataURL) {

                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);

                            // Return modified file to dropzone
                            done(blob);
                        }
                    );

                });

                // Remove the editor from view
                editor.parentNode.removeChild(editor);

            });
            editor.appendChild(confirm);
            editor.appendChild(cancel);
            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {
                aspectRatio: 730 / 560,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                minCropBoxWidth: true,
                minCropBoxHeight: true,
                minContainerHeight: true,
                minContainerWidth: true,
            });

        },
        error: function (file, response) {
            var ord = $("div#myDropzone").find('div.dz-preview').end().find('a.dz-remove').text();
            if (ord == "Remove file") {
                $(file.previewElement).remove();
                alert('File foto melebihi Max File Upload 4MB');
                $('#myDropzone').removeClass('dz-started');
            } else {
                $(file.previewElement).remove();
            }
        },
        success: function (file, response) {
            $("#Dropzone1").val(response);
            $("#Dropzone1").addClass(response);
            // $('#myDropzone').css({"pointer-events": "none", "cursor": "default"});
            $('#myDropzone .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

            //disable the click of your clickable area
            $("#myDropzone").css({ "pointer-events": "none", "cursor": "default" });
            $(".dz-hidden-input#dz-box-1").prop("disabled", true);
        },
        removedfile: function (file) {
            // alert('jos');
            let img_dropzone = $("#Dropzone1").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-1").prop("disabled", false);
            $("#myDropzone").css({ "pointer-events": "all", "cursor": "pointer" });
            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function (data) {
                    $("#Dropzone1").val('');
                    $("#Dropzone1").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                    }
                },
                error: function (error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });

        },
        maxfilesreached: function (file) {
            this.emit("error");
        }
    });
}

function set_up_dropzone2() {
    $("#myDropzone2").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 4, // MB
        maxFiles: 2,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function (file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.className = 'cropperedit2';
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';

            // Create the confirm button
            var confirm = document.createElement('button');
            confirm.style.position = 'absolute';
            confirm.style.left = '10px';
            confirm.style.top = '10px';
            confirm.style.zIndex = 9999;
            confirm.textContent = 'Confirm';

            var cancel = document.createElement('button');
            cancel.style.position = 'absolute';
            cancel.style.right = '10px';
            cancel.style.top = '10px';
            cancel.style.zIndex = 9999;
            cancel.textContent = 'Cancel';

            cancel.addEventListener('click', function () {
                $('.cropperedit2').remove();
                $('#myDropzone2').removeClass('dz-started');
                $('#myDropzone2 .dz-preview').remove();
                $("#myDropzone2").css({ "pointer-events": "all", "cursor": "pointer" });
                myDropZone.removeFile(file);
            });
            confirm.addEventListener('click', function () {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 730,
                    height: 560
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function (blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function (dataURL) {

                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);

                            // Return modified file to dropzone
                            done(blob);
                        }
                    );

                });

                // Remove the editor from view
                editor.parentNode.removeChild(editor);

            });
            editor.appendChild(confirm);
            editor.appendChild(cancel);

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {
                aspectRatio: 730 / 560,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                minCropBoxWidth: true,
                minCropBoxHeight: true,
                minContainerHeight: true,
                minContainerWidth: true,
            });

        },
        error: function (file, response) {
            var ord = $("div#myDropzone2").find('div.dz-preview').end().find('a.dz-remove').text();
            if (ord == "Remove file") {
                $(file.previewElement).remove();
                alert('File foto melebihi Max File Upload 4MB');
                $('#myDropzone2').removeClass('dz-started');
            } else {
                $(file.previewElement).remove();
            }
        },
        success: function (file, response) {
            $("#Dropzone2").val(response);
            $("#Dropzone2").addClass(response);
            // $('#myDropzone2').css({"pointer-events": "none", "cursor": "default"});
            $('#myDropzone2 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

            //disable the click of your clickable area
            $("#myDropzone2").css({ "pointer-events": "none", "cursor": "default" });
            $(".dz-hidden-input#dz-box-2").prop("disabled", true);
        },
        removedFile: function (file) {
            let img_dropzone = $("#Dropzone2").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-2").prop("disabled", false);
            $("#myDropzone2").css({ "pointer-events": "all", "cursor": "pointer" });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function (data) {
                    $("#Dropzone2").val('');
                    $("#Dropzone2").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                    }
                },
                error: function (error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function (file) {
            this.emit("removefile");
        }
    });
}

function set_up_dropzone3() {
    $("#myDropzone3").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 4, // MB
        maxFiles: 2,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function (file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.className = 'cropperedit3';
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';

            // Create the confirm button
            var confirm = document.createElement('button');
            confirm.style.position = 'absolute';
            confirm.style.left = '10px';
            confirm.style.top = '10px';
            confirm.style.zIndex = 9999;
            confirm.textContent = 'Confirm';

            var cancel = document.createElement('button');
            cancel.style.position = 'absolute';
            cancel.style.right = '10px';
            cancel.style.top = '10px';
            cancel.style.zIndex = 9999;
            cancel.textContent = 'Cancel';

            cancel.addEventListener('click', function () {
                $('.cropperedit3').remove();
                $('#myDropzone3').removeClass('dz-started');
                $('#myDropzone3 .dz-preview').remove();
                $("#myDropzone3").css({ "pointer-events": "all", "cursor": "pointer" });
                myDropZone.removeFile(file);
            });

            confirm.addEventListener('click', function () {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 730,
                    height: 560
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function (blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function (dataURL) {

                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);

                            // Return modified file to dropzone
                            done(blob);
                        }
                    );

                });

                // Remove the editor from view
                editor.parentNode.removeChild(editor);

            });
            editor.appendChild(confirm);
            editor.appendChild(cancel);
            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {
                aspectRatio: 730 / 560,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                minCropBoxWidth: true,
                minCropBoxHeight: true,
                minContainerHeight: true,
                minContainerWidth: true,
            });

        },
        error: function (file, response) {
            var ord = $("div#myDropzone3").find('div.dz-preview').end().find('a.dz-remove').text();
            if (ord == "Remove file") {
                $(file.previewElement).remove();
                alert('File foto melebihi Max File Upload 4MB');
                $('#myDropzone3').removeClass('dz-started');
            } else {
                $(file.previewElement).remove();
            }
        },
        success: function (file, response) {
            $("#Dropzone3").val(response);
            $("#Dropzone3").addClass(response);
            $('#myDropzone3 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

            //disable the click of your clickable area
            $("#myDropzone3").css({ "pointer-events": "none", "cursor": "default" });
            $(".dz-hidden-input#dz-box-3").prop("disabled", true);
        },
        removedfile: function (file) {
            let img_dropzone = $("#Dropzone3").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-3").prop("disabled", false);
            $("#myDropzone3").css({ "pointer-events": "all", "cursor": "pointer" });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function (data) {
                    $("#Dropzone3").val('');
                    $("#Dropzone3").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                    }
                },
                error: function (error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function (file) {
            this.emit("removefile");
        }
    });
}

function set_up_dropzone4() {
    $("#myDropzone4").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 4, // MB
        maxFiles: 2,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function (file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.className = 'cropperedit4';
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';

            // Create the confirm button
            var confirm = document.createElement('button');
            confirm.style.position = 'absolute';
            confirm.style.left = '10px';
            confirm.style.top = '10px';
            confirm.style.zIndex = 9999;
            confirm.textContent = 'Confirm';

            var cancel = document.createElement('button');
            cancel.style.position = 'absolute';
            cancel.style.right = '10px';
            cancel.style.top = '10px';
            cancel.style.zIndex = 9999;
            cancel.textContent = 'Cancel';

            cancel.addEventListener('click', function () {
                $('.cropperedit4').remove();
                $('#myDropzone4').removeClass('dz-started');
                $('#myDropzone4 .dz-preview').remove();
                $("#myDropzone4").css({ "pointer-events": "all", "cursor": "pointer" });
                myDropZone.removeFile(file);
            });

            confirm.addEventListener('click', function () {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 730,
                    height: 560
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function (blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function (dataURL) {

                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);

                            // Return modified file to dropzone
                            done(blob);
                        }
                    );

                });

                // Remove the editor from view
                editor.parentNode.removeChild(editor);

            });
            editor.appendChild(confirm);
            editor.appendChild(cancel);

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {
                aspectRatio: 730 / 560,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                minCropBoxWidth: true,
                minCropBoxHeight: true,
                minContainerHeight: true,
                minContainerWidth: true,
            });

        },
        error: function (file, response) {
            var ord = $("div#myDropzone4").find('div.dz-preview').end().find('a.dz-remove').text();
            if (ord == "Remove file") {
                $(file.previewElement).remove();
                alert('File foto melebihi Max File Upload 4MB');
                $('#myDropzone4').removeClass('dz-started');
            } else {
                $(file.previewElement).remove();
            }
        },
        success: function (file, response) {
            $("#Dropzone4").val(response);
            $("#Dropzone4").addClass(response);
            $('#myDropzone4 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

            //disable the click of your clickable area
            $("#myDropzone4").css({ "pointer-events": "none", "cursor": "default" });
            $(".dz-hidden-input#dz-box-4").prop("disabled", true);
        },
        removedfile: function (file) {
            let img_dropzone = $("#Dropzone4").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-4").prop("disabled", false);
            $("#myDropzone4").css({ "pointer-events": "all", "cursor": "pointer" });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function (data) {
                    $("#Dropzone4").val('');
                    $("#Dropzone4").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                    }
                },
                error: function (error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function (file) {
            this.emit("removefile");
        }
    });
}

function set_up_dropzone5() {
    $("#myDropzone5").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 4, // MB
        maxFiles: 2,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function (file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.className = 'cropperedit5';
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';

            // Create the confirm button
            var confirm = document.createElement('button');
            confirm.style.position = 'absolute';
            confirm.style.left = '10px';
            confirm.style.top = '10px';
            confirm.style.zIndex = 9999;
            confirm.textContent = 'Confirm';

            var cancel = document.createElement('button');
            cancel.style.position = 'absolute';
            cancel.style.right = '10px';
            cancel.style.top = '10px';
            cancel.style.zIndex = 9999;
            cancel.textContent = 'Cancel';

            cancel.addEventListener('click', function () {
                $('.cropperedit5').remove();
                $('#myDropzone5').removeClass('dz-started');
                $('#myDropzone5 .dz-preview').remove();
                $("#myDropzone5").css({ "pointer-events": "all", "cursor": "pointer" });
                myDropZone.removeFile(file);
            });

            confirm.addEventListener('click', function () {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 730,
                    height: 560
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function (blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function (dataURL) {

                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);

                            // Return modified file to dropzone
                            done(blob);
                        }
                    );

                });

                // Remove the editor from view
                editor.parentNode.removeChild(editor);

            });
            editor.appendChild(confirm);
            editor.appendChild(cancel);

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {
                aspectRatio: 730 / 560,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                minCropBoxWidth: true,
                minCropBoxHeight: true,
                minContainerHeight: true,
                minContainerWidth: true,
            });

        },
        error: function (file, response) {
            var ord = $("div#myDropzone5").find('div.dz-preview').end().find('a.dz-remove').text();
            if (ord == "Remove file") {
                $(file.previewElement).remove();
                alert('File foto melebihi Max File Upload 4MB');
                $('#myDropzone5').removeClass('dz-started');
            } else {
                $(file.previewElement).remove();
            }
        },
        success: function (file, response) {
            $("#Dropzone5").val(response);
            $("#Dropzone5").addClass(response);
            $('#myDropzone5 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

            //disable the click of your clickable area
            $("#myDropzone5").css({ "pointer-events": "none", "cursor": "default" });
            $(".dz-hidden-input#dz-box-5").prop("disabled", true);
        },
        removedfile: function (file) {
            let img_dropzone = $("#Dropzone5").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-5").prop("disabled", false);
            $("#myDropzone5").css({ "pointer-events": "all", "cursor": "pointer" });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function (data) {
                    $("#Dropzone5").val('');
                    $("#Dropzone5").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                    }
                },
                error: function (error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function (file) {
            this.emit("removefile");
        }
    });
}

var optiondropzone1 = {
    url: base_url + "admin/Manage_properti/upload_image",
    paramName: "filefoto", // The name that will be used to transfer the file
    maxFilesize: 4, // MB
    maxFiles: 2,
    method: "post",
    acceptedFiles: "image/*",
    dictInvalidFileType: "Format file ini tidak diizinkan",
    dictMaxFilesExceeded: "Jumlah file melebihi batas",
    addRemoveLinks: true,

    transformFile: function (file, done) {
        var myDropZone = this;

        // Create the image editor overlay
        var editor = document.createElement('div');
        editor.className = 'cropperedit';
        editor.style.position = 'fixed';
        editor.style.left = 0;
        editor.style.right = 0;
        editor.style.top = 0;
        editor.style.bottom = 0;
        editor.style.zIndex = 9999;
        editor.style.backgroundColor = '#000';

        // Create the confirm button
        var confirm = document.createElement('button');
        confirm.style.position = 'absolute';
        confirm.style.left = '10px';
        confirm.style.top = '10px';
        confirm.style.zIndex = 9999;
        confirm.textContent = 'Confirm';

        var cancel = document.createElement('button');
        cancel.style.position = 'absolute';
        cancel.style.right = '10px';
        cancel.style.top = '10px';
        cancel.style.zIndex = 9999;
        cancel.textContent = 'Cancel';

        cancel.addEventListener('click', function () {
            $('.cropperedit').remove();
            $('#myDropzone').removeClass('dz-started');
            $('#myDropzone .dz-preview').remove();
            $("#myDropzone").css({ "pointer-events": "all", "cursor": "pointer" });
            myDropZone.removeFile(file);
        });
        confirm.addEventListener('click', function () {

            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
                width: 730,
                height: 560
            });
            // Set a specific MIME type


            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function (blob) {

                // Update the image thumbnail with the new image data
                myDropZone.createThumbnail(
                    file,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    true,
                    function (dataURL) {

                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);

                        // Return modified file to dropzone
                        done(blob);
                    }
                );

            });

            // Remove the editor from view
            editor.parentNode.removeChild(editor);

        });
        editor.appendChild(confirm);
        editor.appendChild(cancel);
        // Load the image
        var image = new Image();
        image.src = URL.createObjectURL(file);
        editor.appendChild(image);

        // Append the editor to the page
        document.body.appendChild(editor);
        // Create Cropper.js and pass image
        var cropper = new Cropper(image, {
            aspectRatio: 730 / 560,
            dragMode: 'move',
            cropBoxMovable: false,
            cropBoxResizable: false,
            minCropBoxWidth: true,
            minCropBoxHeight: true,
            minContainerHeight: true,
            minContainerWidth: true,
        });

    },
    error: function (file, response) {
        var ord = $("div#myDropzone").find('div.dz-preview').end().find('a.dz-remove').text();
        if (ord == "Remove file") {
            $(file.previewElement).remove();
            alert('File foto melebihi Max File Upload 4MB');
            $('#myDropzone').removeClass('dz-started');
        } else {
            $(file.previewElement).remove();
        }
    },
    success: function (file, response) {
        $("#Dropzone1").val(response);
        $("#Dropzone1").addClass(response);
        // $('#myDropzone').css({"pointer-events": "none", "cursor": "default"});
        $('#myDropzone .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

        //disable the click of your clickable area
        $("#myDropzone").css({ "pointer-events": "none", "cursor": "default" });
        $(".dz-hidden-input#dz-box-1").prop("disabled", true);
    },
    removedfile: function (file) {
        // alert('jos');
        let img_dropzone = $("#Dropzone1").val();

        // enable the click of your clickable area
        $(".dz-hidden-input#dz-box-1").prop("disabled", false);
        $("#myDropzone").css({ "pointer-events": "all", "cursor": "pointer" });
        $.ajax({
            url: base_url + "admin/Manage_properti/ajax_delete_img",
            type: "POST",
            data: {
                img_name: img_dropzone
            },
            success: function (data) {
                $("#Dropzone1").val('');
                $("#Dropzone1").removeClass();

                if (data == 1) {
                    file.previewElement.remove();
                    toastr.success('Foto berhasil dihapus');
                } else {
                    file.previewElement.remove();
                }
            },
            error: function (error) {
                toastr.warning('Terjadi error saat menghapus file');
            }
        });

    },
    maxfilesreached: function (file) {
        this.emit("error");
    }
};

var optiondropzone2 = {
    url: base_url + "admin/Manage_properti/upload_image",
    paramName: "filefoto", // The name that will be used to transfer the file
    maxFilesize: 4, // MB
    maxFiles: 2,
    method: "post",
    acceptedFiles: "image/*",
    dictInvalidFileType: "Format file ini tidak diizinkan",
    dictMaxFilesExceeded: "Jumlah file melebihi batas",
    addRemoveLinks: true,

    transformFile: function (file, done) {
        var myDropZone = this;

        // Create the image editor overlay
        var editor = document.createElement('div');
        editor.className = 'cropperedit2';
        editor.style.position = 'fixed';
        editor.style.left = 0;
        editor.style.right = 0;
        editor.style.top = 0;
        editor.style.bottom = 0;
        editor.style.zIndex = 9999;
        editor.style.backgroundColor = '#000';

        // Create the confirm button
        var confirm = document.createElement('button');
        confirm.style.position = 'absolute';
        confirm.style.left = '10px';
        confirm.style.top = '10px';
        confirm.style.zIndex = 9999;
        confirm.textContent = 'Confirm';

        var cancel = document.createElement('button');
        cancel.style.position = 'absolute';
        cancel.style.right = '10px';
        cancel.style.top = '10px';
        cancel.style.zIndex = 9999;
        cancel.textContent = 'Cancel';

        cancel.addEventListener('click', function () {
            $('.cropperedit2').remove();
            $('#myDropzone2').removeClass('dz-started');
            $('#myDropzone2 .dz-preview').remove();
            $("#myDropzone2").css({ "pointer-events": "all", "cursor": "pointer" });
            myDropZone.removeFile(file);
        });
        confirm.addEventListener('click', function () {

            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
                width: 730,
                height: 560
            });
            // Set a specific MIME type


            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function (blob) {

                // Update the image thumbnail with the new image data
                myDropZone.createThumbnail(
                    file,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    true,
                    function (dataURL) {

                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);

                        // Return modified file to dropzone
                        done(blob);
                    }
                );

            });

            // Remove the editor from view
            editor.parentNode.removeChild(editor);

        });
        editor.appendChild(confirm);
        editor.appendChild(cancel);

        // Load the image
        var image = new Image();
        image.src = URL.createObjectURL(file);
        editor.appendChild(image);


        // Append the editor to the page
        document.body.appendChild(editor);
        // Create Cropper.js and pass image
        var cropper = new Cropper(image, {
            aspectRatio: 730 / 560,
            dragMode: 'move',
            cropBoxMovable: false,
            cropBoxResizable: false,
            minCropBoxWidth: true,
            minCropBoxHeight: true,
            minContainerHeight: true,
            minContainerWidth: true,
        });

    },
    error: function (file, response) {
        var ord = $("div#myDropzone2").find('div.dz-preview').end().find('a.dz-remove').text();
        if (ord == "Remove file") {
            $(file.previewElement).remove();
            alert('File foto melebihi Max File Upload 4MB');
            $('#myDropzone2').removeClass('dz-started');
        } else {
            $(file.previewElement).remove();
        }
    },
    success: function (file, response) {
        $("#Dropzone2").val(response);
        $("#Dropzone2").addClass(response);
        // $('#myDropzone2').css({"pointer-events": "none", "cursor": "default"});
        $('#myDropzone2 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

        //disable the click of your clickable area
        $("#myDropzone2").css({ "pointer-events": "none", "cursor": "default" });
        $(".dz-hidden-input#dz-box-2").prop("disabled", true);
    },
    removedFile: function (file) {
        let img_dropzone = $("#Dropzone2").val();

        // enable the click of your clickable area
        $(".dz-hidden-input#dz-box-2").prop("disabled", false);
        $("#myDropzone2").css({ "pointer-events": "all", "cursor": "pointer" });

        $.ajax({
            url: base_url + "admin/Manage_properti/ajax_delete_img",
            type: "POST",
            data: {
                img_name: img_dropzone
            },
            success: function (data) {
                $("#Dropzone2").val('');
                $("#Dropzone2").removeClass();

                if (data == 1) {
                    file.previewElement.remove();
                    toastr.success('Foto berhasil dihapus');
                } else {
                    file.previewElement.remove();
                }
            },
            error: function (error) {
                toastr.warning('Terjadi error saat menghapus file');
            }
        });


    },
    maxfilesreached: function (file) {
        this.emit("error");
    }
};

var optiondropzone3 = {
    url: base_url + "admin/Manage_properti/upload_image",
    paramName: "filefoto", // The name that will be used to transfer the file
    maxFilesize: 4, // MB
    maxFiles: 2,
    method: "post",
    acceptedFiles: "image/*",
    dictInvalidFileType: "Format file ini tidak diizinkan",
    dictMaxFilesExceeded: "Jumlah file melebihi batas",
    addRemoveLinks: true,

    transformFile: function (file, done) {
        var myDropZone = this;

        // Create the image editor overlay
        var editor = document.createElement('div');
        editor.className = 'cropperedit3';
        editor.style.position = 'fixed';
        editor.style.left = 0;
        editor.style.right = 0;
        editor.style.top = 0;
        editor.style.bottom = 0;
        editor.style.zIndex = 9999;
        editor.style.backgroundColor = '#000';

        // Create the confirm button
        var confirm = document.createElement('button');
        confirm.style.position = 'absolute';
        confirm.style.left = '10px';
        confirm.style.top = '10px';
        confirm.style.zIndex = 9999;
        confirm.textContent = 'Confirm';

        var cancel = document.createElement('button');
        cancel.style.position = 'absolute';
        cancel.style.right = '10px';
        cancel.style.top = '10px';
        cancel.style.zIndex = 9999;
        cancel.textContent = 'Cancel';

        cancel.addEventListener('click', function () {
            $('.cropperedit3').remove();
            $('#myDropzone3').removeClass('dz-started');
            $('#myDropzone3 .dz-preview').remove();
            $("#myDropzone3").css({ "pointer-events": "all", "cursor": "pointer" });
            myDropZone.removeFile(file);
        });

        confirm.addEventListener('click', function () {

            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
                width: 730,
                height: 560
            });
            // Set a specific MIME type


            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function (blob) {

                // Update the image thumbnail with the new image data
                myDropZone.createThumbnail(
                    file,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    true,
                    function (dataURL) {

                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);

                        // Return modified file to dropzone
                        done(blob);
                    }
                );

            });

            // Remove the editor from view
            editor.parentNode.removeChild(editor);

        });
        editor.appendChild(confirm);
        editor.appendChild(cancel);
        // Load the image
        var image = new Image();
        image.src = URL.createObjectURL(file);
        editor.appendChild(image);

        // Append the editor to the page
        document.body.appendChild(editor);
        // Create Cropper.js and pass image
        var cropper = new Cropper(image, {
            aspectRatio: 730 / 560,
            dragMode: 'move',
            cropBoxMovable: false,
            cropBoxResizable: false,
            minCropBoxWidth: true,
            minCropBoxHeight: true,
            minContainerHeight: true,
            minContainerWidth: true,
        });

    },
    error: function (file, response) {
        var ord = $("div#myDropzone3").find('div.dz-preview').end().find('a.dz-remove').text();
        if (ord == "Remove file") {
            $(file.previewElement).remove();
            alert('File foto melebihi Max File Upload 4MB');
            $('#myDropzone3').removeClass('dz-started');
        } else {
            $(file.previewElement).remove();
        }
    },
    success: function (file, response) {
        $("#Dropzone3").val(response);
        $("#Dropzone3").addClass(response);
        $('#myDropzone3 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

        //disable the click of your clickable area
        $("#myDropzone3").css({ "pointer-events": "none", "cursor": "default" });
        $(".dz-hidden-input#dz-box-3").prop("disabled", true);
    },
    removedfile: function (file) {
        let img_dropzone = $("#Dropzone3").val();

        // enable the click of your clickable area
        $(".dz-hidden-input#dz-box-3").prop("disabled", false);
        $("#myDropzone3").css({ "pointer-events": "all", "cursor": "pointer" });

        $.ajax({
            url: base_url + "admin/Manage_properti/ajax_delete_img",
            type: "POST",
            data: {
                img_name: img_dropzone
            },
            success: function (data) {
                $("#Dropzone3").val('');
                $("#Dropzone3").removeClass();

                if (data == 1) {
                    file.previewElement.remove();
                    toastr.success('Foto berhasil dihapus');
                } else {
                    file.previewElement.remove();
                }
            },
            error: function (error) {
                toastr.warning('Terjadi error saat menghapus file');
            }
        });


    },
    maxfilesreached: function (file) {
        this.emit("error");
    }
}

var optiondropzone4 = {
    url: base_url + "admin/Manage_properti/upload_image",
    paramName: "filefoto", // The name that will be used to transfer the file
    maxFilesize: 4, // MB
    maxFiles: 2,
    method: "post",
    acceptedFiles: "image/*",
    dictInvalidFileType: "Format file ini tidak diizinkan",
    dictMaxFilesExceeded: "Jumlah file melebihi batas",
    addRemoveLinks: true,

    transformFile: function (file, done) {
        var myDropZone = this;

        // Create the image editor overlay
        var editor = document.createElement('div');
        editor.className = 'cropperedit4';
        editor.style.position = 'fixed';
        editor.style.left = 0;
        editor.style.right = 0;
        editor.style.top = 0;
        editor.style.bottom = 0;
        editor.style.zIndex = 9999;
        editor.style.backgroundColor = '#000';

        // Create the confirm button
        var confirm = document.createElement('button');
        confirm.style.position = 'absolute';
        confirm.style.left = '10px';
        confirm.style.top = '10px';
        confirm.style.zIndex = 9999;
        confirm.textContent = 'Confirm';

        var cancel = document.createElement('button');
        cancel.style.position = 'absolute';
        cancel.style.right = '10px';
        cancel.style.top = '10px';
        cancel.style.zIndex = 9999;
        cancel.textContent = 'Cancel';

        cancel.addEventListener('click', function () {
            $('.cropperedit4').remove();
            $('#myDropzone4').removeClass('dz-started');
            $('#myDropzone4 .dz-preview').remove();
            $("#myDropzone4").css({ "pointer-events": "all", "cursor": "pointer" });
            myDropZone.removeFile(file);
        });

        confirm.addEventListener('click', function () {

            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
                width: 730,
                height: 560
            });
            // Set a specific MIME type


            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function (blob) {

                // Update the image thumbnail with the new image data
                myDropZone.createThumbnail(
                    file,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    true,
                    function (dataURL) {

                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);

                        // Return modified file to dropzone
                        done(blob);
                    }
                );

            });

            // Remove the editor from view
            editor.parentNode.removeChild(editor);

        });
        editor.appendChild(confirm);
        editor.appendChild(cancel);

        // Load the image
        var image = new Image();
        image.src = URL.createObjectURL(file);
        editor.appendChild(image);

        // Append the editor to the page
        document.body.appendChild(editor);
        // Create Cropper.js and pass image
        var cropper = new Cropper(image, {
            aspectRatio: 730 / 560,
            dragMode: 'move',
            cropBoxMovable: false,
            cropBoxResizable: false,
            minCropBoxWidth: true,
            minCropBoxHeight: true,
            minContainerHeight: true,
            minContainerWidth: true,
        });

    },
    error: function (file, response) {
        var ord = $("div#myDropzone4").find('div.dz-preview').end().find('a.dz-remove').text();
        if (ord == "Remove file") {
            $(file.previewElement).remove();
            alert('File foto melebihi Max File Upload 4MB');
            $('#myDropzone4').removeClass('dz-started');
        } else {
            $(file.previewElement).remove();
        }
    },
    success: function (file, response) {
        $("#Dropzone4").val(response);
        $("#Dropzone4").addClass(response);
        $('#myDropzone4 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

        //disable the click of your clickable area
        $("#myDropzone4").css({ "pointer-events": "none", "cursor": "default" });
        $(".dz-hidden-input#dz-box-4").prop("disabled", true);
    },
    removedfile: function (file) {
        let img_dropzone = $("#Dropzone4").val();

        // enable the click of your clickable area
        $(".dz-hidden-input#dz-box-4").prop("disabled", false);
        $("#myDropzone4").css({ "pointer-events": "all", "cursor": "pointer" });

        $.ajax({
            url: base_url + "admin/Manage_properti/ajax_delete_img",
            type: "POST",
            data: {
                img_name: img_dropzone
            },
            success: function (data) {
                $("#Dropzone4").val('');
                $("#Dropzone4").removeClass();

                if (data == 1) {
                    file.previewElement.remove();
                    toastr.success('Foto berhasil dihapus');
                } else {
                    file.previewElement.remove();
                }
            },
            error: function (error) {
                toastr.warning('Terjadi error saat menghapus file');
            }
        });


    },
    maxfilesreached: function (file) {
        this.emit("error");
    }
}

var optiondropzone5 = {
    url: base_url + "admin/Manage_properti/upload_image",
    paramName: "filefoto", // The name that will be used to transfer the file
    maxFilesize: 4, // MB
    maxFiles: 2,
    method: "post",
    acceptedFiles: "image/*",
    dictInvalidFileType: "Format file ini tidak diizinkan",
    dictMaxFilesExceeded: "Jumlah file melebihi batas",
    addRemoveLinks: true,

    transformFile: function (file, done) {
        var myDropZone = this;

        // Create the image editor overlay
        var editor = document.createElement('div');
        editor.className = 'cropperedit5';
        editor.style.position = 'fixed';
        editor.style.left = 0;
        editor.style.right = 0;
        editor.style.top = 0;
        editor.style.bottom = 0;
        editor.style.zIndex = 9999;
        editor.style.backgroundColor = '#000';

        // Create the confirm button
        var confirm = document.createElement('button');
        confirm.style.position = 'absolute';
        confirm.style.left = '10px';
        confirm.style.top = '10px';
        confirm.style.zIndex = 9999;
        confirm.textContent = 'Confirm';

        var cancel = document.createElement('button');
        cancel.style.position = 'absolute';
        cancel.style.right = '10px';
        cancel.style.top = '10px';
        cancel.style.zIndex = 9999;
        cancel.textContent = 'Cancel';

        cancel.addEventListener('click', function () {
            $('.cropperedit5').remove();
            $('#myDropzone5').removeClass('dz-started');
            $('#myDropzone5 .dz-preview').remove();
            $("#myDropzone5").css({ "pointer-events": "all", "cursor": "pointer" });
            myDropZone.removeFile(file);
        });

        confirm.addEventListener('click', function () {

            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
                width: 730,
                height: 560
            });
            // Set a specific MIME type


            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function (blob) {

                // Update the image thumbnail with the new image data
                myDropZone.createThumbnail(
                    file,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    true,
                    function (dataURL) {

                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);

                        // Return modified file to dropzone
                        done(blob);
                    }
                );

            });

            // Remove the editor from view
            editor.parentNode.removeChild(editor);

        });
        editor.appendChild(confirm);
        editor.appendChild(cancel);

        // Load the image
        var image = new Image();
        image.src = URL.createObjectURL(file);
        editor.appendChild(image);

        // Append the editor to the page
        document.body.appendChild(editor);
        // Create Cropper.js and pass image
        var cropper = new Cropper(image, {
            aspectRatio: 730 / 560,
            dragMode: 'move',
            cropBoxMovable: false,
            cropBoxResizable: false,
            minCropBoxWidth: true,
            minCropBoxHeight: true,
            minContainerHeight: true,
            minContainerWidth: true,
        });

    },
    error: function (file, response) {
        var ord = $("div#myDropzone5").find('div.dz-preview').end().find('a.dz-remove').text();
        if (ord == "Remove file") {
            $(file.previewElement).remove();
            alert('File foto melebihi Max File Upload 4MB');
            $('#myDropzone5').removeClass('dz-started');
        } else {
            $(file.previewElement).remove();
        }
    },
    success: function (file, response) {
        $("#Dropzone5").val(response);
        $("#Dropzone5").addClass(response);
        $('#myDropzone5 .dz-remove').css({ "pointer-events": "all", "cursor": "pointer" });

        //disable the click of your clickable area
        $("#myDropzone5").css({ "pointer-events": "none", "cursor": "default" });
        $(".dz-hidden-input#dz-box-5").prop("disabled", true);
    },
    removedfile: function (file) {
        let img_dropzone = $("#Dropzone5").val();

        // enable the click of your clickable area
        $(".dz-hidden-input#dz-box-5").prop("disabled", false);
        $("#myDropzone5").css({ "pointer-events": "all", "cursor": "pointer" });

        $.ajax({
            url: base_url + "admin/Manage_properti/ajax_delete_img",
            type: "POST",
            data: {
                img_name: img_dropzone
            },
            success: function (data) {
                $("#Dropzone5").val('');
                $("#Dropzone5").removeClass();

                if (data == 1) {
                    file.previewElement.remove();
                    toastr.success('Foto berhasil dihapus');
                } else {
                    file.previewElement.remove();
                }
            },
            error: function (error) {
                toastr.warning('Terjadi error saat menghapus file');
            }
        });


    },
    maxfilesreached: function (file) {
        this.emit("error");
    }
}


function save_data() {
    formData = new FormData($('#form-properti')[0]);

    $.ajax({
        url: base_url + "admin/Manage_properti/ajax_save_properti",
        type: "POST",
        data: formData,
        dataType: "JSON",
        contentType: false,
        processData: false,
        beforeSend: function () {
            blockUI();
            $("#btn_simpan").attr("disabled", true).html('Menyimpan ...');
        },
        complete: function () {
            unBlockUI();
            $("#btn_simpan").attr("disabled", false).html('Simpan');
        },
        success: function (data) {
            if (data.status == true) {
                toastr.success(data.message);
                clear_form_properti();
                $("#modal_properti").modal('toggle');
                // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();

                $('#opt_filter_status').val(stat);
                $('#table_properti_filter').val(key);

                table.ajax.reload(null, false);
                // load_table();

                // $("#Dropzone1").val('');
                // $("#Dropzone1").removeClass();
                // $("#Dropzone2").val('');
                // $("#Dropzone2").removeClass();
                // $("#Dropzone3").val('');
                // $("#Dropzone3").removeClass();
                // $("#Dropzone4").val('');
                // $("#Dropzone4").removeClass();
                // $("#Dropzone5").val('');
                // $("#Dropzone5").removeClass();
                // $('#myDropzone').removeClass('dz-started');
                // $('#myDropzone .dz-preview').remove();
                // $("#myDropzone").css({ "pointer-events": "all", "cursor": "pointer" });
                // $('#myDropzone2').removeClass('dz-started');
                // $('#myDropzone2 .dz-preview').remove();
                // $("#myDropzone2").css({ "pointer-events": "all", "cursor": "pointer" });
                // $('#myDropzone3').removeClass('dz-started');
                // $('#myDropzone3 .dz-preview').remove();
                // $("#myDropzone3").css({ "pointer-events": "all", "cursor": "pointer" });
                // $('#myDropzone4').removeClass('dz-started');
                // $('#myDropzone4 .dz-preview').remove();
                // $("#myDropzone4").css({ "pointer-events": "all", "cursor": "pointer" });
                // $('#myDropzone5').removeClass('dz-started');
                // $('#myDropzone5 .dz-preview').remove();
                // $("#myDropzone5").css({ "pointer-events": "all", "cursor": "pointer" });
                // $(".dz-preview").fadeOut('slow');
                // $(".dz-preview:hidden").remove();

                // // enable the click of your clickable area
                // $(".dz-hidden-input#dz-box-1").prop("disabled", false);
                // $("#myDropzone").css({ "pointer-events": "all", "cursor": "pointer" });

                // $(".dz-hidden-input#dz-box-2").prop("disabled", false);
                // $("#myDropzone2").css({ "pointer-events": "all", "cursor": "pointer" });

                // $(".dz-hidden-input#dz-box-3").prop("disabled", false);
                // $("#myDropzone3").css({ "pointer-events": "all", "cursor": "pointer" });

                // $(".dz-hidden-input#dz-box-4").prop("disabled", false);
                // $("#myDropzone4").css({ "pointer-events": "all", "cursor": "pointer" });

                // $(".dz-hidden-input#dz-box-5").prop("disabled", false);
                // $("#myDropzone5").css({ "pointer-events": "all", "cursor": "pointer" });

                /* let imgDropzone_1 = Dropzone.forElement("#myDropzone");
                let imgDropzone_2 = Dropzone.forElement("#myDropzone2");
                let imgDropzone_3 = Dropzone.forElement("#myDropzone3");
                let imgDropzone_4 = Dropzone.forElement("#myDropzone4");
                let imgDropzone_5 = Dropzone.forElement("#myDropzone5");

                imgDropzone_1.removeAllFiles(true); 
                imgDropzone_2.removeAllFiles(true); 
                imgDropzone_3.removeAllFiles(true); 
                imgDropzone_4.removeAllFiles(true); 
                imgDropzone_5.removeAllFiles(true);  */

            } else {

                if (data.message_img != "") {
                    toastr.info(data.message_img);
                }

                if (data.message != "") {
                    toastr.error(data.message)
                }

            }
        },
        error: function (error) {
            toastr.warning('Terjadi error saat menyimpan data');
        }
    });
}


$("#telp").change(function () {
    let kontak = $('#telp option:selected').text();
    let split_contact = kontak.split(" | ");
    let no_hp = split_contact[0];
    let pic = split_contact[1];

    $('#no_hp').val(no_hp);
    $('#pic').val(pic);

    /* toastr.success(pic);
    toastr.success(no_hp); */
});
$('.start_date_rent').hide();
$('.due_date_rent').hide();
$("#status_property").change(function () {

    let selected_status = $(this).val();
    // let selected_jns = $('#jns_property option:selected').val();

    if (selected_status == '1') { // Buy

        // $('label.harga_jual_txt').html('Harga Jual');
        // $('#harga_jual').attr("placeholder", "Input Harga Jual");
        $('.form_harga_jual').show();
        $('.form_harga_sewa').hide();
        $('#periode_sewa').hide();
        $('.start_date_rent').hide();
        $('.due_date_rent').hide();

    } else if (selected_status == '2') { // Rent

        // $('label.harga_jual_txt').html('Harga Sewa');
        // $('#harga_jual').attr("placeholder", "Input Harga Sewa");
        $('.form_harga_sewa').show();
        $('.form_harga_jual').hide();
        $('#periode_sewa').show();
        $('.start_date_rent').hide();
        $('.due_date_rent').hide();

    } else if (selected_status == '3') { // Sold

        // $('label.harga_jual_txt').html('Harga Jual');
        // $('#harga_jual').attr("placeholder", "Input Harga Jual");
        $('.form_harga_jual').show();
        $('.form_harga_sewa').hide();
        $('#periode_sewa').hide();
        $('.start_date_rent').hide();
        $('.due_date_rent').hide();

    } else if (selected_status == '4') { // Rented
        // $('label.harga_jual_txt').html('Harga Sewa');
        // $('#harga_jual').attr("placeholder", "Input Harga Sewa");
        $('.form_harga_sewa').show();
        $('.form_harga_jual').hide();
        $('#periode_sewa').show();
        $('.start_date_rent').show();
        $('.due_date_rent').show();
    } else if (selected_status == '5') {
        $('.form_harga_sewa').show();
        $('.form_harga_jual').show();
        $('#periode_sewa').show();
        $('.start_date_rent').hide();
        $('.due_date_rent').hide();
    }




});

$("#jns_property").change(function () {

    let selected_jns = $(this).val();
    let selected_status = $('#status_property option:selected').val();

    if (selected_jns != '3') { // besides Lands / Tanah

        $(".form_harga_jual").show();
        $('.form_tipe_jual_tanah').hide();
        // $('input:radio[name"options_type"]').removeAttr("checked");
        // $('input:radio[name="options_type"]').attr("checked", false);
        // $(".form_harga_tanah").hide();

    } else {
        $(".form_harga_jual").show();
        $('.form_tipe_jual_tanah').show();
    }

    if (selected_status == '2') {
        $('#periode_sewa').show();
    } else {
        $('#periode_sewa').hide();
        // $('periode_sewa option:first').prop('selected',true);
    }


});


$('input:radio[name="options_type"]').change(function () {
    if (this.checked) {


        let selected_status = $("#status_property option:selected").val();

        if (selected_status == '1') { // Buy

            $('label.harga_jual_txt').html('Harga Jual');
            $('#harga_jual').attr("placeholder", "Input Harga Jual");

            $(".form_harga_jual").show();
            $('#periode_sewa').hide();

        } else if (selected_status == '2') { // Rent

            $('label.harga_jual_txt').html('Harga Sewa');
            $('#harga_jual').attr("placeholder", "Input Harga Sewa");

            $(".form_harga_jual").show();
            $('#periode_sewa').show();
        }




    }
});

function update_data(id) {
    // $('.img_form').hide();


    $.ajax({
        url: base_url + "admin/Manage_properti/get_properti_id/" + id,
        dataType: "json",
        beforeSend: function () {
            blockUI();
        },
        complete: function () {
            unBlockUI();
        },
        success: function (data) {

            $('.form-control').val('');
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#alamat').val(data.alamat);
            $('#nama_jalan').val(data.nama_jalan);
            $('#nmr_jalan').val(data.nmr_jalan);
            $('#rt').val(data.rt);
            $('#rw').val(data.rw);
            $('#luas_bangunan').val(data.luas_bangunan);
            $('#luas_tanah').val(data.luas_tanah);
            $('#jml_lantai').val(data.jml_lantai);
            $('#legal').val(data.legalitas);
            $('#start_date_rent').val(data.start_date_rent);
            $('#due_date_rent').val(data.due_date_rent);
            $('.flok').prop('checked', false);
            $("input[name=flag][value=" + data.flag + "]").attr('checked', 'checked');

            $.ajax({
                url: base_url + "admin/Manage_properti/get_fasilitas_by_property/" + id,
                type: "GET",
                success: function (dt_fasilitas) {
                    $('#fasilitas_properti').html(dt_fasilitas);
                    $(".select2_facility").select2();

                }
            });

            $.getJSON(base_url + "admin/Manage_properti/get_features_by_property/" + id,
                function (dt_features) {
                    $('#features').val(dt_features).change();
                }
            );

            let start_date_fmt;
            let due_date_fmt;

            // let start_date_fmt2;
            // let due_date_fmt2;

            if (data.start_date !== null) {
                start_date_fmt = format_date(data.start_date);
            } else {
                start_date_fmt = data.start_date;
            }

            // if (data.start_date_rent !== null) {
            // 	start_date_fmt2 = format_date(data.start_date_rent);
            // } else {
            // 	start_date_fmt2 = data.start_date_rent;
            // }

            if (data.due_date !== null) {
                due_date_fmt = format_date(data.due_date);
            } else {
                due_date_fmt = data.due_date;
            }

            // if (data.due_date_rent !== null) {
            // 	due_date_fmt2 = format_date(data.due_date_rent);
            // } else {
            // 	due_date_fmt2 = data.due_date_rent;
            // }

            $('#start_date').val(start_date_fmt);
            $('#due_date').val(due_date_fmt);

            // $('#start_date_rent').val(start_date_fmt2);
            // $('#due_date_rent').val(due_date_fmt2);

            /* let option = new Option(data.id_agent);
            option.selected = true;

            $("#telp").append(option);
            $("#telp").trigger("change"); */

            /* let select = $('#telp');
            let option = $('<option></option>').attr('selected', true).
                text(data.phone + ' | ' + data.first_name + ' ' + data.last_name).val(data.id_agent); */

            /* insert the option (which is already 'selected'!) into the select */
            // option.appendTo(select);

            /* Let select2 do whatever it likes with this */
            // select.trigger('change');

            /* $("#telp").select2("trigger", "select", {
                data: { id: data.id_agent }
            }); */

            /* $('#periode_sewa').append($('<option>', {
                value: 0,
                text: 'Periode Sewa'
            })); */

            // $('#telp').trigger('change');
            $('#telp').val(data.id_agent).change();
            $('#jns_property').val(data.id_category).change();
            $('#status_property').val(data.id_status_property).change();
            $('#periode_sewa').val(data.id_periode_sewa).change();
            $('#harga_user').val(data.harga_user);
            $('#harga_jual').val(data.harga_jual);
            $('#harga_sewa').val(data.harga_sewa);

            if (data.id_tipe_jual_tanah !== null) {

                if (data.id_tipe_jual_tanah == 1) {
                    document.getElementById('rd_tanah_area').setAttribute('checked', '');
                    $('#rd_tanah_area').trigger('click');
                } else if (data.id_tipe_jual_tanah == 2) {
                    document.getElementById('rd_tanah_per_meter').setAttribute('checked', '');
                    $('#rd_tanah_per_meter').trigger('click');
                }

            } else {
                /* document.getElementById('rd_tanah_area').removeAttribute('checked');
                document.getElementById('rd_tanah_per_meter').removeAttribute('checked'); */
            }

            $('#deskripsi_area_lahan').val(data.desc_area_lahan);
            $('#deskripsi_area_bangunan').val(data.desc_area_bangunan);
            $('#deskripsi_legalitas').val(data.desc_legalitas);
            $('#deskripsi_fasilitas').val(data.desc_fasilitas);
            $('#koordinat').val(data.lat + ',' + data.lang);
            $('#url_video').val(data.video_url);
            $('#full_furnish').val(data.full_furnish);
            /* $('#').val(data.);
            $('#').val(data.);
            $('#').val(data.);*/
            $(".droparea").html('');
            $(".droparea").append(`<div class="dropzone" id="myDropzone" style="width:225px;margin-right:20px;">
            <div class="dz-message needsclick">
                <b> <u> Foto 1 </u> </b> <br> <b> Wajib Upload </b> untuk <b> COVER </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone1" id="Dropzone1">
        </div>
        <div class="dropzone" id="myDropzone2" style="width:225px;margin-right:20px;">
            <div class="dz-message needsclick">
                <b> <u> Foto 2 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone2" id="Dropzone2">
        </div>
        <div class="dropzone" id="myDropzone3" style="width:225px;margin-right:20px;">
            <div class="dz-message needsclick">
                <b> <u> Foto 3 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone3" id="Dropzone3">
        </div>
        <div class="dropzone" id="myDropzone4" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 4 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone4" id="Dropzone4">
        </div>
        <div class="dropzone" id="myDropzone5" style="width:225px;margin-right:20px; margin-top: 2%;">
            <div class="dz-message needsclick">
                <b> <u> Foto 5 </u> </b> <br> Ukuran File max. <b> 4.5 MB </b>
            </div>
            <input type="hidden" name="Dropzone5" id="Dropzone5">
        </div>`);


            //1-5 dropzone

            /* var dropzone1 = new Dropzone("#myDropzone", optiondropzone1);
            var mockFile = { name: data.nama_foto, size: 1024000 };
            dropzone1.options.addedfile.call(dropzone1, mockFile);
            dropzone1.options.thumbnail.call(dropzone1, mockFile, data.foto);
            $("#Dropzone1").val(data.nama_foto); */


            $.getJSON(base_url + "admin/Manage_properti/ajax_img_1/" + id,
                function (dt_image) {
                    let dropzone1 = new Dropzone("#myDropzone", optiondropzone1);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone1.options.addedfile.call(dropzone1, mockFile);
                        dropzone1.options.thumbnail.call(dropzone1, mockFile, dt_image.img_url);
                        $("#Dropzone1").val(dt_image.img_name);
                        // console.log(dt_image);
                    }
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_2/" + id,
                function (dt_image) {

                    let dropzone2 = new Dropzone("#myDropzone2", optiondropzone2);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone2.options.addedfile.call(dropzone2, mockFile);
                        dropzone2.options.thumbnail.call(dropzone2, mockFile, dt_image.img_url);
                        $("#Dropzone2").val(dt_image.img_name);
                        // console.log(dt_image);
                    }
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_3/" + id,
                function (dt_image) {
                    let dropzone3 = new Dropzone("#myDropzone3", optiondropzone3);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone3.options.addedfile.call(dropzone3, mockFile);
                        dropzone3.options.thumbnail.call(dropzone3, mockFile, dt_image.img_url);
                        $("#Dropzone3").val(dt_image.img_name);
                        // console.log(dt_image);
                    }
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_4/" + id,
                function (dt_image) {
                    let dropzone4 = new Dropzone("#myDropzone4", optiondropzone4);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone4.options.addedfile.call(dropzone4, mockFile);
                        dropzone4.options.thumbnail.call(dropzone4, mockFile, dt_image.img_url);
                        $("#Dropzone4").val(dt_image.img_name);
                        // console.log(dt_image);
                    }
                }
            );

            $.getJSON(base_url + "admin/Manage_properti/ajax_img_5/" + id,
                function (dt_image) {
                    let dropzone5 = new Dropzone("#myDropzone5", optiondropzone5);
                    if (dt_image !== null) {
                        let mockFile = { name: dt_image.img_name, size: 1024000 };
                        dropzone5.options.addedfile.call(dropzone5, mockFile);
                        dropzone5.options.thumbnail.call(dropzone5, mockFile, dt_image.img_url);
                        $("#Dropzone5").val(dt_image.img_name);
                        // console.log(dt_image);
                    }
                }
            );

            // Convert ajax data (latitude,longitude) from String to Float, so it could be read by Google Maps API. 
            let lat_number = parseFloat(data.lat);
            let lng_number = parseFloat(data.lang);
            var location = { lat: lat_number, lng: lng_number };

            var mapCanvas = document.getElementById('pro-maps_content');

            var myCenter = new google.maps.LatLng(lat_number, lng_number);
            var mapOptions = {
                center: myCenter,
                zoom: 13,
                mapTypeId: 'hybrid'
            };

            var map = new google.maps.Map(mapCanvas, mapOptions);

            // Create a marker from existing coordinate of ajax data.
            marker = new google.maps.Marker({
                position: location,
                map: map
            });

            google.maps.event.addListener(map, 'click', function (event) {
                var value = placeMarker(map, event.latLng);
            });

            // Create the search box and link it to the UI element.
            var pacinput = '<input type="text" name="pac-input" class="pac-input" id="pac-input" placeholder="Pencarian peta" value="" style="z-index: 9998 !important;">';
            $('#pro-maps_content').append(pacinput);
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();
                // console.log(places);

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                /* markers.forEach(function (marker) {
                    marker.setMap(null);
                }); */

                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();

                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    /* var icon = {
                      url: place.icon,
                      size: new google.maps.Size(71, 71),
                      origin: new google.maps.Point(0, 0),
                      anchor: new google.maps.Point(17, 34),
                      scaledSize: new google.maps.Size(25, 25)
                    }; */

                    // Create a marker for each place.
                    marker = new google.maps.Marker({
                        map: map,
                        // icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    });

                    /* if (marker && marker.setMap()) {
                        marker.setMap(null);
                    } */

                    placeMarker(map, place.geometry.location);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });

                map.fitBounds(bounds);
            });

            google.maps.event.addDomListener(window, "load", myMap);


            // var fakeAjaxCall = function(success, error) {
            // var location = {lat: lat_number, lng: lng_number};
            // window.setTimeout(success.bind(null, response), 1000);
            // }

            // var myCenter = new google.maps.LatLng(-7.021491, 110.4271556);
            //Our map object is already initialized, no marker is there yet.
            /* var map = new google.maps.Map(document.getElementById('pro-maps_content'), {
                center: myCenter,
                zoom: 13
            }); */

            //Here we make the ajax call. We expect a lat-lng response like the one from fake ajax call
            // fakeAjaxCall(function success(responseMarker){
            /* var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Hello World!'
            }); */
            // })

            // placeMarker(data.lat + ',' + data.lang);

            // $('#cabang').val(data.cabang).trigger('change');
        },
        error: function () {
            toastr.warning('Terjadi error saat memuat data');
        }
    });

    $("#modal_properti").modal("toggle");
}



function delete_data(id) {
    bootbox.confirm("Yakin akan menghapus data ?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/hapus_properti/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}





function placeMarker(map, location) {

    if (marker && marker.setMap()) {
        marker.setMap(null);
    }

    marker = new google.maps.Marker({
        position: location,
        map: map
    });

    var lat = location.lat().toString();
    var lng = location.lng().toString();

    $('#koordinat').val(+lat + ',' + lng);
}





/* $('#telp').on("select2:selecting", function(e) { 
    toastr.success()
}); */


function confirm_approve() {
    var id = $("#id_properti").val();
    bootbox.confirm("Apakah Anda yakin akan menyetujui properti ini ?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/approval_setuju/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}


function approve_data(id) {
    // $("#modal_approve").modal("toggle");
    // $("#id_properti").val(id);

    bootbox.confirm("Apakah Anda yakin akan menyetujui properti ini ?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/approval_setuju/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}



function reject_data(id) {
    $('#modal_reject').modal('toggle');
    $('#note_alasan').val('');

    $('#form-reject').submit(function (event) {
        event.preventDefault();
        formData = new FormData($(this)[0]);

        bootbox.confirm({
            size: "medium",
            message: "Apakah Anda yakin akan menolak properti ini ?",
            callback: function (result) {
                if (result) {

                    $.ajax({
                        url: base_url + 'admin/Manage_properti/approval_tolak/' + id,
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
                            if (data.status == 1) {
                                // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                                table.ajax.reload(null, false);
                                // load_table();
                                $('#modal_reject').modal('toggle');
                                // $('.bootbox.modal').modal('hide')
                                toastr.success(data.message);
                            } else {
                                toastr.warning(data.message);
                            }
                        },
                        error: function () {
                            toastr.warning('Terjadi error saat menyimpan data');
                        }
                    });
                }
            }
        });

    });
}



function set_recommended(id) {
    bootbox.confirm("Status properti ini akan menjadi <b> Star Property </b>. Apakah Anda yakin?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/set_recommended/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}


function set_premium(id) {
    bootbox.confirm("Properti ini akan dilihat oleh <b> Premium Investor </b>. Apakah Anda yakin?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/set_premium/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}


function unset_recommended(id) {
    bootbox.confirm("Status <b> Star Property </b> dari properti ini akan dihilangkan. Apakah Anda yakin?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/unset_recommended/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}


function unset_premium(id) {
    bootbox.confirm("Properti ini akan disembunyikan dari <b> Premium Investor </b>. Apakah Anda yakin?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/unset_premium/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, false);
                        // load_table();
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}



function set_property_sold(id) {
    bootbox.confirm("Status Transaksi properti ini akan menjadi <b> Sold </b>. Apakah Anda yakin?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/update_sold/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        table.ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}

function set_property_rented(id) {
    bootbox.confirm("Status Transaksi properti ini akan menjadi <b> Rented </b>. Apakah Anda yakin?", function (event) {
        if (event == true) {
            $.ajax({
                url: base_url + 'admin/Manage_properti/update_rented/' + id,
                dataType: "json",
                beforeSend: function () {
                    blockUI();
                },
                complete: function () {
                    unBlockUI();
                },
                success: function (data) {
                    if (data.status == 1) {
                        table.ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function () {
                    toastr.warning('Terjadi error saat menghapus data');
                }
            });
        }
    });
}

$('#start_date_rent').datepicker({
    format: "dd-mm-yyyy"
});

$('#due_date_rent').datepicker({
    format: "dd-mm-yyyy"
});

$('#start_date').datepicker({
    format: "dd-mm-yyyy"
});

$('#due_date').datepicker({
    format: "dd-mm-yyyy"
});

function format_date(dateStr) {
    arr = dateStr.split("-");  // ex input "2010-01-18"
    return arr[2] + "-" + arr[1] + "-" + arr[0]; //ex out: "18-01-2010"
}

/* bootbox.confirm({
    size: "medium",
    message: "Apakah Anda yakin akan menolak properti ini ?",
    callback: function(result) {
        if (result) {
            $.ajax({
                url : base_url+'admin/Manage_properti/approval_tolak/'+id,
                dataType : "json",
                beforeSend : function(){
                    blockUI();
                },
                complete : function(){
                    unBlockUI();
                },
                success : function(data){
                    if(data.status == 1) {
                         // table.ajax.url(base_url + 'admin/Manage_properti/get_data_bangunan').load();
                        table.ajax.reload(null, true);
                        // // load_table();
                        $('#modal_reject').modal('toggle');
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
    }



}); */

// });





/*
function clear_form_properti() {
    $('#form-properti').trigger('reset');
    $("#id").val('');
    $('#features').val("").change();
    $('#jns_property').val("0").change();
    $('#status_property').val("0").change();
    $('#telp').val("0").change();

    $.ajax({
        url: base_url + "admin/Manage_properti/new_fasilitas_property",
        type: "GET",
        success: function (data) {
            $('#fasilitas_properti').html(data);
            $(".select2_facility option:first").attr('disabled', 'disabled');
            $(".select2_facility").select2();
        }
    });

    $('#Dropzone1').val('');
    $('#Dropzone2').val('');
    $('#Dropzone3').val('');
    $('#Dropzone4').val('');
    $('#Dropzone5').val('');
    $('#koordinat').val('');

    if (typeof marker !== 'undefined') {
        marker.setMap(null);
    }
} */



