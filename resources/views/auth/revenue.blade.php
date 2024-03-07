@extends('layouts.layout')
@section('title', 'Revenue')
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
            @if (Route::currentRouteNamed('revenue'))
                <x-breadcrumb page="All Revenue" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <x-card title="Revenue Post Paid 2023" icon="card" type="light" totalCount="Rp. {{ intval($sum_postpaid_2023) }}"
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
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Revenue</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Lembar Tagihan</th>
                                                <th>Nama SBU</th>
                                                <th>Nama KP</th>
                                                <th>Tahun</th>
                                                <th>Bulan</th>
                                                <th>Pendapatan</th>
                                                <th>Type Billing</th>
                                                <th>Asal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($postpaid_2023 as $pp23)
                                                <tr>
                                                    <td>{{$pp23->lembarTagihan }}</td>
                                                    <td>{{$pp23->namaSBU }}</td>
                                                    <td>{{$pp23->namaKP }}</td>
                                                    <td>{{$pp23->tahun }}</td>
                                                    <td>{{$pp23->bulan }}</td>
                                                    <td>Rp. {{ str_replace(',', '.', number_format($pp23->pendapatan)) }}</td>
                                                    <td>{{$pp23->typeBilling }}</td>
                                                    <td>{{$pp23->asal }}</td>
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
