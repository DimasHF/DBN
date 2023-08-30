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
                                    <center>Detail</center>
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
                                            <a href="{{ route('admin.pinjaman.detail', $t->id_pinjaman) }}">
                                                <span class="btn btn-sm btn-primary btn-icon-text">Detail</span>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 1)
                                                <a>
                                                    <span class="btn btn-sm btn-success btn-icon-text">Sudah Kembali</span>
                                                </a>
                                            @elseif ($t->status == 0)
                                                <a href="/admin/pinjaman/1/{{ $t->id_pinjaman }}"><span
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
@if (auth()->guard('mitra')->check())
                $(document).ready(function() {
                    $('#datatable').DataTable();
                });
            @else
                var groupColumn = 1;
                var table = $('#datatable').DataTable({
                    columnDefs: [{
                        visible: false,
                        targets: groupColumn
                    }],
                    order: [
                        [groupColumn, 'asc']
                    ],
                    displayLength: 25,
                    drawCallback: function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                                page: 'current'
                            })
                            .data()
                            .each(function(group, i) {
                                if (last !== group) {
                                    $(rows)
                                        .eq(i)
                                        .before(
                                            '<tr class="group"><td colspan="5">' +
                                            group +
                                            '</td></tr>'
                                        );

                                    last = group;
                                }
                            });
                    }
                });

                // Order by the grouping
                $('#datatable tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
            @endif
        </script>
    @endpush
@endsection
