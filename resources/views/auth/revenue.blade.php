@extends('layouts.layout')
@section('title', 'Revenue')
@section('content')
    <div class="wrapper">

        <x-preloader />

        <x-navbar />
        <x-sidebar username="{{ $user->name }}" />

        <div class="content-wrapper">
            @if (Route::currentRouteNamed('revenue'))
                <x-breadcrumb page="All Revenue" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <x-card title="Revenue Pre Paid 2023" type="light" totalCount="{{ intval($sum_prepaid_2023) }}" />
                        <x-card title="Revenue Post Paid 2023" type="light"
                            totalCount="{{ intval($sum_postpaid_2023) }}" />
                        <x-card title="Revenue Pre Paid 2024" type="light" totalCount="{{ intval($sum_prepaid_2024) }}" />
                        <x-card title="Revenue Post Paid 2024" type="light"
                            totalCount="{{ intval($sum_postpaid_2024) }}" />
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Revenue</h3>
                                </div>
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
                                    <div id="dt-buttons" class="dt-buttons mt-3"></div>
                                    <table id="table-revenue" class="table table-bordered table-striped">
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
                                            <div id="loading-spinner" class="d-none">
                                                Loading...
                                            </div>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="8"><b>Total Pendapatan</b></td>
                                                <td id="jumlahPendapatanRevenue">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"><b>Jumlah Tagihan</b></td>
                                                <td id="totalTagihanRevenue"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div id="loading-spinner" class="d-none">Loading...</div>
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
