@extends('layouts.layout')
@section('title', 'Revenue Table')
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
@section('content')
    <div class="wrapper">

        <x-preloader />

        <x-navbar />
        <x-sidebar username="{{ $user->name }}" />
        <div class="content-wrapper">
            @if (Route::currentRouteNamed('revenue.table'))
                <x-breadcrumb page="Revenue Table" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="mt-5">
                        <div class="searchPanes"></div>
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Tagihan</th>
                                    <th>Revenue</th>
                                    <th>tanggal Bayar</th>
                                    <th>tanggal Tagihan</th>
                                    <th>nama Produk</th>
                                    <th>type Billing</th>
                                    <th>KP</th>
                                    <th>SBU</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </body>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('revenue.list') }}",
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'idTagihan',
                        name: 'idTagihan'
                    },
                    {
                        data: 'pendapatan',
                        name: 'pendapatan'
                    },
                    {
                        data: 'tanggalBayar',
                        name: 'tanggalBayar'
                    },
                    {
                        data: 'tanggalTagihan',
                        name: 'tanggalTagihan'
                    },
                    {
                        data: 'namaLayananProduk',
                        name: 'namaLayananProduk'
                    },
                    {
                        data: 'typeBilling',
                        name: 'typeBilling'
                    },
                    {
                        data: 'namaKP',
                        name: 'namaKP'
                    },
                    {
                        data: 'namaSBU',
                        name: 'namaSBU'
                    }
                ]
            });
        });
    </script>
