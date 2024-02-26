<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <span class="brand-text font-weight-light">Billing Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ $username }}
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <x-sidebar-search />
        <!-- Sidebar Menu -->
        <x-sidebar-menu />
    </div>
    <!-- /.sidebar -->
</aside>
