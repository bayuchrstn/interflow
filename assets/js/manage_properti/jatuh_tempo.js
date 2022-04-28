

// function load_table() {

    var table = $("#table_properti").DataTable({
                    "processing": true,
                    "responsive": true,
                    "serverSide": true,
                    "ajax": {
                        "url": base_url + 'admin/Manage_properti/get_data_jatuhtempo',
                        "type": "POST",
                        "data": function(data) {
                            data.status = $('#opt_filter_status option:selected').val();
                            data.search_keyword = $('#table_properti_filter').val();
						}
                    },
                    "columnDefs": [{
                        "targets": [0, 1, 7, 7],
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

$('#filter_properti').submit(function(event) {
    event.preventDefault();
    table.ajax.reload(null, false);
});


