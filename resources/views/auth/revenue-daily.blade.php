@extends('layouts.layout')
@section('title', 'Revenue based on Daily')
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
            @if (Route::currentRouteNamed('dailyRevenue'))
                <x-breadcrumb page="Revenue based on Daily" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue based on Daily</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-daily" class="dt-buttons"></div>
                                    <table id="table-daily" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Tagihan</th>
                                                <th>Pendapatan</th>
                                                <th>Tipe Billing</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Layanan Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daily as $data)
                                                <tr>
                                                    <td>{{ $data->idTagihan }}</td>
                                                    <td>{{ $data->pendapatan }}</td>
                                                    <td>{{ $data->typeBilling }}</td>
                                                    <td>{{ $data->tanggalBayar }}</td>
                                                    <td>{{ $data->bulan }}</td>
                                                    <td>{{ $data->tahun }}</td>
                                                    <td>{{ $data->namaLayanan }}</td>
                                                    <td>{{ $data->namaLayananProduk }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"><b>Total Tagihan</b></td>
                                                <td id="jumlahPendapatan">
                                                    {{ 'Rp. ' . number_format($daily->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan">{{ $daily->count() }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Channel of Daily Revenue Percentage</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="dailyPieChart"
                                        style="min-height: 250px; height: 315px; max-height: 350px; max-width: 100%;"></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <section class="col-md-7">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Daily Revenue</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">Rp.
                                                {{ str_replace(',', '.', number_format($sum_daily)) }},-</span>
                                            <span>Total Daily Revenue</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->

                                    <div class="position-relative mb-4">
                                        <canvas id="dailyline-chart" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This Week
                                        </span>
                                    </div>
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
