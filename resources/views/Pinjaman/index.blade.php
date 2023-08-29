@extends('index')
@section('content')

    <form class="user" action="{{route('mitra.pinjam.barang')}}" method="POST">
        <div class="row">
            <div class="col-12 grid-margin " id="barang">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Masukkan Data Barang</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-user" id="caribarang"
                                            name="caribarang" placeholder="Masukkan Nama Barang" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="id_barang" name="id_barang"
                                            value="" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stok Barang</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="stok" id="stok"
                                            value="" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Terima</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal"
                                            value="{{ date('Y-m-d') }}" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah Barang</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="jumlah" id="jumlah"
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
                                        <center>Kode Barang</center>
                                    </th>
                                    <th>
                                        <center>Nama Barang</center>
                                    </th>
                                    <th width="100px">
                                        <center>Jumlah Dipinjam</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="template">

                            </tbody>
                        </table><br>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-info">
                                Pinjam Barang
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
                let barang = document.getElementById('barang');
                let keranjang = document.getElementById('keranjang_brg');
                // barang.style.visibility = 'hidden';
                keranjang.style.visibility = 'hidden';

                //Card Input 
                $("#caribarang").autocomplete({

                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/mitra/pinjaman/add",
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
                        $('#caribarang').val(ui.item.value);
                        $('#id_barang').val(ui.item.label1);
                        if (ui.item.label2 <= 0) {
                            $('#stok').val("Stok Habis!");
                            document.getElementById("keranjang").disabled = true;
                            alert('Stok habis!');
                        } else {
                            $('#stok').val(ui.item.label2);
                        }

                        return false;
                    }
                });
                var row = 1;
                $('#keranjang').click(function() {
                    keranjang.style.visibility = 'visible';

                    let barang = $("#caribarang").val();
                    let id_pinjam = $("#id_pinjam").val();
                    let id_barang = $("#id_barang").val();
                    let jumlah = $("#jumlah").val();
                    let total = parseInt($("#stok_barang").val()) - parseInt($("#jumlah").val());
                    let tanggal = $("#tanggal").val();

                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="nomor[]" value="' +
                        row +
                        '"readonly><td style="display:none;"><input type="text" class="form-control form-control-user"name="id_pinjam[]" value="' +
                        id_pinjam +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name=id_barang[]" value="' +
                        id_barang +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="nama[]" value="' +
                        barang +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="jumlah[]" value="' +
                        jumlah +
                        '" readonly></td><td style="display:none;"><input type="text" class="form-control form-control-user" name="status[]" value="1" readonly></td></tr>'

                    );
                    row++;
                    document.getElementById("caribarang").value = "";
                    document.getElementById("id_barang").value = "";
                    document.getElementById("stok").value = "";
                    document.getElementById("jumlah").value = "";

                });
            });
        </script>
    @endpush
@endsection
