var table = $("#example").DataTable({
                    "processing": true,
                    "responsive": true,
                    "serverSide": true,
                    "ajax": {
                        "url": base_url + 'main/get_data_complete',
                        "type": "POST",
                        "data": function(data) {
                            data.status = $('#opt_filter_status option:selected').val();
                            data.search_keyword = $('#example_filter').val();
						}
                    },
                    "columnDefs": [{
                        "targets": [0, 1, 11, 12],
                        "orderable": false,
                    }],
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
                            }                        ]
                    }
                });