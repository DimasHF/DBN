@extends('index')
@section('content')
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Dokumen </h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th width="50px">
                                    <center>No</center>
                                </th>
                                <th width="200px">
                                    <center>ID Mitra</center>
                                </th>
                                <th width="200px">
                                    <center>ID Order</center>
                                </th>
                                <th>
                                    <center>Formulir</center>
                                </th>
                                <th>
                                    <center>KTP</center>
                                </th>
                                <th>
                                    <center>NPWP</center>
                                </th>
                                <th>
                                    <center>Akta</center>
                                </th>
                                <th>
                                    <center>Izin Pengelola Gedung</center>
                                </th>
                                <th width="200px">
                                    <center>Kirim Pesan</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($doc as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_order }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadform', $t->id_order) }}">Unduh Dokumen</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadktp', $t->id_order) }}">Unduh Dokumen</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadnpwp', $t->id_order) }}">Unduh Dokumen</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadakta', $t->id_order) }}">Unduh Dokumen</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadizp', $t->id_order) }}">Unduh Dokumen</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->statusorder == 1)
                                                <form action="/api/mitra/aktif/2/{{ $t->id_order }}" method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger btn-icon-text">Setuju
                                                        <i class="ti-alert btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @elseif ($t->statusorder == 2)
                                                <form action="/api/mitra/aktif/1/{{ $t->id_order }}" method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success btn-icon-text">Menjadi Mitra
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><br>
                <div class="d-flex justify-content-center">
                    {{-- {!! $po->links('pagination::bootstrap-4') !!} --}}
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
