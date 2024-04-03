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
                        <section class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Revenue</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">Rp.
                                                {{ str_replace(',', '.', number_format(0)) }},-</span>
                                            <span>Total Revenue</span>
                                        </p>
                                    </div>
                                    <div class="position-relative mb-4">
                                        <canvas id="dailyline-chart" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This Week
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue per Account Executive</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-accountExecutive" class="dt-buttons"></div>
                                    <table id="table-accountExecutive" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Pengguna Mobile</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Nama Produk</th>
                                                <th>Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_ae as $data)
                                                <tr>
                                                    <td>{{ $data->idPenggunaMobile }}</td>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->namaProduk }}</td>
                                                    <td>{{ $data->pendapatan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"><b>Total Pendapatan</b></td>
                                                <td id="jumlahPendapatanAE">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Jumlah Account Executive</b></td>
                                                <td id="jumlahAccountExecutive"></td>
                                            </tr>
                                        </tfoot>
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
