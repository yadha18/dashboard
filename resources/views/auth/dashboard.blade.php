@extends('layouts.layout')
@section('title', 'Home')
@section('content')
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <x-navbar />
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <x-sidebar username="{{ $user->name }}" />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <x-breadcrumb page="Dashboard" />
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <x-card title="Kanal Bayar" icon="card" type="info" />
                        <x-card title="Revenue" icon="stats-bars" type="success" />
                        <x-card title="Passive Customer" icon="person" type="warning" :totalCount="intval($total)" />
                        <x-card title="Pelanggan Deaktivasi" icon="pie-graph" type="danger" />
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

                        </section>
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
