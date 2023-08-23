@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Layanan Baru</h4>
                <p class="card-description">
                    Form Layanan Baru
                </p>
                <form class="forms-sample" method="post" action="{{route('tambah.layanan')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="bandwidth">Bandwidth</label>
                        <input type="text" class="form-control" id="bandwidth" name="bandwidth"
                            placeholder="Bandwidth">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga"
                            placeholder="Harga">
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
