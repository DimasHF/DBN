@extends('index')
@section('content')
    {{-- Button Print --}}
    <div class="row">
        <div class="col-md-6 d-grid gap-2 d-md-flex">
            <a href="{{ url()->previous() }}" class="btn btn-info btn-icon-text">
                Kembali
                <i class="ti-arrow-left btn-icon-append"></i>
            </a>
        </div>

        <div class="col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
            <button id="print-button" class="btn btn-warning btn-icon-text">
                Print
                <i class="ti-printer btn-icon-append"></i>
            </button>
        </div>
    </div>

    <div class="row justify-content-center">
        <div id="print_out" class="col-md-6 stretch-card grid-margin ">
            <div class="card ">
                <div class="card-body">
                    <p>
                        <center><b>{{ $detail->id_laypel }}</b></center>
                    </p><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>ID Pelanggan : {{ $detailpelanggan->id_pelanggan }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Nama Pelanggan : {{ $detailpelanggan->nama_pel }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>ID Mitra &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                {{ $detailpelanggan->id_mitra }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Nama Mitra &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                {{ $detailpelanggan->nama_mitra }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Daftar Layanan</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{-- <label class="col-sm-3">Barang :</label> --}}
                            @php
                                $no = 1;
                            @endphp

                            <table class="col-md-12" border="1px">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center>Nama Layanan</center>
                                        </th>
                                        <th>
                                            <center>Harga</center>
                                        </th>
                                        <th>
                                            <center>Biaya</center>
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($detaillayanan as $r)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <center>{{ $no++ }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->nama_lay }}</center>
                                            </td>
                                            <td>
                                                <center>Rp. {{ number_format($r->harga, 0, ',', '.') }}</center>
                                            </td>
                                            <td>
                                                <center>Rp. {{ number_format($r->subtotal, 0, ',', '.') }}</center>
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <center>Total</center>
                                            </td>
                                            <td>
                                                <center>Rp. {{ number_format($r->subtotal, 0, ',', '.') }}</center>
                                            </td>
                                        </tr>
                                    </tfoot>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                $("#print-button").click(function() {
                    var printContents = document.getElementById("print_out").innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                });
            });
        </script>
    @endpush
@endsection
