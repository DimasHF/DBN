@extends('index')
@section('content')

<!--Tittle-->
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="row">
            <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Daftar Barang</h3>
            </div>
            {{-- @if (Auth::user()->role == 'Super') --}}
            <!--Button Modal-->
            <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary" id="modal">Tambah Barang</button>
            </div>
            {{-- @endif --}}
        </div>
    </div>
    <!--List Kategori-->
    <div class="col-lg-12">
        <div class="row">
            @forelse ($Barang as $k)
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h3 style="text-transform: capitalize; bold">{{ $k->nama }}</h3>
                            </center>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h4 class="card-title">Barang Kosong</h4>
                            </center>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection