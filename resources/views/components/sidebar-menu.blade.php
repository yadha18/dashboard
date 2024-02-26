<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('passive-customer') }}"
                        class="nav-link {{ request()->is('passive-customer') ? 'active' : '' }}">
                        <i
                            class="far {{ request()->is('passive-customer') ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                        <p>Passive Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kanal-bayar') }}"
                        class="nav-link {{ request()->is('kanal-bayar') ? 'active' : '' }}">
                        <i class="far {{ request()->is('kanal-bayar') ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                        <p>Kanal Bayar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pelanggan-deaktivasi') }}"
                        class="nav-link {{ request()->is('pelanggan-deaktivasi') ? 'active' : '' }}">
                        <i
                            class="far {{ request()->is('pelanggan-deaktivasi') ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                        <p>Pelanggan Deaktivasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Revenue
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('revenue') }}"
                                class="nav-link {{ request()->is('revenue') ? 'active' : '' }}">
                                <i
                                    class="far {{ request()->is('revenue') ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                                <p>All Revenue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revenue Based on Rekon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revenue Based on Daily</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revenue per Account Executive (AE)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revenue per Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>
