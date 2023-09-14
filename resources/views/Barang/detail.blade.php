@extends('index')
@section('content')
    @php
        use App\Models\Barang;
    @endphp
    <!--Info Detail-->
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="row">
                <div class="col-md-12 d-grid gap-2 d-md-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-info">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Profil Barang ID {{ $barang->id_barang }}</p>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Nama Barang</label>:
                                    <div class="col-sm-9">
                                        {{ $barang->nama_bar }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Harga</label>:
                                    <div class="col-sm-9">
                                        {{ $barang->harga }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Stok</label>:
                                    <div class="col-sm-9">
                                        {{ $barang->stok }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Deskripsi</label>:
                                <div class="form-group">
                                    {{ $barang->deskripsi }}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Foto Barang</p>
                    <center>
                        @if (Barang::whereNotNull('foto')->exists())
                            <img src="{{ asset($barang->foto) }}" alt="image" style="width: 300px; heigth: 300px;"
                                class="mx-auto">
                        @else
                            <img src="{{ asset('assets/images/profil.jpg') }}" alt="image"
                                style="width: 300px; heigth: 300px;" class="mx-auto">
                        @endif
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
