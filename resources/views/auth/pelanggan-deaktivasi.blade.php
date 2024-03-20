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
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Jakarta & Banten (JKB)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-jkb" class="dt-buttons"></div>
                                    <table id="table-jkb" class="table table-bordered table-striped">
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi JAWA BAGIAN BARAT (JBB)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-jbb" class="dt-buttons"></div>
                                    <table id="table-jbb" class="table table-bordered table-striped">
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
                                            @foreach ($table_jbb as $jbb)
                                                <tr>
                                                    <td>{{ $jbb->idPelanggan }}</td>
                                                    <td>{{ $jbb->idPelangganProduk }}</td>
                                                    <td>{{ $jbb->idLayanan }}</td>
                                                    <td>{{ $jbb->idLayananProduk }}</td>
                                                    <td>{{ $jbb->nama }}</td>
                                                    <td>{{ $jbb->namaLayanan }}</td>
                                                    <td>{{ $jbb->namaLayananProduk }}</td>
                                                    <td>{{ $jbb->tipeBilling }}</td>
                                                    <td>{{ $jbb->nomorVA }}</td>
                                                    <td>{{ $jbb->namaSBU }}</td>
                                                    <td>{{ $jbb->billingAlamat }}</td>
                                                    <td>{{ $jbb->terminatingAlamat }}</td>
                                                    <td>{{ $jbb->tanggalAktivasi }}</td>
                                                    <td>{{ $jbb->tanggalDeaktivasi }}</td>
                                                    <td>{{ $jbb->tanggalStartBilling }}</td>
                                                    <td>{{ $jbb->tanggalMutasi }}</td>
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
                                    <div id="dt-buttons-bnt" class="dt-buttons"></div>
                                    <table id="table-bnt" class="table table-bordered table-striped">
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
                        <section class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Jawa Bagian Tengah (JBTG)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-jbtg" class="dt-buttons"></div>
                                    <table id="table-jbtg" class="table table-bordered table-striped">
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
                                            @foreach ($table_jbtg as $jbtg)
                                                <tr>
                                                    <td>{{ $jbtg->idPelanggan }}</td>
                                                    <td>{{ $jbtg->idPelangganProduk }}</td>
                                                    <td>{{ $jbtg->idLayanan }}</td>
                                                    <td>{{ $jbtg->idLayananProduk }}</td>
                                                    <td>{{ $jbtg->nama }}</td>
                                                    <td>{{ $jbtg->namaLayanan }}</td>
                                                    <td>{{ $jbtg->namaLayananProduk }}</td>
                                                    <td>{{ $jbtg->tipeBilling }}</td>
                                                    <td>{{ $jbtg->nomorVA }}</td>
                                                    <td>{{ $jbtg->namaSBU }}</td>
                                                    <td>{{ $jbtg->billingAlamat }}</td>
                                                    <td>{{ $jbtg->terminatingAlamat }}</td>
                                                    <td>{{ $jbtg->tanggalAktivasi }}</td>
                                                    <td>{{ $jbtg->tanggalDeaktivasi }}</td>
                                                    <td>{{ $jbtg->tanggalStartBilling }}</td>
                                                    <td>{{ $jbtg->tanggalMutasi }}</td>
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Jawa Bagian Timur (JBT)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-jbt" class="dt-buttons"></div>
                                    <table id="table-jbt" class="table table-bordered table-striped">
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
                                            @foreach ($table_jbt as $jbt)
                                                <tr>
                                                    <td>{{ $jbt->idPelanggan }}</td>
                                                    <td>{{ $jbt->idPelangganProduk }}</td>
                                                    <td>{{ $jbt->idLayanan }}</td>
                                                    <td>{{ $jbt->idLayananProduk }}</td>
                                                    <td>{{ $jbt->nama }}</td>
                                                    <td>{{ $jbt->namaLayanan }}</td>
                                                    <td>{{ $jbt->namaLayananProduk }}</td>
                                                    <td>{{ $jbt->tipeBilling }}</td>
                                                    <td>{{ $jbt->nomorVA }}</td>
                                                    <td>{{ $jbt->namaSBU }}</td>
                                                    <td>{{ $jbt->billingAlamat }}</td>
                                                    <td>{{ $jbt->terminatingAlamat }}</td>
                                                    <td>{{ $jbt->tanggalAktivasi }}</td>
                                                    <td>{{ $jbt->tanggalDeaktivasi }}</td>
                                                    <td>{{ $jbt->tanggalStartBilling }}</td>
                                                    <td>{{ $jbt->tanggalMutasi }}</td>
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Kalimantan (KAL)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-kal" class="dt-buttons"></div>
                                    <table id="table-kal" class="table table-bordered table-striped">
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
                                            @foreach ($table_kal as $kal)
                                                <tr>
                                                    <td>{{ $kal->idPelanggan }}</td>
                                                    <td>{{ $kal->idPelangganProduk }}</td>
                                                    <td>{{ $kal->idLayanan }}</td>
                                                    <td>{{ $kal->idLayananProduk }}</td>
                                                    <td>{{ $kal->nama }}</td>
                                                    <td>{{ $kal->namaLayanan }}</td>
                                                    <td>{{ $kal->namaLayananProduk }}</td>
                                                    <td>{{ $kal->tipeBilling }}</td>
                                                    <td>{{ $kal->nomorVA }}</td>
                                                    <td>{{ $kal->namaSBU }}</td>
                                                    <td>{{ $kal->billingAlamat }}</td>
                                                    <td>{{ $kal->terminatingAlamat }}</td>
                                                    <td>{{ $kal->tanggalAktivasi }}</td>
                                                    <td>{{ $kal->tanggalDeaktivasi }}</td>
                                                    <td>{{ $kal->tanggalStartBilling }}</td>
                                                    <td>{{ $kal->tanggalMutasi }}</td>
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Sulawesi & Indonesia Timur (SIT)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-sit" class="dt-buttons"></div>
                                    <table id="table-sit" class="table table-bordered table-striped">
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
                                            @foreach ($table_sit as $sit)
                                                <tr>
                                                    <td>{{ $sit->idPelanggan }}</td>
                                                    <td>{{ $sit->idPelangganProduk }}</td>
                                                    <td>{{ $sit->idLayanan }}</td>
                                                    <td>{{ $sit->idLayananProduk }}</td>
                                                    <td>{{ $sit->nama }}</td>
                                                    <td>{{ $sit->namaLayanan }}</td>
                                                    <td>{{ $sit->namaLayananProduk }}</td>
                                                    <td>{{ $sit->tipeBilling }}</td>
                                                    <td>{{ $sit->nomorVA }}</td>
                                                    <td>{{ $sit->namaSBU }}</td>
                                                    <td>{{ $sit->billingAlamat }}</td>
                                                    <td>{{ $sit->terminatingAlamat }}</td>
                                                    <td>{{ $sit->tanggalAktivasi }}</td>
                                                    <td>{{ $sit->tanggalDeaktivasi }}</td>
                                                    <td>{{ $sit->tanggalStartBilling }}</td>
                                                    <td>{{ $sit->tanggalMutasi }}</td>
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Sumatera Bagian Selatan (SBS)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-sbs" class="dt-buttons"></div>
                                    <table id="table-sbs" class="table table-bordered table-striped">
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
                                            @foreach ($table_sbs as $sbs)
                                                <tr>
                                                    <td>{{ $sbs->idPelanggan }}</td>
                                                    <td>{{ $sbs->idPelangganProduk }}</td>
                                                    <td>{{ $sbs->idLayanan }}</td>
                                                    <td>{{ $sbs->idLayananProduk }}</td>
                                                    <td>{{ $sbs->nama }}</td>
                                                    <td>{{ $sbs->namaLayanan }}</td>
                                                    <td>{{ $sbs->namaLayananProduk }}</td>
                                                    <td>{{ $sbs->tipeBilling }}</td>
                                                    <td>{{ $sbs->nomorVA }}</td>
                                                    <td>{{ $sbs->namaSBU }}</td>
                                                    <td>{{ $sbs->billingAlamat }}</td>
                                                    <td>{{ $sbs->terminatingAlamat }}</td>
                                                    <td>{{ $sbs->tanggalAktivasi }}</td>
                                                    <td>{{ $sbs->tanggalDeaktivasi }}</td>
                                                    <td>{{ $sbs->tanggalStartBilling }}</td>
                                                    <td>{{ $sbs->tanggalMutasi }}</td>
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Sumatera Bagian Tengah (SBTG)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-sbtg" class="dt-buttons"></div>
                                    <table id="table-sbtg" class="table table-bordered table-striped">
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
                                            @foreach ($table_sbtg as $sbtg)
                                                <tr>
                                                    <td>{{ $sbtg->idPelanggan }}</td>
                                                    <td>{{ $sbtg->idPelangganProduk }}</td>
                                                    <td>{{ $sbtg->idLayanan }}</td>
                                                    <td>{{ $sbtg->idLayananProduk }}</td>
                                                    <td>{{ $sbtg->nama }}</td>
                                                    <td>{{ $sbtg->namaLayanan }}</td>
                                                    <td>{{ $sbtg->namaLayananProduk }}</td>
                                                    <td>{{ $sbtg->tipeBilling }}</td>
                                                    <td>{{ $sbtg->nomorVA }}</td>
                                                    <td>{{ $sbtg->namaSBU }}</td>
                                                    <td>{{ $sbtg->billingAlamat }}</td>
                                                    <td>{{ $sbtg->terminatingAlamat }}</td>
                                                    <td>{{ $sbtg->tanggalAktivasi }}</td>
                                                    <td>{{ $sbtg->tanggalDeaktivasi }}</td>
                                                    <td>{{ $sbtg->tanggalStartBilling }}</td>
                                                    <td>{{ $sbtg->tanggalMutasi }}</td>
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
                                    <h3 class="card-title">Data Pelanggan Deaktivasi Sumatera Bagian Utara (SBU)</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="dt-buttons-sbu" class="dt-buttons"></div>
                                    <table id="table-sbu" class="table table-bordered table-striped">
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
                                            @foreach ($table_sbu as $sbu)
                                                <tr>
                                                    <td>{{ $sbu->idPelanggan }}</td>
                                                    <td>{{ $sbu->idPelangganProduk }}</td>
                                                    <td>{{ $sbu->idLayanan }}</td>
                                                    <td>{{ $sbu->idLayananProduk }}</td>
                                                    <td>{{ $sbu->nama }}</td>
                                                    <td>{{ $sbu->namaLayanan }}</td>
                                                    <td>{{ $sbu->namaLayananProduk }}</td>
                                                    <td>{{ $sbu->tipeBilling }}</td>
                                                    <td>{{ $sbu->nomorVA }}</td>
                                                    <td>{{ $sbu->namaSBU }}</td>
                                                    <td>{{ $sbu->billingAlamat }}</td>
                                                    <td>{{ $sbu->terminatingAlamat }}</td>
                                                    <td>{{ $sbu->tanggalAktivasi }}</td>
                                                    <td>{{ $sbu->tanggalDeaktivasi }}</td>
                                                    <td>{{ $sbu->tanggalStartBilling }}</td>
                                                    <td>{{ $sbu->tanggalMutasi }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
