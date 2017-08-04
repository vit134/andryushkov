$(document).ready(function() {
    console.log('index page');

    function init() {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons" B>lTfgitp',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                'colvis'
            ],
            "columnDefs": [
                {
                    "width": "10%",
                    "targets": 7
                }
            ]
        });
    }

    init();
})