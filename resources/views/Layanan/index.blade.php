@extends('index')
@section('content')
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        @if (auth()->guard('admin')->check() ||
                                auth()->guard('staff')->check())
                            <h3 class="font-weight-bold">List Layanan Semua Mitra</h3>
                        @elseif(auth()->guard('mitra')->check())
                            <h3 class="font-weight-bold">List Layanan</h3>
                        @endif
                    </div>
                    @if (auth()->guard('mitra')->check())
                        <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-outline-primary btn-rounded btn-icon tambah"
                                data-target="#modal" data-toggle="modal">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    @endif
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th style="display: none">
                                    <center>ID Layanan</center>
                                </th>
                                @if (auth()->guard('admin')->check())
                                    <th>
                                        <center>ID Mitra</center>
                                    </th>
                                @endif
                                <th>
                                    <center>Nama Layanan</center>
                                </th>
                                <th>
                                    <center>Bandwidth</center>
                                </th>
                                <th>
                                    <center>Harga</center>
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
                            @foreach ($layanan as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td style="display: none">
                                        <center>{{ $t->id_layanan }}</center>
                                    </td>
                                    @if (auth()->guard('admin')->check())
                                        <td>
                                            <center>{{ $t->id_mitra }}</center>
                                        </td>
                                    @endif
                                    <td>
                                        <center>{{ $t->nama_lay }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->bandwidth }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->harga }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->statuslay == 1)
                                                <a href="statuslay/0/{{ $t->id_layanan }}">
                                                    <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                                </a>
                                            @elseif ($t->statuslay == 0)
                                                <a href="statuslay/1/{{ $t->id_layanan }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('mitra.edit.layanan', $t->id_layanan) }}"
                                                class="btn btn-sm btn-info btn-icon-text edit">
                                                Edit
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
                    {{-- {!! $pelanggan->links('pagination::bootstrap-4') !!} --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Layanan</h4>
                </div>
                <form class="forms-sample" action="{{ route('mitra.tambah.layanan') }}" method="POST">
                    <input type="hidden" name="ver" id="ver" value="0">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nama">Nama Layanan</label>
                                    <input type="text" class="form-control" id="nama_lay" name="nama_lay"
                                        placeholder="Nama Layanan">
                                </div>
                                <div class="form-group">
                                    <label for="bandwidth">Bandwidth</label>
                                    <input type="text" class="form-control" id="bandwidth" name="bandwidth"
                                        placeholder="Bandwidth">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                        placeholder="Harga">
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="reset" class="btn btn-outline-secondary" value="Reset">&nbsp;&nbsp;
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--JS Modal-->
    @push('page-script')
        <script>
            $(document).ready(function() {
                $('.tambah').on('click', function() {
                    $('#tambah').modal('show');
                    $('ver').val('0');
                });
            });
        </script>
        <script>
            @if (auth()->guard('mitra')->check())
                $(document).ready(function() {
                    $('#datatable').DataTable();
                });
            @else
                var groupColumn = 2;
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
                                            '<tr class="group"><td colspan="6">' +
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
