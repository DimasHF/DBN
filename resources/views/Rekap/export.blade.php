
    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Rekap Tagihan Pelanggan</h3>
        <a href="{{ route('mitra.export') }}" class="btn btn-sm btn-primary btn-icon-text">
            <i class="mdi mdi-download btn-icon-prepend"></i>
            Download
        </a>
    </div>
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
                    <center>ID Layanan Pelanggan</center>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($tagihan as $t)
                <tr>
                    <td>
                        <center>{{ $no++ }}</center>
                    </td>
                    <td>
                        <center>{{ $t->id_rekap }}</center>
                    </td>
                    <td>
                        <center>{{ $t->id_tagihan }}</center>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
