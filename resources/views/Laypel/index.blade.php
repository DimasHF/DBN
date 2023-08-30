@extends('index')
@section('content')
    <form class="user" action="{{ route('mitra.tambah.laypel') }}" method="POST">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Masukkan Pelanggan</h4>
                        <div class="form-group">
                            <label for="pelanggan">Pelanggan</label>
                            <input type="text" class="form-control form-control-user" id="pelanggan" name="pelanggan"
                                placeholder="Masukkan pelanggan" aria-label="Search" aria-describedby="basic-addon2"
                                required>
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Pelanggan</h4>
                        <div class="form-group">
                            <label for="pelanggan">ID Pelanggan</label>
                            <input type="text" class="form-control form-control-user" id="id_pelanggan"
                                name="id_pelanggan" placeholder="Masukkan pelanggan" aria-label="Search"
                                aria-describedby="basic-addon2" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 grid-margin" id="cardlayanan">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Masukkan Data Layanan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Layanan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-user" id="carilayanan"
                                            name="carilayanan" placeholder="Masukkan Nama layanan" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none">
                                    <label class="col-sm-3 col-form-label">ID Layanan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-user" id="id_layanan"
                                            name="id_layanan" placeholder="Masukkan Nama layanan" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Terima</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                                            value="{{ date('Y-m-d') }}" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga Layanan</label>
                                    <div class="col-sm-9">
                                        <input type="int" class="form-control" placeholder="Masukan Nama Layanan"
                                            name="harga" id="harga" value="" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Bandwidth Layanan</label>
                                    <div class="col-sm-9">
                                        <input type="int" class="form-control" placeholder="Masukan Nama Layanan"
                                            name="bandwidth" id="bandwidth" value="" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="pajak">Pajak</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="pajak" name="pajak">
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="keranjang">Tambah Layanan</button>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin " id="keranjang_brg">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="keranjang" name="keranjang" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th width="100px">
                                            <center>No</center>
                                        </th>
                                        <th style="width: 300px">
                                            <center>Nama Pelanggan</center>
                                        </th>
                                        <th style="width: 300px">
                                            <center>Layanan</center>
                                        </th>
                                        <th>
                                            <center>Harga Layanan</center>
                                        </th>
                                        <th>
                                            <center>Pajak</center>
                                        </th>
                                        <th width="200px">
                                            <center>Subtotal</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="template">

                                </tbody>
                                <tfoot id="footerTemplate">
                                    <tr>
                                        <th class="text-center bg_total" colspan="5"><b>TOTAL</b></th>
                                        <th><input class="form-control form-control-user" readonly type="text"
                                                name="total" id="total" value=""></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><br>
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
                let carilayanan = document.getElementById('cardlayanan');
                let keranjang = document.getElementById('keranjang_brg');
                carilayanan.style.visibility = 'hidden';
                keranjang.style.visibility = 'hidden';

                //Card Input 
                $("#pelanggan").autocomplete({

                    source: function(request, response) {
                        // Fetch data
                        // console.log($("#csrf"));
                        $.ajax({
                            url: "/mitra/pelanggan/search",
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
                        $('#pelanggan').val(ui.item.value);
                        $('#id_pelanggan').val(ui.item.label1);
                        carilayanan.style.visibility = 'visible';

                        return false;
                    }
                });
                $("#carilayanan").autocomplete({
                    source: function(request, response) {
                        let pelanggan = $("#pelanggan").val();
                        // Fetch data
                        // console.log($("#csrf"));

                        $.ajax({
                            url: "/mitra/layanan/search",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                pelanggan: pelanggan,
                                search: request.term
                            },
                            success: function(data) {
                                response(data);

                            }
                        });
                    },
                    select: function(event, ui) {
                        $('#carilayanan').val(ui.item.value);
                        $('#id_layanan').val(ui.item.id_layanan);
                        $('#harga').val(ui.item.harga);
                        $('#bandwidth').val(ui.item.bandwidth);

                        return false;
                    }
                });
                var row = 1;
                $('#keranjang').click(function() {
                    keranjang.style.visibility = 'visible';

                    let pelanggan = $("#pelanggan").val();
                    let id_pelanggan = $("#id_pelanggan").val();
                    let id_layanan = $("#id_layanan").val();
                    let id_laypel = $("#id_laypel").val();
                    let layanan = $("#carilayanan").val();
                    let harga = $("#harga").val();
                    let bandwidth = $("#bandwidth").val();
                    let pajak = $("#pajak").val();
                    let tanggal = $("#tanggal").val();
                    let subtotalpajak = parseInt($("#harga").val()) * (1 + 0.11);
                    let SubtotalPajak = subtotalpajak.toFixed(2);
                    formattedSubtotalPajak = SubtotalPajak.replace(/\.?0+$/, '');
                    let subtotal = $("#harga").val();

                    function totalpajak() {
                        if (pajak == 1) {
                            let pajakv = parseInt($("#harga").val()) * (0.11);
                            let Pajakv = pajakv.toFixed(2);
                            formattedPajakv = Pajakv.replace(/\.?0+$/, '');
                            return formattedPajakv;
                        } else {
                            return 0;
                        }
                    }

                    function biaya() {
                        if (pajak == 1) {
                            return formattedSubtotalPajak;
                        } else {
                            return subtotal;
                        }
                    }

                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="nomor[]" value="' +
                        row +
                        '"readonly></td><td><input type="text" class="form-control form-control-user"name="pelanggan[]" value="' +
                        pelanggan +
                        '"readonly></td><td style="display:none"><input type="text" class="form-control form-control-user" name="id_laypel[]" value="' +
                        id_laypel +
                        '"readonly></td><td style="display:none"><input type="text" class="form-control form-control-user" name="id_pelanggan[]" value="' +
                        id_pelanggan +
                        '"readonly></td><td style="display:none"><input type="text" class="form-control form-control-user" name="id_layanan[]" value="' +
                        id_layanan +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="nama[]" value="' +
                        layanan +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="harga[]" value="' +
                        harga +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="pajak[]" value="' +
                        totalpajak() +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="subtotal[]" value="' +
                        biaya() +
                        '" readonly></td></tr>'

                    );
                    total();
                    row++;

                    function total() {
                        var sum = 0;
                        $('.form-control[name="subtotal[]"]').each(function() {
                            sum += parseFloat($(this).val());
                        });

                        var formattedSum = sum.toFixed(2);
                        formattedSum = formattedSum.replace(/\.?0+$/, '');

                        $('#total').val(formattedSum);
                    }

                    document.getElementById("carilayanan").value = "";
                    document.getElementById("harga").value = "";
                    document.getElementById("bandwidth").value = "";

                });
            });
        </script>
    @endpush
@endsection
