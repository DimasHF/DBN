@extends('index')
@section('content')
    @php
        use App\Models\Barang;
    @endphp
    {{-- Tabel Pelanggan --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Barang</h3>
                    </div>
                    <!--Button Modal-->
                    <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon tambah"
                            data-target="#tambah">
                            <i class="ti-plus"></i>
                        </button>
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
                                <th width="300px">
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
                                                <a href="/admin/barang/0/{{ $t->id_barang }}">
                                                    <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                                </a>
                                            @elseif ($t->statusbar == 0)
                                                <a href="/admin/barang/1/{{ $t->id_barang }}"><span
                                                        class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <button class="btn btn-sm btn-info btn-icon-text stok"
                                                data-ids="{{ $t->id_barang }}" data-target="#stokModal">
                                                Tambah Stok
                                                <i class="ti-plus btn-icon-append"></i>
                                            </button>
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

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                </div>
                <form class="forms-sample" method="post" action="{{ route('admin.tambah.barang') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" id="daysLateInput">
                                    <div class="form-group">
                                        <label for="nama">ID Barang</label>
                                        <input type="text" class="form-control" id="id_barang" name="id_barang"
                                            placeholder="Nama Barang" value="{{ 'B' . $kd }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_bar" name="nama_bar"
                                            placeholder="Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="number" class="form-control" id="stok" name="stok"
                                            placeholder="Stok Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            placeholder="Harga Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                            placeholder="Deskripsi Barang"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" name="foto" id="foto" class="file-upload-default"
                                            accept=".jpg, .jpeg, .png">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                placeholder="Upload Foto">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                    type="button">Upload</button>
                                            </span>
                                        </div>
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
    @if (Barang::count() > 0)
        <div class="modal fade" id="stokModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Stok</h4>
                    </div>
                    <form class="forms-sample" method="post" action="{{ route('admin.tambah.stok') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="idbarang" id="idbarang"
                                            value="{{ $t->id_barang }}">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" id="stokplus" name="stokplus"
                                                placeholder="Stok Barang">
                                        </div>
                                    </div>
                                    <span id="taskError" class="alert-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-user btn-block" id="tambah"
                                type="submit">Save</button>
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
                $('.tambah').on('click', function() {
                    $('#tambah').modal('show');
                });

            });
        </script>
        <script>
            $(document).ready(function() {
                $('.stok').on('click', function() {
                    var barangId = $(this).data('ids');
                    $('#idbarang').val(barangId);
                    $('#stokplus').val(''); // Kosongkan input stok
                    $('#stokModal').modal('show');
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
@endsection
