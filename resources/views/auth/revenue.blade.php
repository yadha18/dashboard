@extends('layouts.layout')
@section('title', 'Revenue')
@section('content')
    <div class="wrapper">

        <!-- Preloader -->
        <x-preloader />

        <!-- Navbar -->
        <x-navbar />
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <x-sidebar username="{{ $user->name }}" />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if (Route::currentRouteNamed('revenue'))
                <x-breadcrumb page="All Revenue" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <x-card title="Revenue Postpaid 2023" icon="card" type="light"
                            totalCount="{{ intval($sum_postpaid_2023) }}" route="{{ route('kanal-bayar') }}" />
                        <x-card title="Revenue Postpaid 2024" icon="pie-graph" type="light"
                            totalCount="{{ intval($sum_postpaid_2024) }}" route="{{ route('pelanggan-deaktivasi') }}" />
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Revenue</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="btn-group" role="group" aria-label="Filter Buttons">
                                        <button type="button" class="btn btn-primary filter-button mr-3" data-year="2023"
                                            data-type="prepaid">Prepaid 2023</button>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Filter Buttons">
                                        <button type="button" class="btn btn-primary filter-button mr-3" data-year="2023"
                                            data-type="postpaid">Postpaid 2023</button>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Filter Buttons">
                                        <button type="button" class="btn btn-primary filter-button mr-3" data-year="2024"
                                            data-type="prepaid">Prepaid 2024</button>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Filter Buttons">
                                        <button type="button" class="btn btn-primary filter-button" data-year="2024"
                                            data-type="postpaid">Postpaid 2024</button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownRegional"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Filter Nama SBU
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownRegional">
                                            <!-- Regional options will be added dynamically using JavaScript -->
                                        </div>
                                    </div>
                                    <table id="table-revenue" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Lembar Tagihan</th>
                                                <th>Nama SBU</th>
                                                <th>Nama KP</th>
                                                <th>Tahun</th>
                                                <th>Bulan</th>
                                                <th>Pendapatan</th>
                                                <th>Type Billing</th>
                                                <th>Asal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div id="loading-spinner" class="d-none">
                                                Loading...
                                            </div>
                                        </tbody>
                                        <tfoot>
                                            <tr id="footer-row">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            Billing Collection Team. All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@stop
