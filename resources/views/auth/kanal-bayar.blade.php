@extends('layouts.layout')
@section('title', 'Kanal Bayar')
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
            @if (request()->is('kanal-bayar'))
                <x-breadcrumb page="Kanal Bayar" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <form action="{{ route('kanal-bayar') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                            <p>Filtering results from <strong>{{ $startDate }}</strong> to
                                <strong>{{ $endDate }}</strong></p>
                        </form>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via Bank</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card name="BRI" bill="{{ intval($total_bri) }}"
                                    money="{{ intval($bill_bri) }}" />
                                <x-kanal-card name="BNI" bill="{{ intval($total_bni) }}"
                                    money="{{ intval($bill_bni) }}" />
                                <x-kanal-card name="BCA" bill="{{ intval($total_bca) }}"
                                    money="{{ intval($bill_bca) }}" />
                                <x-kanal-card name="MANDIRI" bill="{{ intval($total_mandiri) }}"
                                    money="{{ intval($bill_mandiri) }}" />
                                <x-kanal-card name="BANK LAINNYA" bill="{{ intval($total_otherbank) }}"
                                    money="{{ intval($bill_otherbank) }}" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via E-Wallet</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row mt-4">
                                    <x-kanal-card name="OVO" bill="{{ intval($total_ovo) }}"
                                        money="{{ intval($bill_ovo) }}" />
                                    <x-kanal-card name="LINK AJA" bill="{{ intval($total_linkaja) }}"
                                        money="{{ intval($bill_linkaja) }}" />
                                    <x-kanal-card name="GOPAY" bill="{{ intval($total_gopay) }}"
                                        money="{{ intval($bill_gopay) }}" />
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via Modern Market</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card name="INDOMART" bill="{{ intval($total_indo) }}"
                                    money="{{ intval($bill_indo) }}" />
                                <x-kanal-card name="ALFAMART" bill="{{ intval($total_alfa) }}"
                                    money="{{ intval($bill_alfa) }}" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via E-Commerce</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card name="ALTERRA" bill="{{ intval($total_e_commerce) }}"
                                    money="{{ intval($bill_e_commerce) }}" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
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
