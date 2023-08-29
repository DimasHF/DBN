@extends('index')
@section('content')
    <link href="{{ asset('assets/jquery-steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/jquery-steps/steps.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.min.css') }}">

    @php
        use App\Models\PurchaseOrder;
    @endphp
    {{-- Tittle --}}
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                @auth('mitra')
                    <h3 class="font-weight-bold">Welcome, {{ auth('mitra')->user()->nama }}</h3>
                @else
                    <h3 class="font-weight-bold">Who Are You?</h3>
                @endauth
            </div>
        </div>
    </div>

    {{-- Card Jam & Tanggal --}}
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card">
                    <div id="jam_aktif" class="card-body">
                        <center>
                            <label id="jam" class="fs-30 mb-2"></label> :
                            <label id="menit" class="fs-30 mb-2"></label> :
                            <label id="detik" class="fs-30 mb-2"></label>
                            <label id="pm_am" class="fs-30 mb-2"></label>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card">
                    <div id="tgl_hari_ini" class="card-body">
                        <?php
                        $tgl = date('Y-m-d');
                        function merubah_tanggal($tgl)
                        {
                            $bulan = [
                                1 => 'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember',
                            ];
                            $pecahkan = explode('-', $tgl);
                            return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
                        }
                        ?>
                        <center>
                            <label class="fs-30 mb-2"><?php echo merubah_tanggal($tgl); ?></label>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (PurchaseOrder::where('status', 1)->where(
                'id_mitra',
                auth()->guard('mitra')->user()->id_mitra)->exists())
        {{-- Card Informasi --}}
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <h3 class="mb-4">Jumlah Pelanggan</h3>
                            <p class="fs-30 mb-2">{{$pelanggan}}</p>
                            <p>Pelanggan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <h3 class="mb-4">Jumlah Layanan</h3>
                            <p class="fs-30 mb-2">{{$layanan}}</p>
                            <p>Layanan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (PurchaseOrder::where('status', 0)->where(
                'id_mitra',
                auth()->guard('mitra')->user()->id_mitra)->exists())
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <h3 class="mb-4">Informasi</h3>
                            <p class="fs-30 mb-2" style="font-size: 20px">Purchase Order Sudah Terkirim dan Dalam Proses Pemeriksaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (auth()->guard('mitra')->user()->status == 1)
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <h3 class="mb-4">Informasi</h3>
                            <p class="fs-30 mb-2" style="font-size: 20px">Akun Mitra Telah Disetujui, Silahkan Melakukan
                                Proses Dengan Mengirimkan Dokumen Yang Kami Berikan Pada Menu Purchase Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (auth()->guard('mitra')->user()->nik == null)
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <h3 class="mb-4">Informasi</h3>
                            <p class="fs-30 mb-2" style="font-size: 20px">Akun Mitra Berhasil Dibuat, Silahkan Lengkapi
                                Profil Untuk Melanjutkan Proses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (auth()->guard('mitra')->user()->status == 0)
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <h3 class="mb-4">Informasi</h3>
                            <p class="fs-30 mb-2" style="font-size: 20px">Akun Mitra Dalam Proses Pemeriksaan, Kami Akan
                                Menghubungi Melalui Nomer WhatsApp Yang Diberikan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        window.setTimeout("jam_aktif()", 1000);

        function jam_aktif() {
            var jam_aktif = new Date();
            setTimeout("jam_aktif()", 1000);
            var jam = jam_aktif.getHours();
            var menit = jam_aktif.getMinutes();
            var detik = jam_aktif.getSeconds();

            //AM/PM
            if (jam < 12) {
                document.getElementById("pm_am").innerHTML = 'AM';
            } else if (jam > 12) {
                document.getElementById("pm_am").innerHTML = 'PM';
            }

            //Jam
            if (jam == 0) {
                document.getElementById("jam").innerHTML = '0' + jam;
            } else if (jam < 10) {
                document.getElementById("jam").innerHTML = '0' + jam;
            } else if (jam == 10) {
                document.getElementById("jam").innerHTML = jam_aktif.getHours();
            } else if (jam > 10) {
                document.getElementById("jam").innerHTML = jam_aktif.getHours();
            }

            //MENIT
            if (menit == 0) {
                document.getElementById("menit").innerHTML = '0' + menit;
            } else if (menit < 10) {
                document.getElementById("menit").innerHTML = '0' + menit;
            } else if (menit == 10) {
                document.getElementById("menit").innerHTML = jam_aktif.getMinutes();
            } else if (menit > 10) {
                document.getElementById("menit").innerHTML = jam_aktif.getMinutes();
            }

            //DETIK
            if (detik == 0) {
                document.getElementById("detik").innerHTML = '0' + detik;
            } else if (detik < 10) {
                document.getElementById("detik").innerHTML = '0' + detik;
            } else if (detik == 10) {
                document.getElementById("detik").innerHTML = jam_aktif.getSeconds();
            } else if (detik > 10) {
                document.getElementById("detik").innerHTML = jam_aktif.getSeconds();
            }
        }
    </script>
@endsection
