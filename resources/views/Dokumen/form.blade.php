@extends('index')
@section('content')
    @push('page-style')
        <style type="text/css">
            p {
                margin: 0;
                padding: 0;
            }

            .ft10 {
                font-size: 13px;
                font-family: Times;
                color: #000000;
            }

            .ft11 {
                font-size: 9px;
                font-family: Times;
                color: #000000;
            }

            .ft12 {
                font-size: 6px;
                font-family: Times;
                color: #000000;
            }

            .ft13 {
                font-size: 9px;
                font-family: Times;
                color: #000000;
            }

            .ft14 {
                font-size: 6px;
                font-family: Times;
                color: #000000;
            }

            .ft15 {
                font-size: 8px;
                font-family: Times;
                color: #000000;
            }

            .ft16 {
                font-size: 6px;
                font-family: Times;
                color: #000000;
            }

            .ft17 {
                font-size: 8px;
                font-family: Times;
                color: #000000;
            }

            .ft18 {
                font-size: 10px;
                font-family: Times;
                color: #000000;
            }

            .ft19 {
                font-size: 6px;
                font-family: Times;
                color: #0000ff;
            }

            .ft110 {
                font-size: 6px;
                font-family: Times;
                color: #000000;
            }

            .ft111 {
                font-size: 18px;
                font-family: Times;
                color: #000000;
            }

            .ft112 {
                font-size: 13px;
                font-family: Times;
                color: #000000;
            }

            .ft113 {
                font-size: 9px;
                line-height: 16px;
                font-family: Times;
                color: #000000;
            }

            .ft114 {
                font-size: 9px;
                line-height: 15px;
                font-family: Times;
                color: #000000;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-md-6 d-grid gap-2 d-md-flex">
            <a href="{{ url()->previous() }}" class="btn btn-info btn-icon-text">
                Kembali
                <i class="ti-arrow-left btn-icon-append"></i>
            </a>
        </div>

        <div class="col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
            <button id="print-button" class="btn btn-warning btn-icon-text">
                Print
                <i class="ti-printer btn-icon-append"></i>
            </button>
        </div>
    </div><br>
    <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Formulir Berlangganan</p>
                <div id="page1-div" style="position:relative;width:892px;height:1403px;">
                    <img width="892" height="1403" src="{{ asset('assets/images/form.png') }}" alt="background image" />
                    <p style="position:absolute;top:100px;left:30px;white-space:nowrap" class="ft10">
                        <b>PT DATA BUANA NUSANTARA</b>
                    </p>
                    <p style="position:absolute;top:160px;left:245px;white-space:nowrap" class="ft111">
                        <b>FORMULIR BERLANGGANAN </b>
                    </p>
                    <p style="position:absolute;top:161px;left:510px;white-space:nowrap" class="ft112">
                        <i><b>SUBSCRIPTION FORM</b></i>
                    </p>
                    {{-- 0 --}}
                    <p style="position:absolute;top:10px;left:655px;white-space:nowrap" class="ft13">Tanggal </p>
                    <p style="position:absolute;top:11px;right:190px;white-space:nowrap" class="ft14"><i>Date</i></p>
                    <p style="position:absolute;top:10px;left:715px;white-space:nowrap" class="ft13">{tanggal}</p>
                    <p style="position:absolute;top:30px;left:580px;white-space:nowrap" class="ft13">No ID Pelanggan</p>
                    <p style="position:absolute;top:31px;right:190px;white-space:nowrap" class="ft14">
                        <i>Customer ID Number</i>
                    </p>
                    <p style="position:absolute;top:30px;left:715px;white-space:nowrap" class="ft13">{id_pelanggan}</p>
                    <p style="position:absolute;top:50px;left:575px;white-space:nowrap" class="ft13">No ID Pembayaran</p>
                    <p style="position:absolute;top:51px;right:190px;white-space:nowrap" class="ft14">
                        <i>Payment ID Number</i>
                    </p>
                    <p style="position:absolute;top:50px;left:715px;white-space:nowrap" class="ft13">{id_bayar}</p>
                    <p style="position:absolute;top:70px;left:605px;white-space:nowrap" class="ft13">No Pemesanan</p>
                    <p style="position:absolute;top:71px;right:190px;white-space:nowrap" class="ft14">
                        <i>Order Number</i>
                    </p>
                    <p style="position:absolute;top:70px;left:715px;white-space:nowrap" class="ft13">{?}</p>
                    <p style="position:absolute;top:90px;left:595px;white-space:nowrap" class="ft13">Nomor PO</p>
                    <p style="position:absolute;top:91px;right:190px;white-space:nowrap" class="ft16"> Purchase Order Number</p>
                    <p style="position:absolute;top:90px;left:715px;white-space:nowrap" class="ft13">{id_po}</p>
                    <p style="position:absolute;top:110px;left:535px;white-space:nowrap" class="ft13">Nomor Surat Penawaran Harga</p>
                    <p style="position:absolute;top:111px;right:190px;white-space:nowrap" class="ft16">
                        <i>Quotation Number</i>
                    </p>
                    <p style="position:absolute;top:110px;left:715px;white-space:nowrap" class="ft13">{?}</p>
                    {{-- 0 --}}
                    {{-- 1 --}}
                    <p style="position:absolute;top:235px;left:25px;white-space:nowrap" class="ft11">
                        <b>Informasi Pelanggan</b>
                    </p>
                    <p style="position:absolute;top:236px;left:110px;white-space:nowrap" class="ft12">
                        <i><b>Customer Information</b></i>
                    </p>
                    <p style="position:absolute;top:258px;left:25px;white-space:nowrap" class="ft13">Nama Perusahaan</p>
                    <p style="position:absolute;top:259px;left:100px;white-space:nowrap" class="ft14">
                        <i>Company Name</i>
                    </p>
                    <p style="position:absolute;top:258px;left:175px;white-space:nowrap" class="ft11">
                        <b>{Nama}</b>
                    </p>
                    <p style="position:absolute;top:279px;left:25px;white-space:nowrap" class="ft13">Alamat Perusahaan</p>
                    <p style="position:absolute;top:280px;left:100px;white-space:nowrap" class="ft14">
                        <i>Company Address</i>
                    </p>
                    <p style="position:absolute;top:279px;left:175px;white-space:nowrap" class="ft13">{Alamat}</p>
                    <p style="position:absolute;top:318px;left:25px;white-space:nowrap" class="ft13">Provinsi</p>
                    <p style="position:absolute;top:319px;left:60px;white-space:nowrap" class="ft14">
                        <i>Province</i>
                    </p>
                    <p style="position:absolute;top:318px;left:96px;white-space:nowrap" class="ft13">{Provinsi}</p>
                    <p style="position:absolute;top:338px;left:25px;white-space:nowrap" class="ft13">Telepon</p>
                    <p style="position:absolute;top:339px;left:60px;white-space:nowrap" class="ft14">
                        <i>Phone</i>
                    </p>
                    <p style="position:absolute;top:338px;left:96px;white-space:nowrap" class="ft13">{No. Telp}</p>
                    <p style="position:absolute;top:360px;left:25px;white-space:nowrap" class="ft13">Situs Web</p>
                    <p style="position:absolute;top:361px;left:65px;white-space:nowrap" class="ft14">
                        <i>Website</i>
                    </p>
                    <p style="position:absolute;top:360px;left:96px;white-space:nowrap" class="ft13">{Website}</p>
                    <p style="position:absolute;top:318px;left:235px;white-space:nowrap" class="ft13">Kota</p>
                    <p style="position:absolute;top:319px;left:255px;white-space:nowrap" class="ft14">
                        <i>City</i>
                    </p>
                    <p style="position:absolute;top:318px;left:305px;white-space:nowrap" class="ft13">{Kota}</p>
                    <p style="position:absolute;top:338px;left:235px;white-space:nowrap" class="ft13">Kode Pos</p>
                    <p style="position:absolute;top:339px;left:273px;white-space:nowrap" class="ft14">
                        <i>Postal Code</i>
                    </p>
                    <p style="position:absolute;top:338px;left:330px;white-space:nowrap" class="ft13">{Kode Pos}</p>
                    <p style="position:absolute;top:360px;left:235px;white-space:nowrap" class="ft13">Faksimile</p>
                    <p style="position:absolute;top:361px;left:273px;white-space:nowrap" class="ft14">
                        <i>Facsimile</i>
                    </p>
                    <p style="position:absolute;top:380px;left:25px;white-space:nowrap" class="ft13">NPWP Perusahaan</p>
                    <p style="position:absolute;top:381px;left:100px;white-space:nowrap" class="ft14">
                        <i>Company Tax Registrated Number</i>
                    </p>
                    <p style="position:absolute;top:380px;left:235px;white-space:nowrap" class="ft13">{NPWP}</p>
                    {{-- 1 --}}
                    {{-- 2 --}}
                    <p style="position:absolute;top:235px;left:430px;white-space:nowrap" class="ft11">
                        <b>Biaya Pembayaran</b>
                    </p>
                    <p style="position:absolute;top:236px;left:510px;white-space:nowrap" class="ft12">
                        <i><b>Payment Fee</b></i>
                    </p>
                    <p style="position:absolute;top:258px;left:430px;white-space:nowrap" class="ft13">Biaya Instalasi</p>
                    <p style="position:absolute;top:259px;left:490px;white-space:nowrap" class="ft14">
                        <i>Installation Fee </i>
                    </p>
                    <p style="position:absolute;top:258px;left:584px;white-space:nowrap" class="ft13">Rp</p>
                    <p style="position:absolute;top:258px;right:180px;white-space:nowrap" class="ft13">{?}</p>
                    <p style="position:absolute;top:258px;left:720px;white-space:nowrap" class="ft13">PPN 11%</p>
                    <p style="position:absolute;top:259px;left:762px;white-space:nowrap" class="ft16">VAT 11%</p>
                    <p style="position:absolute;top:258px;left:800px;white-space:nowrap" class="ft13">Rp</p>
                    <p style="position:absolute;top:258px;right:10px;white-space:nowrap" class="ft13">{?}</p>
                    <p style="position:absolute;top:279px;left:430px;white-space:nowrap" class="ft13">Biaya Bulanan</p>
                    <p style="position:absolute;top:280px;left:490px;white-space:nowrap" class="ft14">
                        <i>Monthly Fee</i>
                    </p>
                    <p style="position:absolute;top:279px;left:584px;white-space:nowrap" class="ft13">Rp</p>
                    <p style="position:absolute;top:279px;right:180px;white-space:nowrap" class="ft13">{Tagihan}</p>
                    <p style="position:absolute;top:279px;left:720px;white-space:nowrap" class="ft13">PPN 11%</p>
                    <p style="position:absolute;top:280px;left:762px;white-space:nowrap" class="ft16">VAT 11%</p>
                    <p style="position:absolute;top:279px;left:800px;white-space:nowrap" class="ft13">Rp</p>
                    <p style="position:absolute;top:279px;right:10px;white-space:nowrap" class="ft13">{TagihanTotal}</p>
                    <p style="position:absolute;top:317px;left:430px;white-space:nowrap" class="ft11">
                        <b>Jumlah</b>
                    </p>
                    <p style="position:absolute;top:318px;left:465px;white-space:nowrap" class="ft12">
                        <i><b>Amount</b></i>
                    </p>
                    <p style="position:absolute;top:317px;left:710px;white-space:nowrap" class="ft13">Rp</p>
                    <p style="position:absolute;top:317px;right:10px;white-space:nowrap" class="ft13">{Total}</p>
                    <p style="position:absolute;top:360px;left:430px;white-space:nowrap" class="ft13">Tanggal Jatuh Tempo
                        Pembayaran (setiap bulan)</p>
                    <p style="position:absolute;top:370px;left:430px;white-space:nowrap" class="ft14">
                        <i>Date Payment (monthly)</i>
                    </p>
                    <p style="position:absolute;top:360px;left:680px;white-space:nowrap" class="ft14">
                        <i>Due</i>
                    </p>
                    <p style="position:absolute;top:360px;left:751px;white-space:nowrap" class="ft13">7 days after invoice
                        recived</p>
                    {{-- 2 --}}
                    {{-- 3 --}}
                    <p style="position:absolute;top:422px;left:25px;white-space:nowrap" class="ft11">
                        <b>Penanggung Jawab Perusahaan</b>
                    </p>
                    <p style="position:absolute;top:423px;left:155px;white-space:nowrap" class="ft12">
                        <i><b>Company Responsibilities</b></i>
                    </p>
                    <p style="position:absolute;top:445px;left:25px;white-space:nowrap" class="ft13">Nama</p>
                    <p style="position:absolute;top:446px;left:50px;white-space:nowrap" class="ft14">
                        <i>Name</i>
                    </p>
                    <p style="position:absolute;top:445px;left:96px;white-space:nowrap" class="ft13">
                        {Nama}
                    </p>
                    <p style="position:absolute;top:445px;left:235px;white-space:nowrap" class="ft13">Jabatan</p>
                    <p style="position:absolute;top:446px;left:265px;white-space:nowrap" class="ft14">
                        <i>Position</i>
                    </p>
                    <p style="position:absolute;top:445px;left:305px;white-space:nowrap" class="ft13">
                        {?}
                    </p>
                    <p style="position:absolute;top:465px;left:25px;white-space:nowrap" class="ft13">No. Handphone</p>
                    <p style="position:absolute;top:465px;left:96px;white-space:nowrap" class="ft13">{No. Telp}</p>
                    <p style="position:absolute;top:465px;left:235px;white-space:nowrap" class="ft13">Email</p>
                    <p style="position:absolute;top:466px;left:260px;white-space:nowrap" class="ft14"><i>E-Mail</i></p>
                    <p style="position:absolute;top:461px;left:310px;white-space:nowrap" class="ft13">{Email}</p>
                    {{-- 2 --}}
                    {{-- 3 --}}
                    <p style="position:absolute;top:422px;left:430px;white-space:nowrap" class="ft11">
                        <b>Jangka Waktu Berlangganan</b>
                    </p>
                    <p style="position:absolute;top:423px;left:550px;white-space:nowrap" class="ft12">
                        <i><b>Subscription Period</b></i>
                    </p>
                    <p style="position:absolute;top:445px;left:430px;white-space:nowrap" class="ft13">
                        Jangka Waktu Berlangganan </p>
                    <p style="position:absolute;top:446px;left:535px;white-space:nowrap" class="ft14">
                        <i>Subscription Period </i>
                    </p>
                    <p style="position:absolute;top:445px;left:660px;white-space:nowrap" class="ft13">12</p>
                    <p style="position:absolute;top:445px;left:715px;white-space:nowrap" class="ft13">Bulan</p>
                    <p style="position:absolute;top:446px;left:741px;white-space:nowrap" class="ft14">Month</p>
                    <p style="position:absolute;top:445px;left:761px;white-space:nowrap" class="ft13">/</p>
                    <p style="position:absolute;top:445px;left:779px;white-space:nowrap" class="ft13">1</p>
                    <p style="position:absolute;top:445px;left:805px;white-space:nowrap" class="ft13">Tahun</p>
                    <p style="position:absolute;top:446px;left:831px;white-space:nowrap" class="ft14">Year</p>
                    {{-- 3 --}}
                    {{-- 4 --}}
                    <p style="position:absolute;top:485px;left:430px;white-space:nowrap" class="ft11">
                        <b>Pusat Operasi Jaringan</b>
                    </p>
                    <p style="position:absolute;top:486px;left:530px;white-space:nowrap" class="ft12">
                        <i><b>Network Operating Center (NOC)</b></i>
                    </p>
                    <p style="position:absolute;top:506px;left:430px;white-space:nowrap" class="ft13">Telepon </p>
                    <p style="position:absolute;top:507px;left:463px;white-space:nowrap" class="ft14">
                        <i>Phone</i>
                    </p>
                    <p style="position:absolute;top:506px;left:490px;white-space:nowrap" class="ft13">
                        <i>0342 5650444</i>
                    </p>
                    <p style="position:absolute;top:506px;left:595px;white-space:nowrap" class="ft13">Telepon Seluler Cell Phone
                    </p>
                    <p style="position:absolute;top:506px;left:700px;white-space:nowrap" class="ft13">082231316699</p>
                    <p style="position:absolute;top:525px;left:430px;white-space:nowrap" class="ft13">WhatsApp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 082231316699</p>
                    <p style="position:absolute;top:525px;left:595px;white-space:nowrap" class="ft13">Email</p>
                    <p style="position:absolute;top:526px;left:620px;white-space:nowrap" class="ft14">E-Mail</p>
                    <p style="position:absolute;top:525px;left:685px;white-space:nowrap" class="ft13">admin@dbn.net.id</p>
                    {{-- 4 --}}
                    {{-- 5 --}}
                    <p style="position:absolute;top:505px;left:25px;white-space:nowrap" class="ft11">
                        <b>Penanggung Jawab Teknis</b>
                    </p>
                    <p style="position:absolute;top:506px;left:130px;white-space:nowrap" class="ft12">
                        <i><b>Technical Responsibilities</b></i>
                    </p>
                    <p style="position:absolute;top:527px;left:25px;white-space:nowrap" class="ft13">Nama</p>
                    <p style="position:absolute;top:528px;left:45px;white-space:nowrap" class="ft14">
                        <i>Name</i>
                    </p>
                    <p style="position:absolute;top:528px;left:100px;white-space:nowrap" class="ft13">{Nama}</p>
                    <p style="position:absolute;top:527px;left:235px;white-space:nowrap" class="ft13">Jabatan</p>
                    <p style="position:absolute;top:528px;left:265px;white-space:nowrap" class="ft14">
                        <i>Position</i>
                    </p>
                    <p style="position:absolute;top:528px;left:305px;white-space:nowrap" class="ft13">{?}</p>
                    <p style="position:absolute;top:547px;left:25px;white-space:nowrap" class="ft13">No. Handphone</p>
                    <p style="position:absolute;top:548px;left:100px;white-space:nowrap" class="ft13">{No. Telp}</p>
                    <p style="position:absolute;top:547px;left:235px;white-space:nowrap" class="ft13">Email</p>
                    <p style="position:absolute;top:548px;left:260px;white-space:nowrap" class="ft14"><i>E-Mail</i></p>
                    <p style="position:absolute;top:547px;left:305px;white-space:nowrap" class="ft13">{Email}</p>
                    {{-- 5 --}}
                    {{-- 6 --}}
                    <p style="position:absolute;top:568px;left:430px;white-space:nowrap" class="ft11">
                        <b>Keuangan </b>
                    </p>
                    <p style="position:absolute;top:569px;left:474px;white-space:nowrap" class="ft12">
                        <i><b>Finance</b></i>
                    </p>
                    <p style="position:absolute;top:588px;left:430px;white-space:nowrap" class="ft13">Telepon</p>
                    <p style="position:absolute;top:589px;left:463px;white-space:nowrap" class="ft14">
                        <i>Phone</i>
                    </p>
                    <p style="position:absolute;top:589px;left:485px;white-space:nowrap" class="ft13">
                        <i>082231316699</i>
                    </p>
                    <p style="position:absolute;top:588px;left:545px;white-space:nowrap" class="ft13"><i>Email</i></p>
                    <p style="position:absolute;top:589px;left:570px;white-space:nowrap" class="ft14"><i>E-Mail</i>
                    </p>
                    <p style="position:absolute;top:588px;left:595px;white-space:nowrap" class="ft13"><i>reza@dbn.net.id</i></p>
                    {{-- 6 --}}
                    {{-- 7 --}}
                    <p style="position:absolute;top:589px;left:25px;white-space:nowrap" class="ft11">
                        <b>Informasi Pembayaran </b>
                    </p>
                    <p style="position:absolute;top:590px;left:120px;white-space:nowrap" class="ft12">
                        <i><b>Payment Information</b></i>
                    </p>
                    <p style="position:absolute;top:610px;left:25px;white-space:nowrap" class="ft13">Penanggung Jwb Keuangan</p>
                    <p style="position:absolute;top:611px;left:130px;white-space:nowrap" class="ft14">
                        <i>Financial Responsibilities </i>
                    </p>
                    <p style="position:absolute;top:610px;left:230px;white-space:nowrap" class="ft13">{Nama}</p>
                    <p style="position:absolute;top:632px;left:25px;white-space:nowrap" class="ft13">Alamat Penagihan</p>
                    <p style="position:absolute;top:633px;left:95px;white-space:nowrap" class="ft14">
                        <i>Billing Address</i>
                    </p>
                    <p style="position:absolute;top:632px;left:175px;white-space:nowrap" class="ft13">{Alamat}</p>
                    <p style="position:absolute;top:652px;left:240px;white-space:nowrap" class="ft13">Kota</p>
                    <p style="position:absolute;top:653px;left:263px;white-space:nowrap" class="ft14">
                        <i>City</i>
                    </p>
                    <p style="position:absolute;top:652px;left:305px;white-space:nowrap" class="ft13">{Kota}</p>
                    <p style="position:absolute;top:673px;left:25px;white-space:nowrap" class="ft13">Provinsi</p>
                    <p style="position:absolute;top:674px;left:60px;white-space:nowrap" class="ft14">
                        <i>Province</i>
                    </p>
                    <p style="position:absolute;top:673px;left:100px;white-space:nowrap" class="ft13">{Provinsi}</p>
                    <p style="position:absolute;top:673px;left:240px;white-space:nowrap" class="ft13">Kode Pos</p>
                    <p style="position:absolute;top:674px;left:280px;white-space:nowrap" class="ft14">
                        <i>Postal Code</i>
                    </p>
                    <p style="position:absolute;top:673px;left:330px;white-space:nowrap" class="ft13">{KodePos}</p>
                    <p style="position:absolute;top:694px;left:25px;white-space:nowrap" class="ft13">Telepon</p>
                    <p style="position:absolute;top:695px;left:60px;white-space:nowrap" class="ft14">
                        <i>Phone</i>
                    </p>
                    <p style="position:absolute;top:694px;left:100px;white-space:nowrap" class="ft13">{No. Telp}</p>
                    <p style="position:absolute;top:694px;left:240px;white-space:nowrap" class="ft13">Email </p>
                    <p style="position:absolute;top:695px;left:265px;white-space:nowrap" class="ft14"><i>E-Mail </i></p>
                    <p style="position:absolute;top:694px;left:305px;white-space:nowrap" class="ft13">{Email}</p>
                    {{-- 7 --}}
                    {{-- 8 --}}
                    <p style="position:absolute;top:630px;left:430px;white-space:nowrap" class="ft11">
                        <b>Tata Cara Pembayaran </b>
                    </p>
                    <p style="position:absolute;top:631px;left:525px;white-space:nowrap" class="ft12">
                        <i><b>Procedure of Payment</b></i>
                    </p>
                    <p style="position:absolute;top:655px;left:430px;white-space:nowrap" class="ft13">Pembayaran dilakukan
                        dengan cara transfer ke rekening :</p>
                    <p style="position:absolute;top:670px;left:430px;white-space:nowrap" class="ft15">Payment is made by
                        transfer to account DBN :</p>
                    <p style="position:absolute;top:695px;left:430px;white-space:nowrap" class="ft11">
                        <b>Pembayaran dengan PPN</b>
                    </p>
                    <p style="position:absolute;top:696px;left:532px;white-space:nowrap" class="ft12">
                        <i><b>Payment with VAT</b></i>
                    </p>
                    <p style="position:absolute;top:714px;left:425px;white-space:nowrap" class="ft11">
                        <b>Cek (X)</b>
                    </p>
                    <p style="position:absolute;top:714px;left:520px;white-space:nowrap" class="ft11">
                        <b>Bank</b>
                    </p>
                    <p style="position:absolute;top:715px;left:547px;white-space:nowrap" class="ft12">
                        <i><b>Bank</b></i>
                    </p>
                    <p style="position:absolute;top:714px;left:652px;white-space:nowrap" class="ft11">
                        <b>Cabang</b>
                    </p>
                    <p style="position:absolute;top:715px;left:687px;white-space:nowrap" class="ft12">
                        <i><b>Branch</b></i>
                    </p>
                    <p style="position:absolute;top:714px;left:760px;white-space:nowrap" class="ft11">
                        <b>No. Rekening </b>
                    </p>
                    <p style="position:absolute;top:715px;left:820px;white-space:nowrap" class="ft110">
                        <b>Account Number</b>
                    </p>
                    <p style="position:absolute;top:735px;left:495px;white-space:nowrap" class="ft13">Bank Central Asia (BCA)
                    </p>
                    <p style="position:absolute;top:735px;left:655px;white-space:nowrap" class="ft13">KCU BLITAR</p>
                    <p style="position:absolute;top:735px;left:785px;white-space:nowrap" class="ft13">0901696399</p>
                    <p style="position:absolute;top:820px;left:430px;white-space:nowrap" class="ft13">
                        *Atas Nama On Behalf : PT DATA BUANA NUSANTARA</p>
                    <p style="position:absolute;top:840px;left:430px;white-space:nowrap" class="ft11">
                        <b>Kelengkapan Dokumen</b>
                    </p>
                    <p style="position:absolute;top:841px;left:525px;white-space:nowrap" class="ft12">
                        <i><b>Completeness of Document</b></i>
                    </p>
                    <p style="position:absolute;top:855px;left:430px;white-space:nowrap" class="ft13">
                        - Fotokopi KTP Penanggung Jawab</p>
                    <p style="position:absolute;top:856px;left:560px;white-space:nowrap" class="ft14">
                        <i>Copy of Person in Charge ID</i>
                    </p>
                    <p style="position:absolute;top:870px;left:430px;white-space:nowrap" class="ft13">
                        - Fotokopi NPWP Perusahaan</p>
                    <p style="position:absolute;top:871px;left:540px;white-space:nowrap" class="ft14">
                        <i>Copy of Company Tax Registrated Number</i>
                    </p>
                    <p style="position:absolute;top:885px;left:430px;white-space:nowrap" class="ft13">
                        - Fotokopi Akta Pendirian Perusahaan</p>
                    <p style="position:absolute;top:886px;left:570px;white-space:nowrap" class="ft14">
                        <i>Copy of Deed of Establishment</i>
                    </p>
                    <p style="position:absolute;top:900px;left:430px;white-space:nowrap" class="ft13">
                        - Fotokopi Surat Izin Pengelola Gedung</p>
                    <p style="position:absolute;top:901px;left:575px;white-space:nowrap" class="ft14">
                        <i>Copy of Building Management License</i>
                    </p>
                    {{-- 8 --}}
                    {{-- 9 --}}
                    <p style="position:absolute;top:735px;left:25px;white-space:nowrap" class="ft11">
                        <b>INFORMASI LAYANAN</b>
                    </p>
                    <p style="position:absolute;top:736px;left:130px;white-space:nowrap" class="ft12">
                        <i><b>SERVICE INFORMATION</b></i>
                    </p>
                    <p style="position:absolute;top:755px;left:25px;white-space:nowrap" class="ft11">
                        <b>Network ID</b>
                    </p>
                    <p style="position:absolute;top:756px;left:150px;white-space:nowrap" class="ft11">
                        <b>{?}</b>
                    </p>
                    <p style="position:absolute;top:777px;left:25px;white-space:nowrap" class="ft11"><b>Lokasi Akhir</b>
                    </p>
                    <p style="position:absolute;top:778px;left:80px;white-space:nowrap" class="ft12">
                        <i><b>Terminating</b></i>
                    </p>
                    <p style="position:absolute;top:777px;left:180px;white-space:nowrap" class="ft11"><b>{?}</b></p>
                    <p style="position:absolute;top:798px;left:25px;white-space:nowrap" class="ft13">Alamat</p>
                    <p style="position:absolute;top:799px;left:55px;white-space:nowrap" class="ft14">
                        <i>Address</i>
                    </p>
                    <p style="position:absolute;top:820px;left:25px;white-space:nowrap" class="ft13">Kontak Person</p>
                    <p style="position:absolute;top:821px;left:80px;white-space:nowrap" class="ft14">
                        <i>Contact Person</i>
                    </p>
                    <p style="position:absolute;top:840px;left:25px;white-space:nowrap" class="ft13">Layanan</p>
                    <p style="position:absolute;top:841px;left:60px;white-space:nowrap" class="ft14">
                        <i>Service</i>
                    </p>
                    <p style="position:absolute;top:840px;left:130px;white-space:nowrap" class="ft13">BANDWITH</p>
                    <p style="position:absolute;top:840px;left:235px;white-space:nowrap" class="ft13">Link Utama</p>
                    <p style="position:absolute;top:841px;left:280px;white-space:nowrap" class="ft14">
                        <i>Prime Link</i>
                    </p>
                    <p style="position:absolute;top:860px;left:25px;white-space:nowrap" class="ft13">Kapasitas</p>
                    <p style="position:absolute;top:861px;left:65px;white-space:nowrap" class="ft14">
                        <i>Capacity</i>
                    </p>
                    <p style="position:absolute;top:860px;left:130px;white-space:nowrap" class="ft13">{Bandwidth}</p>
                    <p style="position:absolute;top:860px;left:235px;white-space:nowrap" class="ft13">Link Cadangan</p>
                    <p style="position:absolute;top:861px;left:295px;white-space:nowrap" class="ft14">
                        <i>Backup Link</i>
                    </p>
                    <p style="position:absolute;top:882px;left:25px;white-space:nowrap" class="ft13">Siap Berlayanan</p>
                    <p style="position:absolute;top:883px;left:90px;white-space:nowrap" class="ft14">
                        <i>Ready For Service</i>
                    </p>
                    <p style="position:absolute;top:882px;left:235px;white-space:nowrap" class="ft13">Tambahan</p>
                    <p style="position:absolute;top:883px;left:276px;white-space:nowrap" class="ft14">
                        <i>Additional</i>
                    </p>
                    {{-- 9 --}}
                    {{-- 10 --}}
                    <p style="position:absolute;top:970px;left:25px;white-space:nowrap" class="ft13">
                        Dengan ini kami menyatakan bahwa informasi yang kami berikan adalah benar adanya dan bersedia mematuhi
                        ketentuan dan syarat berlangganan sebagaimana diuraikan.
                    </p>
                    <p style="position:absolute;top:985px;left:25px;white-space:nowrap" class="ft14">
                        <i> We hereby declare that the information we provide is true and willing to comply with the terms and
                            conditions of the subscription as described.
                        </i>
                    </p>
                    <p style="position:absolute;top:1025px;left:25px;white-space:nowrap" class="ft13">Tanggal </p>
                    <p style="position:absolute;top:1026px;left:60px;white-space:nowrap" class="ft14">
                        <i>Date</i>
                    </p>
                    <p style="position:absolute;top:1025px;left:100px;white-space:nowrap" class="ft13">{?}</p>
                    <p style="position:absolute;top:1025px;left:625px;white-space:nowrap" class="ft13">Tanggal</p>
                    <p style="position:absolute;top:1026px;left:660px;white-space:nowrap" class="ft14">
                        <i>Date</i>
                    </p>
                    <p style="position:absolute;top:1025px;left:680px;white-space:nowrap" class="ft13">{?}</p>
                    <p style="position:absolute;top:1050px;left:25px;white-space:nowrap" class="ft13">
                        <b>Pelanggan </b>
                    </p>
                    <p style="position:absolute;top:1051px;left:75px;white-space:nowrap" class="ft14"><i><b>Customer,</b></i></p>
                    <p style="position:absolute;top:1110px;left:52px;white-space:nowrap" class="ft13">Materai 10000</p>
                    <p style="position:absolute;top:1180px;left:30px;white-space:nowrap" class="ft13">{Nama}</p>
                    <p style="position:absolute;top:1050px;left:625px;white-space:nowrap" class="ft11"><b>Direktur</b></p>
                    <p style="position:absolute;top:1180px;left:640px;white-space:nowrap" class="ft11">
                        <b>Muhammad Khotib</b>
                    </p>
                    <p style="position:absolute;top:1230px;left:25px;white-space:nowrap" class="ft15">
                        * Nama, Tanda Tangan dan Stempel Perusahaan <i>* Name, Signature and Company Stamp</i>
                    </p>
                    {{-- 10 --}}
                    {{-- 11 --}}
                    <p style="position:absolute;top:1270px;left:25px;white-space:nowrap" class="ft113">
                        <b>PT DATA BUANA NUSANTARA<br /></b>Head Office : Ds Tawangrejo Kec. Wonodadi Kab Blitar<br />Marketing
                        Office : Ds Tawangrejo Kec. Wonodadi Kab Blitar<br />Network Office : Ds Tawangrejo Kec. Wonodadi Kab
                        Blitar<br />Hunting : (0342) 5650444<br />Website : www.dbn.net.id
                    </p>
                    {{-- 11 --}}
                </div>
            </div>
        </div>
    </div>

    <div id="print_out" style="display: none">
        <div id="page1-div" style="position:relative;width:892px;height:1403px;">
            <img width="892" height="1403" src="{{ asset('assets/images/form.png') }}" alt="background image" />
            <p style="position:absolute;top:100px;left:30px;white-space:nowrap" class="ft10">
                <b>PT DATA BUANA NUSANTARA</b>
            </p>
            <p style="position:absolute;top:160px;left:245px;white-space:nowrap" class="ft111">
                <b>FORMULIR BERLANGGANAN </b>
            </p>
            <p style="position:absolute;top:161px;left:510px;white-space:nowrap" class="ft112">
                <i><b>SUBSCRIPTION FORM</b></i>
            </p>
            {{-- 0 --}}
            <p style="position:absolute;top:10px;left:655px;white-space:nowrap" class="ft13">Tanggal </p>
            <p style="position:absolute;top:11px;right:190px;white-space:nowrap" class="ft14"><i>Date</i></p>
            <p style="position:absolute;top:10px;left:715px;white-space:nowrap" class="ft13">{tanggal}</p>
            <p style="position:absolute;top:30px;left:580px;white-space:nowrap" class="ft13">No ID Pelanggan</p>
            <p style="position:absolute;top:31px;right:190px;white-space:nowrap" class="ft14">
                <i>Customer ID Number</i>
            </p>
            <p style="position:absolute;top:30px;left:715px;white-space:nowrap" class="ft13">{id_pelanggan}</p>
            <p style="position:absolute;top:50px;left:575px;white-space:nowrap" class="ft13">No ID Pembayaran</p>
            <p style="position:absolute;top:51px;right:190px;white-space:nowrap" class="ft14">
                <i>Payment ID Number</i>
            </p>
            <p style="position:absolute;top:50px;left:715px;white-space:nowrap" class="ft13">{id_bayar}</p>
            <p style="position:absolute;top:70px;left:605px;white-space:nowrap" class="ft13">No Pemesanan</p>
            <p style="position:absolute;top:71px;right:190px;white-space:nowrap" class="ft14">
                <i>Order Number</i>
            </p>
            <p style="position:absolute;top:70px;left:715px;white-space:nowrap" class="ft13">{?}</p>
            <p style="position:absolute;top:90px;left:595px;white-space:nowrap" class="ft13">Nomor PO</p>
            <p style="position:absolute;top:91px;right:190px;white-space:nowrap" class="ft16"> Purchase Order Number</p>
            <p style="position:absolute;top:90px;left:715px;white-space:nowrap" class="ft13">{id_po}</p>
            <p style="position:absolute;top:110px;left:535px;white-space:nowrap" class="ft13">Nomor Surat Penawaran Harga</p>
            <p style="position:absolute;top:111px;right:190px;white-space:nowrap" class="ft16">
                <i>Quotation Number</i>
            </p>
            <p style="position:absolute;top:110px;left:715px;white-space:nowrap" class="ft13">{?}</p>
            {{-- 0 --}}
            {{-- 1 --}}
            <p style="position:absolute;top:235px;left:25px;white-space:nowrap" class="ft11">
                <b>Informasi Pelanggan</b>
            </p>
            <p style="position:absolute;top:236px;left:110px;white-space:nowrap" class="ft12">
                <i><b>Customer Information</b></i>
            </p>
            <p style="position:absolute;top:258px;left:25px;white-space:nowrap" class="ft13">Nama Perusahaan</p>
            <p style="position:absolute;top:259px;left:100px;white-space:nowrap" class="ft14">
                <i>Company Name</i>
            </p>
            <p style="position:absolute;top:258px;left:175px;white-space:nowrap" class="ft11">
                <b>{Nama}</b>
            </p>
            <p style="position:absolute;top:279px;left:25px;white-space:nowrap" class="ft13">Alamat Perusahaan</p>
            <p style="position:absolute;top:280px;left:100px;white-space:nowrap" class="ft14">
                <i>Company Address</i>
            </p>
            <p style="position:absolute;top:279px;left:175px;white-space:nowrap" class="ft13">{Alamat}</p>
            <p style="position:absolute;top:318px;left:25px;white-space:nowrap" class="ft13">Provinsi</p>
            <p style="position:absolute;top:319px;left:60px;white-space:nowrap" class="ft14">
                <i>Province</i>
            </p>
            <p style="position:absolute;top:318px;left:96px;white-space:nowrap" class="ft13">{Provinsi}</p>
            <p style="position:absolute;top:338px;left:25px;white-space:nowrap" class="ft13">Telepon</p>
            <p style="position:absolute;top:339px;left:60px;white-space:nowrap" class="ft14">
                <i>Phone</i>
            </p>
            <p style="position:absolute;top:338px;left:96px;white-space:nowrap" class="ft13">{No. Telp}</p>
            <p style="position:absolute;top:360px;left:25px;white-space:nowrap" class="ft13">Situs Web</p>
            <p style="position:absolute;top:361px;left:65px;white-space:nowrap" class="ft14">
                <i>Website</i>
            </p>
            <p style="position:absolute;top:360px;left:96px;white-space:nowrap" class="ft13">{Website}</p>
            <p style="position:absolute;top:318px;left:235px;white-space:nowrap" class="ft13">Kota</p>
            <p style="position:absolute;top:319px;left:255px;white-space:nowrap" class="ft14">
                <i>City</i>
            </p>
            <p style="position:absolute;top:318px;left:305px;white-space:nowrap" class="ft13">{Kota}</p>
            <p style="position:absolute;top:338px;left:235px;white-space:nowrap" class="ft13">Kode Pos</p>
            <p style="position:absolute;top:339px;left:273px;white-space:nowrap" class="ft14">
                <i>Postal Code</i>
            </p>
            <p style="position:absolute;top:338px;left:330px;white-space:nowrap" class="ft13">{Kode Pos}</p>
            <p style="position:absolute;top:360px;left:235px;white-space:nowrap" class="ft13">Faksimile</p>
            <p style="position:absolute;top:361px;left:273px;white-space:nowrap" class="ft14">
                <i>Facsimile</i>
            </p>
            <p style="position:absolute;top:380px;left:25px;white-space:nowrap" class="ft13">NPWP Perusahaan</p>
            <p style="position:absolute;top:381px;left:100px;white-space:nowrap" class="ft14">
                <i>Company Tax Registrated Number</i>
            </p>
            <p style="position:absolute;top:380px;left:235px;white-space:nowrap" class="ft13">{NPWP}</p>
            {{-- 1 --}}
            {{-- 2 --}}
            <p style="position:absolute;top:235px;left:430px;white-space:nowrap" class="ft11">
                <b>Biaya Pembayaran</b>
            </p>
            <p style="position:absolute;top:236px;left:510px;white-space:nowrap" class="ft12">
                <i><b>Payment Fee</b></i>
            </p>
            <p style="position:absolute;top:258px;left:430px;white-space:nowrap" class="ft13">Biaya Instalasi</p>
            <p style="position:absolute;top:259px;left:490px;white-space:nowrap" class="ft14">
                <i>Installation Fee </i>
            </p>
            <p style="position:absolute;top:258px;left:584px;white-space:nowrap" class="ft13">Rp</p>
            <p style="position:absolute;top:258px;right:180px;white-space:nowrap" class="ft13">{?}</p>
            <p style="position:absolute;top:258px;left:720px;white-space:nowrap" class="ft13">PPN 11%</p>
            <p style="position:absolute;top:259px;left:762px;white-space:nowrap" class="ft16">VAT 11%</p>
            <p style="position:absolute;top:258px;left:800px;white-space:nowrap" class="ft13">Rp</p>
            <p style="position:absolute;top:258px;right:10px;white-space:nowrap" class="ft13">{?}</p>
            <p style="position:absolute;top:279px;left:430px;white-space:nowrap" class="ft13">Biaya Bulanan</p>
            <p style="position:absolute;top:280px;left:490px;white-space:nowrap" class="ft14">
                <i>Monthly Fee</i>
            </p>
            <p style="position:absolute;top:279px;left:584px;white-space:nowrap" class="ft13">Rp</p>
            <p style="position:absolute;top:279px;right:180px;white-space:nowrap" class="ft13">{Tagihan}</p>
            <p style="position:absolute;top:279px;left:720px;white-space:nowrap" class="ft13">PPN 11%</p>
            <p style="position:absolute;top:280px;left:762px;white-space:nowrap" class="ft16">VAT 11%</p>
            <p style="position:absolute;top:279px;left:800px;white-space:nowrap" class="ft13">Rp</p>
            <p style="position:absolute;top:279px;right:10px;white-space:nowrap" class="ft13">{TagihanTotal}</p>
            <p style="position:absolute;top:317px;left:430px;white-space:nowrap" class="ft11">
                <b>Jumlah</b>
            </p>
            <p style="position:absolute;top:318px;left:465px;white-space:nowrap" class="ft12">
                <i><b>Amount</b></i>
            </p>
            <p style="position:absolute;top:317px;left:710px;white-space:nowrap" class="ft13">Rp</p>
            <p style="position:absolute;top:317px;right:10px;white-space:nowrap" class="ft13">{Total}</p>
            <p style="position:absolute;top:360px;left:430px;white-space:nowrap" class="ft13">Tanggal Jatuh Tempo
                Pembayaran (setiap bulan)</p>
            <p style="position:absolute;top:370px;left:430px;white-space:nowrap" class="ft14">
                <i>Date Payment (monthly)</i>
            </p>
            <p style="position:absolute;top:360px;left:680px;white-space:nowrap" class="ft14">
                <i>Due</i>
            </p>
            <p style="position:absolute;top:360px;left:751px;white-space:nowrap" class="ft13">7 days after invoice
                recived</p>
            {{-- 2 --}}
            {{-- 3 --}}
            <p style="position:absolute;top:422px;left:25px;white-space:nowrap" class="ft11">
                <b>Penanggung Jawab Perusahaan</b>
            </p>
            <p style="position:absolute;top:423px;left:155px;white-space:nowrap" class="ft12">
                <i><b>Company Responsibilities</b></i>
            </p>
            <p style="position:absolute;top:445px;left:25px;white-space:nowrap" class="ft13">Nama</p>
            <p style="position:absolute;top:446px;left:50px;white-space:nowrap" class="ft14">
                <i>Name</i>
            </p>
            <p style="position:absolute;top:445px;left:96px;white-space:nowrap" class="ft13">
                {Nama}
            </p>
            <p style="position:absolute;top:445px;left:235px;white-space:nowrap" class="ft13">Jabatan</p>
            <p style="position:absolute;top:446px;left:265px;white-space:nowrap" class="ft14">
                <i>Position</i>
            </p>
            <p style="position:absolute;top:445px;left:305px;white-space:nowrap" class="ft13">
                {?}
            </p>
            <p style="position:absolute;top:465px;left:25px;white-space:nowrap" class="ft13">No. Handphone</p>
            <p style="position:absolute;top:465px;left:96px;white-space:nowrap" class="ft13">{No. Telp}</p>
            <p style="position:absolute;top:465px;left:235px;white-space:nowrap" class="ft13">Email</p>
            <p style="position:absolute;top:466px;left:260px;white-space:nowrap" class="ft14"><i>E-Mail</i></p>
            <p style="position:absolute;top:461px;left:310px;white-space:nowrap" class="ft13">{Email}</p>
            {{-- 2 --}}
            {{-- 3 --}}
            <p style="position:absolute;top:422px;left:430px;white-space:nowrap" class="ft11">
                <b>Jangka Waktu Berlangganan</b>
            </p>
            <p style="position:absolute;top:423px;left:550px;white-space:nowrap" class="ft12">
                <i><b>Subscription Period</b></i>
            </p>
            <p style="position:absolute;top:445px;left:430px;white-space:nowrap" class="ft13">
                Jangka Waktu Berlangganan </p>
            <p style="position:absolute;top:446px;left:535px;white-space:nowrap" class="ft14">
                <i>Subscription Period </i>
            </p>
            <p style="position:absolute;top:445px;left:660px;white-space:nowrap" class="ft13">12</p>
            <p style="position:absolute;top:445px;left:715px;white-space:nowrap" class="ft13">Bulan</p>
            <p style="position:absolute;top:446px;left:741px;white-space:nowrap" class="ft14">Month</p>
            <p style="position:absolute;top:445px;left:761px;white-space:nowrap" class="ft13">/</p>
            <p style="position:absolute;top:445px;left:779px;white-space:nowrap" class="ft13">1</p>
            <p style="position:absolute;top:445px;left:805px;white-space:nowrap" class="ft13">Tahun</p>
            <p style="position:absolute;top:446px;left:831px;white-space:nowrap" class="ft14">Year</p>
            {{-- 3 --}}
            {{-- 4 --}}
            <p style="position:absolute;top:485px;left:430px;white-space:nowrap" class="ft11">
                <b>Pusat Operasi Jaringan</b>
            </p>
            <p style="position:absolute;top:486px;left:530px;white-space:nowrap" class="ft12">
                <i><b>Network Operating Center (NOC)</b></i>
            </p>
            <p style="position:absolute;top:506px;left:430px;white-space:nowrap" class="ft13">Telepon </p>
            <p style="position:absolute;top:507px;left:463px;white-space:nowrap" class="ft14">
                <i>Phone</i>
            </p>
            <p style="position:absolute;top:506px;left:490px;white-space:nowrap" class="ft13">
                <i>0342 5650444</i>
            </p>
            <p style="position:absolute;top:506px;left:595px;white-space:nowrap" class="ft13">Telepon Seluler Cell Phone
            </p>
            <p style="position:absolute;top:506px;left:700px;white-space:nowrap" class="ft13">082231316699</p>
            <p style="position:absolute;top:525px;left:430px;white-space:nowrap" class="ft13">WhatsApp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 082231316699</p>
            <p style="position:absolute;top:525px;left:595px;white-space:nowrap" class="ft13">Email</p>
            <p style="position:absolute;top:526px;left:620px;white-space:nowrap" class="ft14">E-Mail</p>
            <p style="position:absolute;top:525px;left:685px;white-space:nowrap" class="ft13">admin@dbn.net.id</p>
            {{-- 4 --}}
            {{-- 5 --}}
            <p style="position:absolute;top:505px;left:25px;white-space:nowrap" class="ft11">
                <b>Penanggung Jawab Teknis</b>
            </p>
            <p style="position:absolute;top:506px;left:130px;white-space:nowrap" class="ft12">
                <i><b>Technical Responsibilities</b></i>
            </p>
            <p style="position:absolute;top:527px;left:25px;white-space:nowrap" class="ft13">Nama</p>
            <p style="position:absolute;top:528px;left:45px;white-space:nowrap" class="ft14">
                <i>Name</i>
            </p>
            <p style="position:absolute;top:528px;left:100px;white-space:nowrap" class="ft13">{Nama}</p>
            <p style="position:absolute;top:527px;left:235px;white-space:nowrap" class="ft13">Jabatan</p>
            <p style="position:absolute;top:528px;left:265px;white-space:nowrap" class="ft14">
                <i>Position</i>
            </p>
            <p style="position:absolute;top:528px;left:305px;white-space:nowrap" class="ft13">{?}</p>
            <p style="position:absolute;top:547px;left:25px;white-space:nowrap" class="ft13">No. Handphone</p>
            <p style="position:absolute;top:548px;left:100px;white-space:nowrap" class="ft13">{No. Telp}</p>
            <p style="position:absolute;top:547px;left:235px;white-space:nowrap" class="ft13">Email</p>
            <p style="position:absolute;top:548px;left:260px;white-space:nowrap" class="ft14"><i>E-Mail</i></p>
            <p style="position:absolute;top:547px;left:305px;white-space:nowrap" class="ft13">{Email}</p>
            {{-- 5 --}}
            {{-- 6 --}}
            <p style="position:absolute;top:568px;left:430px;white-space:nowrap" class="ft11">
                <b>Keuangan </b>
            </p>
            <p style="position:absolute;top:569px;left:474px;white-space:nowrap" class="ft12">
                <i><b>Finance</b></i>
            </p>
            <p style="position:absolute;top:588px;left:430px;white-space:nowrap" class="ft13">Telepon</p>
            <p style="position:absolute;top:589px;left:463px;white-space:nowrap" class="ft14">
                <i>Phone</i>
            </p>
            <p style="position:absolute;top:589px;left:485px;white-space:nowrap" class="ft13">
                <i>082231316699</i>
            </p>
            <p style="position:absolute;top:588px;left:545px;white-space:nowrap" class="ft13"><i>Email</i></p>
            <p style="position:absolute;top:589px;left:570px;white-space:nowrap" class="ft14"><i>E-Mail</i>
            </p>
            <p style="position:absolute;top:588px;left:595px;white-space:nowrap" class="ft13"><i>reza@dbn.net.id</i></p>
            {{-- 6 --}}
            {{-- 7 --}}
            <p style="position:absolute;top:589px;left:25px;white-space:nowrap" class="ft11">
                <b>Informasi Pembayaran </b>
            </p>
            <p style="position:absolute;top:590px;left:120px;white-space:nowrap" class="ft12">
                <i><b>Payment Information</b></i>
            </p>
            <p style="position:absolute;top:610px;left:25px;white-space:nowrap" class="ft13">Penanggung Jwb Keuangan</p>
            <p style="position:absolute;top:611px;left:130px;white-space:nowrap" class="ft14">
                <i>Financial Responsibilities </i>
            </p>
            <p style="position:absolute;top:610px;left:230px;white-space:nowrap" class="ft13">{Nama}</p>
            <p style="position:absolute;top:632px;left:25px;white-space:nowrap" class="ft13">Alamat Penagihan</p>
            <p style="position:absolute;top:633px;left:95px;white-space:nowrap" class="ft14">
                <i>Billing Address</i>
            </p>
            <p style="position:absolute;top:632px;left:175px;white-space:nowrap" class="ft13">{Alamat}</p>
            <p style="position:absolute;top:652px;left:240px;white-space:nowrap" class="ft13">Kota</p>
            <p style="position:absolute;top:653px;left:263px;white-space:nowrap" class="ft14">
                <i>City</i>
            </p>
            <p style="position:absolute;top:652px;left:305px;white-space:nowrap" class="ft13">{Kota}</p>
            <p style="position:absolute;top:673px;left:25px;white-space:nowrap" class="ft13">Provinsi</p>
            <p style="position:absolute;top:674px;left:60px;white-space:nowrap" class="ft14">
                <i>Province</i>
            </p>
            <p style="position:absolute;top:673px;left:100px;white-space:nowrap" class="ft13">{Provinsi}</p>
            <p style="position:absolute;top:673px;left:240px;white-space:nowrap" class="ft13">Kode Pos</p>
            <p style="position:absolute;top:674px;left:280px;white-space:nowrap" class="ft14">
                <i>Postal Code</i>
            </p>
            <p style="position:absolute;top:673px;left:330px;white-space:nowrap" class="ft13">{KodePos}</p>
            <p style="position:absolute;top:694px;left:25px;white-space:nowrap" class="ft13">Telepon</p>
            <p style="position:absolute;top:695px;left:60px;white-space:nowrap" class="ft14">
                <i>Phone</i>
            </p>
            <p style="position:absolute;top:694px;left:100px;white-space:nowrap" class="ft13">{No. Telp}</p>
            <p style="position:absolute;top:694px;left:240px;white-space:nowrap" class="ft13">Email </p>
            <p style="position:absolute;top:695px;left:265px;white-space:nowrap" class="ft14"><i>E-Mail </i></p>
            <p style="position:absolute;top:694px;left:305px;white-space:nowrap" class="ft13">{Email}</p>
            {{-- 7 --}}
            {{-- 8 --}}
            <p style="position:absolute;top:630px;left:430px;white-space:nowrap" class="ft11">
                <b>Tata Cara Pembayaran </b>
            </p>
            <p style="position:absolute;top:631px;left:525px;white-space:nowrap" class="ft12">
                <i><b>Procedure of Payment</b></i>
            </p>
            <p style="position:absolute;top:655px;left:430px;white-space:nowrap" class="ft13">Pembayaran dilakukan
                dengan cara transfer ke rekening :</p>
            <p style="position:absolute;top:670px;left:430px;white-space:nowrap" class="ft15">Payment is made by
                transfer to account DBN :</p>
            <p style="position:absolute;top:695px;left:430px;white-space:nowrap" class="ft11">
                <b>Pembayaran dengan PPN</b>
            </p>
            <p style="position:absolute;top:696px;left:532px;white-space:nowrap" class="ft12">
                <i><b>Payment with VAT</b></i>
            </p>
            <p style="position:absolute;top:714px;left:425px;white-space:nowrap" class="ft11">
                <b>Cek (X)</b>
            </p>
            <p style="position:absolute;top:714px;left:520px;white-space:nowrap" class="ft11">
                <b>Bank</b>
            </p>
            <p style="position:absolute;top:715px;left:547px;white-space:nowrap" class="ft12">
                <i><b>Bank</b></i>
            </p>
            <p style="position:absolute;top:714px;left:652px;white-space:nowrap" class="ft11">
                <b>Cabang</b>
            </p>
            <p style="position:absolute;top:715px;left:687px;white-space:nowrap" class="ft12">
                <i><b>Branch</b></i>
            </p>
            <p style="position:absolute;top:714px;left:760px;white-space:nowrap" class="ft11">
                <b>No. Rekening </b>
            </p>
            <p style="position:absolute;top:715px;left:820px;white-space:nowrap" class="ft110">
                <b>Account Number</b>
            </p>
            <p style="position:absolute;top:735px;left:495px;white-space:nowrap" class="ft13">Bank Central Asia (BCA)
            </p>
            <p style="position:absolute;top:735px;left:655px;white-space:nowrap" class="ft13">KCU BLITAR</p>
            <p style="position:absolute;top:735px;left:785px;white-space:nowrap" class="ft13">0901696399</p>
            <p style="position:absolute;top:820px;left:430px;white-space:nowrap" class="ft13">
                *Atas Nama On Behalf : PT DATA BUANA NUSANTARA</p>
            <p style="position:absolute;top:840px;left:430px;white-space:nowrap" class="ft11">
                <b>Kelengkapan Dokumen</b>
            </p>
            <p style="position:absolute;top:841px;left:525px;white-space:nowrap" class="ft12">
                <i><b>Completeness of Document</b></i>
            </p>
            <p style="position:absolute;top:855px;left:430px;white-space:nowrap" class="ft13">
                - Fotokopi KTP Penanggung Jawab</p>
            <p style="position:absolute;top:856px;left:560px;white-space:nowrap" class="ft14">
                <i>Copy of Person in Charge ID</i>
            </p>
            <p style="position:absolute;top:870px;left:430px;white-space:nowrap" class="ft13">
                - Fotokopi NPWP Perusahaan</p>
            <p style="position:absolute;top:871px;left:540px;white-space:nowrap" class="ft14">
                <i>Copy of Company Tax Registrated Number</i>
            </p>
            <p style="position:absolute;top:885px;left:430px;white-space:nowrap" class="ft13">
                - Fotokopi Akta Pendirian Perusahaan</p>
            <p style="position:absolute;top:886px;left:570px;white-space:nowrap" class="ft14">
                <i>Copy of Deed of Establishment</i>
            </p>
            <p style="position:absolute;top:900px;left:430px;white-space:nowrap" class="ft13">
                - Fotokopi Surat Izin Pengelola Gedung</p>
            <p style="position:absolute;top:901px;left:575px;white-space:nowrap" class="ft14">
                <i>Copy of Building Management License</i>
            </p>
            {{-- 8 --}}
            {{-- 9 --}}
            <p style="position:absolute;top:735px;left:25px;white-space:nowrap" class="ft11">
                <b>INFORMASI LAYANAN</b>
            </p>
            <p style="position:absolute;top:736px;left:130px;white-space:nowrap" class="ft12">
                <i><b>SERVICE INFORMATION</b></i>
            </p>
            <p style="position:absolute;top:755px;left:25px;white-space:nowrap" class="ft11">
                <b>Network ID</b>
            </p>
            <p style="position:absolute;top:756px;left:150px;white-space:nowrap" class="ft11">
                <b>{?}</b>
            </p>
            <p style="position:absolute;top:777px;left:25px;white-space:nowrap" class="ft11"><b>Lokasi Akhir</b>
            </p>
            <p style="position:absolute;top:778px;left:80px;white-space:nowrap" class="ft12">
                <i><b>Terminating</b></i>
            </p>
            <p style="position:absolute;top:777px;left:180px;white-space:nowrap" class="ft11"><b>{?}</b></p>
            <p style="position:absolute;top:798px;left:25px;white-space:nowrap" class="ft13">Alamat</p>
            <p style="position:absolute;top:799px;left:55px;white-space:nowrap" class="ft14">
                <i>Address</i>
            </p>
            <p style="position:absolute;top:820px;left:25px;white-space:nowrap" class="ft13">Kontak Person</p>
            <p style="position:absolute;top:821px;left:80px;white-space:nowrap" class="ft14">
                <i>Contact Person</i>
            </p>
            <p style="position:absolute;top:840px;left:25px;white-space:nowrap" class="ft13">Layanan</p>
            <p style="position:absolute;top:841px;left:60px;white-space:nowrap" class="ft14">
                <i>Service</i>
            </p>
            <p style="position:absolute;top:840px;left:130px;white-space:nowrap" class="ft13">BANDWITH</p>
            <p style="position:absolute;top:840px;left:235px;white-space:nowrap" class="ft13">Link Utama</p>
            <p style="position:absolute;top:841px;left:280px;white-space:nowrap" class="ft14">
                <i>Prime Link</i>
            </p>
            <p style="position:absolute;top:860px;left:25px;white-space:nowrap" class="ft13">Kapasitas</p>
            <p style="position:absolute;top:861px;left:65px;white-space:nowrap" class="ft14">
                <i>Capacity</i>
            </p>
            <p style="position:absolute;top:860px;left:130px;white-space:nowrap" class="ft13">{Bandwidth}</p>
            <p style="position:absolute;top:860px;left:235px;white-space:nowrap" class="ft13">Link Cadangan</p>
            <p style="position:absolute;top:861px;left:295px;white-space:nowrap" class="ft14">
                <i>Backup Link</i>
            </p>
            <p style="position:absolute;top:882px;left:25px;white-space:nowrap" class="ft13">Siap Berlayanan</p>
            <p style="position:absolute;top:883px;left:90px;white-space:nowrap" class="ft14">
                <i>Ready For Service</i>
            </p>
            <p style="position:absolute;top:882px;left:235px;white-space:nowrap" class="ft13">Tambahan</p>
            <p style="position:absolute;top:883px;left:276px;white-space:nowrap" class="ft14">
                <i>Additional</i>
            </p>
            {{-- 9 --}}
            {{-- 10 --}}
            <p style="position:absolute;top:970px;left:25px;white-space:nowrap" class="ft13">
                Dengan ini kami menyatakan bahwa informasi yang kami berikan adalah benar adanya dan bersedia mematuhi
                ketentuan dan syarat berlangganan sebagaimana diuraikan.
            </p>
            <p style="position:absolute;top:985px;left:25px;white-space:nowrap" class="ft14">
                <i> We hereby declare that the information we provide is true and willing to comply with the terms and
                    conditions of the subscription as described.
                </i>
            </p>
            <p style="position:absolute;top:1025px;left:25px;white-space:nowrap" class="ft13">Tanggal </p>
            <p style="position:absolute;top:1026px;left:60px;white-space:nowrap" class="ft14">
                <i>Date</i>
            </p>
            <p style="position:absolute;top:1025px;left:100px;white-space:nowrap" class="ft13">{?}</p>
            <p style="position:absolute;top:1025px;left:625px;white-space:nowrap" class="ft13">Tanggal</p>
            <p style="position:absolute;top:1026px;left:660px;white-space:nowrap" class="ft14">
                <i>Date</i>
            </p>
            <p style="position:absolute;top:1025px;left:680px;white-space:nowrap" class="ft13">{?}</p>
            <p style="position:absolute;top:1050px;left:25px;white-space:nowrap" class="ft13">
                <b>Pelanggan </b>
            </p>
            <p style="position:absolute;top:1051px;left:75px;white-space:nowrap" class="ft14"><i><b>Customer,</b></i></p>
            <p style="position:absolute;top:1110px;left:52px;white-space:nowrap" class="ft13">Materai 10000</p>
            <p style="position:absolute;top:1180px;left:30px;white-space:nowrap" class="ft13">{Nama}</p>
            <p style="position:absolute;top:1050px;left:625px;white-space:nowrap" class="ft11"><b>Direktur</b></p>
            <p style="position:absolute;top:1180px;left:640px;white-space:nowrap" class="ft11">
                <b>Muhammad Khotib</b>
            </p>
            <p style="position:absolute;top:1230px;left:25px;white-space:nowrap" class="ft15">
                * Nama, Tanda Tangan dan Stempel Perusahaan <i>* Name, Signature and Company Stamp</i>
            </p>
            {{-- 10 --}}
            {{-- 11 --}}
            <p style="position:absolute;top:1270px;left:25px;white-space:nowrap" class="ft113">
                <b>PT DATA BUANA NUSANTARA<br /></b>Head Office : Ds Tawangrejo Kec. Wonodadi Kab Blitar<br />Marketing
                Office : Ds Tawangrejo Kec. Wonodadi Kab Blitar<br />Network Office : Ds Tawangrejo Kec. Wonodadi Kab
                Blitar<br />Hunting : (0342) 5650444<br />Website : www.dbn.net.id
            </p>
            {{-- 11 --}}
        </div>
    </div>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                $("#print-button").click(function() {
                    var printContents = document.getElementById("print_out").innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                });
            });
        </script>
    @endpush
@endsection
