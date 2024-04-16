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
                                                <th>ID Tagihan</th>
                                                <th>Pendapatan</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Produk</th>
                                                <th>Type Billing</th>
                                                {{-- <th>Nama KP</th> --}}
                                                <th>Nama SBU</th>
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
                                        <tfoot>
                                            <tr>
                                                <td colspan="8"><b>Total Pendapatan</b></td>
                                                <td id="totalAE">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"><b>Jumlah Tagihan</b></td>
                                                <td id="totalAE"></td>
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
