@extends('layouts.layout')
@section('title', 'Revenue based on Product')
@section('content')
    <div class="wrapper">

        <x-preloader />

        <x-navbar />
        <x-sidebar username="{{ $user->name }}" />

        <div class="content-wrapper">
            @if (Route::currentRouteNamed('productRevenue'))
                <x-breadcrumb page="Revenue based on Product" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue per Product Percentage</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart"
                                        style="min-height: 250px; height: 315px; max-height: 350px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <section class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue per Product Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">820</span>
                                            <span>Visitors Over Time</span>
                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> 12.5%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </p>
                                    </div>

                                    <div class="position-relative mb-4">
                                        <canvas id="visitors-chart" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This Week
                                        </span>

                                        <span>
                                            <i class="fas fa-square text-gray"></i> Last Week
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue 5 MBPS 2024</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-5mbps" class="dt-buttons"></div>
                                    <table id="table-5mbps" class="table table-bordered table-striped">
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
                                            @foreach ($mbps5 as $data)
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
                                                <td id="jumlahPendapatan5mbps">
                                                    {{ 'Rp. ' . number_format($mbps5->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan5mbps">{{ $mbps5->count() }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue 10 MBPS 2024</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-10mbps" class="dt-buttons"></div>
                                    <table id="table-10mbps" class="table table-bordered table-striped">
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
                                            @foreach ($mbps10 as $data)
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
                                                <td id="jumlahPendapatan10mbps">
                                                    {{ 'Rp. ' . number_format($mbps10->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan10mbps">{{ $mbps10->count() }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue 20 MBPS 2024</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-20mbps" class="dt-buttons"></div>
                                    <table id="table-20mbps" class="table table-bordered table-striped">
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
                                            @foreach ($mbps20 as $data)
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
                                                <td id="jumlahPendapatan20mbps">
                                                    {{ 'Rp. ' . number_format($mbps20->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan20mbps">{{ $mbps20->count() }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue 35 MBPS 2024</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-35mbps" class="dt-buttons"></div>
                                    <table id="table-35mbps" class="table table-bordered table-striped">
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
                                            @foreach ($mbps35 as $data)
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
                                                <td id="jumlahPendapatan35mbps">
                                                    {{ 'Rp. ' . number_format($mbps35->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan35mbps">{{ $mbps35->count() }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue 50 MBPS 2024</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-50mbps" class="dt-buttons"></div>
                                    <table id="table-50mbps" class="table table-bordered table-striped">
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
                                            @foreach ($mbps50 as $data)
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
                                                <td id="jumlahPendapatan50mbps">
                                                    {{ 'Rp. ' . number_format($mbps50->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan50mbps">{{ $mbps50->count() }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue 100 MBPS 2024</h3>
                                </div>
                                <div class="card-body">
                                    <div id="dt-buttons-100mbps" class="dt-buttons"></div>
                                    <table id="table-100mbps" class="table table-bordered table-striped">
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
                                            @foreach ($mbps100 as $data)
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
                                                <td id="jumlahPendapatan100mbps">
                                                    {{ 'Rp. ' . number_format($mbps100->sum('pendapatan'), 0, ',', '.') . ',-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><b>Jumlah Tagihan</b></td>
                                                <td id="jumlahTagihan100mbps">{{ $mbps100->count() }}</td>
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
