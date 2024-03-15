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
                                    <table id="baddebt-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>ID PLN</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>No. Telp</th>
                                                <th>Type Billing</th>
                                                <th>Tanggal Aktivasi</th>
                                                <th>Periode Isolir</th>
                                                <th>Telat Hari</th>
                                                <th>Nama Layanan Produk</th>
                                                <th>Harga Produk</th>
                                                <th>Kode Gerak</th>
                                                <th>Status Aktif</th>
                                                <th>Nama SBU</th>
                                            </tr>
                                        </thead>
                                        {{-- <tbody>
                                            @foreach ($data as $baddebt)
                                                <tr>
                                                    <td>{{ $baddebt->idPelanggan }}</td>
                                                    <td>{{ $baddebt->idPLN }}</td>
                                                    <td>{{ $baddebt->nama }}</td>
                                                    <td>{{ $baddebt->email }}</td>
                                                    <td>{{ $baddebt->alamat }}</td>
                                                    <td>{{ $baddebt->telepon }}</td>
                                                    <td>{{ $baddebt->typebilling }}</td>
                                                    <td>{{ $baddebt->tanggalAktivasi }}</td>
                                                    <td>{{ $baddebt->periodeIsolir }}</td>
                                                    <td>{{ $baddebt->telatHari }}</td>
                                                    <td>{{ $baddebt->namaLayananProduk }}</td>
                                                    <td>{{ $baddebt->rp_produk }}</td>
                                                    <td>{{ $baddebt->kodeGerak }}</td>
                                                    <td>{{ $baddebt->statusAktif }}</td>
                                                    <td>{{ $baddebt->namaSBU }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
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
    <script>
        $(document).ready(function () {
            $('#baddebt-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('baddebt.data') }}",
                columns: [
                    {data: 'idPelanggan', name: 'idPelanggan'},
                    {data: 'idPLN', name: 'idPLN'},
                    {data: 'nama', name: 'nama'},
                    {data: 'email', name: 'email'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'telepon', name: 'telepon'},
                    {data: 'typebilling', name: 'typebilling'},
                    {data: 'tanggalAktivasi', name: 'tanggalAktivasi'},
                    {data: 'periodeIsolir', name: 'periodeIsolir'},
                    {data: 'telatHari', name: 'telatHari'},
                    {data: 'namaLayananProduk', name: 'namaLayananProduk'},
                    {data: 'rp_produk', name: 'rp_produk'},
                    {data: 'kodeGerak', name: 'kodeGerak'},
                    {data: 'statusAktif', name: 'statusAktif'},
                    {data: 'namaSBU', name: 'namaSBU'}
                ]
            });
        });
    </script>
@stop
