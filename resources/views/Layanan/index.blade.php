@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Layanan</h3>
                    </div>
                    <!--Button Modal-->
                    <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                        <a type="button" class="btn btn-primary" href="{{ route('mitra.form.layanan') }}">Tambahkan Layanan</a>
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
                                <th style="display: none;">
                                    <center>ID Layanan</center>
                                </th>
                                <th>
                                    <center>Nama Layanan</center>
                                </th>
                                <th>
                                    <center>Bandwidth</center>
                                </th>
                                <th>
                                    <center>harga</center>
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
                            @forelse ($layanan as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td style="display: none;">
                                        <center>{{ $t->id_layanan }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->bandwidth }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->harga }}</center>
                                    </td>
                                    <td>
                                        <center><img src="images/" alt=""></center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 1)
                                                <a href="/status/0/{{ $t->id_layanan }}">
                                                    <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                                </a>
                                            @elseif ($t->status == 0)
                                                <a href=" /status/1/{{ $t->id_layanan }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a onclick="javascript:void(0)" data-id="{{ $t->id_barang }}"
                                                class="btn btn-sm btn-info btn-icon-text edit">
                                                Edit
                                                <i class="ti-file btn-icon-append"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <center>Belum Ada Data</center>
                                    </td>
                                </tr>
                            @endforelse
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
            function hanyaAngka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                    return false;
                return true;
            }
        </script>

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
    @endpush
@endsection
