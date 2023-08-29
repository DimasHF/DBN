@extends('index')
@section('content')
    <!--Info Detail-->
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="row">
                <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Profil Mitra</h3>
                </div>
                <!--Button Modal-->
                @if(auth()->guard('mitra')->check())
                    <div class="col-md-4 col-xl-4 d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{route('mitra.edit.form', $mitra->id_mitra)}}" class="btn btn-primary">Update Profil</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">{{ $mitra->id_mitra }}</p>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Nama Mitra</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->nama }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Email</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">No. Telp</label>:
                                    <div class="col-sm-9">
                                        +{{ $mitra->no_telp }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">NIK</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->nik }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">NPWP</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->npwp }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Alamat</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->alamat }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Koordinat</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->latitude }}, {{ $mitra->longitude }}
                                    </div>
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
                    <p class="card-title">Logo Mitra</p>
                    <center>
                        <img src="{{ asset('logo/'. $mitra->logo) }}" alt="image" style="max-width: 600px; max-heigth: 600px;"
                            class="mx-auto">
                    </center>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const latitude = urlParams.get('latitude');
            const longitude = urlParams.get('longitude');

            // Menampilkan nilai latitude dan longitude dalam elemen
            document.getElementById("latitude").value = latitude || 'Tidak ada data';
            document.getElementById("longitude").value = longitude || 'Tidak ada data';
        });
    </script>
@endsection
