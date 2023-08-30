@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        @if (auth()->guard('admin')->check() ||
                                auth()->guard('staff')->check())
                            <h3 class="font-weight-bold">Rekap Transaksi Semua Mitra</h3>
                        @elseif(auth()->guard('mitra')->check())
                            <h3 class="font-weight-bold">Rekap Transaksi</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                @if (auth()->guard('admin')->check() ||
                                        auth()->guard('staff')->check())
                                    <th>
                                        <center>ID Mitra</center>
                                    </th>
                                @endif
                                <th>
                                    <center>ID Transaksi</center>
                                </th>
                                <th>
                                    <center>Tanggal</center>
                                </th>
                                <th>
                                    <center>Total</center>
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
                            @foreach ($transaksi as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    @if (auth()->guard('admin')->check() ||
                                            auth()->guard('staff')->check())
                                        <td>
                                            <center>{{ $t->id_mitra }}</center>
                                        </td>
                                    @endif
                                    <td>
                                        <center>{{ $t->id_transaksi }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->tanggal }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->total }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="/mitra/transaksi/detail/{{ $t->id_transaksi }}">
                                                <span class="btn btn-sm btn-primary btn-icon-text">Detail</span>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><br>
                <div class="d-flex justify-content-center">
                    {{-- {!! $pelanggan->links('pagination::bootstrap-4') !!} --}}
                </div>
            </div>
        </div>
    </div>

    <!--JS Modal-->
    @push('page-script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
@endsection