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
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.2/b-3.0.1/sb-1.7.0/sp-2.3.0/datatables.min.css" rel="stylesheet">
    <style>
        table {
            white-space: nowrap;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('content');
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.2/b-3.0.1/sb-1.7.0/sp-2.3.0/datatables.min.js"></script>
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
    <script>
        $(function() {
            $("#example1, #example2, #example3, #example4").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", {
                    extend: 'searchBuilder',

                }],
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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#table-revenue').DataTable({
                "responsive": true,
                "lengthChange": false,
            });

            $('.filter-button, .dropdown-item').on('click', function() {
                var year = $(this).data('year');
                var type = $(this).data('type');
                var regional = $(this).data('regional');

                $.ajax({
                    url: '/get-revenue-data',
                    type: 'GET',
                    data: {
                        year: year,
                        type: type,
                        regional: regional,
                    },
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                    },
                    success: function(data) {
                        table.clear();

                        $.each(data, function(index, item) {
                            var pendapatan = isNaN(item.pendapatan) ? item.pendapatan :
                                parseFloat(item.pendapatan);

                            var row = [
                                item.lembarTagihan,
                                item.namaSBU,
                                item.namaKP,
                                item.tahun,
                                item.bulan,
                                'Rp. ' + (typeof pendapatan === 'number' ?
                                    pendapatan.toFixed(2).replace(
                                        /\d(?=(\d{3})+\.)/g, '$&,') : ''),
                                item.typeBilling,
                                item.asal
                            ];

                            table.row.add(row);
                        });

                        table.draw();
                        updateFooter(data);
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    }
                });

                $.ajax({
                    url: '/get-regional',
                    type: 'GET',
                    success: function(data) {
                        var dropdownRegional = $('#dropdownRegional');
                        var dropdownMenu = dropdownRegional.next('.dropdown-menu');

                        // Clear existing dropdown items
                        dropdownMenu.empty();

                        // Add regional options to the dropdown
                        $.each(data, function(index, item) {
                            dropdownMenu.append(
                                '<a class="dropdown-item regional-filter" data-regional="' +
                                item.namaSBU + '">' + item.namaSBU + '</a>');
                        });

                        // Handle regional filter click event
                        dropdownMenu.on('click', '.regional-filter', function() {
                            // Ensure year and type are defined
                            var year = $('.filter-button.active').data('year');
                            var type = $('.filter-button.active').data('type');

                            var selectedRegional = $(this).data('regional');

                            // Trigger the existing filter-button click event with the selected regional
                            $('.filter-button[data-year="' + year + '"][data-type="' +
                                    type + '"]').data('regional', selectedRegional)
                                .trigger('click');
                        });
                    }
                });

                function updateFooter(data) {
                    var totalLembarTagihan = 0;
                    var totalPendapatan = 0;

                    $.each(data, function(index, item) {
                        totalLembarTagihan += parseFloat(item.lembarTagihan);
                        totalPendapatan += parseFloat(item.pendapatan);
                    });

                    $('#footer-row th:eq(0)').text(totalLembarTagihan);
                    $('#footer-row th:eq(5)').text('Rp. ' + totalPendapatan.toFixed(2).replace(
                        /\d(?=(\d{3})+\.)/g, '$&,'));
                }
            });
        });
    </script>
</body>

</html>
