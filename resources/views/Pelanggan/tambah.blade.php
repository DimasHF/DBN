@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Pelanggan Baru</h4>
                <p class="card-description">
                    Form Pelanggan Baru
                </p>
                <form class="forms-sample" method="post" action="{{ route('mitra.tambah.pelanggan') }}"
                    enctype="multipart/form-data">
                    @csrf
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
                            <input type="tel" pattern="[0-9]*" class="form-control" id="no_telp" name="no_telp"
                                placeholder="No. Telp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP Pelanggan</label>
                        <input type="text" class="form-control" id="npwp" name="npwp"
                            placeholder="NPWP Pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK Pelanggan</label>
                        <input type="text" pattern="[0-9]*" class="form-control" id="nik" name="nik"
                            placeholder="NIK Pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label>Foto Pelanggan</label>
                        <input type="file" name="foto" id="foto" class="file-upload-default"
                            accept=".jpg, .jpeg, .png" required>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled id="imageInput"
                                placeholder="Upload Foto">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="reset" class="btn btn-outline-secondary" value="Reset">&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
