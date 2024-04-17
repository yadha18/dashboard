@extends('layouts.layout')
@section('title', 'Revenue per Account Executive')
@section('content')
    <div class="wrapper">

        <x-preloader />

        <x-navbar />
        <x-sidebar username="{{ $user->name }}" />

        <div class="content-wrapper">
            @if (Route::currentRouteNamed('revenueAccountExecutive'))
                <x-breadcrumb page="Revenue per Account Executive" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top 5 Downline Sales 2022-2024</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="downlineBarChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </section>
                        <section class="col-md-6">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top 5 Upline Sales 2022-2024</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="uplineBarChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue per Account Executive</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-accountExecutive" class="dt-buttons"></div>
                                    <table id="table-accountExecutive" class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Permohonan</th>
                                                <th>Sales Input</th>
                                                <th>Upline Sales</th>
                                                <th>Mitra Sales</th>
                                                <th>Mitra Upline</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Produk</th>
                                                <th>Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_ae as $data)
                                                <tr>
                                                    <td>{{ $data->idPermohonan }}</td>
                                                    <td>{{ $data->salesInput }}</td>
                                                    <td>{{ $data->uplineSales }}</td>
                                                    <td>{{ $data->mitraSales }}</td>
                                                    <td>{{ $data->mitraUpline }}</td>
                                                    <td>{{ $data->tanggalAktivasi }}</td>
                                                    <td>{{ $data->namaLayanan }}</td>
                                                    <td>{{ $data->namaProduk }}</td>
                                                    <td>{{ $data->rpProduk }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
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
