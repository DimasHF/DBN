@extends('index')
@section('content')
    <form class="forms-sample" action="/mitra/pinjaman/checkout">
        @csrf
        <div class="row">
            <div class="col-12 grid-margin" id="pesan">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Pemesanan</h4>
                        <p class="card-description">
                            Informasi Mitra
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal Pesan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tenggat" id="tenggat"
                                            value="{{ date('Y-m-d') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Mitra</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            value="{{ $mitra->nama }}" />
                                        @error('nama')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal Deadline</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal_deadline"
                                            id="tanggal_deadline" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin " id="keranjang_produk">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="keranjang" name="keranjang" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="150px">Nama Produk</th>
                                        <th width="50px">Jumlah</th>
                                        <th id="harga" width="150px">Harga</th>
                                        <th width="150px">Sub Total</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach (session('cart') as $id_barang => $cart)
                                        @php $total += $cart['harga'] * $cart['jumlah']; @endphp
                                        <tr data-id="{{ $id_barang }}">
                                            <td style="display: none;">{{ $cart['id_barang'] }}</td>
                                            <td>{{ $cart['nama_bar'] }}</td>
                                            <td>
                                                <input type="number" value="{{ $cart['jumlah'] }}"
                                                    class="jumlah cart-update">
                                            </td>
                                            <td>{{ number_format($cart['harga'], 0, ',', '.') }}</td>
                                            <td>{{ number_format($cart['harga'] * $cart['jumlah'], 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm remove"
                                                    href="{{ url('/cart/remove/' . $id_barang) }}">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot id="footerTemplate">
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <h3>TOTAL : Rp.
                                                <strong>{{ number_format($total, 0, ',', '.') }}</strong>
                                            </h3>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><br>
                        <div class="col-md-6" style="display: none;">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Total</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="total" id="total"
                                        value="{{ $total }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">
                                <i class="mdi mdi-cart"></i> Lanjutkan Belanja
                            </a> &nbsp;
                            <button id="submit" type="submit" class="btn btn-info">
                                Pesan Produk
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- @push('page-script')
        <script>
            $(".cart-update").change(function(e) {
                e.preventDefault();

                var ele = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/cart/update",
                    method: 'patch',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_produk: ele.parents("tr").attr("data-id"),
                        jumlah: ele.parents("tr").find(".jumlah").val()
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            })
        </script>
    @endpush --}}
@endsection
