@extends('layouts.layout')
@section('title', 'Pelanggan Deaktivasi')
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
            @if (Route::currentRouteNamed('pelanggan-deaktivasi'))
                <x-breadcrumb page="Pelanggan Deaktivasi" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row col-12">
                        <x-card title="Pelanggan Deaktivasi" icon="pie-graph" type="light"
                            totalCount="{{ intval($total_pd) }}" route="{{ route('pelanggan-deaktivasi') }}" />
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Jakarta & Banten (JKB)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>ID Pelanggan Produk</th>
                                                <th>ID Layanan</th>
                                                <th>ID Layanan Produk</th>
                                                <th>Nama</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Layanan Produk</th>
                                                <th>Tipe Billing</th>
                                                <th>Nomor VA</th>
                                                <th>Nama SBU</th>
                                                <th>Alamat Billing</th>
                                                <th>Alamat Terminating</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Tanggal Deaktivasi</th>
                                                <th>Tanggal Start Billing</th>
                                                <th>Tanggal Mutasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($table_jkb as $jkb)
                                                <tr>
                                                    <td>{{ $jkb->idPelanggan }}</td>
                                                    <td>{{ $jkb->idPelangganProduk }}</td>
                                                    <td>{{ $jkb->idLayanan }}</td>
                                                    <td>{{ $jkb->idLayananProduk }}</td>
                                                    <td>{{ $jkb->nama }}</td>
                                                    <td>{{ $jkb->namaLayanan }}</td>
                                                    <td>{{ $jkb->namaLayananProduk }}</td>
                                                    <td>{{ $jkb->tipeBilling }}</td>
                                                    <td>{{ $jkb->nomorVA }}</td>
                                                    <td>{{ $jkb->namaSBU }}</td>
                                                    <td>{{ $jkb->billingAlamat }}</td>
                                                    <td>{{ $jkb->terminatingAlamat }}</td>
                                                    <td>{{ $jkb->tanggalAktivasi }}</td>
                                                    <td>{{ $jkb->tanggalDeaktivasi }}</td>
                                                    <td>{{ $jkb->tanggalStartBilling }}</td>
                                                    <td>{{ $jkb->tanggalMutasi }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Bali & Nusa Tenggara (BNT)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>ID Pelanggan Produk</th>
                                                <th>ID Layanan</th>
                                                <th>ID Layanan Produk</th>
                                                <th>Nama</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Layanan Produk</th>
                                                <th>Tipe Billing</th>
                                                <th>Nomor VA</th>
                                                <th>Nama SBU</th>
                                                <th>Alamat Billing</th>
                                                <th>Alamat Terminating</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Tanggal Deaktivasi</th>
                                                <th>Tanggal Start Billing</th>
                                                <th>Tanggal Mutasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($table_bnt as $bnt)
                                                <tr>
                                                    <td>{{ $bnt->idPelanggan }}</td>
                                                    <td>{{ $bnt->idPelangganProduk }}</td>
                                                    <td>{{ $bnt->idLayanan }}</td>
                                                    <td>{{ $bnt->idLayananProduk }}</td>
                                                    <td>{{ $bnt->nama }}</td>
                                                    <td>{{ $bnt->namaLayanan }}</td>
                                                    <td>{{ $bnt->namaLayananProduk }}</td>
                                                    <td>{{ $bnt->tipeBilling }}</td>
                                                    <td>{{ $bnt->nomorVA }}</td>
                                                    <td>{{ $bnt->namaSBU }}</td>
                                                    <td>{{ $bnt->billingAlamat }}</td>
                                                    <td>{{ $bnt->terminatingAlamat }}</td>
                                                    <td>{{ $bnt->tanggalAktivasi }}</td>
                                                    <td>{{ $bnt->tanggalDeaktivasi }}</td>
                                                    <td>{{ $bnt->tanggalStartBilling }}</td>
                                                    <td>{{ $bnt->tanggalMutasi }}</td>
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
