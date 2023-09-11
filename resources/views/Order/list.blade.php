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
                                <th>
                                    <center>Status</center>
                                </th>
                                @if (Order::where('statusorder', 0))
                                    <th>
                                        <center>Action</center>
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
                                            @if ($t->statusorder == 1)
                                                <span class="btn btn-sm btn-success btn-icon-text">Setuju</span>
                                            @elseif ($t->statusorder == 0)
                                                <span class="btn btn-sm btn-danger btn-icon-text">Dalam Pertimbangan</span>
                                            @endif
                                        </center>
                                    </td>
                                    @if ($t->statusorder == 0)
                                        <td>
                                            <center>
                                                <a class="btn btn-sm btn-info btn-icon-text nego" data-toggle="modal"
                                                    value="{{ $t->id_order }}" data-target="#modal">
                                                    Nego Harga
                                                    <i class="ti-money btn-icon-append"></i>
                                                </a>
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

    <div class="modal fade" id="nego" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nego Harga</h4>
                </div>
                <form action="{{ route('mitra.order.nego', $t->id_order) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" id="daysLateInput">
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
                                        <input type="text" class="form-control" id="pajak" name="pajak" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="text" class="form-control" id="total" name="total" readonly>
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
                        url: '/mitra/order/nego/' + ids,
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
