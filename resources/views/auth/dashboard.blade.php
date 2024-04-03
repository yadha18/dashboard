@extends('layouts.layout')
@section('title', 'Home')
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
            <x-breadcrumb page="Dashboard" />
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <x-card title="Revenue Bulan ini" icon="card" type="light" totalCount="{{ intval($pendapatan) }}"
                            route="{{ route('revenue') }}" />
                        <x-card title="Pelanggan Deaktivasi" icon="pie-graph" type="light"
                            totalCount="{{ intval($total_pd) }}" route="{{ route('pelanggan-deaktivasi') }}" />
                        <x-card title="Pelanggan Passive" icon="person" type="light" totalCount="{{ intval($total) }}"
                            route="{{ route('passive-customer') }}" />
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Passive Customer (Post Paid) All-Time Chart</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span
                                                class="text-bold text-lg">{{ str_replace(',', '.', number_format($total)) }}</span>
                                            <span>Passive Customer</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->

                                    <div class="position-relative mb-4">
                                        <canvas id="sales-chart-fix" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-info"></i> 2020
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> 2021
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-square text-success"></i> 2022
                                        </span>
                                        <span>
                                            <i class="fas fa-square text-danger"></i> 2023
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Channel of All Time Percentage</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart"
                                        style="min-height: 250px; height: 315px; max-height: 350px; max-width: 100%;"></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Revenue Recap Report</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Sales: 1 Aug, 2023 - 29 Feb, 2024</strong>
                                            </p>

                                            <div class="chart">
                                                <canvas id="salesChart" height="180"
                                                    style="height: 180px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 col-7">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-dark"><i
                                                        class="fas fa-caret-left"></i> 0%</span>
                                                <h5 class="description-header">Rp.
                                                    {{ str_replace(',', '.', number_format($totalPendapatan)) }}</h5>
                                                <span class="description-text">TOTAL REVENUE</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-7">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-dark"><i
                                                        class="fas fa-caret-left"></i> 0%</span>
                                                <h5 class="description-header">Rp.
                                                    {{ str_replace(',', '.', number_format($pendapatan_feb)) }},-</h5>
                                                <span class="description-text">REVENUE BASED ON DAILY</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-7">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-dark"><i
                                                        class="fas fa-caret-left"></i> 0%</span>
                                                <h5 class="description-header">Rp.
                                                    {{ str_replace(',', '.', number_format($pendapatan_ae)) }},-</h5>
                                                <span class="description-text">REVENUE PER ACCOUNT EXECUTIVE</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            Billing Collection Team. All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
@stop
