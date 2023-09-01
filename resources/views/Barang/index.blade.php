@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Barang</h3>
                    </div>
                    <!--Button Modal-->
                    <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                        <a type="button" class="btn btn-primary" href="{{ route('admin.form.barang') }}">Tambahkan Barang</a>
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
                                <th style="display: none;">
                                    <center>ID Barang</center>
                                </th>
                                <th>
                                    <center>Nama Barang</center>
                                </th>
                                <th>
                                    <center>Stok</center>
                                </th>
                                <th>
                                    <center>Foto</center>
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
                            @foreach ($barang as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td style="display: none;">
                                        <center>{{ $t->id_barang }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama_bar }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->stok }}</center>
                                    </td>
                                    <td>
                                        <center><img src="{{ asset($t->foto) }}" alt=""></center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->statusbar == 1)
                                                <a href="/admin/statusbar/0/{{ $t->id_barang }}">
                                                    <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                                </a>
                                            @elseif ($t->statusbar == 0)
                                                <a href="/admin/statusbar/1/{{ $t->id_barang }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.edit.barang', $t->id_barang) }}"
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

    <!--JS Modal-->
    @push('page-script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
@endsection
