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
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/dashboard.css') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <style>
        .btn-icon a:visited {
            text-decoration: none;
            color: black;
            /* Ganti dengan warna teks yang Anda inginkan */
        }

        #preloader {
            background: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 9999;
            opacity: 1;
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #9370DB;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #BA55D3;
            -webkit-animation: spin 3s linear infinite;
            animation: spin 3s linear infinite;
        }

        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #FF00FF;
            -webkit-animation: spin 1.5s linear infinite;
            animation: spin 1.5s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    @php
        use App\Models\PurchaseOrder;
    @endphp
</head>

<body>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{ asset('assets/images/plant.png') }}"
                        class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img
                        src="{{ asset('assets/images/plant.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <i class="icon-head mx-0"></i>
                        </a>
                        {{-- Logout --}}
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="ti-arrow-circle-down text-primary"></i>
                                Log Out
                            </a>
                        </div>
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
                    @if (auth()->guard('admin')->check())
                        <li class="nav-header">Admin</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <i class="ti-home menu-icon"></i>
                                <span class="menu-title">Dashboard Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.purchase') }}">
                                <i class="ti-clipboard menu-icon"></i>
                                <span class="menu-title">Purchase Order</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.pelanggan.aktif') }}">
                                <i class="ti-world menu-icon"></i>
                                <span class="menu-title">Layanan Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#data_admin" aria-expanded="false"
                                aria-controls="data_admin">
                                <i class="ti-files menu-icon"></i>
                                <span class="menu-title">Data Admin</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="data_admin">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.spk') }}">Data SPK</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.spk') }}">Data BA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.pelanggan') }}">Data Pelanggan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.layanan') }}">Data Layanan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.mitra') }}">Data Mitra</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#databarang" aria-expanded="false"
                                aria-controls="databarang">
                                <i class="ti-package menu-icon"></i>
                                <span class="menu-title">Barang</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="databarang">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.barang') }}">Kelola Barang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.pinjaman') }}">Peminjaman</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#admintagihan" aria-expanded="false"
                                aria-controls="admintagihan">
                                <i class="ti-wallet menu-icon"></i>
                                <span class="menu-title">Tagihan</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="admintagihan">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link">Tagihan Mitra</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.cetak.tagihan') }}">Tagihan
                                            Pelanggan</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#adminrekap" aria-expanded="false"
                                aria-controls="adminrekap">
                                <i class="ti-receipt menu-icon"></i>
                                <span class="menu-title">Rekap Admin</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="adminrekap">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link">Tagihan Mitra</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.cetak.tagihan.index') }}">Tagihan
                                            Pelanggan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.rekap.pinjaman') }}">Peminjaman</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @elseif(auth()->guard('mitra')->check())
                        <li class="nav-header">Mitra</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mitra.index') }}">
                                <i class="ti-home menu-icon"></i>
                                <span class="menu-title">Dashboard Mitra</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mitra.profil') }}">
                                <i class="ti-user menu-icon"></i>
                                <span class="menu-title">Profil Mitra</span>
                            </a>
                        </li>
                        @if (auth()->guard('mitra')->user()->statusmitra == 1)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#purchase_order"
                                    aria-expanded="false" aria-controls="purchase_order">
                                    <i class="ti-clipboard menu-icon"></i>
                                    <span class="menu-title">Purchase Order</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="purchase_order">
                                    <ul class="nav flex-column sub-menu">
                                        @if (
                                            !PurchaseOrder::where('statuspo', 1)->where(
                                                    'id_mitra',
                                                    auth()->guard('mitra')->user()->id_mitra)->exists())
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('mitra.po') }}">Kirim Dokumen</a>
                                            </li>
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('mitra.spk') }}">SPK</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">BA</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (PurchaseOrder::where('statuspo', 1)->where(
                                    'id_mitra',
                                    auth()->guard('mitra')->user()->id_mitra)->exists())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#mitra" aria-expanded="false"
                                    aria-controls="mitra">
                                    <i class="ti-file menu-icon"></i>
                                    <span class="menu-title">Data Mitra</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="mitra">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('mitra.pelanggan') }}">List Pelanggan</a>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('mitra.layanan') }}">List Layanan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#layanan" aria-expanded="false"
                                    aria-controls="layanan">
                                    <i class="ti-desktop menu-icon"></i>
                                    <span class="menu-title">Layanan Aktif</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="layanan">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('mitra.pelanggan.aktif') }}">Pelanggan Aktif</a>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('mitra.cetak.tagihan') }}">Cek Tagihan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#peminjaman_barang"
                                    aria-expanded="false" aria-controls="peminjaman_barang">
                                    <i class="ti-package menu-icon"></i>
                                    <span class="menu-title">Peminjaman Barang</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="peminjaman_barang">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('mitra.pinjaman') }}">Pinjam Barang</a>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('mitra.barang') }}">List Barang</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#mitrarekap" aria-expanded="false"
                                    aria-controls="mitrarekap">
                                    <i class="ti-receipt menu-icon"></i>
                                    <span class="menu-title">Rekap Mitra</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="mitrarekap">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('mitra.transaksi') }}">Transaksi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('mitra.rekap.tagihan') }}">Tagihan
                                                Pelanggan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('mitra.rekap.pinjaman') }}">Peminjaman</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mitra.cetak.tagihan.index') }}">
                                    <i class="ti-printer menu-icon"></i>
                                    <span class="menu-title">Cetak Tagihan</span>
                                </a>
                            </li>
                        @endif
                    @elseif(auth()->guard('staff')->check())
                        <li class="nav-header">Staff</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('staff.index') }}">
                                <i class="ti-home menu-icon"></i>
                                <span class="menu-title">Dashboard Staff</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#staff" aria-expanded="false"
                                aria-controls="staff">
                                <i class="icon-columns menu-icon"></i>
                                <span class="menu-title">Data</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="staff">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="/">List Pelanggan</a></li>
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
                                    <li class="nav-item"> <a class="nav-link" href="/">Tagihan Pelanggan</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link" href="/">Tagihan Mitra</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="/">Peminjaman Barang</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
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
                @if (auth()->guard('admin')->check())
                    <div class="modal-body">Are You Sure To Logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('admin.logout') }}">Logout</a>
                    </div>
                @elseif(auth()->guard('mitra')->check())
                    <div class="modal-body">Are You Sure To Logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('mitra.logout') }}">Logout</a>
                    </div>
                @elseif(auth()->guard('staff')->check())
                    <div class="modal-body">Are You Sure To Logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('staff.logout') }}">Logout</a>
                    </div>
                @endif
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
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <!-- JS MODAL -->
    @stack('page-script')
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sembunyikan preloader dan perlihatkan konten
            var preloader = document.querySelector("#preloader");
            preloader.style.display = "none";

            // Ganti kelas body untuk mengubah latar belakang atau menyembunyikan konten
            document.body.classList.remove("preloader-active");
        });
    </script>

</body>

</html>
