<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Logo / Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <span class="font-weight-bold">SPK</span> Bansos
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!--  Menu Masyarakat -->
    @if(auth()->user()->role === 'masyarakat')
        <hr class="sidebar-divider">

        <!-- Dashboard -->
        <li class="nav-item {{ request()->is('masyarakat/dashboard') || request()->is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('masyarakat.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Hasil Perhitungan -->
        <li class="nav-item {{ request()->is('masyarakat/penilaian/hasil*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penilaian.hasil.masyarakat') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Hasil Perhitungan</span>
            </a>
        </li>


        <hr class="sidebar-divider">

    @else
        <!--  Menu Admin -->
        <hr class="sidebar-divider">

    <!-- Dashboard -->
        <li class="nav-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">Data Master</div>

        <!-- Data Masyarakat -->
        <li class="nav-item {{ request()->is('admin/masyarakat*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('masyarakat.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Masyarakat</span>
            </a>
        </li>

        <!-- Kelola Akun Warga -->
        <li class="nav-item {{ request()->is('admin/akun*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('akun.index') }}"> 
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Kelola Akun Warga</span>
            </a>
        </li>

        <!-- Data Kriteria -->
        <li class="nav-item {{ request()->is('admin/kriteria*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kriteria.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Data Kriteria</span>
            </a>
        </li>

        <!-- Data Subkriteria -->
        <li class="nav-item {{ request()->is('admin/subkriteria*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('subkriteria.index') }}">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Data Subkriteria</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">Penilaian & Hasil</div>

        <!-- Input Penilaian -->
        <li class="nav-item {{ request()->is('admin/penilaian*') && !request()->is('admin/penilaian/hasil*') && !request()->is('admin/penilaian/cetak*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penilaian.index') }}">
                <i class="fas fa-fw fa-clipboard-check"></i>
                <span>Input Penilaian</span>
            </a>
        </li>

        <!-- Hasil Perhitungan -->
        <li class="nav-item {{ request()->is('admin/penilaian/hasil*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penilaian.hasil') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Hasil Perhitungan</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">Laporan</div>

        <!-- Cetak PDF -->
        <li class="nav-item {{ request()->is('admin/penilaian/cetak-pdf*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penilaian.cetak-pdf') }}">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Cetak PDF</span>
            </a>
        </li>

        <!-- Cetak PDF Detail -->
        <li class="nav-item {{ request()->is('admin/penilaian/cetak-pdf-detail*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penilaian.cetak-pdf-detail') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Cetak Detail</span>
            </a>
        </li>

        <hr class="sidebar-divider">
    @endif

    <li class="nav-item">
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>

</ul>
