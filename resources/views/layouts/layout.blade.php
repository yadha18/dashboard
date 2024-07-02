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
    <link rel="stylesheet" href="{{ asset('dist/css/ceknik.css') }}">
    <style>
        table {
            white-space: nowrap;
        }

        .dropbtn {
            background-color: #f1f1f1;
            color: #3d3d3d;
            border-radius: 50px;
            padding: 5px 20px;
            font-size: 14px;
            cursor: pointer;
            margin: 0px 0px 10px 10px;
            transition: all 0.3s;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #e1e1e1;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 180px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }

        .dropbtn2 {
            background-color: #f1f1f1;
            color: #3d3d3d;
            border-radius: 50px;
            padding: 5px 20px;
            font-size: 14px;
            cursor: pointer;
            margin: 0px 0px 10px 10px;
            transition: all 0.3s;
        }

        .dropbtn2:hover,
        .dropbtn2:focus {
            background-color: #e1e1e1;
        }

        .dropdown2 {
            position: relative;
            display: inline-block;
        }

        .dropdown-content2 {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 180px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 5px;
        }

        .dropdown-content2 a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown2 a:hover {
            background-color: #ddd;
        }

        .show2 {
            display: block;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('content');
    <script src="{{ asset('dist/js/ceknik.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        $(function() {
            var $dailyLineChart = $("#dailyline-chart");
            var $aeLineChart = $("#aeline-chart");
            var $productLineChart = $("#productline-chart");
            var mode = 'index';
            var intersect = true;

            $.ajax({
                url: '/get-ae-revenue',
                method: 'GET',
                success: (data) => {
                    data.sort((a, b) => new Date(a.tanggalAktivasi) - new Date(b.tanggalAktivasi));

                    const labels = data.map(entry => entry.tanggalAktivasi);
                    const pendapatan = data.map(entry => entry.pendapatan);

                    aeLineChart.data.labels = labels;
                    aeLineChart.data.datasets[0].data = pendapatan;

                    aeLineChart.update();
                }
            })

            var aeLineChart = new Chart($aeLineChart, {
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
                    }, ],
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

            $.ajax({
                url: '/get-daily-revenue',
                method: 'GET',
                success: (data) => {
                    data.sort((a, b) => new Date(a.tanggalBayar) - new Date(b.tanggalBayar));

                    const labels = data.map(entry => entry.tanggalBayar);
                    const pendapatan = data.map(entry => entry.pendapatanHarian);

                    dailyLineChart.data.labels = labels;
                    dailyLineChart.data.datasets[0].data = pendapatan;

                    dailyLineChart.update();
                }
            })

            var dailyLineChart = new Chart($dailyLineChart, {
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
                    }, ],
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

            $.ajax({
                url: '/get-product-chart',
                method: 'GET',
                success: (data) => {
                    var groupedData = {};
                    data.forEach(function(item) {
                        if (!groupedData[item.namaLayananProduk]) {
                            groupedData[item.namaLayananProduk] = {};
                        }
                        if (!groupedData[item.namaLayananProduk][item.bulan]) {
                            groupedData[item.namaLayananProduk][item.bulan] = parseFloat(item
                                .pendapatan);
                        } else {
                            groupedData[item.namaLayananProduk][item.bulan] += parseFloat(item
                                .pendapatan);
                        }
                    });
                    var labels = ["January", "February", "March", "April", "May", "June", "July",
                        "August", "September", "October", "November", "December"
                    ];
                    var color = ["#6610f2", "#adb5bd", "#198754", "#0dcaf0", "#dc3545", "#ffc107"];
                    var colorIndex = 0;
                    var datasets = [];
                    for (var productName in groupedData) {
                        var productData = groupedData[productName];
                        var dataArray = [];
                        labels.forEach(function(month) {
                            dataArray.push(productData[month] ||
                                0);
                        });
                        datasets.push({
                            label: productName,
                            data: dataArray,
                            backgroundColor: "transparent",
                            borderColor: color[colorIndex],
                            pointBorderColor: color[colorIndex],
                            pointBackgroundColor: color[colorIndex],
                            fill: false,
                        });
                        colorIndex = (colorIndex + 1) % color.length;
                    }
                    var productLineChart = new Chart($productLineChart, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: datasets,
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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown);
                }
            })

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "scrollX": true,
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
                    $('#jumlahPendapatanRevenue').text('Rp. ' + formatRupiah(pendapatanAwal) + ',-');

                    var jumlahTagihan = api.rows({
                        search: 'applied'
                    }).count();
                    $('#totalTagihanRevenue').text(jumlahTagihan);
                }
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
            var tableAccountExecutiveDownline = $('#table-accountExecutive-downline').DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "scrollX": true,
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
                }
            });
            var tableAccountExecutiveUpline = $('#table-accountExecutive-upline').DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "scrollX": true,
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
            tableAccountExecutiveDownline.buttons().container().appendTo('#dt-buttons-accountExecutive-downline');
            tableAccountExecutiveUpline.buttons().container().appendTo('#dt-buttons-accountExecutive-upline');

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
                                item.pendapatan,
                                // 'Rp. ' + (typeof pendapatan === 'number' ?
                                //     pendapatan.toFixed(2).replace(
                                //         /\d(?=(\d{3})+\.)/g, '$&,') : ''),
                                item.tanggalBayar,
                                item.bulan,
                                item.tahun,
                                item.namaLayanan,
                                item.namaLayananProduk,
                                item.typeBilling,
                                // item.namaKP,
                                item.namaSBU,
                            ];

                            table.row.add(row);
                        });

                        table.draw();
                        // updateFooter(data.data);
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

            $('.filter-ae-button').on('click', function() {
                var bandwidth = $(this).data('bandwidth');

                $.ajax({
                    url: '/get-ae-revenue-data-downline',
                    type: 'GET',
                    data: {
                        bandwidth: bandwidth,
                    },
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                        $('#loading-spinner').addClass('text-center');
                    },
                    success: function(data) {
                        tableAccountExecutiveDownline.clear();

                        $.each(data, function(index, item) {
                            var pendapatan = isNaN(item.pendapatan) ? item.pendapatan :
                                parseFloat(item.pendapatan);
                            var row = [
                                item.salesInput,
                                item.jumlahSales,
                                item.namaProduk,
                                pendapatan
                            ];
                            tableAccountExecutiveDownline.row.add(row);
                        });

                        tableAccountExecutiveDownline.draw();
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    }
                });
            });

            $('.filter-ae-upline-button').on('click', function() {
                var bandwidth = $(this).data('bandwidth');
                var spinner = $('#loading-spinner-upline');

                $.ajax({
                    url: '/api/get-ae-revenue-data-upline',
                    type: 'GET',
                    data: {
                        bandwidth: bandwidth,
                    },
                    beforeSend: function() {
                        spinner.removeClass('d-none');
                        spinner.addClass('text-center');
                    },
                    success: function(data) {
                        tableAccountExecutiveUpline.clear();

                        $.each(data, function(index, item) {
                            var pendapatan = isNaN(item.pendapatan) ? item.pendapatan :
                                parseFloat(item.pendapatan);
                            var row = [
                                item.uplineSales,
                                item.jumlahSales,
                                item.namaProduk,
                                pendapatan
                            ];
                            tableAccountExecutiveUpline.row.add(row);
                        });

                        tableAccountExecutiveUpline.draw();
                    },
                    complete: function() {
                        spinner.addClass('d-none');
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {
            $.ajax({
                url: '/api/get-prepaid-revenue',
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
                        url: '/api/get-postpaid-revenue',
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
                                label: 'Postpaid',
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
                url: "/api/get-baddebt-2021",
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
    {{-- <script>
        var ctx = document.getElementById('revenue-bar-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Realisasi',
                        backgroundColor: "#0dcaf0",
                        borderColor: "#0dcaf0",
                        data: [151, 299, 449, 599, 751, 904, 1059, 1215, 1371, 1531, 1692, 1860],
                        datalabels: {
                            color: '#FFCE56'
                        }
                    },
                    {
                        label: 'Target',
                        backgroundColor: "#007bff",
                        borderColor: "#007bff",
                        data: [150, 300, 500, 600, 800, 950, 1100, 1250, 1400, 1600, 1700, 2000],
                        datalabels: {
                            color: '#FFCE56'
                        }
                    },
                    {
                        label: 'Selisih',
                        backgroundColor: "#198754",
                        borderColor: "#198754",
                        data: [1, 1, 51, 1, 49, 46, 41, 35, 29, 69, 8, 140],
                        datalabels: {
                            color: '#FFCE56'
                        }
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.js">
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
            var loadingIndicator = $('#loadingIndicator');

            Chart.register(ChartDataLabels);

            var $revenueBarChart = $("#revenue-bar-chart")[0].getContext('2d');
            var revenueBarChart = new Chart($revenueBarChart, {
                type: "bar",
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                            barPercentage: 0.7,
                            label: 'Realisasi',
                            backgroundColor: "#0dcaf0",
                            borderColor: "#0dcaf0",
                            data: [],
                        },
                        {
                            barPercentage: 0.7,
                            label: 'Target',
                            backgroundColor: "#007bff",
                            borderColor: "#007bff",
                            data: [],
                        },
                        {
                            barPercentage: 0.5,
                            label: 'Selisih',
                            backgroundColor: "#198754",
                            borderColor: "#198754",
                            data: [],
                        }
                    ]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: Math.round,
                            font: {
                                weight: 'bold'
                            }
                        },
                    },
                    maintainAspectRatio: false,
                    interaction: {
                        mode: mode,
                        intersect: intersect,
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                }
            });

            $('.revenue-dropdown').click(function() {
                var year = $(this).data('year');
                loadingIndicator.show();
                $.ajax({
                    url: '/api/get-revenue-nasional',
                    method: 'GET',
                    data: {
                        year: year
                    },
                    success: function(data) {
                        loadingIndicator.hide();
                        var labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November',
                            'Desember'
                        ];
                        var realisasi = new Array(labels.length).fill(0);
                        var target = new Array(labels.length).fill(0);
                        var selisih = new Array(labels.length).fill(0);

                        data.forEach(function(item) {
                            var bulanIndex = labels.indexOf(item.bulan);
                            if (bulanIndex !== -1) {
                                realisasi[bulanIndex] = parseInt(item.realisasi, 10) /
                                    1000;
                                target[bulanIndex] = parseInt(item.target, 10) / 1000;
                                selisih[bulanIndex] = (parseInt(item.realisasi, 10) -
                                    parseInt(item.target, 10)) / 1000;
                            }
                        });

                        updateChart(revenueBarChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: 'Realisasi',
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: realisasi,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: 'Target',
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: target,
                                },
                                {
                                    barPercentage: 0.5,
                                    label: 'Selisih',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: selisih,
                                }
                            ]
                        });
                        var revenueHtml = '<h3 class="card-title"><b>Revenue Nasional Tahun ' +
                            year + '</b></h3>';
                        $('#chart-title').html(revenueHtml);
                        $('#satuan-1').show();
                    },
                    error: function(error) {
                        loadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                });
            });

            $('#updateData1').click(function() {
                loadingIndicator.show();
                $.ajax({
                    url: '/api/get-nasional-hc',
                    method: 'GET',
                    success: function(data) {
                        loadingIndicator.hide();
                        var labels = ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'KAL',
                            'SIT', 'BNT'
                        ];
                        var realisasi = new Array(labels.length).fill(0);
                        var target = [250, 400, 550, 700, 850, 1000, 1150, 1100, 1100, 1100];
                        var selisih = new Array(labels.length).fill(0);

                        data.forEach(function(item) {
                            var index = labels.indexOf(item.namaSBU);
                            if (index !== -1) {
                                realisasi[index] = item.jumlahPelanggan;
                            }
                        });

                        for (var i = 0; i < realisasi.length; i++) {
                            selisih[i] = realisasi[i] - target[i];
                        }

                        updateChart(revenueBarChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: 'Realisasi',
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: realisasi,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: 'Target',
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: target,
                                },
                                {
                                    barPercentage: 0.5,
                                    label: 'Selisih',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: selisih,
                                }
                            ]
                        });
                        var hcTitle = '<h3 class="card-title"><b>HC Nasional</b></h3>';
                        $('#chart-title').html(hcTitle);
                        $('#satuan-1').hide();
                    },
                    error: function(error) {
                        loadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                });
            });

            $('#updateData2').click(function() {
                loadingIndicator.show();
                $.ajax({
                    url: '/api/get-revenue-sbu',
                    method: 'GET',
                    success: function(data) {
                        loadingIndicator.hide();
                        var labels = ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'KAL',
                            'SIT', 'BNT'
                        ];
                        var realisasi = new Array(labels.length).fill(0);
                        var target = new Array(labels.length).fill(0);
                        var selisih = new Array(labels.length).fill(0);

                        data.forEach(function(item) {
                            var sbuIndex = labels.indexOf(item.namaSBU);
                            if (sbuIndex !== -1) {
                                realisasi[sbuIndex] = parseInt(item.realisasi, 10) /
                                    1000;
                                target[sbuIndex] = parseInt(item.target, 10) / 1000;
                                selisih[sbuIndex] = (parseInt(item.realisasi, 10) -
                                    parseInt(item.target, 10)) / 1000;
                            }
                        });

                        updateChart(revenueBarChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: 'Realisasi',
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: realisasi,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: 'Target',
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: target,
                                },
                                {
                                    barPercentage: 0.5,
                                    label: 'Selisih',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: selisih,
                                }
                            ],
                        })
                        var revenue_SBU_title =
                            '<h3 class="card-title"><b>Revenue per SBU</b></h3>';
                        $('#chart-title').html(revenue_SBU_title);
                        $('#satuan-1').show();
                    },
                    error: function(error) {
                        loadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            });

            function updateChart(chart, data) {
                chart.data.labels = data.labels;
                chart.data.datasets.forEach((dataset, index) => {
                    dataset.data = data.datasets[index].data;
                });
                chart.update();
            }
        });
    </script>

    <script>
        $(function() {
            "use strict";

            var ticksStyle = {
                fontColor: "#495057",
                fontStyle: "bold",
            };

            var periodeLoadingIndicator = $('#periodeLoadingIndicator');
            var mode = "index";
            var intersect = true;
            const realisasi = [151, 299, 449, 599, 751, 904, 1059, 1215, 1371, 1531, 1692, 1860];
            const target = [150, 300, 500, 600, 800, 950, 1100, 1250, 1400, 1600, 1700, 2000];

            var realisasiData = [
                [3984, 4616, 4602, 3068, 4160, 3064, 2925, 3106, 2716, 3282], // Januari
                [4500, 4200, 4800, 3100, 4400, 3200, 3000, 3200, 2800, 3400], // Februari
                // Add data for other months here
            ];

            var targetData = [
                [1688, 1256, 1417, 1845, 2010, 1849, 1843, 942, 1585, 838], // Januari
                [1800, 1400, 1600, 2000, 2200, 2000, 1900, 1000, 1700, 900], // Februari
                // Add data for other months here
            ];

            $('.dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });

            $('#compareButton').click(function() {
                var tahunPertama = $('#tahunPertama').val();
                var tahunKedua = $('#tahunKedua').val();

                if (!tahunPertama || !tahunKedua) {
                    alert('Mohon isi tahun pertama dan keduanya!');
                    periodeLoadingIndicator.hide();
                    return;
                }

                if (tahunPertama === tahunKedua) {
                    alert('Tahun Pertama dan Kedua tidak boleh sama!');
                    periodeLoadingIndicator.hide();
                    return
                }

                if (tahunPertama > tahunKedua) {
                    alert('Tahun kedua harus lebih besar dari tahun pertama!');
                    periodeLoadingIndicator.hide();
                    return;
                }
                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-revenue',
                    method: 'GET',
                    data: {
                        tahunPertama: tahunPertama,
                        tahunKedua: tahunKedua
                    },
                    success: function(response) {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data1 = response.data1;
                        var data2 = response.data2;

                        data1 = data1.map(function(value) {
                            return value / 1000; // Convert to thousands
                        });
                        data2 = data2.map(function(value) {
                            return value / 1000; // Convert to thousands
                        });

                        var selisihData = data1.map(function(value, index) {
                            return (data2[index] - value) / 1000;
                        });

                        selisihData = parseInt(selisihData, 10) / 1000;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${tahunPertama}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data1,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${tahunKedua}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data2,
                                },
                                {
                                    barPercentage: 0.5,
                                    label: 'Selisih',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: selisihData,
                                }
                            ]
                        });
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan Revenue Nasional Tahun ' +
                            tahunPertama + ' & ' + tahunKedua + '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').show();
                    },
                    error: function(error) {
                        periodeLoadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            })

            $('#compareHCButton').click(function() {
                var hcPertama = $('#hcPertama').val();
                var hcKedua = $('#hcKedua').val();

                if (!hcPertama || !hcKedua) {
                    alert('Mohon isi tahun pertama dan keduanya!');
                    return;
                }

                if (hcPertama > hcKedua) {
                    alert('Tahun kedua harus lebih besar dari tahun pertama!');
                }
                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-hc',
                    method: 'GET',
                    data: {
                        hcPertama: hcPertama,
                        hcKedua: hcKedua
                    },
                    success: function(response) {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data1 = response.data_HC_1;
                        var data2 = response.data_HC_2;

                        var selisihData = data1.map((value, index) => {
                            return data2[index] - value;
                        });

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${hcPertama}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data1,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${hcKedua}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data2,
                                },
                                {
                                    barPercentage: 0.5,
                                    label: 'Selisih',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: selisihData,
                                }
                            ]
                        })

                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan HC Nasional tahun ' +
                            hcPertama + ' & ' + hcKedua + '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').hide();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            })

            var $periodRevenueChart = $("#period-revenue-chart")[0].getContext('2d');

            var periodRevenueChart = new Chart($periodRevenueChart, {
                type: "bar",
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                            barPercentage: 0.7,
                            label: 'Realisasi',
                            backgroundColor: "#0dcaf0",
                            borderColor: "#0dcaf0",
                            data: realisasi,
                        },
                        {
                            barPercentage: 0.7,
                            label: 'Target',
                            barPercentage: 0.7,
                            backgroundColor: "#007bff",
                            borderColor: "#007bff",
                            data: target,
                        },
                        {
                            barPercentage: 0.5,
                            label: 'Selisih',
                            backgroundColor: "#198754",
                            borderColor: "#198754",
                            data: target.map((value, index) => value - realisasi[index]),
                        }
                    ],
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            font: {
                                weight: 'bold'
                            }
                        },
                    },
                    maintainAspectRatio: false,
                    interaction: {
                        mode: mode,
                        intersect: intersect,
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });

            $('#compareRevenueBillingTerbitButton').click(function() {
                var tahunPertamaBillingTerbit = $('#tahunPertamaBillingTerbit').val();
                var tahunKeduaBillingTerbit = $('#tahunKeduaBillingTerbit').val();

                if (!tahunPertamaBillingTerbit || !tahunKeduaBillingTerbit) {
                    alert('Mohon isi tahun pertama dan keduanya!');
                    periodeLoadingIndicator.hide();
                    return;
                }

                if (tahunPertamaBillingTerbit === tahunKeduaBillingTerbit) {
                    alert('Tahun pertama dan kedua tidak boleh sama.');
                    periodeLoadingIndicator.hide();
                    return;
                }

                if (tahunPertamaBillingTerbit > tahunKeduaBillingTerbit) {
                    alert('Tahun kedua harus lebih besar dari tahun pertama!');
                    periodeLoadingIndicator.hide();
                    return;
                }

                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-revenue-bt',
                    method: 'GET',
                    data: {
                        tahunPertamaBillingTerbit: tahunPertamaBillingTerbit,
                        tahunKeduaBillingTerbit: tahunKeduaBillingTerbit
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data1 = response.data_pertama;
                        var data2 = response.data_kedua;

                        data1 = data1.map(function(value) {
                            return value / 1000; // Convert to thousands
                        });
                        data2 = data2.map(function(value) {
                            return value / 1000; // Convert to thousands
                        });

                        var selisihData = data1.map(function(value, index) {
                            return (data2[index] - value) / 1000;
                        });

                        selisihData = parseInt(selisihData, 10) / 1000;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${tahunPertamaBillingTerbit}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data1,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${tahunKeduaBillingTerbit}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data2,
                                },
                                {
                                    barPercentage: 0.5,
                                    label: 'Selisih',
                                    backgroundColor: "#198754",
                                    borderColor: "#198754",
                                    data: selisihData,
                                }
                            ]
                        });
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan Revenue Nasional (Billing Terbit) Tahun ' +
                            tahunPertamaBillingTerbit + ' & ' + tahunKeduaBillingTerbit +
                            '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').show();
                    },
                    error: (error) => {

                    }
                })
            })

            $('#startDatePertama_BT, #endDatePertama_BT').change(function() {
                var startDatePertama_BT = $('#startDatePertama_BT').val();
                var endDatePertama_BT = $('#endDatePertama_BT').val();

                if (startDatePertama_BT && endDatePertama_BT) {
                    var startDate = new Date(startDatePertama_BT);
                    var endDate = new Date(endDatePertama_BT);

                    // Set dates for the following month
                    var lastMonthStartDate = new Date(startDate.setMonth(startDate.getMonth() - 1));
                    var lastMonthEndDate = new Date(endDate.setMonth(endDate.getMonth() - 1));

                    // Handle cases where the month rollover causes date to jump (e.g., January 31 to March 3)
                    if (lastMonthStartDate.getMonth() === startDate.getMonth() + 1) {
                        lastMonthStartDate = new Date(lastMonthStartDate.getFullYear(), lastMonthStartDate
                            .getMonth(), 0);
                    }
                    if (lastMonthEndDate.getMonth() === endDate.getMonth() + 1) {
                        lastMonthEndDate = new Date(lastMonthEndDate.getFullYear(), lastMonthEndDate
                            .getMonth(), 0);
                    }

                    // Format the dates to 'yyyy-mm-dd'
                    var lastMonthStartDateStr = lastMonthStartDate.toISOString().slice(0, 10);
                    var lastMonthEndDateStr = lastMonthEndDate.toISOString().slice(0, 10);

                    // Set the values of the input fields
                    $('#startDateKedua_BT').val(lastMonthStartDateStr);
                    $('#endDateKedua_BT').val(lastMonthEndDateStr);
                }
            });

            $('#compareMonthRevenueBillingTerbitButton').click(() => {
                var startDatePertama_BT = $('#startDatePertama_BT').val();
                var endDatePertama_BT = $('#endDatePertama_BT').val();
                var startDateKedua_BT = $('#startDateKedua_BT').val();
                var endDateKedua_BT = $('#endDateKedua_BT').val();

                var tanggalAwalPertama = new Date(startDatePertama_BT).getDate();
                var tanggalAwalKedua = new Date(startDateKedua_BT).getDate();

                var tanggalAkhirPertama = new Date(endDatePertama_BT).getDate();
                var tanggalAkhirKedua = new Date(endDateKedua_BT).getDate();

                var bulan1 = new Date(startDatePertama_BT).getMonth() + 1;
                var bulan2 = new Date(startDateKedua_BT).getMonth() + 1;

                var tahun1 = new Date(startDatePertama_BT).getFullYear();
                var tahun2 = new Date(startDateKedua_BT).getFullYear();

                var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                if (!startDatePertama_BT || !endDatePertama_BT || !startDateKedua_BT || !endDateKedua_BT) {
                    alert('Lengkapi tanggal periode');
                    return;
                }

                if (bulan1 === bulan2) {
                    alert('Bulan tidak bisa sama');
                    return;
                }

                if (startDatePertama_BT > endDatePertama_BT) {
                    alert('Tanggal akhir harus lebih besar dari tanggal awal');
                    return;
                }

                if (startDateKedua_BT > endDateKedua_BT) {
                    alert('tanggal akhir harus lebih besar dari tanggal awal');
                    return;
                }

                let bulanToStr_1 = namaBulan[bulan1 - 1];
                let bulanToStr_2 = namaBulan[bulan2 - 1];

                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-month-revenue-bt',
                    method: 'GET',
                    data: {
                        startDatePertama_BT: startDatePertama_BT,
                        endDatePertama_BT: endDatePertama_BT,
                        startDateKedua_BT: startDateKedua_BT,
                        endDateKedua_BT: endDateKedua_BT
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data1 = response.data_BT_1;
                        var data2 = response.data_BT_2;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${bulanToStr_2}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data2,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${bulanToStr_1}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data1,
                                }
                            ]
                        })
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan Revenue Nasional (Billing Terbit) per ' +
                            tanggalAwalKedua + '-' + tanggalAkhirKedua + ' ' +
                            bulanToStr_2 +
                            ' ' + tahun2 + ' s.d. ' +
                            tanggalAwalPertama + '-' + tanggalAkhirPertama + ' ' +
                            bulanToStr_1 + ' ' + tahun1 + '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').show();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            })

            $('#compareDayBillingTerbitRevenueButton').click(function() {
                var startDateDay_BT = $('#startDateDay_BT').val();
                var endDateDay_BT = $('#endDateDay_BT').val();

                var tanggalAwal = new Date(startDateDay_BT).getDate();
                var tanggalAkhir = new Date(endDateDay_BT).getDate();

                var bulanAwal = new Date(startDateDay_BT).getMonth() + 1;
                var bulanAkhir = new Date(endDateDay_BT).getMonth() + 1;

                var tahunAwal = new Date(startDateDay_BT).getFullYear();
                var tahunAkhir = new Date(endDateDay_BT).getFullYear();

                var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                if (!startDateDay_BT || !endDateDay_BT) {
                    alert('Tanggal wajib diisi!');
                    return;
                }

                if (startDateDay_BT < endDateDay_BT) {
                    alert('Tanggal kedua tidak boleh lebih besar dibanding tanggal pertama');
                    return;
                }

                let bulanToString_1 = namaBulan[bulanAwal - 1];
                let bulanToString_2 = namaBulan[bulanAkhir - 1];

                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-day-revenue-bt',
                    method: 'GET',
                    data: {
                        startDateDay_BT: startDateDay_BT,
                        endDateDay_BT: endDateDay_BT
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data1 = response.data_1;
                        var data2 = response.data_2;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${tanggalAkhir} ${bulanToString_2} ${tahunAkhir}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data2,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${tanggalAwal} ${bulanToString_1} ${tahunAwal}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data1,
                                }
                            ]
                        })
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan Revenue Nasional ' +
                            tanggalAkhir + ' ' + bulanToString_2 + ' ' + tahunAkhir + ' & ' +
                            tanggalAwal + ' ' + bulanToString_1 + ' ' + tahunAwal +
                            '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').show();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            })

            $('#startDatePertama, #endDatePertama').change(function() {
                var startDatePertama = $('#startDatePertama').val();
                var endDatePertama = $('#endDatePertama').val();

                if (startDatePertama && endDatePertama) {
                    var startDate = new Date(startDatePertama);
                    var endDate = new Date(endDatePertama);

                    // Set dates for the following month
                    var lastMonthStartDate = new Date(startDate.setMonth(startDate.getMonth() - 1));
                    var lastMonthEndDate = new Date(endDate.setMonth(endDate.getMonth() - 1));

                    // Handle cases where the month rollover causes date to jump (e.g., January 31 to March 3)
                    if (lastMonthStartDate.getMonth() === startDate.getMonth() + 1) {
                        lastMonthStartDate = new Date(lastMonthStartDate.getFullYear(), lastMonthStartDate
                            .getMonth(), 0);
                    }
                    if (lastMonthEndDate.getMonth() === endDate.getMonth() + 1) {
                        lastMonthEndDate = new Date(lastMonthEndDate.getFullYear(), lastMonthEndDate
                            .getMonth(), 0);
                    }

                    // Format the dates to 'yyyy-mm-dd'
                    var lastMonthStartDateStr = lastMonthStartDate.toISOString().slice(0, 10);
                    var lastMonthEndDateStr = lastMonthEndDate.toISOString().slice(0, 10);

                    // Set the values of the input fields
                    $('#startDateKedua').val(lastMonthStartDateStr);
                    $('#endDateKedua').val(lastMonthEndDateStr);
                }
            });

            $('#compareMonthRevenueButton').click(function() {
                var startDatePertama = $('#startDatePertama').val();
                var endDatePertama = $('#endDatePertama').val();
                var startDateKedua = $('#startDateKedua').val();
                var endDateKedua = $('#endDateKedua').val();

                var tanggalAwalPertama = new Date(startDatePertama).getDate();
                var tanggalAwalKedua = new Date(startDateKedua).getDate();

                var tanggalAkhirPertama = new Date(endDatePertama).getDate();
                var tanggalAkhirKedua = new Date(endDateKedua).getDate();

                var bulan1 = new Date(startDatePertama).getMonth() + 1;
                var bulan2 = new Date(startDateKedua).getMonth() + 1;

                var tahun1 = new Date(startDatePertama).getFullYear();
                var tahun2 = new Date(startDateKedua).getFullYear();

                var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                if (!startDatePertama || !startDateKedua || !endDatePertama || !endDateKedua) {
                    alert('Mohon lengkapi tanggal periodenya');
                    return;
                }

                if (bulan1 === bulan2) {
                    alert('Bulan tidak bisa sama');
                    return;
                }

                if (startDatePertama > endDatePertama) {
                    alert('Tanggal akhir harus lebih besar dari tanggal awal');
                    return;
                }

                if (startDateKedua > endDateKedua) {
                    alert('tanggal akhir harus lebih besar dari tanggal awal');
                    return;
                }

                let bulanToStr_1 = namaBulan[bulan1 - 1];
                let bulanToStr_2 = namaBulan[bulan2 - 1];

                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-month-revenue',
                    method: 'GET',
                    data: {
                        startDatePertama: startDatePertama,
                        startDateKedua: startDateKedua,
                        endDatePertama: endDatePertama,
                        endDateKedua: endDateKedua
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data1 = response.data_month_rev_1;
                        var data2 = response.data_month_rev_2;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${bulanToStr_2}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data2,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${bulanToStr_1}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data1,
                                }
                            ]
                        })
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan Revenue Nasional (Tanggal Bayar) per ' +
                            tanggalAwalKedua + '-' + tanggalAkhirKedua + ' ' + bulanToStr_2 +
                            ' ' + tahun2 + ' s.d. ' +
                            tanggalAwalPertama + '-' + tanggalAkhirPertama + ' ' +
                            bulanToStr_1 + ' ' + tahun1 + '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').show();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            })

            // $('#revenuePerDay').click(function() {
            //     var data_revenue_day = {
            //         labels: ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'BNT', 'KAL', 'SIT'],
            //         datasets: [{
            //             barPercentage: 0.7,
            //             label: 'Mei',
            //             backgroundColor: "#0dcaf0",
            //             borderColor: "#0dcaf0",
            //             data: [15.03, 17.59, 16.93, 17.34, 14.66, 14.77, 18.71, 13.12, 12.45,
            //                 11.15
            //             ]
            //         }, {
            //             barPercentage: 0.7,
            //             label: 'Juni',
            //             backgroundColor: "#007bff",
            //             borderColor: "#007bff",
            //             data: [14.94, 17.21, 17.32, 16.77, 14.60, 14.81, 17.79, 13.46, 12.42,
            //                 11.30
            //             ]
            //         }],
            //     }
            //     updateChart(periodRevenueChart, data_revenue_day);
            // });

            $('#compareDayRevenueButton').click(function() {
                var startDateDay = $('#startDateDay').val();
                var endDateDay = $('#endDateDay').val();

                var tanggalAwal = new Date(startDateDay).getDate();
                var tanggalAkhir = new Date(endDateDay).getDate();

                var bulanAwal = new Date(startDateDay).getMonth() + 1;
                var bulanAkhir = new Date(endDateDay).getMonth() + 1;

                var tahunAwal = new Date(startDateDay).getFullYear();
                var tahunAkhir = new Date(endDateDay).getFullYear();

                var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                if (!startDateDay || !endDateDay) {
                    alert('Tanggal wajib diisi!');
                    return;
                }

                if (startDateDay < endDateDay) {
                    alert('Tanggal kedua tidak boleh lebih besar dibanding tanggal pertama');
                    return;
                }

                let bulanToString_1 = namaBulan[bulanAwal - 1];
                let bulanToString_2 = namaBulan[bulanAkhir - 1];

                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-day-revenue',
                    method: 'GET',
                    data: {
                        startDateDay: startDateDay,
                        endDateDay: endDateDay
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();
                        var labels = response.labels;
                        var data_day_rev_1 = response.data_day_rev_1;
                        var data_day_rev_2 = response.data_day_rev_2;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${tanggalAkhir} ${bulanToString_2} ${tahunAkhir}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data_day_rev_2,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${tanggalAwal} ${bulanToString_1} ${tahunAwal}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data_day_rev_1,
                                }
                            ]
                        })
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan Revenue Nasional ' +
                            tanggalAkhir + ' ' + bulanToString_2 + ' ' + tahunAkhir + ' & ' +
                            tanggalAwal + ' ' + bulanToString_1 + ' ' + tahunAwal +
                            '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').show();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                        console.error("Error fetching data:", error);
                    }
                })
            });

            $('#hcStartDatePertama, #hcEndDatePertama').change(function() {
                var hcStartDatePertama = $('#hcStartDatePertama').val();
                var hcEndDatePertama = $('#hcEndDatePertama').val();

                if (hcStartDatePertama && hcEndDatePertama) {
                    var startDate = new Date(hcStartDatePertama);
                    var endDate = new Date(hcEndDatePertama);

                    // Set dates for the following month
                    var lastMonthStartDate = new Date(startDate.setMonth(startDate.getMonth() - 1));
                    var lastMonthEndDate = new Date(endDate.setMonth(endDate.getMonth() - 1));

                    // Handle cases where the month rollover causes date to jump (e.g., January 31 to March 3)
                    if (lastMonthStartDate.getMonth() === startDate.getMonth() + 1) {
                        lastMonthStartDate = new Date(lastMonthStartDate.getFullYear(), lastMonthStartDate
                            .getMonth(), 0);
                    }
                    if (lastMonthEndDate.getMonth() === endDate.getMonth() + 1) {
                        lastMonthEndDate = new Date(lastMonthEndDate.getFullYear(), lastMonthEndDate
                            .getMonth(), 0);
                    }

                    // Format the dates to 'yyyy-mm-dd'
                    var lastMonthStartDateStr = lastMonthStartDate.toISOString().slice(0, 10);
                    var lastMonthEndDateStr = lastMonthEndDate.toISOString().slice(0, 10);

                    // Set the values of the input fields
                    $('#hcStartDateKedua').val(lastMonthStartDateStr);
                    $('#hcEndDateKedua').val(lastMonthEndDateStr);
                }
            });

            $('#compareMonthHCButton').click(function() {
                var hcStartDatePertama = $('#hcStartDatePertama').val();
                var hcEndDatePertama = $('#hcEndDatePertama').val();
                var hcStartDateKedua = $('#hcStartDateKedua').val();
                var hcEndDateKedua = $('#hcEndDateKedua').val();

                var tanggalAwalPertama = new Date(hcStartDatePertama).getDate();
                var tanggalAwalKedua = new Date(hcStartDateKedua).getDate();

                var tanggalAkhirPertama = new Date(hcEndDatePertama).getDate();
                var tanggalAkhirKedua = new Date(hcEndDateKedua).getDate();

                var bulan_hc_pertama = new Date(hcStartDatePertama).getMonth() + 1;
                var bulan_hc_kedua = new Date(hcStartDateKedua).getMonth() + 1;

                var tahun_hc_pertama = new Date(hcStartDatePertama).getFullYear();
                var tahun_hc_kedua = new Date(hcStartDateKedua).getFullYear();

                var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                if (!hcStartDatePertama || !hcStartDateKedua || !hcEndDatePertama || !hcEndDateKedua) {
                    alert('Mohon lengkapi tanggal periodenya');
                    return;
                }

                if (bulan_hc_pertama === bulan_hc_kedua) {
                    alert('Bulan tidak bisa sama');
                    return;
                }

                if (hcStartDatePertama > hcEndDatePertama) {
                    alert('Tanggal akhir harus lebih besar dari tanggal awal');
                    return;
                }

                if (hcStartDateKedua > hcEndDateKedua) {
                    alert('tanggal akhir harus lebih besar dari tanggal awal');
                    return;
                }

                let bulanToStr_1 = namaBulan[bulan_hc_pertama - 1];
                let bulanToStr_2 = namaBulan[bulan_hc_kedua - 1];

                periodeLoadingIndicator.show();
                $.ajax({
                    url: '/api/get-compare-month-hc',
                    method: 'GET',
                    data: {
                        hcStartDatePertama: hcStartDatePertama,
                        hcEndDatePertama: hcEndDatePertama,
                        hcStartDateKedua: hcStartDateKedua,
                        hcEndDateKedua: hcEndDateKedua
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();

                        var labels = response.labels
                        var data_month_hc_1 = response.bulan_pertama
                        var data_month_hc_2 = response.bulan_kedua

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${bulanToStr_2}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data_month_hc_2,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${bulanToStr_1}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data_month_hc_1,
                                }
                            ]
                        })
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan HC Nasional per ' +
                            tanggalAwalKedua + '-' + tanggalAkhirKedua + ' ' + bulanToStr_2 +
                            ' ' + tahun_hc_kedua + ' s.d. ' +
                            tanggalAwalPertama + '-' + tanggalAkhirPertama + ' ' +
                            bulanToStr_1 + ' ' + tahun_hc_pertama + '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').hide();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                    }
                })
            })

            $('#compareDayHCButton').click(function() {
                var hcStartDateDay = $('#hcStartDateDay').val();
                var hcEndDateDay = $('#hcEndDateDay').val();

                var tanggalAwal = new Date(hcStartDateDay).getDate();
                var tanggalAkhir = new Date(hcEndDateDay).getDate();

                var bulan_hc_awal = new Date(hcStartDateDay).getMonth() + 1;
                var bulan_hc_akhir = new Date(hcEndDateDay).getMonth() + 1;

                var tahun_hc_awal = new Date(hcStartDateDay).getFullYear();
                var tahun_hc_akhir = new Date(hcEndDateDay).getFullYear();

                var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                    'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                if (!hcStartDateDay || !hcEndDateDay) {
                    alert('Isi tanggal periode!')
                    return;
                }

                if (hcStartDateDay < hcEndDateDay) {
                    alert('Tanggal pertama tidak bisa lebih besar dari tanggal kedua');
                    return;
                }

                var bulanToString_1 = namaBulan[bulan_hc_awal - 1];
                var bulanToString_2 = namaBulan[bulan_hc_akhir - 1];

                periodeLoadingIndicator.show();

                $.ajax({
                    url: '/api/get-compare-day-hc',
                    method: 'GET',
                    data: {
                        hcStartDateDay: hcStartDateDay,
                        hcEndDateDay: hcEndDateDay
                    },
                    success: (response) => {
                        periodeLoadingIndicator.hide();

                        var labels = response.labels;
                        var data_hc_1 = response.data_hc_1;
                        var data_hc_2 = response.data_hc_2;

                        updateChart(periodRevenueChart, {
                            labels: labels,
                            datasets: [{
                                    barPercentage: 0.7,
                                    label: `${tanggalAkhir} ${bulanToString_2} ${tahun_hc_akhir}`,
                                    backgroundColor: "#0dcaf0",
                                    borderColor: "#0dcaf0",
                                    data: data_hc_2,
                                },
                                {
                                    barPercentage: 0.7,
                                    label: `${tanggalAwal} ${bulanToString_1} ${tahun_hc_awal}`,
                                    backgroundColor: "#007bff",
                                    borderColor: "#007bff",
                                    data: data_hc_1,
                                }
                            ]
                        })
                        var periodChartTitle =
                            '<h3 class="card-title"><b>Perbandingan HC Nasional ' +
                            tanggalAkhir + ' ' + bulanToString_2 + ' ' + tahun_hc_akhir +
                            ' & ' + tanggalAwal + ' ' + bulanToString_1 + ' ' + tahun_hc_awal +
                            '</b></h3>';
                        $('#period-chart-title').html(periodChartTitle);
                        $('#satuan').hide();
                    },
                    error: (error) => {
                        periodeLoadingIndicator.hide();
                        console.error('Error:', error);
                    }
                })
            })

            // $('#compare-revenue').click(function() {
            //     var data_revenue_tahunan = {
            //         labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
            //             'September', 'Oktober', 'November', 'Desember'
            //         ],
            //         datasets: [{
            //                 barPercentage: 0.7,
            //                 label: '2023',
            //                 backgroundColor: "#0dcaf0",
            //                 borderColor: "#0dcaf0",
            //                 data: [200, 350, 500, 650, 800, 950, 1100, 1250, 1400, 1600, 1750,
            //                     1900
            //                 ],
            //             },
            //             {
            //                 barPercentage: 0.7,
            //                 label: '2024',
            //                 backgroundColor: "#007bff",
            //                 borderColor: "#007bff",
            //                 data: [250, 400, 550, 700, 850, 1000, 1150, 1300, 1450, 1600, 1800,
            //                     2000
            //                 ],
            //             },
            //             {
            //                 barPercentage: 0.5,
            //                 label: 'Selisih',
            //                 backgroundColor: "#198754",
            //                 borderColor: "#198754",
            //                 data: [25, 25, 25, 25, 25, 25, 25, 25, 50, 25, 50, 150],
            //             }
            //         ],
            //     };
            //     updateChart(periodRevenueChart, data_revenue_tahunan);
            // });

            // $('#monthlyRevenue').click(function() {
            //     var data_monthly_revenue = {
            //         labels: ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'BNT', 'KAL', 'SIT'],
            //         datasets: [{
            //                 barPercentage: 0.7,
            //                 label: 'Realisasi',
            //                 backgroundColor: "#0dcaf0",
            //                 borderColor: "#0dcaf0",
            //                 data: [14.94, 17.21, 17.32, 16.77, 14.60, 14.81, 17.79, 13.46, 12.42,
            //                     11.30
            //                 ],
            //             },
            //             {
            //                 barPercentage: 0.7,
            //                 label: 'Target',
            //                 backgroundColor: "#007bff",
            //                 borderColor: "#007bff",
            //                 data: [15.03, 17.59, 16.93, 17.34, 14.66, 14.77, 18.71, 13.12, 12.45,
            //                     11.15
            //                 ],
            //             },
            //             {
            //                 barPercentage: 0.5,
            //                 label: 'Selisih',
            //                 backgroundColor: "#198754",
            //                 borderColor: "#198754",
            //                 data: [3, 4, 2, 3, 2.5, 6, 4, 2, 4.5, 2.75],
            //             }
            //         ],
            //     };
            //     updateChart(periodRevenueChart, data_monthly_revenue);
            // })

            // $('#compare-HC').click(function() {
            //     var data_compare_HC = {
            //         labels: ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'BNT', 'KAL', 'SIT'],
            //         datasets: [{
            //                 barPercentage: 0.7,
            //                 label: '2023',
            //                 backgroundColor: "#0dcaf0",
            //                 borderColor: "#0dcaf0",
            //                 data: [3984, 4616, 4602, 3068, 4160, 3064, 2925, 3106, 2716, 3282],
            //             },
            //             {
            //                 barPercentage: 0.7,
            //                 label: '2024',
            //                 backgroundColor: "#007bff",
            //                 borderColor: "#007bff",
            //                 data: [1688, 1256, 1417, 1845, 2010, 1849, 1843, 942, 1585, 838],
            //             }
            //         ],
            //     };
            //     updateChart(periodRevenueChart, data_compare_HC);
            // });

            // $('#monthlyHC').click(function() {
            //     var realisasi_monthly_HC = [3984, 4616, 4602, 3068, 4160, 3064, 2925, 3106, 2716, 3282];
            //     var target_monthly_HC = [1688, 1256, 1417, 1845, 2010, 1849, 1843, 942, 1585, 838];
            //     var data_monthly_HC = {
            //         labels: ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'BNT', 'KAL', 'SIT'],
            //         datasets: [{
            //                 barPercentage: 0.7,
            //                 label: 'Realisasi',
            //                 backgroundColor: "#0dcaf0",
            //                 borderColor: "#0dcaf0",
            //                 data: realisasi_monthly_HC,
            //             },
            //             {
            //                 barPercentage: 0.7,
            //                 label: 'Target',
            //                 backgroundColor: "#007bff",
            //                 borderColor: "#007bff",
            //                 data: target_monthly_HC,
            //             }
            //         ],
            //     };
            //     updateChart(periodRevenueChart, data_monthly_HC)
            // });

            // $('#HCPerDay').click(function() {
            //     var data_hc_day = {
            //         labels: ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'BNT', 'KAL', 'SIT'],
            //         datasets: [{
            //             barPercentage: 0.7,
            //             label: 'Mei',
            //             backgroundColor: "#0dcaf0",
            //             borderColor: "#0dcaf0",
            //             data: [1688, 1256, 1417, 1845, 2010, 1849, 1843, 942, 1585, 838]
            //         }, {
            //             barPercentage: 0.7,
            //             label: 'Juni',
            //             backgroundColor: "#007bff",
            //             borderColor: "#007bff",
            //             data: [250, 400, 550, 700, 850, 1000, 1150, 1300, 1450, 1600, 1800,
            //                 2000
            //             ]
            //         }],
            //     }
            //     updateChart(periodRevenueChart, data_hc_day);
            // });

            function updateChart(chart, newData) {
                chart.data = newData;
                chart.update();
            }
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

            $.ajax({
                url: '/get-product-revenue',
                method: 'GET',
                success: (data) => {
                    var productPieChartCanvas = $('#productPieChart').get(0).getContext('2d')
                    var donutData = {
                        labels: [
                            '5 MBPS',
                            '10 MBPS',
                            '20 MBPS',
                            '35 MBPS',
                            '50 MBPS',
                            '100 MBPS'
                        ],
                        datasets: [{
                            data: [
                                data['data5mbps'],
                                data['data10mbps'],
                                data['data20mbps'],
                                data['data35mbps'],
                                data['data50mbps'],
                                data['data100mbps']
                            ],
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef',
                                '#3c8dbc', '#d2d6de'
                            ],
                        }]
                    }

                    var pieData = donutData;
                    var pieOptions = {
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
                                            var percent = parseFloat((value / ds.data
                                                .reduce((a, b) => a + b, 0) *
                                                100)).toFixed(1);
                                            return {
                                                text: label + ' (' + percent + '%)',
                                                fillStyle: ds.backgroundColor[i],
                                                hidden: isNaN(ds.data[i]) || meta.data[
                                                    i].hidden,
                                                index: i
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        }
                    }
                    new Chart(productPieChartCanvas, {
                        type: 'pie',
                        data: pieData,
                        options: pieOptions
                    })
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })

            $.ajax({
                url: '/get-revenue',
                method: 'GET',
                success: (data) => {
                    var dailyPieChartCanvas = $('#dailyPieChart').get(0).getContext('2d')
                    var donutData = {
                        labels: [
                            '5 MBPS',
                            '10 MBPS',
                            '20 MBPS',
                            '35 MBPS',
                            '50 MBPS',
                            '100 MBPS'
                        ],
                        datasets: [{
                            data: [
                                data['data5mbps'],
                                data['data10mbps'],
                                data['data20mbps'],
                                data['data35mbps'],
                                data['data50mbps'],
                                data['data100mbps']
                            ],
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef',
                                '#3c8dbc', '#d2d6de'
                            ],
                        }]
                    }

                    var pieData = donutData;
                    var pieOptions = {
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
                                            var percent = parseFloat((value / ds.data
                                                .reduce((a, b) => a + b, 0) *
                                                100)).toFixed(1);
                                            return {
                                                text: label + ' (' + percent + '%)',
                                                fillStyle: ds.backgroundColor[i],
                                                hidden: isNaN(ds.data[i]) || meta.data[
                                                    i].hidden,
                                                index: i
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        }
                    }
                    new Chart(dailyPieChartCanvas, {
                        type: 'pie',
                        data: pieData,
                        options: pieOptions
                    })
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })

            $.ajax({
                url: '/get-top-5-downline',
                method: 'GET',
                success: (data) => {
                    var labels = [];
                    var dataValues = [];
                    var dataPendapatan = [];

                    $.each(data, (index, item) => {
                        labels.push(item.downlineSales);
                        dataValues.push(item.jumlahSales);
                        dataPendapatan.push(item.pendapatan);
                    })

                    var chartData = {
                        labels: labels,
                        datasets: [{
                                label: 'Jumlah Sales',
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                borderWidth: 1,
                                data: dataValues
                            },
                            {
                                label: 'Revenue (Rp.)',
                                backgroundColor: 'rgba(210, 214, 222, 1)',
                                borderColor: 'rgba(210, 214, 222, 1)',
                                borderWidth: 1,
                                data: dataPendapatan
                            }
                        ]
                    };

                    var barChartCanvas = $('#downlineBarChart').get(0).getContext('2d')

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    };

                    new Chart(barChartCanvas, {
                        type: 'bar',
                        data: chartData,
                        options: barChartOptions
                    })
                }
            })
            $.ajax({
                url: '/get-top-5-upline',
                method: 'GET',
                success: (data) => {
                    var labels = [];
                    var dataValues = [];
                    var dataPendapatan = [];

                    $.each(data, (index, item) => {
                        labels.push(item.uplineSales);
                        dataValues.push(item.jumlahSales);
                        dataPendapatan.push(item.pendapatan);
                    })

                    var chartData = {
                        labels: labels,
                        datasets: [{
                                label: 'Jumlah Sales',
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                borderWidth: 1,
                                data: dataValues
                            },
                            {
                                label: 'Revenue (Rp.)',
                                backgroundColor: 'rgba(210, 214, 222, 1)',
                                borderColor: 'rgba(210, 214, 222, 1)',
                                borderWidth: 1,
                                data: dataPendapatan
                            },
                        ]
                    };

                    var uplineBarChartCanvas = $('#uplineBarChart').get(0).getContext('2d');

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    };

                    new Chart(uplineBarChartCanvas, {
                        type: 'bar',
                        data: chartData,
                        options: barChartOptions
                    })
                }
            })
        })
    </script>
</body>

</html>
