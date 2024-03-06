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
                    <div class="row">
                        <x-card title="Kanal Bayar" icon="card" type="light" totalCount="{{ intval($total_kanal) }}"
                            route="{{ route('kanal-bayar') }}" />
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
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Pelanggan Deaktivasi per SBU</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card name="JKB" />
                                <x-kanal-card name="JKB" />
                                <x-kanal-card name="JKB" />
                                <x-kanal-card name="JKB" />
                                <x-kanal-card name="JKB" />
                                <x-kanal-card name="JKB" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pelanggan Deaktivasi</h3>
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
                                                <th>Alamat Billing</th>
                                                <th>Alamat Terminating</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Tanggal Deaktivasi</th>
                                                <th>Tanggal Start Billing</th>
                                                <th>Tanggal Mutasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $pd)
                                                <tr>
                                                    <td>{{ $pd->idPelanggan }}</td>
                                                    <td>{{ $pd->idPelangganProduk }}</td>
                                                    <td>{{ $pd->idLayanan }}</td>
                                                    <td>{{ $pd->idLayananProduk }}</td>
                                                    <td>{{ $pd->nama }}</td>
                                                    <td>{{ $pd->namaLayanan }}</td>
                                                    <td>{{ $pd->namaLayananProduk }}</td>
                                                    <td>{{ $pd->tipeBilling }}</td>
                                                    <td>{{ $pd->nomorVA }}</td>
                                                    <td>{{ $pd->billingAlamat }}</td>
                                                    <td>{{ $pd->terminatingAlamat }}</td>
                                                    <td>{{ $pd->tanggalAktivasi }}</td>
                                                    <td>{{ $pd->tanggalDeaktivasi }}</td>
                                                    <td>{{ $pd->tanggalStartBilling }}</td>
                                                    <td>{{ $pd->tanggalMutasi }}</td>
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
