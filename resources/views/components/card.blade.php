<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-{{ $type }}">
        <div class="inner">
            <span class="text-bold text-lg">{{ str_replace(',', '.', number_format($totalCount)) }}</span>
            <p>{{ $title }}</p>
        </div>
        <div class="icon">
            <i class="ion ion-{{ $icon }}"></i>
        </div>
        <a href={{ $route }} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
