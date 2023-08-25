@extends('index')
@section('content')

    {{-- Tabel mitra --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">List Mitra</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                        <thead style="background-color: #00AFEF">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>ID Mitra</center>
                                </th>
                                <th>
                                    <center>Nama Mitra</center>
                                </th>
                                <th>
                                    <center>Status</center>
                                </th>
                                <th>
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($mitra as $t)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->id_mitra }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->nama }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            @if ($t->status == 0)
                                                <form action="/api/mitra/konfimasi/1/{{ $t->id_mitra }}" method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger btn-icon-text">Konfirmasi
                                                        <i class="ti-alert btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @elseif ($t->status == 1)
                                                <form action="/api/mitra/konfimasi/0/{{ $t->id_mitra }}" method="POST">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success btn-icon-text">Menjadi Mitra
                                                        <i class="ti-check btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('admin.mitra.detail', $t->id_mitra) }}"
                                                class="btn btn-sm btn-info btn-icon-text edit">
                                                View Detail
                                                <i class="ti-file btn-icon-append"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><br>
                <div class="d-flex justify-content-center">
                    {{-- {!! $mitra->links('pagination::bootstrap-4') !!} --}}
                </div>
            </div>
        </div>
    </div>

    <!--JS Modal-->
    @push('page-script')
        <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
@endsection
