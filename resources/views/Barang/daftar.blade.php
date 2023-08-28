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
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            @foreach($barang as $b)
            <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card">
                    <div class="card-body">
                        <center>                        
                            <img src={{asset($b->foto)}} alt="image" class="img-fluid" style="width: 300px; height: 300px;"/>
                        </center><br>
                        <center><p class="card-title">{{$b->nama}}</p></center>
                        <center><p class="font-weight-500">Stok : {{$b->stok}}</p></center>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
