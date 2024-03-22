<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') || Billing Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-searchbuilder/css/searchBuilder.bootstrap4.min.css') }}">
    <style>
        table {
            white-space: nowrap;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('content');
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script><!-- Include the external script file -->
    <script src="{{ asset('plugins/js/chart.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-searchbuilder/js/dataTables.searchBuilder.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
    <script>
        $(function() {
            var $visitorsChart = $("#visitors-chart");
            var mode = 'index'; // Definisikan mode tooltips dan hover
            var intersect = true; // Definisikan nilai intersect untuk tooltips dan hover

            var visitorsChart = new Chart($visitorsChart, {
                type: 'line',
                data: {
                    labels: ["18th", "20th", "22nd", "24th", "26th", "28th", "30th"],
                    datasets: [{
                            type: "line",
                            data: [100, 120, 170, 167, 180, 177, 160],
                            backgroundColor: "transparent",
                            borderColor: "#007bff",
                            pointBorderColor: "#007bff",
                            pointBackgroundColor: "#007bff",
                            fill: false,
                        },
                        {
                            type: "line",
                            data: [60, 80, 70, 67, 80, 77, 100],
                            backgroundColor: "transparent", // Perbaiki typo 'tansparent' menjadi 'transparent'
                            borderColor: "#ced4da",
                            pointBorderColor: "#ced4da",
                            pointBackgroundColor: "#ced4da",
                            fill: false,
                        },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect,
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect,
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: "4px",
                                color: "rgba(0, 0, 0, .2)",
                                zeroLineColor: "transparent",
                            },
                            ticks: {
                                beginAtZero: true,
                                suggestedMax: 200,
                            },
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false,
                            },
                        }],
                    },
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            }).buttons().container().appendTo('#dt-buttons');

            var table = $('#table-revenue').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });

            table.buttons().container().appendTo('#dt-buttons');

            var table2 = $('#table-jkb').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jkb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table3 = $('#table-jbb').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table4 = $('#table-bnt').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table5 = $('#table-jbtg').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table6 = $('#table-jbt').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table7 = $('#table-kal').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table8 = $('#table-sit').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table9 = $('#table-sbs').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table10 = $('#table-sbtg').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var table11 = $('#table-sbu').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-jbb' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
            });
            var tableDailyRevenue = $('#table-daily').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-daily' // Menentukan kontainer SearchBuilder
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan').text(jumlahTagihan);
                }
            });
            var table5mbps = $('#table-5mbps').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-5mbps'
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan5mbps').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan5mbps').text(jumlahTagihan);
                }
            });
            var table10mbps = $('#table-10mbps').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-10mbps'
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan10mbps').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan10mbps').text(jumlahTagihan);
                }
            });
            var table20mbps = $('#table-20mbps').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-20mbps'
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan20mbps').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan20mbps').text(jumlahTagihan);
                }
            });
            var table35mbps = $('#table-35mbps').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-35mbps'
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan35mbps').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan35mbps').text(jumlahTagihan);
                }
            });
            var table50mbps = $('#table-50mbps').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-50mbps'
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan50mbps').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan50mbps').text(jumlahTagihan);
                }
            });
            var table100mbps = $('#table-100mbps').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                    {
                        extend: 'searchBuilder',
                        text: 'Filters',
                        config: {
                            container: '#searchbuilder-container-100mbps'
                        },
                    }
                ],
                "language": {
                    searchBuilder: {
                        data: 'Column',
                        add: 'Add Condition',
                        button: {
                            0: '<i class="fas fa-filter"></i> Filters',
                            _: '<i class="fas fa-filter"></i> Filters (%d)'
                        }
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var pendapatanAwal = 0;
                    api.column(1, {
                        search: 'applied'
                    }).data().each(function(value) {
                        if (!isNaN(parseFloat(value))) {
                            pendapatanAwal += parseFloat(value);
                        }
                    });
                    $('#jumlahPendapatan100mbps').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#jumlahTagihan100mbps').text(jumlahTagihan);
                }
            });

            function formatRupiah(angka) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }

            table2.buttons().container().appendTo('#dt-buttons-jkb');
            table3.buttons().container().appendTo('#dt-buttons-jbb');
            table4.buttons().container().appendTo('#dt-buttons-bnt');
            table5.buttons().container().appendTo('#dt-buttons-jbtg');
            table6.buttons().container().appendTo('#dt-buttons-jbt');
            table7.buttons().container().appendTo('#dt-buttons-kal');
            table8.buttons().container().appendTo('#dt-buttons-sit');
            table9.buttons().container().appendTo('#dt-buttons-sbs');
            table10.buttons().container().appendTo('#dt-buttons-sbtg');
            table11.buttons().container().appendTo('#dt-buttons-sbu');
            tableDailyRevenue.buttons().container().appendTo('#dt-buttons-daily');
            table5mbps.buttons().container().appendTo('#dt-buttons-5mbps');
            table10mbps.buttons().container().appendTo('#dt-buttons-10mbps');
            table20mbps.buttons().container().appendTo('#dt-buttons-20mbps');
            table35mbps.buttons().container().appendTo('#dt-buttons-35mbps');
            table50mbps.buttons().container().appendTo('#dt-buttons-50mbps');
            table100mbps.buttons().container().appendTo('#dt-buttons-100mbps');

            $('.filter-button, .dropdown-item').on('click', function() {
                var year = $(this).data('year');
                var type = $(this).data('type');

                $.ajax({
                    url: '/get-revenue-data',
                    type: 'GET',
                    data: {
                        year: year,
                        type: type,
                    },
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                    },
                    success: function(data) {
                        table.clear();

                        $.each(data.data, function(index, item) {
                            var pendapatan = isNaN(item.pendapatan) ? item.pendapatan :
                                parseFloat(item.pendapatan);

                            var row = [
                                item.idTagihan,
                                'Rp. ' + (typeof pendapatan === 'number' ?
                                    pendapatan.toFixed(2).replace(
                                        /\d(?=(\d{3})+\.)/g, '$&,') : ''),
                                item.tanggalBayar,
                                item.bulan,
                                item.tahun,
                                item.namaLayanan,
                                item.namaLayananProduk,
                                item.typeBilling,
                                item.namaKP,
                                item.namaSBU,
                            ];

                            table.row.add(row);
                        });

                        table.draw();
                        updateFooter(data.data);
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    }
                });

                function updateFooter(data) {
                    var totalLembarTagihan = 0;
                    var totalPendapatan = 0;

                    $.each(data, function(index, item) {
                        totalLembarTagihan += parseFloat(item.idTagihan);
                        totalPendapatan += parseFloat(item.pendapatan);
                    });

                    $('#footer-row th:eq(0)').text(totalLembarTagihan);
                    $('#footer-row th:eq(1)').text('Rp. ' + totalPendapatan.toFixed(2).replace(
                        /\d(?=(\d{3})+\.)/g, '$&,'));
                }
            });


        });
    </script>
    <script>
        $(function() {
            $.ajax({
                url: '/get-prepaid-revenue',
                method: 'GET',
                success: function(data1) {
                    var dataPrepaid = [];

                    var labels = data1.map(function(item) {
                        return item.bulan;
                    });

                    data1.forEach(function(item) {
                        var numericValue = parseFloat(item.total_pendapatan.replace('Rp ', '')
                            .replace(/\./g, '').replace(',', '.'));

                        dataPrepaid.push(numericValue);
                    });

                    var datasetPrepaid = {
                        label: 'Prepaid',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: dataPrepaid
                    }

                    $.ajax({
                        url: '/get-postpaid-revenue',
                        method: 'GET',
                        success: function(data2) {
                            var dataPostpaid = [];
                            var label2 = data2.map(item => {
                                return item.bulan
                            });

                            data2.forEach((item) => {
                                var numericValue = parseFloat(item.total_pendapatan
                                    .replace('Rp ', '')
                                    .replace(/\./g, '').replace(',', '.'));

                                dataPostpaid.push(numericValue);
                            })

                            var datasetPostpaid = {
                                label: 'Total Revenue 2',
                                backgroundColor: 'rgba(255,99,132,0.9)',
                                borderColor: 'rgba(255,99,132,0.8)',
                                pointRadius: false,
                                pointColor: '#ff6384',
                                pointStrokeColor: 'rgba(255,99,132,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255,99,132,1)',
                                data: dataPostpaid
                            }

                            var salesChartData = {
                                labels: labels,
                                datasets: [datasetPrepaid, datasetPostpaid]
                            }

                            var salesChartOptions = {
                                maintainAspectRatio: false,
                                responsive: true,
                                legend: {
                                    display: false
                                },
                                scales: {
                                    xAxes: [{
                                        gridLines: {
                                            display: false
                                        }
                                    }],
                                    yAxes: [{
                                        gridLines: {
                                            display: false
                                        },
                                        ticks: {
                                            callback: function(value, index,
                                                values) {
                                                return 'Rp ' + value
                                                    .toLocaleString(
                                                        'id-ID');
                                            }
                                        }
                                    }]
                                }
                            };

                            var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
                            var salesChart = new Chart(salesChartCanvas, {
                                type: 'line',
                                data: salesChartData,
                                options: salesChartOptions
                            });
                        },
                        error: function(xhr2, status2, error2) {
                            console.error('Error fetching second data:', error2);
                        }
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            })
        })
    </script>
    <script>
        $(function() {
            "use strict";

            var ticksStyle = {
                fontColor: "#495057",
                fontStyle: "bold",
            };

            var mode = "index";
            var intersect = true;

            var $salesChart = $("#sales-chart-fix");

            $.ajax({
                url: "/get-baddebt-2021",
                method: "GET",
                success: function(response) {
                    var namaSBU = response.map(function(data) {
                        return data.namaSBU;
                    });
                    var jumlah2020 = response.map(function(data) {
                        return data.jumlah['2020'];
                    });
                    var jumlah2021 = response.map(function(data) {
                        return data.jumlah['2021'];
                    });
                    var jumlah2022 = response.map(function(data) {
                        return data.jumlah['2022'];
                    });
                    var jumlah2023 = response.map(function(data) {
                        return data.jumlah['2023'];
                    });

                    var salesChart = new Chart($salesChart, {
                        type: "bar",
                        data: {
                            labels: namaSBU,
                            datasets: [{
                                    label: '2020',
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: jumlah2020,
                                },
                                {
                                    label: '2021',
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: jumlah2021,
                                },
                                {
                                    label: '2022',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: jumlah2022,
                                },
                                {
                                    label: '2023',
                                    backgroundColor: "#dc3545",
                                    borderColor: "#dc3545",
                                    data: jumlah2023,
                                },
                            ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect,
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect,
                            },
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        display: true,
                                        lineWidth: "4px",
                                        color: "rgba(0, 0, 0, .2)",
                                        zeroLineColor: "transparent",
                                    },
                                    ticks: $.extend({
                                            beginAtZero: true,
                                            callback: function(value) {
                                                if (value >= 1000) {
                                                    value /= 1000;
                                                    value += "k";
                                                }
                                                return value;
                                            },
                                        },
                                        ticksStyle
                                    ),
                                }, ],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: ticksStyle,
                                }, ],
                            },
                        },
                    });
                },
            });
        });
    </script>
    <script>
        $(function() {
            $.ajax({
                url: '/get-total-kanal',
                method: 'GET',
                success: (data) => {
                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
                    var donutData = {
                        labels: ['E-Wallet', 'Modern Market', 'Bank', 'E-Commerce'],
                        datasets: [{
                            data: [data.e_wallet, data.modern_market, data.bank, data
                                .e_commerce
                            ],
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef']
                        }]
                    };

                    var labels = donutData.labels.map(function(label, index) {
                        var value = donutData.datasets[0].data[index];
                        var color = donutData.datasets[0].backgroundColor[index];
                        return label + ': ' + value;
                    });

                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                generateLabels: function(chart) {
                                    var data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map(function(label, i) {
                                            var meta = chart.getDatasetMeta(0);
                                            var ds = data.datasets[0];
                                            var arc = meta.data[i];
                                            var value = ds.data[i];
                                            var color = ds.backgroundColor[i];
                                            return {
                                                text: label + ': ' + value + '%',
                                                fillStyle: color,
                                                hidden: isNaN(ds.data[i]) || meta.data[
                                                    i].hidden,
                                                index: i
                                            };
                                        });
                                    } else {
                                        return [];
                                    }
                                }
                            }
                        }
                    };
                    new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })
            var donutData = {
                labels: [
                    'Chrome 20%',
                    'IE 20%',
                    'FireFox 20%',
                    'Safari 20%',
                    'Opera 20%',
                ],
                datasets: [{
                    data: [200, 200, 200, 200, 200],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }

            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position: 'right',
                }
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })
    </script>
</body>

</html>
