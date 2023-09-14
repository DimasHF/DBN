@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Barang Yang Tersedia</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="dropdown">
            <button type="button" class="btn btn-outline-primary btn-icon" data-toggle="dropdown">
                <i class="ti ti-shopping-cart" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu">
                @if (session('cart'))
                    @foreach (session('cart') as $id_barang => $detail)
                        <div class="row cart-detail">
                            <div class="col-lg-12 text-center">
                                <p>{{ $detail['nama_bar'] }}</p>
                                <span class="price text-info">Rp.
                                    {{ number_format($detail['harga'], 0, ',', '.') }}</span>
                                <span class="count"> Quantity:{{ $detail['jumlah'] }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                @php $total = 0; @endphp
                @foreach ((array) session('cart') as $id_barang => $detail)
                    @php $total += $detail['harga'] * $detail['jumlah'] @endphp
                @endforeach
                <div class="col-lg-12 text-center checkout">
                    <p>Total : <span class="text-info">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center checkout">
                        <a href="/mitra/pinjaman" class="btn btn-primary btn-block">View</a>
                    </div>
                </div>
            </div>
            <a href="{{ route('mitra.batal.cart') }}">
                <button type="button" class="btn btn-outline-danger btn-icon">
                    <i class="ti ti-trash" aria-hidden="true"></i>
                </button>
            </a>

        </div>
    </div>
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            @foreach ($barang as $b)
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <img src={{ asset($b->foto) }} alt="image" class="img-fluid"
                                    style="width: 200px; height: 200px;" />
                            </center><br>
                            <center>
                                <p class="card-title"><a href="{{route('mitra.barang.detail', $b->id_barang)}}">{{ $b->nama_bar }}</a></p>
                            </center>
                            <center>
                                <p class="font-weight-500">Harga : {{ $b->harga }} || Stok : {{ $b->stok }}</p>
                            </center>
                            @if ($b->stok > 0)
                                <center><a type="button" href="{{ route('mitra.keranjang', $b->id_barang) }}"
                                        class="btn btn-primary">PESAN</a></center><br>
                            @else
                                <center><a type="button" class="btn btn-habis" style="color: white">STOK HABIS</a>
                                </center><br>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
