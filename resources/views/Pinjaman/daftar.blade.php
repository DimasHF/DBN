@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Pinjaman Semua Mitra</h3>
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
                                <th>
                                    <center>ID Mitra</center>
                                </th>
                                <th>
                                    <center>ID Pinjaman</center>
                                </th>
                                <th>
                                    <center>Status</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pinjaman as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                        <td>
                                            <center>{{ $t->id_mitra }}</center>
                                        </td>
                                    <td>
                                        <center>{{ $t->id_pinjaman }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 1)
                                                <a href="/admin/statuspinjaman/0/{{ $t->id_pinjaman }}">
                                                    <span class="btn btn-sm btn-success btn-icon-text">Sudah Kembali</span>
                                                </a>
                                            @elseif ($t->status == 0)
                                                <a href="/admin/statuspinjaman/1/{{ $t->id_pinjaman }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">Belum Kembali</span></a>
                                            @endif
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
