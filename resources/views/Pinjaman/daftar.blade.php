@extends('index')
@section('content')

    @php
        use App\Models\Pinjaman;
    @endphp

    {{-- Modal --}}
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
                                    <center>Total</center>
                                </th>
                                <th>
                                    <center>Detail</center>
                                </th>
                                <th>
                                    <center>Status</center>
                                </th>
                                @if (Auth::guard('mitra')->check())
                                    <th>
                                        <center>Aksi</center>
                                    </th>
                                @endif
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
                                        <center>{{ $t->total }}</center>
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
                                            @if ($t->sisa == 0)
                                                <a>
                                                    <span class="btn btn-sm btn-success btn-icon-text">Sudah Lunas</span>
                                                </a>
                                            @elseif ($t->sisa > 0)
                                                <a href="/admin/pinjaman/1/{{ $t->id_pinjaman }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">Belum Lunas</span></a>
                                            @endif
                                        </center>
                                    </td>
                                    @if (Auth::guard('mitra')->check())
                                        <td>
                                            <center>
                                                <a class="btn btn-sm btn-success btn-icon-text bayar" data-toggle="modal"
                                                    value="{{ $t->id_pinjaman }}" data-target="#modal">
                                                    Bayar
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

    @if (Pinjaman::count() > 0)
        @foreach ($pinjaman as $t)
            <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Bayar Harga</h4>
                        </div>
                        <form action="{{ route('mitra.bayar') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="id" name="id"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="">ID Peminjaman</label>
                                                <input type="text" class="form-control" id="id_pinjaman"
                                                    name="id_pinjaman" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Total</label>
                                                <input type="number" pattern="[0-9]*" class="form-control" id="total"
                                                    name="total" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="sisa">Sisa</label>
                                                <input type="text" class="form-control" id="sisa" name="sisa"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="bayar">Bayar</label>
                                                <input type="text" class="form-control" id="bayarform" name="bayarform">
                                            </div>
                                        </div>
                                        <span id="taskError" class="alert-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-user btn-block" id="nego"
                                    type="submit">Save</button>
                                <button class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <!--JS Modal-->
    @push('page-script')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.bayar', function() {

                    var ids = $(this).attr('value');
                    //console.log(ids);
                    $('#bayar').modal('show');

                    $.ajax({
                        type: 'GET',
                        url: '/mitra/pinjaman/bayar/' + ids,
                        success: function(response) {
                            //console.log(response);
                            $('#id_pinjaman').val(response.pinjam.id_pinjaman);
                            $('#total').val(response.pinjam.total);
                            $('#sisa').val(response.pinjam.sisa);
                            $('#bayarform').val(response.pinjam.sisa);
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
