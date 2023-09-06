@extends('index')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h3 class="font-weight-bold">Cetak Tagihan</h3>
                        </center>
                    </div>
                </div><br>
                <center><label for="tgl_awal">Tanggal Awal</label></center>
                <div class="form-group">
                    <input type="date" class="form-control" id="tgl_awal" placeholder="Pilih Tanggal Awal">
                </div>
                <center><label for="tgl_awal">Tanggal Akhir</label></center>
                <div class="form-group">
                    <input type="date" class="form-control" id="tgl_akhir" placeholder="Pilih Tanggal Akhir">
                </div>
                <div class="form-group">
                    @if (auth()->guard('mitra')->check())
                        <a onclick="this.href='/mitra/tagihan/cetak/'+document.getElementById('tgl_awal').value+'/'+document.getElementById('tgl_akhir').value"
                            target="_blank" class="btn btn-primary btn-lg btn-block">Cetak
                        </a>
                    @elseif(auth()->guard('admin')->check())
                        <a onclick="this.href='/admin/tagihan/cetak/'+document.getElementById('tgl_awal').value+'/'+document.getElementById('tgl_akhir').value"
                            target="_blank" class="btn btn-primary btn-lg btn-block">Cetak
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
