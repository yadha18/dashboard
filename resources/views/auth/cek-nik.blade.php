@extends('layouts.layout')
@section('title', 'Cek NIK')
@section('content')
    <div class="wrapper">

        <x-preloader />

        <x-navbar />
        <x-sidebar username="{{ $user->name }}" />
        <div class="content-wrapper">
            <div class="container">
                <h2>Cek Informasi NIK</h2>
                <form id="nikForm">
                    <label for="nikInput">Enter NIK:</label><br />
                    <input type="text" id="nikInput" name="nik" minlength="16" required /><br /><br />
                    <button type="submit">Submit</button>
                </form>
                <div id="loadingIndicator" style="display: none">Loading...</div>
                <div id="resultContainer"></div>
            </div>
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
@stop
