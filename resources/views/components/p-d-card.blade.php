<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box">
        <h5 class="card-header bg-secondary bg-opacity-50"><strong>{{ $name }}</strong></h5>
        <div class="inner card-body bg-light">
            <p class="card-text">Jumlah Pelanggan Deaktivasi: {{ str_replace(',', '.', number_format($count)) }}</p>
        </div>
    </div>
</div>
