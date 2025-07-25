@extends('layouts.layout')
@section('title', 'Passive Customer')
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
            @if (Route::currentRouteNamed('passive-customer'))
                <x-breadcrumb page="Passive Customer" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
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
                        <!-- Left col -->
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Passive Customer</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons" class="dt-buttons"></div>
                                    <table id="example1" class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Produk</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Tahun Bulan Aktivasi</th>
                                                <th>Tanggal Tagihan</th>
                                                <th>Tahun Bulan Tagihan</th>
                                                <th>Tanggal Isolir</th>
                                                <th>Telat Hari</th>
                                                <th>Prepaid</th>
                                                <th>Nama SBU</th>
                                                <th>Nama KP</th>
                                                <th>Sales Input</th>
                                                <th>Total Tiket</th>
                                                <th>Promo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $baddebt)
                                                <tr>
                                                    <td>{{ $baddebt->idPelanggan }}</td>
                                                    <td>{{ $baddebt->namaLayanan }}</td>
                                                    <td>{{ $baddebt->namaLayananProduk }}</td>
                                                    <td>{{ $baddebt->tanggalAktivasi }}</td>
                                                    <td>{{ $baddebt->tahunBulanAktivasi }}</td>
                                                    <td>{{ $baddebt->tanggalTagihan }}</td>
                                                    <td>{{ $baddebt->tahunBulanTagihan }}</td>
                                                    <td>{{ $baddebt->tglIsolir }}</td>
                                                    <td>{{ $baddebt->telatHari }}</td>
                                                    <td>{{ $baddebt->prepaid }}</td>
                                                    <td>{{ $baddebt->namaSBU }}</td>
                                                    <td>{{ $baddebt->namaKP }}</td>
                                                    <td>{{ $baddebt->salesinput }}</td>
                                                    <td>{{ $baddebt->totalTiket }}</td>
                                                    <td>{{ $baddebt->Promo }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
