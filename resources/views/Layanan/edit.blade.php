@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Layanan</h4>
                <p class="card-description">
                    Form Edit Layanan
                </p>
                    <form class="forms-sample" method="post" action="{{route('mitra.proses.editlay', $layanan->id_layanan)}}">
                        @csrf
                        <div class="form-group">
                            <label for="id_Layanan">ID Layanan</label>
                            <input value="{{ $layanan->id_layanan }}" type="text" class="form-control" id="id_layanan"
                                name="id_layanan" placeholder="Nama Layanan" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Layanan</label>
                            <input type="text" class="form-control" id="nama_lay" name="nama_lay"
                                placeholder="Nama Layanan" value="{{ $layanan->nama_lay }}">
                        </div>
                        <div class="form-group">
                            <label for="bandwidth">Bandwidth</label>
                            <input type="text" class="form-control" id="bandwidth" name="bandwidth"
                                placeholder="Bandwidth"
                                value="{{ $layanan->bandwidth }}">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                placeholder="Harga Pelanggan" value="{{ $layanan->harga }}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <input type="reset" class="btn btn-light" value="Reset">
                    </form>
            </div>
        </div>
    </div>

@endsection
