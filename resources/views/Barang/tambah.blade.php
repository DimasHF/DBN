@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Barang Baru</h4>
                <p class="card-description">
                    Form Barang Baru
                </p>
                <form class="forms-sample" method="post" action="{{route('admin.tambah.barang')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">ID Barang</label>
                        <input type="text" class="form-control" id="id_barang" name="id_barang"
                            placeholder="Nama Pelanggan" value="{{'B'.$kd}}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok"
                            placeholder="Stok Barang">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" id="foto" class="file-upload-default" accept=".jpg, .jpeg, .png">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Foto">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <input type="reset" class="btn btn-light" value="Reset">
                </form>
            </div>
        </div>
    </div>

@endsection
