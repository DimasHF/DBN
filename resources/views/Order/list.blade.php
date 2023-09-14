@extends('index')
@section('content')
    @php
        use App\Models\Order;
    @endphp
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        @if (auth()->guard('admin')->check() ||
                                auth()->guard('staff')->check())
                            <h3 class="font-weight-bold">List Order Semua Mitra</h3>
                        @elseif(auth()->guard('mitra')->check())
                            <h3 class="font-weight-bold">List Order</h3>
                        @endif
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>ID Order</center>
                                </th>
                                @if (auth()->guard('admin')->check())
                                    <th>
                                        <center>ID Mitra</center>
                                    </th>
                                @endif
                                <th>
                                    <center>Bandwidth</center>
                                </th>
                                <th>
                                    <center>Harga</center>
                                </th>
                                <th width="200px">
                                    <center>Status</center>
                                </th>
                                <th width="200px">
                                    <center>Action</center>
                                </th>
                                @if (Auth::guard('mitra')->check())
                                    <th width="200px">
                                        <center>Mitra</center>
                                    </th>
                                @else
                                    <th width="200px">
                                        <center>Admin</center>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($order as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_order }}</center>
                                    </td>
                                    @if (auth()->guard('admin')->check())
                                        <td>
                                            <center>{{ $t->id_mitra }}</center>
                                        </td>
                                    @endif
                                    <td>
                                        <center>{{ $t->bandwidth }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->harga }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->statusorder == 2)
                                                <span class="btn btn-sm btn-success btn-icon-text">
                                                    Order Dikonfirmasi
                                                    <i class="ti-check btn-icon-append"></i>
                                                </span>
                                            @elseif ($t->statusorder == 1 && $t->statusmitra == 2 && $t->statusadmin == 2)
                                                <span class="btn btn-sm btn-warning btn-icon-text">
                                                    Order Diterima. Menunggu Dokumen
                                                </span>
                                            @elseif ($t->statusorder == 0)
                                                <span class="btn btn-sm btn-danger btn-icon-text">Dalam
                                                    Pertimbangan</span>
                                            @endif
                                        </center>
                                    </td>
                                    @if (Auth::guard('mitra')->check())
                                        <td>
                                            <center>
                                                @if ($t->statusmitra == 0 && $t->statusadmin == 1)
                                                    <a class="btn btn-sm btn-info btn-icon-text nego" data-toggle="modal"
                                                        value="{{ $t->id_order }}" data-target="#modal">
                                                        Nego Harga
                                                        <i class="ti-money btn-icon-append"></i>
                                                    </a>
                                                @elseif ($t->statusmitra == 1 && $t->statusadmin == 0)
                                                    <span class="btn btn-sm btn-success btn-icon-text">
                                                        Order Dikonfirmasi
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </span>
                                                @elseif ($t->statusorder == 1)
                                                    <span class="btn btn-sm btn-success btn-icon-text">
                                                        Order Dikonfirmasi
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </span>
                                                @elseif ($t->statusmitra == 1 && $t->statusadmin == 2)
                                                    <a class="btn btn-sm btn-success btn-icon-text confirm"
                                                        data-toggle="modal" value="{{ $t->id_order }}"
                                                        data-target="#modal">
                                                        Admin Setuju Harga
                                                        <i class="ti-money btn-icon-append"></i>
                                                    </a>
                                                @elseif ($t->statusmitra == 2)
                                                    <span class="btn btn-sm btn-warning btn-icon-text">
                                                        Menunggu Konfirmasi Admin
                                                    </span>
                                                @elseif ($t->statusmitra == 2 && $t->statusadmin == 2)
                                                    <span class="btn btn-sm btn-success btn-icon-text">
                                                        Menunggu Form Subs
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </span>
                                                @endif
                                            </center>
                                        </td>
                                    @else
                                        <td>
                                            <center>
                                                @if ($t->statusmitra == 1 && $t->statusadmin == 0)
                                                    <a class="btn btn-sm btn-info btn-icon-text nego" data-toggle="modal"
                                                        value="{{ $t->id_order }}" data-target="#modal">
                                                        Nego Harga
                                                        <i class="ti-money btn-icon-append"></i>
                                                    </a>
                                                @elseif ($t->statusmitra == 0 && $t->statusadmin == 1)
                                                    <span class="btn btn-sm btn-success btn-icon-text">
                                                        Order Dikonfirmasi
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </span>
                                                @elseif ($t->statusorder == 1)
                                                    <span class="btn btn-sm btn-success btn-icon-text">
                                                        Order Dikonfirmasi
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </span>
                                                @elseif ($t->statusmitra == 2 && $t->statusadmin == 1)
                                                    <a class="btn btn-sm btn-success btn-icon-text confirm"
                                                        data-toggle="modal" value="{{ $t->id_order }}"
                                                        data-target="#modal">
                                                        Mitra Setuju Harga
                                                        <i class="ti-money btn-icon-append"></i>
                                                    </a>
                                                @elseif ($t->statusadmin == 2 && $t->statusmitra == 2)
                                                    <a class="btn btn-sm btn-success btn-icon-text cetak"
                                                        data-toggle="modal" value="{{ $t->id_order }}"
                                                        data-target="#modal">
                                                        Cetak Form Subs
                                                        <i class="ti-money btn-icon-append"></i>
                                                    </a>
                                                @elseif ($t->statusadmin == 2)
                                                    <span class="btn btn-sm btn-warning btn-icon-text">
                                                        Menunggu Konfirmasi Mitra
                                                    </span>
                                                @endif
                                            </center>
                                        </td>
                                    @endif
                                    @if (($t->statusorder == 0 && $t->statusmitra == 0) || $t->statusadmin == 0)
                                        <td>
                                            <center>
                                                <a class="btn btn-sm btn-success btn-icon-text confirm" data-toggle="modal"
                                                    value="{{ $t->id_order }}" data-target="#modal">
                                                    Setuju Harga
                                                    <i class="ti-money btn-icon-append"></i>
                                                </a>
                                            </center>
                                        </td>
                                    @elseif ($t->statusorder == 1)
                                        <td>
                                            <center>
                                                @if (Auth::guard('admin')->check())
                                                    <a href="{{ route('admin.order.form') }}"
                                                        class="btn btn-sm btn-info btn-icon-text edit">
                                                    @elseif(Auth::guard('staff')->check())
                                                        <a href="{{ route('staff.order.form') }}"
                                                            class="btn btn-sm btn-info btn-icon-text edit">
                                                        @elseif(Auth::guard('mitra')->check())
                                                            <a href="{{ route('mitra.order.form') }}"
                                                                class="btn btn-sm btn-info btn-icon-text edit">
                                                @endif
                                                Cetak Form Berlangganan
                                                <i class="ti-file btn-icon-append"></i>
                                                </a>
                                            </center>
                                        </td>
                                    @elseif ($t->statusmitra == 2 || $t->statusadmin == 2)
                                        <td>
                                            <center>
                                                <span class="btn btn-sm btn-warning btn-icon-text">
                                                    Menunggu Konfirmasi
                                                </span>
                                            </center>
                                        </td>
                                    @endif
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
    @if (Order::count() > 0)
        <div class="modal fade" id="nego" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nego Harga</h4>
                    </div>
                    @if (Auth::guard('admin')->check())
                        <form action="{{ route('admin.order.nego', $t->id_order) }}" method="POST">
                        @elseif(Auth::guard('mitra')->check())
                            <form action="{{ route('mitra.order.nego', $t->id_order) }}" method="POST">
                            @elseif(Auth::guard('staff')->check())
                                <form action="{{ route('staff.order.nego', $t->id_order) }}" method="POST">
                    @endif
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_order">ID Order</label>
                                        <input type="text" class="form-control" id="id_order" name="id_order" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="number">Harga</label>
                                        <input type="number" pattern="[0-9]*" class="form-control" id="harga"
                                            name="harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="pajak">Pajak</label>
                                        <input type="text" class="form-control" id="pajak" name="pajak"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="text" class="form-control" id="total" name="total"
                                            readonly>
                                    </div>
                                </div>
                                <span id="taskError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-user btn-block" id="nego" type="submit">Save</button>
                        <button class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Order</h4>
                    </div>
                    @if (Auth::guard('admin')->check())
                        <form action="{{ route('admin.order.status', $t->id_order) }}" method="POST">
                        @elseif(Auth::guard('mitra')->check())
                            <form action="{{ route('mitra.order.status', $t->id_order) }}" method="POST">
                            @elseif(Auth::guard('staff')->check())
                                <form action="{{ route('staff.order.status', $t->id_order) }}" method="POST">
                    @endif
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_order">ID Order</label>
                                        <input type="text" class="form-control" id="id_orderc" name="id_orderc"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Bandwidth</label>
                                        <input type="text" class="form-control" id="bandwidthc" name="bandwidthc"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="number">Harga</label>
                                        <input type="number" pattern="[0-9]*" class="form-control" id="hargac"
                                            name="hargac" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="pajak">Pajak</label>
                                        <input type="text" class="form-control" id="pajakc" name="pajakc"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="text" class="form-control" id="totalc" name="totalc"
                                            readonly>
                                    </div>
                                </div>
                                <span id="taskError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-user btn-block" id="nego" type="submit">Save</button>
                        <button class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Order</h4>
                    </div>
                    <form action="{{ route('admin.order.cetak', $t->id_order) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="id_order">ID Order</label>
                                            <input type="text" class="form-control" id="id_ordercetak"
                                                name="id_ordercetak" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Bandwidth</label>
                                            <input type="text" class="form-control" id="bandwidthcetak"
                                                name="bandwidthcetak" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="number">Harga</label>
                                            <input type="number" pattern="[0-9]*" class="form-control" id="hargacetak"
                                                name="hargacetak" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pajak">Pajak</label>
                                            <input type="text" class="form-control" id="pajakcetak" name="pajakcetak"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <input type="text" class="form-control" id="totalcetak" name="totalcetak"
                                                readonly>
                                        </div>
                                    </div>
                                    <span id="taskError" class="alert-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if (Auth::guard('admin')->check())
                                <button class="btn btn-primary btn-user btn-block" id="nego"
                                    type="submit">Save</button>
                            @endif
                            <button class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
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

                $(document).on('click', '.nego', function() {

                    var ids = $(this).attr('value');
                    //console.log(ids);
                    $('#nego').modal('show');

                    $.ajax({
                        type: 'GET',
                        @if (Auth::guard('admin')->check())
                            url: '/admin/order/nego/' + ids,
                        @elseif (Auth::guard('mitra')->check())
                            url: '/mitra/order/nego/' + ids,
                        @elseif (Auth::guard('staff')->check())
                            url: '/staff/order/nego/' + ids,
                        @endif
                        success: function(response) {
                            $('#id_order').val(response.order.id_order);

                            var harga = parseFloat(response.order.harga);
                            var pajak = harga * 0.11;
                            var total = harga + pajak;
                            //console.log(response);
                            $('#harga').val(harga);
                            $('#pajak').val(pajak);
                            $('#total').val(total);

                            $('#harga').on('input', function() {
                                var harga = parseFloat($(this).val());
                                var pajak = harga * 0.11;
                                var total = harga + pajak;

                                var formattedHarga = harga.toLocaleString('id-ID');
                                var formattedPajak = pajak.toLocaleString('id-ID');
                                var formattedTotal = total.toLocaleString('id-ID');

                                // Memperbarui nilai input pajak dan total
                                $('#pajak').val(formattedPajak);
                                $('#total').val(formattedTotal);

                            });
                        }
                    })
                })
            })
        </script>
        <script>
            $(document).ready(function() {

                $(document).on('click', '.confirm', function() {

                    var ids = $(this).attr('value');
                    //console.log(ids);
                    $('#confirm').modal('show');

                    $.ajax({
                        type: 'GET',
                        @if (Auth::guard('admin')->check())
                            url: '/admin/order/confirm/' + ids,
                        @elseif (Auth::guard('staff')->check())
                            url: '/staff/order/confirm/' + ids,
                        @elseif (Auth::guard('mitra')->check())
                            url: '/mitra/order/confirm/' + ids,
                        @endif
                        success: function(response) {
                            //console.log(response);
                            $('#id_orderc').val(response.order.id_order);
                            $('#bandwidthc').val(response.order.bandwidth);
                            $('#hargac').val(response.order.harga);
                            if (response.order.pajak == null) {
                                $('#pajakc').val("Pajak Belum Dikonfirmasi");
                            } else {
                                $('#pajakc').val(response.order.pajak);
                            }
                            if (response.order.total == null) {
                                $('#totalc').val("Total Belum Dikonfirmasi");
                            } else {
                                $('#totalc').val(response.order.total);
                            }
                        }
                    })
                })
            })
        </script>
        <script>
            $(document).ready(function() {

                $(document).on('click', '.cetak', function() {

                    var ids = $(this).attr('value');
                    //console.log(ids);
                    $('#cetak').modal('show');

                    $.ajax({
                        type: 'GET',
                        url: '/admin/order/confirm/' + ids,
                        success: function(response) {
                            //console.log(response);
                            $('#id_ordercetak').val(response.order.id_order);
                            $('#bandwidthcetak').val(response.order.bandwidth);
                            $('#hargacetak').val(response.order.harga);
                            if (response.order.pajak == null) {
                                $('#pajakcetak').val("Pajak Belum Dikonfirmasi");
                            } else {
                                $('#pajakcetak').val(response.order.pajak);
                            }
                            if (response.order.total == null) {
                                $('#totalcetak').val("Total Belum Dikonfirmasi");
                            } else {
                                $('#totalcetak').val(response.order.total);
                            }
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
                                            '<tr class="group"><td colspan="7">' +
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
