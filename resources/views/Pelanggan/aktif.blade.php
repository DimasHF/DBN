@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        @if (auth()->guard('admin')->check() ||
                                auth()->guard('staff')->check())
                            <h3 class="font-weight-bold">List Pelanggan Semua Mitra</h3>
                        @elseif(auth()->guard('mitra')->check())
                            <h3 class="font-weight-bold">List Pelanggan Aktif</h3>
                        @endif
                    </div>
                    @if (auth()->guard('mitra')->check())
                        <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-outline-primary btn-rounded btn-icon">
                                <a href="{{ route('mitra.laypel') }}">
                                    <i class="ti-plus"></i>
                                </a>
                            </button>
                        </div>
                    @endif
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
                                    <center>ID Layanan Pelanggan</center>
                                </th>
                                <th>
                                    <center>ID Pelanggan</center>
                                </th>
                                <th>
                                    <center>Nama Pelanggan</center>
                                </th>
                                <th>
                                    <center>Tagihan</center>
                                </th>
                                <th>
                                    <center>Aksi</center>
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
                                        <center>{{ $t->id_laypel }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_pelanggan }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama_pel }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="/mitra/laypel/detail/{{ $t->id_laypel }}">
                                                <span class="btn btn-sm btn-primary btn-icon-text">Liat Tagihan</span>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a class="btn btn-sm btn-info btn-icon-text bayarmodal" data-toggle="modal"
                                                value="{{ $t->id_laypel }}" data-target="#modal">
                                                Bayar
                                                <i class="ti-money btn-icon-append"></i>
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

    <div class="modal fade" id="bayarmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Tagihan</h4>
                </div>
                <form action="{{ route('mitra.tagihan.bayar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" id="daysLateInput">
                                    <div class="form-group">
                                        <label for="id_laypel">ID Layanan Pelanggan</label>
                                        <input type="text" class="form-control" id="id_laypel" name="id_laypel" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_pelanggan">ID Pelanggan</label>
                                        <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pel">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="nama_pel" name="nama_pel" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_deadline">Tanggal Jatuh Tempo</label>
                                        <input type="text" class="form-control" id="tanggal_deadline"
                                            name="tanggal_deadline" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="pajak">Pajak</label>
                                        <input type="text" class="form-control" id="pajak" name="pajak" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="telat">Telat</label>
                                        <input type="text" class="form-control" id="telat" name="telat" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="bayar">Bayar</label>
                                        <input type="text" class="form-control" id="bayar" name="bayar">
                                    </div>
                                </div>
                                <span id="taskError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-user btn-block" id="tambah" type="submit">Save</button>
                        <button class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--JS Modal-->
    @push('page-script')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.bayarmodal', function() {

                    var id = $(this).attr('value');
                    $('#bayarmodal').modal('show');

                    $.ajax({
                        type: 'GET',
                        url: '/mitra/tagihan/bayar/' + id,
                        success: function(response) {
                            // console.log(response);
                            $('#id_laypel').val(response.bayar.id_laypel);
                            $('#id_pelanggan').val(response.bayar.id_pelanggan);
                            $('#nama_pel').val(response.bayar.nama_pel);
                            $('#tanggal_deadline').val(response.bayar.tanggal_bayar);
                            $('#pajak').val(response.bayar.pajak);

                            var tanggalBayar = new Date();
                            var tanggalDeadline = new Date(response.bayar.tanggal_bayar);
                            var timeDifference = tanggalBayar - tanggalDeadline;
                            var daysLate = timeDifference / (1000 * 60 * 60 * 24);
                            var roundedDaysLate = Math.floor(daysLate);
                            var modifiedText = roundedDaysLate.toString().replace(/-/, '');

                            console.log(modifiedText);
                            $('#telat').val(modifiedText);
                            $('#bayar').val(response.bayar.total);
                        }
                    })
                })
            })
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
