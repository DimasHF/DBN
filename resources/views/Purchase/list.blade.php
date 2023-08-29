@extends('index')
@section('content')

    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Purchase Order</h3>
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
                                    <center>ID Purchase Order</center>
                                </th>
                                <th>
                                    <center>SPK</center>
                                </th>
                                <th>
                                    <center>BA</center>
                                </th>
                                <th width="200px">
                                    <center>Kirim Pesan</center>
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
                            @foreach ($po as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_mitra }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_purchase_order }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadspk', $t->id_purchase_order) }}">Unduh Dokumen
                                                SPK</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.downloadba', $t->id_purchase_order) }}">Unduh Dokumen
                                                BA</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 0)
                                                <form action="/api/mitra/aktif/1/{{ $t->id_purchase_order }}"
                                                    method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger btn-icon-text">Setuju
                                                        <i class="ti-alert btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @elseif ($t->status == 1)
                                                <form action="/api/mitra/aktif/0/{{ $t->id_purchase_order }}"
                                                    method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success btn-icon-text">Menjadi Mitra
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </center>

                                    </td>
                                    <td>
                                        <center>
                                            <a onclick="javascript:void(0)" data-id="{{ $t->id_purchase_order }}"
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
