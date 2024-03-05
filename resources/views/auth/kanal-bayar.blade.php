@extends('layouts.layout')
@section('title', 'Kanal Bayar')
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
            @if (request()->is('kanal-bayar'))
                <x-breadcrumb page="Kanal Bayar" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via Bank</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card bill="{{ intval($total_e_commerce) }}" />
                                <x-kanal-card />
                                <x-kanal-card />
                                <x-kanal-card />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via E-Wallet</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card />
                                <x-kanal-card />
                                <x-kanal-card />
                                <x-kanal-card />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via Modern Market</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card />
                                <x-kanal-card />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Via E-Commerce</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <x-kanal-card />
                                <x-kanal-card />
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
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
