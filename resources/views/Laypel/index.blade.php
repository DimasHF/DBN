@extends('index')
@section('content')

    <form class="user" action="{{route('mitra.pinjam.barang')}}" method="POST">
        <div class="row">
            <div class="col-12 grid-margin " id="pelanggan">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Masukkan Data Layanan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-user" id="caripelanggan"
                                            name="caripelanggan" placeholder="Masukkan Nama Pelanggan" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Terima</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                                            value="{{ date('d-m-y') }}" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Layanan</label>
                                    <div class="col-sm-9">
                                        <input type="int" class="form-control" placeholder="Masukan Nama Layanan" name="layanan" id="layanan"
                                            value="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="keranjang">Tambah Keranjang</button>
                        </div><br>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin " id="keranjang_brg">
                <div class="card">
                    <div class="card-body">
                        <table id="keranjang" name="keranjang" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100px">
                                        <center>No</center>
                                    </th>
                                    <th>
                                        <center>Nama Pelanggan</center>
                                    </th>
                                    <th>
                                        <center>Layanan</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="template">

                            </tbody>
                        </table><br>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-info">
                                Konfirmasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </form>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                //Input Barang Receive
                let pelanggan = document.getElementById('pelanggan');
                let keranjang = document.getElementById('keranjang_brg');
                // barang.style.visibility = 'hidden';
                keranjang.style.visibility = 'hidden';

                //Card Input 
                $("#caripelanggan").autocomplete({

                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/mitra/pelanggan/add",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                search: request.term,
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#caripelanggan').val(ui.item.value);
                        $('#id_barang').val(ui.item.label1);
                        $('#stok').val(ui.item.label2);

                        return false;
                    }
                });
                var row = 1;
                $('#keranjang').click(function() {
                    keranjang.style.visibility = 'visible';

                    let pelanggan = $("#caripelanggan").val();
                    let id_pinjam = $("#id_pinjam").val();
                    let id_barang = $("#id_barang").val();
                    let layanan = $("#layanan").val();
                    let total = parseInt($("#stok_barang").val()) + parseInt($("#jumlah").val());
                    let kode_supplier = $("#kode_supplier").val();
                    let tanggal = $("#tanggal").val();

                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="nomor[]" value="' +
                        row +
                        '"readonly><td><input type="text" class="form-control form-control-user"name="pelanggan[]" value="' +
                        pelanggan +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="layanan[]" value="' +
                        layanan +
                        '" readonly></td><td style="display:none;"><input type="text" class="form-control form-control-user" name="status[]" value="1" readonly></td></tr>'

                    );
                    row++;
                    document.getElementById("caripelanggan").value = "";
                    document.getElementById("layanan").value = "";

                });
            });
        </script>

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
