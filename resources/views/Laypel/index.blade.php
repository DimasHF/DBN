@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Layanan</h4>
                <p class="card-description">
                    Form Produk Baru
                </p>
                <form class="forms-sample" method="post" action="{{route('mitra.tambah.pelanggan')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Pilih Layanan</label>
                        <select class="form-control form-control-sm" aria-label="Default select example" id="nama" name="nama">
                            <option selected disabled>Pilih</option>
                            <option value="1">Layanan 1</option>
                            <option value="2">Layanan 2</option>
                            <option value="3">Layanan 3</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control form-control-lg" id="deskripsi" name="deskripsi"
                            placeholder="Deskripsi layanan">
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
