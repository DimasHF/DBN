@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Produk Baru</h4>
                <p class="card-description">
                    Form Produk Baru
                </p>
                <form class="forms-sample" method="post" action="{{route('mitra.tambah.pelanggan')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Pelanggan</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Alamat Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Pelanggan</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Email Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp Pelanggan</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp"
                            placeholder="No Telp Pelanggan" onkeypress="return hanyaAngka(event)">
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP Pelanggan</label>
                        <input type="text" class="form-control" id="npwp" name="npwp"
                            placeholder="NPWP Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK Pelanggan</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            placeholder="NIK Pelanggan" onkeypress="return hanyaAngka(event)">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <input type="reset" class="btn btn-light" value="Reset">
                </form>
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

        <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>
    @endpush
@endsection
