<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DBN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- logo Atas Web -->
    <link rel="shortcut icon" href="{{ asset('assets/images/plant.png') }}" />
    {{-- DATATABLES --}}
    <link rel="stylesheet" href="{{ asset('assets/table/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
    <link href="{{ asset('assets/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            {{-- <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{ asset('assets/images/plant.png') }}"
                        class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('assets/images/plant.png') }}"
                        alt="logo" /></a>
            </div> --}}
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <i class="icon-head mx-0"></i>
                        </a>
                        @auth
                            {{-- Logout --}}
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="ti-arrow-circle-down text-primary"></i>
                                    Log Out
                                </a>
                            </div>
                        @else
                            {{-- Login --}}
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="/login">
                                    <i class="ti-arrow-circle-down text-primary"></i>
                                    Log In
                                </a>
                            </div>
                        @endauth
                    </li>
                    {{-- Responsive --}}
                    <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="#">
                            <i class="icon-ellipsis"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    {{-- @if(auth()->guard('admin')->check()) --}}
                    <li class="nav-header">Admin</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.index')}}">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Dashboard Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="route('po')">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Purchase Order</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.pelanggan')}}">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Pelanggan Aktif</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#list" aria-expanded="false"
                            aria-controls="list">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="list">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/">List Pelanggan</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">List Layanan</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">List Mitra</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">List Pinjaman</a></li>
                            </ul>
                        </div>
                    </li>
                    {{-- @elseif(auth()->guard('mitra')->check()) --}}
                    <li class="nav-header">Mitra</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mitra.index')}}">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Dashboard Mitra</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Purchase Order</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mitra.pelanggan')}}">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Pelanggan Aktif</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Peminjaman Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#list" aria-expanded="false"
                            aria-controls="list">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="list">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('mitra.pelanggan')}}">List Pelanggan</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">List Layanan</a></li>
                            </ul>
                        </div>
                    </li>
                    {{-- @elseif(auth()->guard('staff')->check()) --}}
                    <li class="nav-header">Staff</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('staff.index')}}">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Dashboard Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#list" aria-expanded="false"
                            aria-controls="list">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="list">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('staff.pelanggan')}}">List Pelanggan</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">List Layanan</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">List Pinjaman</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Kelola Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false"
                            aria-controls="laporan">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Laporan</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="laporan">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/">Tagihan Pelanggan</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">Tagihan Mitra</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/">Peminjaman Barang</a></li>
                            </ul>
                        </div>
                    </li>
                    {{-- @endif --}}
                    {{-- @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Kelola Barang</span>
                        </a>
                    </li>
                    @endguest --}}
                </ul>
                <!-- End Sidebar -->
            </nav>
            <!-- Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are You Sure To Logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/jqueryui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/table/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <!-- JS MODAL -->
    @stack('page-script')
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
</body>

</html>
