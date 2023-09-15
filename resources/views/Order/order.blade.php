@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Bandwidth</h4>
                <form class="forms-sample" method="post" action="{{ route('mitra.order.save') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Lokasi Server (Harap Isi Koordinat Terlebih Dahulu)
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longtitude<a href="/mitra/order/map/{{ $mitra->id_mitra }}"> Lihat Map</a></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                        placeholder="Longitude" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi">Provinsi<a class="penting">*</a></label>
                                <select id="provinsi" name="provinsi" class="form-control" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota/kab">Kabupaten/Kota<a class="penting">*</a></label>
                                <select id="kota/kab" name="kota/kab" class="form-control" required>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan<a class="penting">*</a></label>
                                <select id="kecamatan" name="kecamatan" class="form-control" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelurahan">Kelurahan<a class="penting">*</a></label>
                                <select id="kelurahan" name="kelurahan" class="form-control" required>
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jalan">Alamat<a class="penting">*</a></label>
                                <input type="text" class="form-control" id="jalan" name="jalan"
                                    placeholder="Jalan" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kodepos">Kode Pos<a class="penting">*</a></label>
                                <input type="number" class="form-control" id="kodepos" name="kodepos"
                                    placeholder="Kode Pos" value=" " required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Alamat" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Order Bandwidth
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bandwidth">Bandwidth</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="bandwidth" name="bandwidth"
                                        placeholder="Order Bandwidth" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Mbps</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga Yang Diajukan (Pajak 11%) <a type="button" class="hint"
                                        data-target="#modal" data-toggle="modal">(?)</a></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" pattern="[0-9]*" class="form-control" id="harga"
                                        name="harga" placeholder="Harga">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="reset" class="btn btn-outline-secondary" value="Reset">&nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hint" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modal"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pemberitahuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Harga yang diajukan akan didiskusikan lebih lanjut antara kedua belah pihak. Serta harga yang
                        diajukan akan dikenai tambahan pajak sebesar 11% dari harga.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            $(document).ready(function() {
                $('.hint').on('click', function() {
                    $('#hint').modal('show');
                });

            });
        </script>
    @endpush
    @include('API.alamat')
@endsection
