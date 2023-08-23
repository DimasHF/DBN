@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Purchase Order</h4>
                <p class="card-description">
                    Form Purchase Order
                </p>
                <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Date/Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="spk">SPK</label>
                        <input type="file" class="form-control" id="spk" name="spk"
                            placeholder="SPK">
                    </div>
                    <div class="form-group">
                        <label for="ba">BA</label>
                        <input type="file" class="form-control" id="ba" name="ba"
                            placeholder="BA">
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
