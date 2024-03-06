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
                        <x-card title="Pelanggan Deaktivasi" icon="pie-graph" type="light"
                            route="{{ route('pelanggan-deaktivasi') }}" />
                        <x-card title="Kanal Bayar" icon="card" type="light" totalCount="{{ intval($total_kanal) }}"
                            route="{{ route('kanal-bayar') }}" />
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>ID Pelanggan Produk</th>
                                                <th>Nama</th>
                                                <th>No. Telp</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Provinsi</th>
                                                <th>Kabupaten</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                                <th>Tipe Billing</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Layanan Produk</th>
                                                <th>Nama SBU</th>
                                                <th>Nama KP</th>
                                                <th>Olt ID</th>
                                                <th>Splitter ID</th>
                                                <th>Ont ID</th>
                                                <th>Ont Serial Number</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Durasi</th>
                                                <th>Lama Durasi</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Status Winback</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $baddebt)
                                                <tr>
                                                    <td>{{ $baddebt->idPelanggan }}</td>
                                                    <td>{{ $baddebt->idPelangganProduk }}</td>
                                                    <td>{{ $baddebt->nama }}</td>
                                                    <td>{{ $baddebt->no_telp }}</td>
                                                    <td>{{ $baddebt->email }}</td>
                                                    <td>{{ $baddebt->alamat }}</td>
                                                    <td>{{ $baddebt->provinsi }}</td>
                                                    <td>{{ $baddebt->kabupaten }}</td>
                                                    <td>{{ $baddebt->kecamatan }}</td>
                                                    <td>{{ $baddebt->kelurahan }}</td>
                                                    <td>{{ $baddebt->tipeBilling }}</td>
                                                    <td>{{ $baddebt->namaLayanan }}</td>
                                                    <td>{{ $baddebt->namaLayananProduk }}</td>
                                                    <td>{{ $baddebt->namaSBU }}</td>
                                                    <td>{{ $baddebt->namaKP }}</td>
                                                    <td>{{ $baddebt->oltId }}</td>
                                                    <td>{{ $baddebt->splitterId }}</td>
                                                    <td>{{ $baddebt->ontId }}</td>
                                                    <td>{{ $baddebt->ontSerialNumber }}</td>
                                                    <td>{{ $baddebt->tanggalAktivasi }}</td>
                                                    <td>{{ $baddebt->durasi }}</td>
                                                    <td>{{ $baddebt->lama_durasi }}</td>
                                                    <td>{{ $baddebt->month }}</td>
                                                    <td>{{ $baddebt->year }}</td>
                                                    <td>{{ $baddebt->status_winback }}</td>
                                                    <td>{{ $baddebt->status }}</td>
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
