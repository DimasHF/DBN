@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pinjaman</h4>
                <p class="card-description">
                    Form Pinjaman
                </p>
                <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="pinjaman">Pinjaman</label>
                        <input type="text" class="form-control" id="pinjaman" name="pinjaman"
                            placeholder="Pinjaman">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" form="usrform" placeholder="Nama Pelanggan"></textarea>
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
