@extends('layouts.layout')
@section('title', 'Revenue')
@section('content')
    <div class="wrapper">

        <x-preloader />

        <x-navbar />
        <x-sidebar username="{{ $user->name }}" />

        <div class="content-wrapper">
            @if (Route::currentRouteNamed('revenue'))
                <x-breadcrumb page="All Revenue" />
            @else
                <x-breadcrumb page="Dashboard" />
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <x-card title="Total Revenue Nasional" type="light" totalCount=150633725971 />
                        <x-card title="Revenue Registrasi" type="light" totalCount=50233152222 />
                        <x-card title="Revenue Recurring" type="light" totalCount=100400152333 />
                        <x-card title="Revenue Bulan ini" type="light" totalCount=14354251971 />
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-end">
                        <div class="dropdown">
                            <button class="dropdown-toggle mb-3 mr-3"
                                style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Revenue Nasional
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item revenue-dropdown" id="revenue-nasional-2020"
                                    data-year="2020">2020</button>
                                <button class="dropdown-item revenue-dropdown" id="revenue-nasional-2021"
                                    data-year="2021">2021</button>
                                <button class="dropdown-item revenue-dropdown" id="revenue-nasional-2022"
                                    data-year="2022">2022</button>
                                <button class="dropdown-item revenue-dropdown" id="revenue-nasional-2023"
                                    data-year="2023">2023</button>
                                <button class="dropdown-item revenue-dropdown" id="revenue-nasional-2024"
                                    data-year="2024">2024</button>
                            </div>
                        </div>
                        <button id="updateData1" class="mb-3 mr-3"
                            style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;">HC
                            Nasional</button>
                        <button id="updateData2" class="mb-3 mr-2"
                            style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;">Revenue
                            per SBU</button>
                    </div>
                    <div class="row">
                        <section class="col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 id="chart-title" class="card-title"><b>Revenue Nasional</b></h3>
                                        <span id="satuan-1" class="mr-2"><b>x Rp. 1.000.000.000</b></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4">
                                        <canvas id="revenue-bar-chart" height="350" width="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title"><b>Informasi Tambahan</b></h3>
                                    </div>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <div class="d-flex flex-row">
                                        <div class="card m-2">
                                            <div class="card-body" style="background-color: #e1e1e1">
                                                <b id="subTitleInfo">Total Revenue Nasional</b>
                                                <p id="totalRevenue" class="text-gray-500 mt-2">Rp. 150.633.725.971,-</p>
                                            </div>
                                        </div>
                                        <div class="card m-2">
                                            <div class="card-body" style="background-color: #e1e1e1">
                                                <b id="subTitleInfo2">Lost Revenue Nasional</b>
                                                <p id="lostRevenue" class="text-gray-500 mt-2">Rp. 45.633.725.971,-</p>
                                            </div>
                                        </div>
                                        <div class="card m-2">
                                            <div class="card-body" style="background-color: #e1e1e1">
                                                <b id="subTitleInfo">Komposisi Revenue</b>
                                                <p id="totalRevenue" class="text-gray-500 mt-2">7.08% Registration</p>
                                                <p id="totalRevenue" class="text-gray-500 mt-2">92.92% Recurring</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </section>
                        <section class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Pilih menu:</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="w-25">
                                            <h3 class="pl-2"><b>Revenue</b></h3>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle mb-2 mr-3"
                                                    style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Perbandingan Revenue Nasional
                                                </button>
                                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton"
                                                    style="width: 400px;">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="form-group mr-2">
                                                            <label for="tahunPertama">Tahun Pertama:</label>
                                                            <select class="form-control" id="tahunPertama">
                                                                <option value="">Pilih Tahun</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group ml-2">
                                                            <label for="tahunKedua">Tahun Kedua:</label>
                                                            <select class="form-control" id="tahunKedua">
                                                                <option value="">Pilih Tahun</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-success mt-3 w-100"
                                                        id="compareButton">Bandingkan</button>
                                                </div>
                                            </div>
                                            <br>
                                            <button id="monthlyRevenue" class="mr-3 mb-2"
                                                style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;">Revenue
                                                Nasional per Bulan</button>
                                            <br>
                                            <button id="revenuePerDay" class="mr-3 mb-2"
                                                style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;">Revenue
                                                Nasional per Hari</button>
                                        </div>
                                        <div
                                            style="background-color: #d3d3d3; width: 3px; height:150px; margin-right: 35px; border-radius: 10px;">
                                        </div>
                                        <div class="w-25">
                                            <h3 class="pl-2"><b>HC</b></h3>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle mb-2 mr-3"
                                                    style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Perbandingan HC Nasional
                                                </button>
                                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton"
                                                    style="width: 400px;">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="form-group mr-2">
                                                            <label for="hcPertama">Tahun Pertama:</label>
                                                            <select class="form-control" id="hcPertama">
                                                                <option value="">Pilih Tahun</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group ml-2">
                                                            <label for="hcKedua">Tahun Kedua:</label>
                                                            <select class="form-control" id="hcKedua">
                                                                <option value="">Pilih Tahun</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-success mt-3 w-100"
                                                        id="compareHCButton">Bandingkan</button>
                                                </div>
                                            </div>
                                            <br>
                                            <button id="monthlyHC" class="mr-2 mb-2"
                                                style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;">HC
                                                per Bulan</button>
                                            <br>
                                            <button id="HCPerDay" class="mr-3 mb-2"
                                                style="background-color: #e1e1e1;color: #3d3d3d;border: 1px solid #3d3d3d;border-radius: 50px;padding: 5px 20px;font-size: 14px;cursor: pointer;">HC
                                                per Hari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 id="period-chart-title" class="card-title"><b>Perbandingan Revenue Nasional
                                                2023
                                                & 2024</b></h3>
                                        <span id="satuan" class="mr-2"><b>x Rp. 1.000.000.000</b></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4">
                                        <canvas id="period-revenue-chart" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </section>
                        {{-- <section class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Data Revenue</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group" role="group" aria-label="Filter Buttons">
                                        <button type="button" class="btn btn-info filter-button" data-year="2023"
                                            data-type="prepaid">Prepaid 2023</button>
                                        <button type="button" class="btn btn-info filter-button" data-year="2023"
                                            data-type="postpaid">Postpaid 2023</button>
                                        <button type="button" class="btn btn-info filter-button" data-year="2024"
                                            data-type="prepaid">Prepaid 2024</button>
                                        <button type="button" class="btn btn-info filter-button" data-year="2024"
                                            data-type="postpaid">Postpaid 2024</button>
                                    </div>
                                    <div id="dt-buttons" class="dt-buttons mt-3"></div>
                                    <table id="table-revenue" class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Tagihan</th>
                                                <th>Pendapatan</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama Produk</th>
                                                <th>Type Billing</th>
                                                <th>Nama SBU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div id="loading-spinner" class="d-none">
                                                Loading...
                                            </div>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="8"><b>Total Pendapatan</b></td>
                                                <td id="jumlahPendapatanRevenue"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"><b>Jumlah Tagihan</b></td>
                                                <td id="totalTagihanRevenue"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div id="loading-spinner" class="d-none">Loading...</div>
                                </div>
                            </div>
                        </section> --}}
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
    <script>
        var revenueNasional2020 = document.getElementById("revenue-nasional-2020");
        var revenueNasional2021 = document.getElementById("revenue-nasional-2021");
        var revenueNasional2022 = document.getElementById("revenue-nasional-2022");
        var revenueNasional2023 = document.getElementById("revenue-nasional-2023");
        var revenueNasional2024 = document.getElementById("revenue-nasional-2024");
        var revenuePerDayButton = document.getElementById("revenuePerDay");
        var HCPerDayButton = document.getElementById("HCPerDay");
        var revenueNasButton = document.getElementById("revenue-nasional");
        var hcButton = document.getElementById("updateData1");
        var revenueSBUButton = document.getElementById("updateData2");
        var compareRevenueButton = document.getElementById("compare-revenue");
        var monthlyRevenueButton = document.getElementById("monthlyRevenue");
        var compareHCButton = document.getElementById("compare-HC");
        var monthlyHCButton = document.getElementById("monthlyHC");
        var chartTitle = document.getElementById("chart-title");
        var periodChartTitle = document.getElementById("period-chart-title");
        var subTitleInfo = document.getElementById("subTitleInfo");
        var subTitleInfo2 = document.getElementById("subTitleInfo2");
        var valueSubInfo = document.getElementById("totalRevenue");
        var valueSubInfo2 = document.getElementById("lostRevenue");
        var satuanSubChart = document.getElementById("satuan");

        revenueNasButton.addEventListener("click", function() {
            var newTotalRevenue = "Rp. 150.633.725.971,-";
            var newLostRevenue = "Rp. 45.633.725.971,-";

            chartTitle.innerHTML = "<b>Revenue Nasional</b>"
            subTitleInfo.innerText = "Total Revenue Nasional"
            subTitleInfo2.innerText = "Lost Revenue Nasional"
            satuanRupiah1.style.display = 'block'
            valueSubInfo.innerText = newTotalRevenue;
            valueSubInfo2.innerText = newLostRevenue;
        })

        revenueNasional2020.addEventListener("click", function() {
            chartTitle.innerHTML += "2020";
            alert('tombol diclick');
        })

        hcButton.addEventListener("click", function() {
            var newTotalRevenue = "4.616 HC";
            var newLostRevenue = "4.602 HC";

            chartTitle.innerHTML = "<b>HC Nasional</b>"
            subTitleInfo.innerText = "1st. SBT"
            subTitleInfo2.innerText = "2nd. SBS"
            satuanRupiah1.style.display = 'none'
            valueSubInfo.innerText = newTotalRevenue;
            valueSubInfo2.innerText = newLostRevenue;
        });

        revenueSBUButton.addEventListener("click", function() {
            var newTotalRevenue = "Rp. 13.463.199.000,-";
            var newLostRevenue = "Rp. 17.324.208.000,-";

            chartTitle.innerHTML = "<b>Revenue per SBU</b>"
            subTitleInfo.innerText = "1st. Sumatera Bagian Selatan"
            subTitleInfo2.innerText = "2nd. Bali & Nusa Tenggara"
            satuanRupiah1.style.display = 'block'
            valueSubInfo.innerText = newTotalRevenue;
            valueSubInfo2.innerText = newLostRevenue;
        });

        compareRevenueButton.addEventListener("click", function() {
            periodChartTitle.innerHTML = '<b>Perbandingan Revenue Nasional 2023 & 2024</b>'
            satuanSubChart.style.display = 'block';
        })

        monthlyRevenueButton.addEventListener("click", function() {
            periodChartTitle.innerHTML = '<b>Revenue Nasional bulan Januari 2024</b>'
            satuanSubChart.style.display = 'block';
        })

        compareHCButton.addEventListener("click", function() {
            periodChartTitle.innerHTML = "<b>Perbandingan HC Nasional 2023 & 2024</b>"
            satuanSubChart.style.display = 'none';
        })

        monthlyHCButton.addEventListener("click", function() {
            periodChartTitle.innerHTML = '<b>HC bulan Januari 2024</b>'
            satuanSubChart.style.display = 'none';
        })

        revenuePerDayButton.addEventListener("click", function() {
            periodChartTitle.innerHTML = '<b>Revenue Hari Ini, 7 Juni 2024</b>'
            satuanSubChart.style.display = 'block';
        })

        HCPerDayButton.addEventListener("click", function() {
            periodChartTitle.innerHTML = "<b>HC Hari ini, 7 Juni 2024</b>"
            satuanSubChart.style.display = 'none';
        })
    </script>
@stop
