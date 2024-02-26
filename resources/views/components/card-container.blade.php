<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <x-card title="Kanal Bayar" icon="card" type="info" route="{{ route('kanal-bayar') }}" />
        <x-card title="Revenue" icon="stats-bars" type="success" route="{{ route('revenue') }}" />
        <x-card title="Passive Customer" icon="person" type="warning" totalCount="{{ intval($total) }}"
            route="{{ route('passive-customer') }}" />
        <x-card title="Pelanggan Deaktivasi" icon="pie-graph" type="danger"
            route="{{ route('pelanggan-deaktivasi') }}" />
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
