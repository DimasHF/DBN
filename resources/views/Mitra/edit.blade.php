@extends('index')
@section('content')
    <!--Form Edit-->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Profil Mitra</h4>
                <form class="forms-sample" method="post" action="{{ route('mitra.edit.proses', $mitra->id_mitra) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">ID Mitra</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Nama Pelanggan" readonly value="{{ $mitra->id_mitra }}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mitra</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mitra"
                            value="{{ $mitra->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            value="{{ $mitra->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ $mitra->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                            </div>
                            <input type="tel" pattern="[0-9]*" class="form-control" id="no_telp" name="no_telp"
                                placeholder="No. Telp" value="{{ $mitra->no_telp }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" pattern="[0-9]*" title="Harap masukkan hanya angka" class="form-control"
                            id="nik" name="nik" placeholder="NIK" value="{{ $mitra->nik }}" required>
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP"
                            value="{{ $mitra->npwp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                            value="{{ $mitra->alamat }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Longtitude<a href="/mitra/map/{{ $mitra->id_mitra }}"> Lihat Map</a></label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                    value="{{ isset($longitudeFromURL) ? $longitudeFromURL : $mitra->longitude }}"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Latitude</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                    value="{{ isset($latitudeFromURL) ? $latitudeFromURL : $mitra->latitude }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Logo Mitra</label>
                        <input type="file" name="logo" id="logo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled id="imageInput"
                                placeholder="Upload Logo" value="{{ $mitra->logo }}">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    @if ($mitra->logo)
                    <label>Logo Mitra Terkini</label>
                    <div>
                        <img src="{{ asset('logo/'. $mitra->logo) }}" style="max-width: 300px;">
                    </div>
                    @endif
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/mitra/profil" class="btn btn-light">Kembali</a>&nbsp;
                        <button type="submit" class="btn btn-primary btn-icon-text">
                            Submit
                            {{-- <i class="ti-printer btn-icon-append"></i> --}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('page-script')

        <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const urlParams = new URLSearchParams(window.location.search);
                const latitude = urlParams.get('latitude');
                const longitude = urlParams.get('longitude');

                // Isi input field dengan nilai yang diterima
                document.getElementById("latitude").value = latitude || document.getElementById("latitude").value;
                document.getElementById("longitude").value = longitude || document.getElementById("longitude").value;
            });
        </script>
    @endpush
@endsection
