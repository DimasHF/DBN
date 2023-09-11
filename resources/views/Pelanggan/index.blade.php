@extends('index')
@section('content')
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-xl-8 mb-4 mb-xl-0">
                        @if (auth()->guard('admin')->check() ||
                                auth()->guard('staff')->check())
                            <h3 class="font-weight-bold">List Pelanggan Semua Mitra</h3>
                        @elseif(auth()->guard('mitra')->check())
                            <h3 class="font-weight-bold">List Pelanggan</h3>
                        @endif
                    </div>
                    @if (auth()->guard('mitra')->check())
                        <!--Button Modal-->
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
                                @if (auth()->guard('admin')->check() ||
                                        auth()->guard('staff')->check())
                                    <th>
                                        <center>ID Mitra</center>
                                    </th>
                                @endif
                                <th>
                                    <center>ID Pelanggan</center>
                                </th>
                                <th>
                                    <center>Nama Pelanggan</center>
                                </th>
                                @if (auth()->guard('mitra')->check())
                                    <th>
                                        <center>Status</center>
                                    </th>
                                    <th>
                                        <center>Action</center>
                                    </th>
                                @endif
                                <th>
                                    <center>Detail</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pelanggan as $t)
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
                                        <center>{{ $t->id_pelanggan }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama_pel }}</center>
                                    </td>
                                    @if (auth()->guard('mitra')->check())
                                        <td>
                                            <center>
                                                @if ($t->statuspel == 1)
                                                    <a href="pelanggan/0/{{ $t->id_pelanggan }}">
                                                        <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                                    </a>
                                                @elseif ($t->statuspel == 0)
                                                    <a href="pelanggan/1/{{ $t->id_pelanggan }}"><span
                                                            class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                                @endif
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="{{ route('mitra.edit.pelanggan', $t->id_pelanggan) }}"
                                                    class="btn btn-sm btn-info btn-icon-text edit">
                                                    Edit
                                                    <i class="ti-file btn-icon-append"></i>
                                                </a>
                                            </center>
                                        </td>
                                    @endif
                                    <td>
                                        <center>
                                            @if (auth()->guard('mitra')->check())
                                                <a href="{{ route('mitra.detail.pelanggan', $t->id_pelanggan) }}"
                                                    class="btn btn-sm btn-warning btn-icon-text">
                                                @elseif (auth()->guard('admin')->check())
                                                    <a href="{{ route('admin.detail.pelanggan', $t->id_pelanggan) }}"
                                                        class="btn btn-sm btn-warning btn-icon-text">
                                                    @elseif (auth()->guard('staff')->check())
                                                        <a href="{{ route('staff.detail.pelanggan', $t->id_pelanggan) }}"
                                                            class="btn btn-sm btn-warning btn-icon-text">
                                            @endif
                                            Detail
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

    @if (auth()->guard('mitra')->check())
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pelanggan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="forms-sample" method="post" action="{{ route('mitra.tambah.pelanggan') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="nama_pel" name="nama_pel"
                                            placeholder="Nama Pelanggan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Pelanggan</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Alamat Pelanggan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Pelanggan</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email Pelanggan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No. Telp</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input type="tel" pattern="[0-9]*" class="form-control" id="no_telp"
                                                name="no_telp" placeholder="No. Telp" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="npwp">NPWP Pelanggan</label>
                                        <input type="text" class="form-control" id="npwp" name="npwp"
                                            placeholder="NPWP Pelanggan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK Pelanggan</label>
                                        <input type="text" pattern="[0-9]*" class="form-control" id="nik"
                                            name="nik" placeholder="NIK Pelanggan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Pelanggan</label>
                                        <input type="file" name="foto" id="foto" class="file-upload-default"
                                            accept=".jpg, .jpeg, .png">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                id="imageInput" placeholder="Upload Foto">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                    type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <input type="reset" class="btn btn-outline-secondary"
                                            value="Reset">&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!--JS Modal-->
    @push('page-script')
        <script>
            $(document).ready(function() {
                $('.tambah').on('click', function() {
                    $('#tambah').modal('show');
                });

            });
        </script>
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
                                            '<tr class="group"><td colspan="4">' +
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
