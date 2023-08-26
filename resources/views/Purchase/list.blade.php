@extends('index')
@section('content')
    <!--Tittle-->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Purchase Order</h3>
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
                                    <center>ID Purchase Order</center>
                                </th>
                                <th>
                                    <center>SPK</center>
                                </th>
                                <th>
                                    <center>BA</center>
                                </th>
                                <th>
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
                                            <a href="https://api.whatsapp.com/send?phone=&text=Halo%20ada%20yang%20bisa%20saya%20bantu?"
                                                target="_blank">
                                                <span class="btn btn-sm btn-success btn-icon-text">Setuju</span>
                                            </a>
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
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
@endsection
