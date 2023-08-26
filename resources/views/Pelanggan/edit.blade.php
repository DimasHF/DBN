@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Pelanggan</h4>
                <p class="card-description">
                    Form Edit Pelanggan
                </p>
                @foreach ($pelanggan as $p)
                    <form class="forms-sample" method="post" action="{{route('mitra.proses.edit', $p->id_pelanggan)}}">
                        @csrf
                        <div class="form-group">
                            <label for="id_Pelanggan">ID Pelanggan</label>
                            <input value="{{ $p->id_pelanggan }}" type="text" class="form-control" id="id_pelanggan"
                                name="id_pelanggan" placeholder="Nama Pelanggan" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Nama Pelanggan" value="{{ $p->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Pelanggan</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat Pelanggan" value="{{ $p->alamat }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Pelanggan</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email Pelanggan" value="{{ $p->email }}">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telp Pelanggan</label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp"
                                placeholder="No Telp Pelanggan"
                                value="{{ $p->no_telp }}">
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP Pelanggan</label>
                            <input type="text" class="form-control" id="npwp" name="npwp"
                                placeholder="NPWP Pelanggan" value="{{ $p->npwp }}">
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK Pelanggan</label>
                            <input type="number" class="form-control" id="nik" name="nik"
                                placeholder="NIK Pelanggan"
                                value="{{ $p->nik }}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <input type="reset" class="btn btn-light" value="Reset">
                    </form>
                @endforeach
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;
            }
        </script>
    @endpush
@endsection
