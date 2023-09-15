@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload Dokumen</h4>
                <p class="card-description">
                    Upload Dokumen
                </p>
                <form class="forms-sample" method="post" action="{{ route('mitra.send.doc') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>ID Order</label>
                        <select class="form-control" name="id_order" id="id_order" required>
                            <option value="">-- Pilih ID Order --</option>
                            @foreach ($order as $o)
                                <option value="{{ $o->id_order }}">{{ $o->id_order }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Formulir Berlangganan<a type="button" class="hint" data-target="#modal"
                                data-toggle="modal">(?)</a></label>
                        <input type="file" name="form" id="form" class="file-upload-default" accept=".pdf">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Formulir Berlangganan">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Fotokopi KTP Penanggung Jawab</label>
                        <input type="file" name="ktp" id="ktp" class="file-upload-default" accept=".pdf">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Fotokopi KTP Penanggung Jawab">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Fotokopi NPWP Perusahaan</label>
                        <input type="file" name="npwp" id="npwp" class="file-upload-default" accept=".pdf">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Fotokopi NPWP Perusahaan">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Fotokopi Formulir Akta Pendirian Perusahaan</label>
                        <input type="file" name="akta" id="akta" class="file-upload-default" accept=".pdf">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Fotokopi Formulir Akta Pendirian Perusahaan">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Fotokopi Surat Izin Pengelola Gedung</label>
                        <input type="file" name="izp" id="izp" class="file-upload-default" accept=".pdf">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Fotokopi Surat Izin Pengelola Gedung">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
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
                    <p>Setelah mendapatkan konfirmasi order bandwitdh, akan mendapatkan formulir berlangganan. Cetak dan
                        kirimkan dalam bentuk PDF.</p>
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
@endsection
