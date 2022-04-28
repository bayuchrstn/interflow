<script type="text/javascript">
    Dropzone.autoDiscover = false;


    $(document).ready(function() {
        load_table();

        /* $('#telp').select2({
            placeholder : "Pilih Agen",
            // ajax call data
            ajax : {
                url : base_url+'admin/Manage_properti/select2_kontak_agen',
                dataType : 'json',
                type : 'post',
                delay : 250,
                data : function(params) {
                    return {
                        q : params.term
                    }
                },
                processResults : function(data) {
                    var results = [];
                    if (data) {
                        $.each(data, function(index, item){
                            results.push({
                                id : item.id,
                                text : item.text
                            });
                        });
                    }

                    return {
                        results : results
                    }
                }
            }
        }); */



        // $('#telp').on('select2:selecting', function(e) {
        // console.log('Selecting: ' , e.params.args.data);
        // toastr.success($('#telp').val());
        // });


        $('#telp option:first').attr('disabled', 'disabled');
        $('#telp').select2();

        $('#jns_property option:first').attr('disabled', 'disabled');
        $('#jns_property').select2();

        $('#status_property option:first').attr('disabled', 'disabled');
        $('#status_property').select2();


        /* $("#telp").live('change', function(){
            alert(this.value)
        }); */

    });


    $(document).on("click", ".openImageDialog", function() {
        let myImageId = $(this).data('id');
        let myImageName = $(this).data('name');

        $(".modal-body #myImage").attr("src", myImageId);
        $(".btn_download").attr("href", myImageId);
        $(".btn_download").attr("download", myImageName);
    });


    function show_form() {
        $('#modal_properti').modal('toggle');
        clear_form_properti();

        $('.dz-hidden-input').each(function(index, element) {
            $('.dz-hidden-input:eq(0)').attr("id", "dz-box-1");
            $('.dz-hidden-input:eq(1)').attr("id", "dz-box-2");
            $('.dz-hidden-input:eq(2)').attr("id", "dz-box-3");
            $('.dz-hidden-input:eq(3)').attr("id", "dz-box-4");
            $('.dz-hidden-input:eq(4)').attr("id", "dz-box-5");
            // toastr.info("Element = " + element +", Index = " + index);
        });
    }


    function load_table() {
        $("#table_properti").DataTable({
            "destroy": true,
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ajax": {
                "url": base_url + 'admin/Manage_properti/get_data_bangunan',
                "type": "POST"
            },
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                },
                {
                    "targets": [8, 6],
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


    // Initialize Dropzone

    // $('.dropzone').html5imageupload();




    $("#myDropzone").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 0.25, // MB
        maxFiles: 1,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function(file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
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

            confirm.addEventListener('click', function() {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function(dataURL) {

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

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {

            });

        },
        success: function(file, response) {
            $("#Dropzone1").val(response);
            $("#Dropzone1").addClass(response);
            // $('#myDropzone').css({"pointer-events": "none", "cursor": "default"});
            $('#myDropzone .dz-remove').css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            //disable the click of your clickable area
            $("#myDropzone").css({
                "pointer-events": "none",
                "cursor": "default"
            });
            $(".dz-hidden-input#dz-box-1").prop("disabled", true);
        },
        removedfile: function(file) {
            // alert('jos');
            let img_dropzone = $("#Dropzone1").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-1").prop("disabled", false);
            $("#myDropzone").css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function(data) {
                    $("#Dropzone1").val('');
                    $("#Dropzone1").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                        toastr.error('Foto gagal dihapus');
                    }
                },
                error: function(error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function(file) {
            removeFile(file);
        }
    });



    $("#myDropzone2").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 0.25, // MB
        maxFiles: 1,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function(file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
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

            confirm.addEventListener('click', function() {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function(dataURL) {

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

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {

            });

        },
        success: function(file, response) {
            $("#Dropzone2").val(response);
            $("#Dropzone2").addClass(response);
            // $('#myDropzone2').css({"pointer-events": "none", "cursor": "default"});
            $('#myDropzone2 .dz-remove').css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            //disable the click of your clickable area
            $("#myDropzone2").css({
                "pointer-events": "none",
                "cursor": "default"
            });
            $(".dz-hidden-input#dz-box-2").prop("disabled", true);
        },
        removedfile: function(file) {
            let img_dropzone = $("#Dropzone2").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-2").prop("disabled", false);
            $("#myDropzone2").css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function(data) {
                    $("#Dropzone2").val('');
                    $("#Dropzone2").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                        toastr.error('Foto gagal dihapus');
                    }
                },
                error: function(error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function(file) {
            removeFile(file);
        }
    });



    $("#myDropzone3").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 0.25, // MB
        maxFiles: 1,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function(file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
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

            confirm.addEventListener('click', function() {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function(dataURL) {

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

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {

            });

        },
        success: function(file, response) {
            $("#Dropzone3").val(response);
            $("#Dropzone3").addClass(response);
            $('#myDropzone3 .dz-remove').css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            //disable the click of your clickable area
            $("#myDropzone3").css({
                "pointer-events": "none",
                "cursor": "default"
            });
            $(".dz-hidden-input#dz-box-3").prop("disabled", true);
        },
        removedfile: function(file) {
            let img_dropzone = $("#Dropzone3").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-3").prop("disabled", false);
            $("#myDropzone3").css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function(data) {
                    $("#Dropzone3").val('');
                    $("#Dropzone3").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                        toastr.error('Foto gagal dihapus');
                    }
                },
                error: function(error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function(file) {
            removeFile(file);
        }
    });



    $("#myDropzone4").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 0.25, // MB
        maxFiles: 1,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function(file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
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

            confirm.addEventListener('click', function() {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function(dataURL) {

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

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {

            });

        },
        success: function(file, response) {
            $("#Dropzone4").val(response);
            $("#Dropzone4").addClass(response);
            $('#myDropzone4 .dz-remove').css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            //disable the click of your clickable area
            $("#myDropzone4").css({
                "pointer-events": "none",
                "cursor": "default"
            });
            $(".dz-hidden-input#dz-box-4").prop("disabled", true);
        },
        removedfile: function(file) {
            let img_dropzone = $("#Dropzone4").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-4").prop("disabled", false);
            $("#myDropzone4").css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function(data) {
                    $("#Dropzone4").val('');
                    $("#Dropzone4").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                        toastr.error('Foto gagal dihapus');
                    }
                },
                error: function(error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function(file) {
            removeFile(file);
        }
    });



    $("#myDropzone5").dropzone({
        url: base_url + "admin/Manage_properti/upload_image",
        paramName: "filefoto", // The name that will be used to transfer the file
        maxFilesize: 0.25, // MB
        maxFiles: 1,
        method: "post",
        acceptedFiles: "image/*",
        dictInvalidFileType: "Format file ini tidak diizinkan",
        dictMaxFilesExceeded: "Jumlah file melebihi batas",
        addRemoveLinks: true,

        transformFile: function(file, done) {
            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
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

            confirm.addEventListener('click', function() {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });
                // Set a specific MIME type


                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        file,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        true,
                        function(dataURL) {

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

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);
            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {

            });

        },
        success: function(file, response) {
            $("#Dropzone5").val(response);
            $("#Dropzone5").addClass(response);
            $('#myDropzone5 .dz-remove').css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            //disable the click of your clickable area
            $("#myDropzone5").css({
                "pointer-events": "none",
                "cursor": "default"
            });
            $(".dz-hidden-input#dz-box-5").prop("disabled", true);
        },
        removedfile: function(file) {
            let img_dropzone = $("#Dropzone5").val();

            // enable the click of your clickable area
            $(".dz-hidden-input#dz-box-5").prop("disabled", false);
            $("#myDropzone5").css({
                "pointer-events": "all",
                "cursor": "pointer"
            });

            $.ajax({
                url: base_url + "admin/Manage_properti/ajax_delete_img",
                type: "POST",
                data: {
                    img_name: img_dropzone
                },
                success: function(data) {
                    $("#Dropzone5").val('');
                    $("#Dropzone5").removeClass();

                    if (data == 1) {
                        file.previewElement.remove();
                        toastr.success('Foto berhasil dihapus');
                    } else {
                        file.previewElement.remove();
                        toastr.error('Foto gagal dihapus');
                    }
                },
                error: function(error) {
                    toastr.warning('Terjadi error saat menghapus file');
                }
            });


        },
        maxfilesreached: function(file) {
            removeFile(file);
        }
    });




    /* $('#modal_properti').on('shown.bs.modal', function(e) { }); */




    /* function input_data() {
        $("#modal_properti").attr('transaksi', 'tambah');
        $('#modal_properti').modal('show');
    }

    $('#pro-maps_done').click(function() {
        $('form').removeClass('disabled-form');
    });

    $('#upload_img').click(function() {
        var img = $('#kirim_img').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'get_image',
            data: {
                img: img
            },
            beforeSend: function() {
                blockUI();
            },
            success: function(response) {
                if (response == '1') {
                    alert('ya');
                } else if (response == '0') {
                    toastr.error('Gambar gagal diupload');
                } else {
                    toastr.warning(response);
                }
                unBlockUI();
            }
        });
    });

    $("#formulir_modal").validate({
        rules: {
            service_id_val: {
                required: true
            },
            nama: {
                required: true
            },
            customer_id: {
                required: true
            },
            customer_group_name: {
                required: true
            },
            date_invoice: {
                required: true
            },
            date_due: {
                required: true
            },
            periode_invoice: {
                required: true
            },
        },
        submitHandler: function(form) {
            var cekTransaksi = $("#formulir_modal").attr('transaksi');
            if (cekTransaksi == 'tambah') {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'insert_data',
                    data: $('#formulir_modal').serialize(),
                    beforeSend: function() {
                        blockUI();
                    },
                    success: function(response) {
                        if (response == '1') {
                            $('#formulir_modal').clearForm();
                            $("#tabelDetailInvoice tbody tr.remove").remove();
                            alert('Data berhasil disimpan');
                            table.ajax.reload(null, false);
                        } else if (response == '0') {
                            alert('Data gagal disimpan');
                        } else {
                            alert(response);
                        }
                        unBlockUI();
                    }
                });
            } else if (cekTransaksi == 'edit') {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'edit_data',
                    data: $('#formulir_modal').serialize(),
                    beforeSend: function() {
                        blockUI();
                    },
                    success: function(response) {
                        if (response == '1') {
                            var id = $('#id').val();
                            $('#formulir_modal').clearForm();
                            $("#tabelDetailInvoice tbody tr.remove").remove();
                        } else if (response == '0') {
                            toastr.warning('Data gagal disimpan');
                        } else {
                            toastr.error(response);
                        }
                        unBlockUI();
                    }
                });
            }
            return false;
        }
    }); */




    function save_data() {
        formData = new FormData($('#form-properti')[0]);

        $.ajax({
            url: base_url + "admin/Manage_properti/ajax_save_properti",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            beforeSend: function() {
                blockUI();
                $("#btn_simpan").attr("disabled", true).html('Menyimpan ...');
            },
            complete: function() {
                unBlockUI();
                $("#btn_simpan").attr("disabled", false).html('Simpan');
            },
            success: function(data) {
                if (data.status == true) {
                    toastr.success(data.message);
                    clear_form_properti();
                    $("#modal_properti").modal('toggle');
                    load_table();
                } else {

                    if (data.message_img != "") {
                        toastr.info(data.message_img);
                    }

                    if (data.message != "") {
                        toastr.error(data.message)
                    }

                }
            },
            error: function(error) {
                toastr.warning('Terjadi error saat menyimpan data');
            }
        });
    }


    $("#telp").change(function() {
        let kontak = $('#telp option:selected').text();
        let split_contact = kontak.split(" | ");
        let no_hp = split_contact[0];
        let pic = split_contact[1];

        $('#no_hp').val(no_hp);
        $('#pic').val(pic);

        /* toastr.success(pic);
        toastr.success(no_hp); */
    });


    function update_data(id) {
        $.ajax({
            url: base_url + "admin/Manage_properti/get_properti_id/" + id,
            dataType: "json",
            beforeSend: function() {
                blockUI();
            },
            complete: function() {
                unBlockUI();
            },
            success: function(data) {
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#luas_bangunan').val(data.luas_bangunan);
                $('#luas_tanah').val(data.luas_tanah);
                $('#jml_lantai').val(data.jml_lantai);
                $('#legal').val(data.legalitas);

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



                // $('#telp').trigger('change');
                $('#telp').val(data.id_agent).change();
                $('#jns_property').val(data.id_category).change();
                $('#status_property').val(data.id_status_property).change();
                $('#harga_user').val(data.harga_user);
                $('#harga_jual').val(data.harga_jual);
                $('#deskripsi_area_lahan').val(data.desc_area_lahan);
                $('#deskripsi_area_bangunan').val(data.desc_area_bangunan);
                $('#deskripsi_legalitas').val(data.desc_legalitas);
                $('#deskripsi_fasilitas').val(data.desc_fasilitas);
                $('#koordinat').val(data.lat + ',' + data.lang);
                $('#url_video').val(data.video_url);
                /* $('#').val(data.);
                $('#').val(data.);
                $('#').val(data.);*/


                // Convert ajax data (latitude,longitude) from String to Float, so it could be read by Google Maps API. 
                let lat_number = parseFloat(data.lat);
                let lng_number = parseFloat(data.lang);
                var location = {
                    lat: lat_number,
                    lng: lng_number
                };

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

                google.maps.event.addListener(map, 'click', function(event) {
                    var value = placeMarker(map, event.latLng);
                });

                // Create the search box and link it to the UI element.
                var pacinput = '<input type="text" name="pac-input" class="pac-input" id="pac-input" placeholder="Pencarian peta" value="">';
                $('#pro-maps_content').append(pacinput);
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
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

                    places.forEach(function(place) {
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
            error: function() {
                toastr.warning('Terjadi error saat memuat data');
            }
        });

        $("#modal_properti").modal("toggle");

        $('.dz-hidden-input').each(function(index, element) {
            $('.dz-hidden-input:eq(0)').attr("id", "dz-box-1");
            $('.dz-hidden-input:eq(1)').attr("id", "dz-box-2");
            $('.dz-hidden-input:eq(2)').attr("id", "dz-box-3");
            $('.dz-hidden-input:eq(3)').attr("id", "dz-box-4");
            $('.dz-hidden-input:eq(4)').attr("id", "dz-box-5");
            // toastr.info("Element = " + element +", Index = " + index);
        });

    }



    function delete_data(id) {
        bootbox.confirm("Yakin akan menghapus data ?", function(event) {
            if (event == true) {
                $.ajax({
                    url: base_url + 'admin/Manage_properti/hapus_properti/' + id,
                    dataType: "json",
                    beforeSend: function() {
                        blockUI();
                    },
                    complete: function() {
                        unBlockUI();
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            load_table();
                            toastr.success(data.message);
                        } else {
                            toastr.warning(data.message);
                        }
                    },
                    error: function() {
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





    function approve_data(id) {
        bootbox.confirm("Apakah Anda yakin akan menyetujui properti ini ?", function(event) {
            if (event == true) {
                $.ajax({
                    url: base_url + 'admin/Manage_properti/approval_setuju/' + id,
                    dataType: "json",
                    beforeSend: function() {
                        blockUI();
                    },
                    complete: function() {
                        unBlockUI();
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            load_table();
                            toastr.success(data.message);
                        } else {
                            toastr.warning(data.message);
                        }
                    },
                    error: function() {
                        toastr.warning('Terjadi error saat menghapus data');
                    }
                });
            }
        });
    }



    function reject_data(id) {
        $('#modal_reject').modal('toggle');
        $('#note_alasan').val('');

        $('#form-reject').submit(function(event) {
            event.preventDefault();
            formData = new FormData($(this)[0]);

            bootbox.confirm({
                size: "medium",
                message: "Apakah Anda yakin akan menolak properti ini ?",
                callback: function(result) {
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
                            beforeSend: function() {
                                blockUI();
                            },
                            complete: function() {
                                unBlockUI();
                            },
                            success: function(data) {
                                if (data.status == 1) {
                                    load_table();
                                    $('#modal_reject').modal('toggle');
                                    // $('.bootbox.modal').modal('hide')
                                    toastr.success(data.message);
                                } else {
                                    toastr.warning(data.message);
                                }
                            },
                            error: function() {
                                toastr.warning('Terjadi error saat menyimpan data');
                            }
                        });
                    }
                }
            });

        });
    }



    function set_recommended(id) {
        bootbox.confirm("Status properti ini akan menjadi <b> Recommended </b>. Apakah Anda yakin?", function(event) {
            if (event == true) {
                $.ajax({
                    url: base_url + 'admin/Manage_properti/set_recommended/' + id,
                    dataType: "json",
                    beforeSend: function() {
                        blockUI();
                    },
                    complete: function() {
                        unBlockUI();
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            load_table();
                            toastr.success(data.message);
                        } else {
                            toastr.warning(data.message);
                        }
                    },
                    error: function() {
                        toastr.warning('Terjadi error saat menghapus data');
                    }
                });
            }
        });
    }


    function set_premium(id) {
        bootbox.confirm("Properti ini akan dilihat oleh <b> Premium Investor </b>. Apakah Anda yakin?", function(event) {
            if (event == true) {
                $.ajax({
                    url: base_url + 'admin/Manage_properti/set_premium/' + id,
                    dataType: "json",
                    beforeSend: function() {
                        blockUI();
                    },
                    complete: function() {
                        unBlockUI();
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            load_table();
                            toastr.success(data.message);
                        } else {
                            toastr.warning(data.message);
                        }
                    },
                    error: function() {
                        toastr.warning('Terjadi error saat menghapus data');
                    }
                });
            }
        });
    }


    function unset_recommended(id) {
        bootbox.confirm("Status <b> Recommended </b> dari properti ini akan dihilangkan. Apakah Anda yakin?", function(event) {
            if (event == true) {
                $.ajax({
                    url: base_url + 'admin/Manage_properti/unset_recommended/' + id,
                    dataType: "json",
                    beforeSend: function() {
                        blockUI();
                    },
                    complete: function() {
                        unBlockUI();
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            load_table();
                            toastr.success(data.message);
                        } else {
                            toastr.warning(data.message);
                        }
                    },
                    error: function() {
                        toastr.warning('Terjadi error saat menghapus data');
                    }
                });
            }
        });
    }


    function unset_premium(id) {
        bootbox.confirm("Properti ini akan disembunyikan oleh <b> Premium Investor </b>. Apakah Anda yakin?", function(event) {
            if (event == true) {
                $.ajax({
                    url: base_url + 'admin/Manage_properti/unset_premium/' + id,
                    dataType: "json",
                    beforeSend: function() {
                        blockUI();
                    },
                    complete: function() {
                        unBlockUI();
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            load_table();
                            toastr.success(data.message);
                        } else {
                            toastr.warning(data.message);
                        }
                    },
                    error: function() {
                        toastr.warning('Terjadi error saat menghapus data');
                    }
                });
            }
        });
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
                                    load_table();
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







    function clear_form_properti() {
        $('#form-properti').trigger('reset');
        $("#id").val('');
    }







    /* Dropzone.options.myDropzone = {
        url: base_url+'/',
        transformFile: function(file, done) {

            var myDropZone = this;

            // Create the image editor overlay
            var editor = document.createElement('div');
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
            confirm.addEventListener('click', function() {

                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });

                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false,
                        function(dataURL) {

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

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            // Append the editor to the page
            document.body.appendChild(editor);

            // Create Cropper.js and pass image
            var cropper = new Cropper(image, {
                aspectRatio: 1
            });

        }
    }; */
</script>