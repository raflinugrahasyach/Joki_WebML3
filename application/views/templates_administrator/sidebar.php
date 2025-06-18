<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-chart-bar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SVM Kemiskinan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    <!-- Nav Item - Data Penduduk -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('penduduk'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Penduduk</span>
        </a>
    </li>
    
    <!-- MENU KLASIFIKASI DIHAPUS DARI SINI -->

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('penduduk/laporan'); ?>">
            <i class="fas fa-fw fa-print"></i>
            <span>Laporan Hasil</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
