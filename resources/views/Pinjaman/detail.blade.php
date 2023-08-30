@extends('index')
@section('content')
    {{-- Button Print --}}
    <div class="row">
        <div class="col-md-6 d-grid gap-2 d-md-flex">
            <a href="{{url()->previous()}}" class="btn btn-info btn-icon-text">
                Kembali
                <i class="ti-arrow-left btn-icon-append"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div id="print_out" class="col-md-6 stretch-card grid-margin ">
            <div class="card ">
                <div class="card-body">
                    <p>
                        <center><b>{{ $pinjaman->id_pinjaman }}</b></center>
                    </p><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>ID Mitra &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                {{ $pinjaman->id_mitra }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Nama Mitra &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                {{ $pinjaman->nama }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Daftar Barang</p>
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
                                            <center>ID Barang</center>
                                        </th>
                                        <th>
                                            <center>Nama Barang</center>
                                        </th>
                                        <th>
                                            <center>Jumlah</center>
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($detail as $r)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <center>{{ $no++ }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->id_barang }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->nama_bar }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->jumlah }}</center>
                                            </td>

                                        </tr>

                                    </tbody>
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
