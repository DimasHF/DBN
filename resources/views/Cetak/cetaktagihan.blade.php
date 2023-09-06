<div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">Rekap Tagihan Pelanggan</h3>
    <a href="{{ route('mitra.export', ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]) }}" class="btn btn-sm btn-primary btn-icon-text">
        <i class="mdi mdi-download btn-icon-prepend"></i>
        Download
    </a>
</div>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                    <thead style="background-color: #00AFEF">
                        <tr>
                            <th>
                                <center>No</center>
                            </th>
                            <th>
                                <center>ID Tagihan</center>
                            </th>
                            <th>
                                <center>Tanggal</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($cetak as $t)
                            <tr>
                                <td>
                                    <center>{{ $no++ }}</center>
                                </td>
                                <td>
                                    <center>{{ $t->id_tagihan }}</center>
                                </td>
                                <td>
                                    <center>{{ $t->tanggal_bayar }}</center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br>
            <div class="d-flex justify-content-center">
                {{-- {!! $pelanggan->links('pagination::bootstrap-4') !!} --}}
            </div>
        </div>
    </div>
</div>