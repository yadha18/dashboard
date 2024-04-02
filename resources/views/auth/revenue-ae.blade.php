@extends('layouts.layout')
@section('title', 'Revenue per Account Executive')
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
            @if (Route::currentRouteNamed('revenueAccountExecutive'))
                <x-breadcrumb page="Revenue per Account Executive" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-md-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Revenue</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">Rp.
                                                {{ str_replace(',', '.', number_format(0)) }},-</span>
                                            <span>Total Revenue</span>
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
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue per Account Executive</h3>
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
                                            {{-- @foreach ($daily as $data)
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
                                            @endforeach --}}
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"><b>Total Tagihan</b></td>
                                                <td id="jumlahPendapatan">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan"></td>
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
