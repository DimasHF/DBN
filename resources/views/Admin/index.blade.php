@extends('index')
@section('content')
    {{-- Tittle --}}
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                @auth('admin')
                    <h3 class="font-weight-bold">Welcome, {{ auth('admin')->user()->nama }}</h3>
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

    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <h3 class="mb-4">Jumlah Mitra</h3>
                        <p class="fs-30 mb-2">10</p>
                        <p>Mitra</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <h3 class="mb-4">Jumlah Semua Pelanggan</h3>
                        <p class="fs-30 mb-2">1111</p>
                        <p>Pelanggan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel mitra --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Mitra</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>ID Mitra</center>
                                </th>
                                <th>
                                    <center>Nama Mitra</center>
                                </th>
                                <th>
                                    <center>SPK</center>
                                </th>
                                <th>
                                    <center>Status</center>
                                </th>
                                <th>
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($mitra as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_mitra }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.spk', $t->id_mitra) }}"
                                                class="btn btn-sm btn-info btn-icon-text edit">
                                                Buat SPK
                                                <i class="ti-file btn-icon-append"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 0)
                                                <form action="/api/mitra/konfimasi/1/{{ $t->id_mitra }}" method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger btn-icon-text">Konfirmasi
                                                        <i class="ti-alert btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @elseif ($t->status == 1)
                                                <form action="/api/mitra/konfimasi/0/{{ $t->id_mitra }}" method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success btn-icon-text">Menjadi Mitra
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.mitra.detail', $t->id_mitra) }}"
                                                class="btn btn-sm btn-info btn-icon-text edit">
                                                View Detail
                                                <i class="ti-file btn-icon-append"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><br>
                <div class="d-flex justify-content-center">
                    {!! $mitra->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>

    <!--JS Modal-->
    @push('page-script')
        <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>

        <!--JS Jam & Tanggal-->
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
    @endpush
@endsection
