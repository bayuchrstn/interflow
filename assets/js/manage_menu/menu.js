$(document).ready(function () {
    // $('#filter_role__role').select2();
});


$('#set_menu__cancel').click(function() {
    $('#set_menu_modal').modal('hide');
    $('#set_menu__form')[0].reset();
    $('#set_menu__role').val('').trigger('change');
    $('#set_menu__submit').attr('disabled', false).html('Simpan');
});




$('#filter_role__form').submit(function(event) {
    event.preventDefault();
    // formData = new FormData($(this)[0]);

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: base_url + 'admin/Manage_menu/list_menu_role',
        data: $(this).serialize(),
        beforeSend: function() {
            $('#filter_role__submit').attr('disabled', true).html('<i class="icon-search4"></i>');
        },
        success: function(data) {
            $('#display_role_name').html(data.role.name);
            loadMenutree(data);
        },
        complete: function() {
            $('#filter_role__submit').attr('disabled', false).html('<i class="icon-search4"></i>');
        },
        error: function(err) {
            $('#filter_role__submit').attr('disabled', false).html('<i class="icon-search4"></i>');
            throw err;
        }
    })
});



function loadMenutree(tree_data) {
    $('#menu_role__tree').jstree({
        core: {
            themes: {
                name: 'proton', // 'default'
                responsive: true
            }
        },
        plugins: ['contextmenu', 'search'],
        contextmenu: {
            items: function(node) {
                return {
                    delete: {
                        label: '&nbsp;Hapus&nbsp;',
                        action: function(ctx) {
                            // console.log($(node));
                            bootbox.confirm({
                                title: 'Konfirmasi Hapus',
                                message: '<div class="col-md-12 text-center">Apakah anda yakin ingin menghapus<br> menu <b>' + node.text + '</b> dari <b>' + tree_data.role.name + '</b>?</div><br>',
                                buttons: {
                                    confirm: {
                                        label: 'Ya',
                                        className: 'btn-danger menu_role_delete__confirm'
                                    },
                                    cancel: {
                                        label: 'Tidak',
                                        className: 'btn-default menu_role_delete__cancel'
                                    }
                                },
                                callback: function(ok) {
                                    if (ok) {
                                        $.ajax({
                                            type: 'post',
                                            dataType: 'json',
                                            url: base_url + 'admin/Manage_menu/delete_menu_role',
                                            data: {
                                                menu_id: $(node).attr('id'),
                                                role: tree_data.role.id
                                            },
                                            beforeSend: function() {
                                                $('.menu_role_delete__confirm').attr('disabled', true).html('Menghapus');
                                                $('.menu_role_delete__cancel').attr('disabled', true);
                                            },
                                            success: function(res) {
                                                loadMenutree(res);
                                                $('#menu_role__tree').jstree(true).settings.core.data = res.menu;
                                                $('#menu_role__tree').jstree(true).refresh();
                                                bootbox.hideAll();

                                                if (res.title == 'Success') {
                                                    toastr.success(res.text);
                                                } else {
                                                    toastr.error(res.text);
                                                }
                                                
                                                // $('.bootbox-confirm').modal('hide');
                                            },
                                            complete: function() {
                                                $('.menu_role_delete__confirm').attr('disabled', false).html('Ya');
                                                $('.menu_role_delete__cancel').attr('disabled', false);
                                            },
                                            error: function(err) {
                                                throw err;
                                            }
                                        })
                                        return false;
                                    }
                                }
                            });
                        }
                    }/* ,
                    detail: {
                        label: '&nbsp;Detail&nbsp;',
                        action: function(ctx) {
                            // console.log('Node: '+node);
                            console.log($(node).attr('id'));
                        }
                    } */
                };
            }
        }
    });

    $('#menu_role__tree').jstree(true).settings.core.data = tree_data.menu;
    $('#menu_role__tree').jstree(true).refresh();
}






$('#set_menu__form').submit(function(event) {
    event.preventDefault();
    var checked_nodes = [];

    $('.set_menu__node:checked').each(function() {
        checked_nodes.push($(this).val());
    });

    var checked_nodes = $("#set_menu__menulist").jstree('get_checked');
    $("#set_menu__menulist").find(".jstree-undetermined").each(
        function(i, element) {
            checked_nodes.push($(element).closest('.jstree-node').attr("id"));
        }
    );

    $.ajax({
        type: 'post',
        url: base_url + 'admin/Manage_menu/store_permission',
        data: {
            role: $('#set_menu__role').val(),
            menus: checked_nodes
        },
        beforeSend: function() {
            $('#set_menu__submit').attr('disabled', true).html('Menyimpan...');
            $('#set_menu__cancel').attr('disabled', true);
        },
        success: function(data) {
            $('#set_menu_modal').modal('hide');
            $('#set_menu__form')[0].reset();
            $('#set_menu__role').val('').trigger('change');
            $('#set_menu__menulist').jstree('deselect_all');

            loadMenutree(data);

        },
        complete: function() {
            $('#set_menu__submit').attr('disabled', false).html('Simpan');
            $('#set_menu__cancel').attr('disabled', false);
        },
        error: function(err) {
            new PNotify({
                title: 'Error',
                text: 'Maaf, terjadi kesalahan',
                type: 'error'
            });
            throw err;
        }
    })

});