
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
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
                                        <center>ID Transaksi</center>
                                    </th>
                                    <th>
                                        <center>Tagihan</center>
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
                                            <center>{{ $t->id_transaksi }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $t->total }}</center>
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
    
        <script>
            window.print();
        </script>
    </body>
    </html>
    {{-- Tabel Pelanggan --}}
    
