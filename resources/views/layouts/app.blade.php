@inject('carbon', 'Carbon\Carbon')
@php
    $today          = Illuminate\Support\Carbon::now()->isoFormat('dddd, D MMMM Y');
    $usersprofile   = asset('drive/profile/' . ( auth()->user()->profile ?? 'profile.png' ));
@endphp
@include('layouts.css')
<body id="page-top">
    <div class="preloader">
        <div class="loading">
          <img src="{{URL::to('assets/img/loader.gif')}}" width="300">
        </div>
    </div>

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: rgb(2, 59, 124);">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <div class="sidebar-brand-text mx-2">SiRentCar</div>
            </a>


            <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2" style="font-size: 15px;"></i>
                    <span>Dashboard</span></a>
            </li>


            <div class="sidebar-heading pt-3">
                Master Data
            </div>

            <li class="nav-item pb-0">
                <a class="nav-link {{ Route::is('role', 'users') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="bi bi-people-fill" style="font-size: 15px;"></i>
                    <span>Users</span>
                </a>
                <div id="collapseTwo" class="collapse {{ Route::is('role', 'users', 'add.users', 'up.users') ? 'show' : '' }}" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Mater Users :</h6>
                        <a class="collapse-item {{ Route::is('role') ? 'active' : '' }}" href="{{ route('role') }}">Manajemen Roles</a>
                        <a class="collapse-item {{ Route::is('users', 'add.users', 'up.users') ? 'active' : '' }}" href="{{ route('users') }}">Manajemen Users</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Route::is('kategori', 'add.kategori' ,'up.kategori', 'mobil', 'add.mobil','up.mobil') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#mastercar"
                    aria-expanded="true" aria-controls="mastercar">
                    <i class="bi bi-car-front-fill" style="font-size: 15px;"></i>
                    <span>Master Cars</span>
                </a>
                <div id="mastercar" class="collapse {{ Route::is('kategori', 'add.kategori' ,'up.kategori', 'mobil', 'add.mobil','up.mobil') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#mastercar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Master Cars:</h6>
                        <a class="collapse-item {{ Route::is('kategori', 'add.kategori','up.kategori') ? 'active' : '' }}" href="{{ route('kategori') }}">Kategori Kendaraan</a>
                        <a class="collapse-item {{ Route::is('mobil', 'add.mobil','up.mobil') ? 'active' : '' }}" href="{{ route('mobil') }}">Data Kendaraan</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ Route::is('pelanggan', 'add.pelanggan','up.pelanggan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pelanggan') }}">
                    <i class="bi bi-person-check" style="font-size: 15px;"></i>
                    <span>Profile Customer</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading pt-3">
                Data Transaksi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link {{ Route::is('transaksi.pendding') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#datatransaksi"
                    aria-expanded="true" aria-controls="datatransaksi">
                    <i class="bi bi-credit-card-fill" style="font-size: 15px;"></i>
                    <span>Transaksi Customer</span>
                </a>
                <div id="datatransaksi" class="collapse {{ Route::is('transaksi.pendding') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('transaksi.pendding') ? 'active' : '' }}" href="{{ route('transaksi.pendding') }}">Transaksi Pendding</a>
                        <a class="collapse-item" href="#">Transaksi Proses</a>
                        <a class="collapse-item" href="#">Transaksi Selesai</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Laporan Transaksi</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="#" style="font-size: 15px;">
                    <i class="bi bi-receipt"></i>
                    <span>Invoice Pelanggan</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <h6 class="mb-0"><i class="bi bi-calendar-fill"></i> {{ $today }}</h6>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->username }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ $usersprofile }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('up.profile', auth()->user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout" href="{{ route('posts.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SiRentCar 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.js')
</body>

</html>
